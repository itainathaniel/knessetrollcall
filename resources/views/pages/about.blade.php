@extends('layouts.default')

@section('title')
    | {{ Lang::get('about.title') }}
@stop

@section('nav-active-about')
    class="active"
@stop

@section('content')
    <div class="row">
        <h1>{{ Lang::get('about.title') }}</h1>
        <p>{{ Lang::get('about.text') }}</p>
    </div>
@stop