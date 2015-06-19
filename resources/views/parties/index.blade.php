@extends('layouts.default')

@section('title')
    | {{ Lang::get('parties.title') }}
@stop

@section('nav-active-parties')
    class="active"
@stop

@section('content')
<div class="row">
    <div class="col-md-3 user-block">
        <h1>כל המפלגות</h1>

        <ul class="list-group">
            @foreach($parties as $party)
                @if(count($party->knessetmembers) > 0)
                    <li class="list-group-item">
                        <span class="badge">{{ count($party->knessetmembers) }}</span>
                        {!! link_to_route('party_path', $party->name, ['id' => $party->id]) !!}
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
</div>
@stop
