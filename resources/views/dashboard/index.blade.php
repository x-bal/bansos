@extends('layouts.master', ['title' => 'Dashboard'])

@section('content')
<div class="card">
    <div class="card-body">
        Hello {{ auth()->user()->name }}, Welcome to website. <br>
        <span class="text-primary">Have a nice day :)</span>
    </div>
</div>
@stop