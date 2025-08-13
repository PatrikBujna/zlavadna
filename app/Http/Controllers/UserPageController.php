<?php

namespace App\Http\Controllers;

use App\Factories\UserFactory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Handlers\User\StoreUserHandler;
use App\Handlers\User\UpdateUserHandler;
use App\Handlers\User\DestroyUserHandler;
use App\Handlers\Team\IndexTeamHandler;

class UserPageController extends Controller
{
    public function __construct(
        private UserFactory $userFactory,
        private StoreUserHandler $storeHandler,
        private UpdateUserHandler $updateHandler,
        private DestroyUserHandler $destroyHandler,
        private IndexTeamHandler $teamIndexHandler,
    ) {}

    public function index()
    {
        $users = $this->userFactory->getAllWithTeams();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $response = ($this->teamIndexHandler)();
        $teams = [];
        if ($response->getStatusCode() === 200) {
            $teams = collect($response->getData(true))
                ->map(fn ($t) => (object) $t)
                ->all();
        }

        return view('users.create', compact('teams'));
    }

    public function store(Request $request): RedirectResponse
    {
        $response = ($this->storeHandler)($request->all());

        if ($response->getStatusCode() === 201) {
            return redirect()->route('admin.users.index')->with('status', 'User created successfully.');
        }

        if ($response->getStatusCode() === 422) {
            $data = $response->getData(true);
            return back()->withErrors($data['errors'] ?? [])->withInput();
        }

        return back()->with('status', 'Unexpected error while creating user.');
    }

    public function edit(User $user)
    {
        $response = ($this->teamIndexHandler)();
        $teams = [];
        if ($response->getStatusCode() === 200) {
            $teams = collect($response->getData(true))
                ->map(fn ($t) => (object) $t)
                ->all();
        }
        $selectedTeamIds = $user->teams()->pluck('teams.id')->all();
        
        return view('users.edit', compact('user', 'teams', 'selectedTeamIds'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $response = ($this->updateHandler)($user, $request->all());

        if ($response->getStatusCode() === 200) {
            return redirect()
                ->route('admin.users.index')
                ->with('status', 'User updated successfully.');
        }

        if ($response->getStatusCode() === 422) {
            $data = $response->getData(true);

            return back()->withErrors($data['errors'] ?? [])->withInput();
        }

        return back()->with('status', 'Unexpected error while updating user.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $response = ($this->destroyHandler)($user);

        if ($response->getStatusCode() === 204) {
            return redirect()->route('admin.users.index')->with('status', 'User deleted.');
        }

        $data = $response->getData(true);
        $message = $data['message'] ?? 'User could not be deleted.';
        
        return redirect()->route('admin.users.index')->with('status', $message);
    }
}
