@extends('admin.layout')

@section('content')
    <h1 class="page-header">{{ $party->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ action('Admin\PartiesController@update', $party) }}">
                <input name="_method" type="hidden" value="PATCH">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">מספר</label>
                    <pre>{{ $party->id }}</pre>
                </div>
                <div class="form-group">
                    <label for="name">שם</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $party->name }}">
                </div>
                <div class="form-group">
                    <label for="name">הצטרפות</label>
                    <pre>{{ $party->created_at->format('d/m/Y H:i:s') }}</pre>
                </div>
                <div class="form-group">
                    <label for="name">עדכון</label>
                    <pre>{{ $party->updated_at->format('d/m/Y H:i:s') }}</pre>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">שמירה</button>
                </div>
            </form>
        </div>
    </div>
@stop