@extends('layouts.master', ['title' => 'Create Jenis'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Tambah Data Jenis</h4>
        <a href="{{ route('jenis.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('jenis.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('jenis.form')
        </form>
    </div>
</div>
@stop