@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>רישום לאתר</h1>

            @include('layouts.partials.errors')

            <form method="POST" action="/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email">דואר אלקטרוני:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">ססמה:</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">התחברות</button>
                    <span class="help-block pull-left"><a href="{{ url('/password/email') }}">שכחתם ססמה?</a></span>
                    <span class="help-block">עוד לא רשומים לאתר? <a href="{{ url('/register') }}">לחצו כאן</a> כדי להרשם</span>
                </div>
            </form>
        </div>
    </div>
@stop