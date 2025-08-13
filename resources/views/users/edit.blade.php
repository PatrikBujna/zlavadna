<x-layouts.app :title="'Edit User'">
  <h1 class="h3 mb-3">Edit User</h1>
  <form action="{{ route('admin.users.update', $user) }}" method="POST" class="vstack gap-3" style="max-width: 520px;">
    @csrf
    @method('PUT')

    <div>
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
      @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="form-label">Password <span class="text-muted">(leave blank to keep)</span></label>
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div>
      <label class="form-label">Teams</label>
      <select name="team_ids[]" class="form-select" multiple size="5">
        @foreach($teams as $team)
          <option value="{{ $team->id }}" @selected(in_array($team->id, $selectedTeamIds))>{{ $team->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">Save</button>
  <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
    </div>
  </form>
</x-layouts.app>
