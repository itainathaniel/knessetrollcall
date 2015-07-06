@extends('layouts.default')

@section('title', ' | ' . $party->name)

@section('content')
<div class="row user-profile">
    <div class="col-md-4">
        <h1>{{ $party->name }} ({{ count($knessetMembers) }})</h1>
    </div>
    <div class="col-md-2 col-md-offset-2">
        <div class="presence presence-today">
            <p class="number">{{ Lang::get('knessetmember.show.x_hours', ['hours' => minutesToHours($today)] ) }}</p>
            <p class="text">{{ Lang::get('knessetmember.show.today') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="presence presence-today">
            <p class="number">{{ Lang::get('knessetmember.show.x_hours', ['hours' => minutesToHours($week)] ) }}</p>
            <p class="text">{{ Lang::get('knessetmember.show.week') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="presence presence-today">
            <p class="number">{{ Lang::get('knessetmember.show.x_hours', ['hours' => minutesToHours($month)] ) }}</p>
            <p class="text">{{ Lang::get('knessetmember.show.month') }}</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row users-sniplet">
            @include('layouts.partials.membersList', ['members' => $knessetMembers, 'showRibbon' => true])
        </div>
    </div>
</div>
@stop