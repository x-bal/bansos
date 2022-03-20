@extends('layouts.master', ['title' => 'Create Warga'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Tambah Data Warga</h4>
        <a href="{{ route('warga.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('warga.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('warga.form')
        </form>
    </div>
</div>
@stop