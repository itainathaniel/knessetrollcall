@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>איפוס ססמה</h1>

            @include('layouts.partials.errors')

            <form method="POST" action="/password/email">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email">דואר אלקטרוני:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">שליחת דואר אלקטרוני לאיפוס ססמה</button>
                    <span class="help-block">עוד לא רשום לאתר? <a href="{{ url('/register') }}">לחץ כאן</a> כדי להרשם</span>
                </div>
            </form>
        </div>
    </div>
@stop