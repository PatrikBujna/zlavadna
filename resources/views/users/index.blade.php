<x-layouts.app :title="'Users'">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Users</h1>
    <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Add User</a>
  </div>

  <table class="table table-striped align-middle">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Teams</th>
        <th scope="col" class="text-end">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $user)
      <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
          @if($user->teams && $user->teams->count())
            {{ $user->teams->pluck('name')->join(', ') }}
          @else
            <span class="text-muted">—</span>
          @endif
        </td>
        <td class="text-end">
          <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
          <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this user?')">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
  <td colspan="5" class="text-center text-muted">No users yet.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</x-layouts.app>
