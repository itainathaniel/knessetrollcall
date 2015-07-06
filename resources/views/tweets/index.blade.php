@extends('layouts.default')

@section('content')
<div class="row">
    <div class="col-md-3">
        <h1>ציוצים</h1>

        <div class="row users-sniplet">
            @include('layouts.partials.membersList', ['members' => $tweets])
        </div>
    </div>
</div>
@stop