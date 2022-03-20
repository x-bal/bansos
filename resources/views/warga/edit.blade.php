@extends('layouts.master', ['title' => 'Edit Warga'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Edit Data Warga</h4>
        <a href="{{ route('warga.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('warga.update', $warga->id) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            @include('warga.form')
        </form>
    </div>
</div>
@stop

@push('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });

    setInterval(function() {
        $.ajax({
            url: '{{ route("rfid.show") }}',
            type: 'GET',
            success: function(response) {
                $("#rfid").val("");
                $("#rfid").val(response.rfid.rfid);
            }
        }, 2000);
    })
</script>
@endpush