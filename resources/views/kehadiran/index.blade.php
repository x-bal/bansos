@extends('layouts.master', ['title' => 'Data Kehadiran Warga'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Kehadiran Warga</h4>
    </div>
    <div class="card-body">
        <form action="" method="get">
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mulai">Mulai</label>
                        <input type="date" name="mulai" id="mulai" class="form-control" value="{{ request('mulai') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sampai">Sampai</label>
                        <input type="date" name="sampai" id="sampai" class="form-control" value="{{ request('sampai') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="jenis">Jenis Bantuan</label>
                        <select name="jenis" id="jenis" class="form-control">
                            <option value="semua">Semua</option>
                            @foreach($jenis as $jns)
                            <option {{ $jns->id == request('jenis') ? 'selected' : '' }} value="{{ $jns->id }}">{{ $jns->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-4">Tampil</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Bantuan</th>
                        <th>Waktu</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($kehadiran as $hadir)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $hadir->warga->nik }}</td>
                        <td>{{ $hadir->warga->nama }}</td>
                        <td>{{ $hadir->jenis->nama }}</td>
                        <td>{{ $hadir->waktu }}</td>
                        <td>{{ $hadir->ket }}</td>
                        <td>
                            <a href="{{ route('kehadiran.edit', $hadir->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@push('script')
<script>
    $(document).ready(function() {
        var table = $('.table').DataTable({
            responsive: {
                details: {
                    type: 'column'
                }
            },
            columnDefs: [{
                    className: 'dtr-control',
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 2,
                    targets: 1
                }
            ]
        });

        new $.fn.dataTable.FixedHeader(table);
    });
</script>
@endpush