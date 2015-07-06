@extends('layouts.default')

@section('title')
  {{ Lang::get('knessetmember.page-title') . $knessetMember->name }}
@stop

@section('content')
<div class="row user-profile">
    <div class="media col-md-6">
        <div class="media-image pull-right">
            <img src="http://www.knesset.gov.il/{{ $knessetMember->image_big() }}">
        </div>
        <h1 class="media-heading">{{ $knessetMember->name }}</h1>
        <h3>{!! link_to_route('party_path', $knessetMember->party->name, ['id' => $knessetMember->party->id]) !!}</h3>
    </div>
    <div class="col-md-6">
        <ul>
            @foreach($entranceLogs as $log)
                <li class="list-group-item">{{ Lang::choice('knessetmember.isInside', $log->isInside) }} {{ date(Lang::get('knessetmember.dateFormat'), strtotime($log->created_at)) }}</li>
            @endforeach
        </ul>
    </div>
</div>
@stop