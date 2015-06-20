@extends('layouts.default')

@section('title', '| ' . Lang::get('contact.title'))

@section('head', '<link rel="profile" href="http://microformats.org/profile/hcard">')

@section('nav-active-contact', 'class="active"')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ Lang::get('contact.title') }}</h1>
            <div class="hcard text-right">
                <div class="fn">{{ Lang::get('contact.hcard.fn') }}</div>
                <div class="tel">{{ Lang::get('contact.hcard.tel') }}</div>
                <div class="email">{{ Lang::get('contact.hcard.email') }}</div>
                <div class="url"><a class="url" href="{{ Lang::get('contact.hcard.url') }}">{{ Lang::get('contact.hcard.url') }}</a></div>
            </div>
        </div>
    </div>
@stop