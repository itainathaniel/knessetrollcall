@extends('layouts.default')

@section('nav-active-profile', 'class="active"')

@section('content')
    <div class="row">
        <div class="col-md-2">
            <img src="http://www.gravatar.com/avatar/{{ md5($user->email) }}?s=150" class="img-circle">
        </div>
        <div class="col-md-6 col-md-offset-2">
            <h2>עריכת חשבון</h2>
            @include('layouts.partials.errors')
            <form method="POST" action="/profile/edit">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">שם:</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">דואר אלקטרוני:</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
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
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="mail_daily" value="1" @if($user->mail_daily == 1)checked="checked"@endif>קבלת עדכון יומי
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="mail_weekly" value="1" @if($user->mail_weekly == 1)checked="checked"@endif>קבלת עדכון שבועי
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="mail_monthly" value="1" @if($user->mail_monthly == 1)checked="checked"@endif>קבלת עדכון חודשי
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">עדכון</button>
                </div>
            </form>
        </div>
    </div>
@stop