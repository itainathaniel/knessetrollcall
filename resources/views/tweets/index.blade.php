@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h1>ציוצים</h1>

        <ul class="list-group">
            @foreach($tweets as $tweet)
                <li class="list-group-item">
                    {{ $tweet->tweet }}
                    <p>{{ link_to_route('tweet_path', $tweet->created_at, ['id' => $tweet->id]) }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@stop