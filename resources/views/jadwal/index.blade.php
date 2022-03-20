@extends('layouts.master', ['title' => 'Master Jadwal'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Jadwal</h4>
    </div>
    <div class="card-body">
        <a href="{{ route('jadwal.create') }}" class="btn btn-sm btn-primary mb-3"> Tambah Jadwal</a>

        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No</th>
                        <th>Jenis Bantuan</th>
                        <th>Tanggal</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jadwal as $jdw)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $jdw->jenis->nama }}</td>
                        <td>{{ Carbon\Carbon::parse($jdw->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('jadwal.edit', $jdw->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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

        $('.table').on('click', '.device', function() {
            let id = $(this).attr('id')

            if ($(this).is(':checked')) {
                let mode = 'SCAN'
            } else {
                let mode = 'ADD'
            }

            $.ajax({
                url: '/device/' + id,
                type: 'GET',
                data: {
                    mode: 'SCAN'
                },
                success: function(response) {
                    $(".label-" + response.device.id).empty()
                    $(".label-" + response.device.id).append('Scan')
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#4fbe87",
                    }).showToast();
                },
                error: function(response) {
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "right",
                        backgroundColor: "#dc3545",
                    }).showToast();
                }
            })
        });
    });
</script>
@endpush