<div class="form-group">
    <label for="nik">Nik</label>
    <input type="number" name="nik" id="nik" placeholder="Nik" class="form-control" value="{{ $warga->nik ?? old('nik') }}">

    @error('nik')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="rfid">Rfid</label>
    <input type="text" name="rfid" id="rfid" placeholder="Rfid" class="form-control" value="{{ $warga->rfid ?? old('rfid') }}">

    @error('rfid')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" placeholder="Nama" class="form-control" value="{{ $warga->nama ?? old('nama') }}">

    @error('nama')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="tempat_lahir">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" class="form-control" value="{{ $warga->tempat_lahir ?? old('tempat_lahir') }}">

    @error('tempat_lahir')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="tgl_lahir">Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir" class="form-control" value="{{ $warga->tgl_lahir ?? old('tgl_lahir') }}">

    @error('tgl_lahir')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" id="alamat" rows="3" class="form-control" placeholder="Alamat">{{ $warga->alamat ?? old('alamat') }}</textarea>

    @error('alamat')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="status_perkawinan">Status Perkawinan</label>
    <select name="status_perkawinan" id="status_perkawinan" class="form-control">
        <option disabled selected>-- Select Status Perkawinan --</option>
        <option {{ $warga->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }} value="Belum Menikah">Belum Menikah</option>
        <option {{ $warga->status_perkawinan == 'Menikah' ? 'selected' : '' }} value="Menikah">Menikah</option>
    </select>

    @error('status_perkawinan')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="agama">Agama</label>
    <select name="agama" id="agama" class="form-control">
        <option disabled selected>-- Select Agama --</option>
        <option {{ $warga->agama == 'Islam' ? 'selected' : '' }} value="Islam">Islam</option>
        <option {{ $warga->agama == 'Kristen' ? 'selected' : '' }} value="Kristen">Kristen</option>
        <option {{ $warga->agama == 'Katholik' ? 'selected' : '' }} value="Katholik">Katholik</option>
        <option {{ $warga->agama == 'Hindu' ? 'selected' : '' }} value="Hindu">Hindu</option>
        <option {{ $warga->agama == 'Buddha' ? 'selected' : '' }} value="Buddha">Buddha</option>
    </select>

    @error('agama')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="pekerjaan">Pekerjaan</label>
    <input type="text" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" class="form-control" value="{{ $warga->pekerjaan ?? old('pekerjaan') }}">

    @error('pekerjaan')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="photo">Photo</label>
    <input type="file" name="foto" id="photo" placeholder="photo" class="form-control">

    @error('photo')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>