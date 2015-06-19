@extends('layouts.default')

@section('title')
    | {{ $party->name }}
@stop

@section('content')
<div class="row user-profile">
    <div class="col-md-4">
        <h1>{{ $party->name }} ({{ count($knessetMembers) }})</h1>
    </div>
    <div class="col-md-2 col-md-offset-2">
        <div class="presence presence-today">
            <p class="number">{{ Lang::get('knessetmember.show.x_hours', ['hours' => round($today/60, 2)] ) }}</p>
            <p class="text">{{ Lang::get('knessetmember.show.today') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="presence presence-today">
            <p class="number">{{ Lang::get('knessetmember.show.x_hours', ['hours' => round($week/60, 2)] ) }}</p>
            <p class="text">{{ Lang::get('knessetmember.show.week') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="presence presence-today">
            <p class="number">{{ Lang::get('knessetmember.show.x_hours', ['hours' => round($month/60, 2)] ) }}</p>
            <p class="text">{{ Lang::get('knessetmember.show.month') }}</p>
        </div>
    </div>
</div>
<div class="row">
    {{--<div class="col-md-3">--}}
        {{--<h1>{{ $party->name }} ({{ count($knessetMembers) }})</h1>--}}
    {{--</div>--}}
    <div class="col-md-12">
        <ul class="media-list users-sniplet">
            @include('layouts.partials.membersList', ['members' => $knessetMembers, 'perRow' => 4])
        </ul>
    </div>
</div>
@stop