@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-6">
        <h1>{{ $tweet->tweet }}</h1>
        <h4>{{ date('j/m/Y H:i:s', strtotime($tweet->created_at)) }}</h4>
    </div>
    <div class="col-md-6">
        <ul class="media-list media-list-33">
            @include('layouts.partials.membersList', ['members' => $knessetMembers])
        </ul>
    </div>
</div>
@stop