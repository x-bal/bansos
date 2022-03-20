<div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" value="{{ $jeni->nama ?? old('nama') }}">

    @error('nama')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>