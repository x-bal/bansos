@extends('layouts.master', ['title' => 'Data Kehadiran Warga'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Kehadiran Warga</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
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
                        <td>{{ $hadir->nama }}</td>
                        <td>{{ $hadir->nama }}</td>
                        <td>{{ $hadir->nama }}</td>
                        <td>{{ $hadir->nama }}</td>
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