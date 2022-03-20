@extends('layouts.master', ['title' => 'Detail Data Warga'])

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Detail Data Warga</h4>
            </div>
            <div class="card-body row">
                <div class="col-md-2">
                    <div class="avatar avatar-xl me-3">
                        <img src="{{ asset('/storage/'. $warga->foto) }}" alt="" srcset="">
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="nik">Nik</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nik" id="nik" class="form-control" value="{{ $warga->nik }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="nama">Nama</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $warga->nama }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="ttl">TTL</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="ttl" id="ttl" class="form-control" value="{{ $warga->tempat_lahir }}, {{ Carbon\Carbon::parse($warga->tgl_lahir)->format('d-m-Y') }}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="alamat">Alamat</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="alamat" id="alamat" rows="3" class="form-control" disabled>{{ $warga->alamat }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Daftar Bantuan</h4>
            </div>

            <div class="card-body">
                <form action="{{ route('warga.update-bantuan', $warga->id) }}" method="post">
                    @csrf
                    <div class="row">
                        @foreach($jenis as $jns)
                        <div class="col-md-6">
                            <input type="checkbox" id="check-{{ $jns->id }}" class="form-check-input" name="jenis[]" value="{{ $jns->id }}" @if(in_array($jns->id, $warga->jenis()->pluck('jenis_id')->toArray())) checked @endif>
                            <label for="check-{{ $jns->id }}">{{ $jns->nama }}</label>
                        </div>
                        @endforeach
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
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