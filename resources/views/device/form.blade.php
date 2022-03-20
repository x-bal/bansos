<div class="form-group">
    <label for="nama">Nama Device</label>
    <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" value="{{ $device->name ?? old('nama') }}">

    @error('nama')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>