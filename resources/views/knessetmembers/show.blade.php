@extends('layouts.default')

@section('title')
  {{ Lang::get('knessetmember.page-title') . $knessetMember->name }}
@stop

@section('content')
@if ($knessetMember->isInside)
<div class="row">
    <div class="alert alert-success text-center">
        עכשיו במשכן הכנסת, כבר
        {{ $lastEntranceSign }}
        שעות
    </div>
</div>
@endif
<div class="row user-profile">
    <div class="media col-md-4">
        <div class="media-image pull-right">
            <img src="http://www.knesset.gov.il/{{ $knessetMember->image_big() }}">
        </div>
        <h1 class="media-heading">{{ $knessetMember->name }}</h1>
        {{--<h3>{{ link_to_route('party_path', $knessetMember->party->name, ['id' => $knessetMember->party->id]) }}</h3>--}}
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
    <div class="col-md-12">
        <h3>{!! Lang::get('knessetmember.show.x_members_to_party_y', [
            'members' => count($sameParty),
            'party' => link_to_route('party_path', $knessetMember->party->name, ['id' => $knessetMember->party->id])
        ] ) !!}</h3>
        <ul class="media-list users-sniplet">
            @include('layouts.partials.membersList', ['members' => $sameParty, 'perRow' => 5])
        </ul>
    </div>
</div>
@stop