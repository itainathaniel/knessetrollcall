@extends('layouts.default')

@section('title', '| ' . Lang::get('about.title'))

@section('nav-active-about', 'class="active"')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ Lang::get('about.title') }}</h1>
            <p>{!! Lang::get('about.text') !!}</p>
        </div>
    </div>
@stop