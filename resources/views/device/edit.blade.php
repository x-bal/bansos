@extends('layouts.master', ['title' => 'Edit Device'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Edit Device</h4>
        <a href="{{ route('device.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('device.update', $device->id) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            @include('device.form')
        </form>
    </div>
</div>
@stop