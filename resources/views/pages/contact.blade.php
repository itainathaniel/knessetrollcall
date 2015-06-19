@extends('layouts.default')

@section('title')
    | {{ Lang::get('contact.title') }}
@stop

@section('head')
    <link rel="profile" href="http://microformats.org/profile/hcard">
@stop

@section('nav-active-contact')
    class="active"
@stop

@section('content')
    <div class="row">
        <div class="media col-md-2 col-md-offset-5">
            <h1>{{ Lang::get('contact.title') }}</h1>
            <div class="hcard">
                <div class="fn">{{ Lang::get('contact.hcard.fn') }}</div>
                <div class="tel">{{ Lang::get('contact.hcard.tel') }}</div>
                <div class="email">{{ Lang::get('contact.hcard.email') }}</div>
                <div class="url"><a class="url" href="{{ Lang::get('contact.hcard.url') }}">{{ Lang::get('contact.hcard.url') }}</a></div>
            </div>
        </div>
    </div>
@stop