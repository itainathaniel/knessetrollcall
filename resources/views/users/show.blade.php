@extends('layouts.default')

@section('nav-active-profile', 'class="active"')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <img src="http://www.gravatar.com/avatar/{{ md5($user->email) }}?s=150">
        </div>
        <div class="col-md-6 col-md-offset-2">
            <h1 class="page-header">{{ $user->name }}</h1>
        </div>
    </div>
@stop