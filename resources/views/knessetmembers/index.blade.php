@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-3 user-block">
        <h1>כל חברי הכנסת</h1>

        <ul class="list-group">
            @foreach($members as $member)
                <li class="list-group-item"><a href="member/{{ $member->knesset_id }}">{{ $member->name }} - {{ $member->knesset_id }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@stop