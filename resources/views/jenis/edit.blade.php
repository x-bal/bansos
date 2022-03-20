@extends('layouts.master', ['title' => 'Edit jenis'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Edit jenis</h4>
        <a href="{{ route('jenis.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('jenis.update', $jeni->id) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            @include('jenis.form')
        </form>
    </div>
</div>
@stop