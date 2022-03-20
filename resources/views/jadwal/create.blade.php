@extends('layouts.master', ['title' => 'Create Jadwal'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Tambah Data Jadwal</h4>
        <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('jadwal.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('jadwal.form')
        </form>
    </div>
</div>
@stop