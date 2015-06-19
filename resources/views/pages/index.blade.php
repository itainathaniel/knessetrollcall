@extends('layouts.default')

@section('nav-active-index', 'class="active"')

@section('content')
    <div class="row isInside">
        <h2>{{ Lang::get('index.nowInside', ['count' => count($membersInside) ]) }}</h2>
        @foreach ($membersInside as $member)
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 media">
                <a class="media-center" href="{{ route('member_path', ['id' => $member->id]) }}">
                    <img src="http://www.knesset.gov.il/{{ $member->image }}" alt="{{ $member->name }}" class="img-thumbnail">
                </a>
                <a class="media-body" href="{{ route('member_path', ['id' => $member->id]) }}">
                    <h5 class="media-heading">{{ $member->name }}</h5>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row">
    	<div class="col-md-6">
            <h3>נכנסו לאחרונה</h3>
            @if (count($membersLatestIn))
                <ul class="media-list users-sniplet">
                    @include('layouts.partials.membersList', ['members' => $membersLatestIn, 'showTimes' => true, 'perRow' => 3])
                </ul>
            @else
                <div class="alert alert-warning" role="alert">לא נמצאו ח״כים שנכנסו לאחרונה</div>
            @endif
    	</div>
    	<div class="col-md-6">
    	    <h3>יצאו לאחרונה</h3>
    	    @if (count($membersLatestOut))
                <ul class="media-list users-sniplet">
                    @include('layouts.partials.membersList', ['members' => $membersLatestOut, 'showTimes' => true, 'perRow' => 3])
                </ul>
            @else
                <div class="alert alert-warning" role="alert">לא נמצאו ח״כים שיצאו לאחרונה</div>
            @endif
    	</div>
    </div>
@stop