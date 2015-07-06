@extends('layouts.default')

@section('nav-active-inside', 'class="active"')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ Lang::get('index.nowInside', ['count' => count($members) ]) }}</h1>

            <div class="users-sniplet">
                @include('layouts.partials.membersList', ['members' => $members])
            </div>
        </div>
    </div>
@stop