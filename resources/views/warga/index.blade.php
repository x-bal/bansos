@extends('layouts.master', ['title' => 'Master Warga'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Data Warga Active</h4>
    </div>
    <div class="card-body">
        <a href="{{ route('warga.create') }}" class="btn btn-sm btn-primary mb-3"> Tambah Warga</a>
        <button type="button" class="btn btn-sm btn-info mb-3" data-bs-toggle="modal" data-bs-target="#penerima-bantun">
            Tambah Penerima Bantuan
        </button>

        <div class="table-responsive">
            <table class="table-bordered table-striped table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>
                            <input class="form-check-input" type="checkbox" id="check-all">
                        </th>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Nik</th>
                        <th>Rfid</th>
                        <th>Nama Lengkap</th>
                        <th>Daftar Bantuan</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($warga as $wrg)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <input type="checkbox" class="form-check-input check-warga" data-id="{{ $wrg->id }}">
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="avatar avatar-l">
                                <img src="{{ asset('/storage/'. $wrg->foto) }}" alt="{{ $wrg->foto }}">
                            </div>
                        </td>
                        <td>{{ $wrg->nik }}</td>
                        <td>{{ $wrg->rfid }}</td>
                        <td>{{ $wrg->nama }}</td>
                        <td>
                            @foreach($wrg->jenis as $jn)
                            <input type="checkbox" id="check-{{ $jn->id }}" class="form-check-input" name="jenis[]" value="{{ $jn->id }}" checked disabled>
                            <label for="check-{{ $jn->id }}">{{ $jn->nama }}</label> <br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('warga.show', $wrg->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('warga.edit', $wrg->id) }}" class="btn btn-sm btn-success"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Basic Modal -->
<div class="modal fade text-left" id="penerima-bantun" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel1">Form Penerima Bantuan</h5>
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <form action="{{ route('warga.jenis') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="jenis">Jenis Bantuan</label>
                        </div>
                        @foreach($jenis as $jns)
                        <div class="col-md-6">
                            <input type="checkbox" id="check-{{ $jns->id }}" class="form-check-input" name="jenis[]" value="{{ $jns->id }}">
                            <label for="check-{{ $jns->id }}">{{ $jns->nama }}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="data-warga"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kembali</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Kirim</span>
                    </button>
                </div>
            </form>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#check-all").click(function() {
        $('.check-warga').not(this).prop('checked', this.checked);

        var ischecked = $(this).is(':checked');

        if (ischecked == true) {
            $.ajax({
                url: '{{ route("warga.get") }}',
                type: 'GET',
                success: function(response) {
                    $('.data-warga').empty()
                    $.each(response.warga, function(index, item) {
                        $('.data-warga').append('<input type="hidden" name="id[]" id="' + item.id + '" value="' + item.id + '"/>');
                    });
                }
            })
        } else {
            $.ajax({
                url: '{{ route("warga.get") }}',
                type: 'GET',
                success: function(response) {
                    $.each(response.warga, function(index, item) {
                        $('#' + item.id).remove();
                    });
                }
            })
        }
    });

    $('.table').on('click', '.check-warga', function() {
        var ischecked = $(this).is(':checked');
        let id = $(this).attr('data-id')
        console.log(id)
        if (ischecked == false) {
            $('#' + id).remove();
        } else {
            $('.data-warga').append('<input type="hidden" name="id[]" id="' + id + '" value="' + id + '"/>');
        }
    })
</script>
@endpush