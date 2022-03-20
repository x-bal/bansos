<div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="{{ $user->username ?? old('username') }}">

    @error('username')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" id="name" placeholder="Name" class="form-control" value="{{ $user->name ?? old('name') }}">

    @error('name')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Password" class="form-control" value="{{ old('password') }}">

    @error('password')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="role">Role</label>
    <select name="role" id="role" class="form-control">
        <option disabled selected>-- Select Role --</option>
        @foreach($roles as $role)
        <option {{ $user->getRoleNames()[0] == $role->name ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>

    @error('role')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" name="photo" id="photo" placeholder="photo" class="form-control" value="{{ $user->photo ?? old('photo') }}">

    @error('photo')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>