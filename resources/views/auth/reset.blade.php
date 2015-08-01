@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h1>רישום לאתר</h1>

            @include('layouts.partials.errors')

            <form method="POST" action="/password/reset">
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label for="email">דואר אלקטרוני:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">ססמה חדשה:</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">ססמה חדשה, שוב:</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">איפוס ססמה</button>
                </div>
            </form>
        </div>
    </div>
@stop