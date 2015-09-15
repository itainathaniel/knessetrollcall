@extends('layouts.default')

@section('nav-active-profile', 'class="active"')

@section('content')
    <div class="row">
        <div class="col-md-2 hide">
            <img src="http://www.gravatar.com/avatar/{{ md5($user->email) }}?s=150" class="img-circle">
        </div>
        <div class="col-md-4">
            <h2>{{ Lang::get('users.edit.header') }}</h2>
            @include('layouts.partials.errors')
            <form method="POST" action="/profile/edit">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">{{ Lang::get('users.edit.form.name_label') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">{{ Lang::get('users.edit.form.email_label') }}</label>
                    <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <h4>{{ Lang::get('users.edit.form.password_header') }}</h4>
                    <label for="password">{{ Lang::get('users.edit.form.password_label') }}</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation">{{ Lang::get('users.edit.form.password_confirmation_label') }}</label>
                    <input type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="mail_daily" value="1" @if($user->mail_daily == 1)checked="checked"@endif>{{ Lang::get('users.edit.form.mail_daily_label') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="mail_weekly" value="1" @if($user->mail_weekly == 1)checked="checked"@endif>{{ Lang::get('users.edit.form.mail_weekly_label') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="mail_monthly" value="1" @if($user->mail_monthly == 1)checked="checked"@endif>{{ Lang::get('users.edit.form.mail_monthly_label') }}
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="{{ Lang::get('users.edit.form.button_update') }}">
                </div>
            </form>
        </div>
    </div>
@stop