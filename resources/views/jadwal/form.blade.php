<div class="form-group">
    <label for="jenis">Jenis Bantuan</label>
    <select name="jenis" id="jenis" class="form-control">
        <option disabled selected>-- Pilih Jenis Bantuan --</option>
        @foreach($jenis as $jns)
        <option {{ $jns->id == $jadwal->jenis_id ? 'selected' : '' }} value="{{ $jns->id }}">{{ $jns->nama }}</option>
        @endforeach
    </select>

    @error('jenis')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="tanggal">Tanggal Bantuan</label>
    <input type="date" name="tanggal" id="tanggal" value="{{ $jadwal->tanggal }}" class="form-control">

    @error('tanggal')
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>