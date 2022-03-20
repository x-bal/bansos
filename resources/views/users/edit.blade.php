@extends('layouts.master', ['title' => 'Edit User'])

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Edit Data User</h4>
        <a href="{{ route('user.index') }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card-body">
        <form action="{{ route('user.update', $user->id) }}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            @include('users.form')
        </form>
    </div>
</div>
@stop