@extends('layouts.master', ['title' => 'Setting'])

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Setting</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('setting.update') }}" method="post" class="row">
            @csrf
            <div class="col-md-6">
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ $waktu->start }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $waktu->end }}">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

        <div class="row mt-3">
            <div class="col-md-12">
                <div class="alert alert-primary row">
                    <div class="col-md-1">
                        <i class="fas fa-key fa-2x"></i>
                    </div>
                    <div class="col-md-11">
                        <h4 class="alert-heading">Secret Key</h4>
                        <p>{{ $secretKey->key }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop