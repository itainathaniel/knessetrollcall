@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>{{ Lang::get('index.nowOutside', ['count' => count($members) ]) }}</h1>

        @foreach ($members as $member)
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
</div>
@stop