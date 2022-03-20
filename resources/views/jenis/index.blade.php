@extends('layouts.master', ['title' => 'Master Jenis'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Jenis</h4>
    </div>
    <div class="card-body">
        <a href="{{ route('jenis.create') }}" class="btn btn-sm btn-primary mb-3"> Tambah Jenis</a>

        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jenis as $jns)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jns->nama }}</td>
                        <td>
                            <a href="{{ route('jenis.edit', $jns->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
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