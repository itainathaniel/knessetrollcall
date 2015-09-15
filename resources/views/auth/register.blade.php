@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>רישום לאתר</h1>

            @include('layouts.partials.errors')

            <form method="POST" action="/register">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">שם:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="email">דואר אלקטרוני:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">ססמה:</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">אימות ססמה:</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">רישום</button>
                    <span class="help-block">כבר רשומים לאתר? <a href="{{ url('/login') }}">לחצו כאן</a> לעבור למסך התחברות</span>
                </div>
            </form>
        </div>
    </div>
@stop