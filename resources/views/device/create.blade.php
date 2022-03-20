@extends('layouts.master', ['title' => 'Create Device'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Tambah Data Device</h4>
        <a href="{{ route('device.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('device.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('device.form')
        </form>
    </div>
</div>
@stop