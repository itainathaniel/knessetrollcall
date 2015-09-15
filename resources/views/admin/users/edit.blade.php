@extends('admin.layout')

@section('content')
    <h1 class="page-header">{{ $user->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ action('Admin\UsersController@update', $user) }}">
                <input name="_method" type="hidden" value="PATCH">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">מספר</label>
                    <pre>{{ $user->id }}</pre>
                </div>
                <div class="form-group">
                    <label for="name">שם</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="name">דואר אלקטרוני</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="verified">מאומת</label>
                    <select name="verified" id="verified" class="form-control">
                        <option value="0" {{ $user->verified == 0 ? 'selected' : '' }}>לא</option>
                        <option value="1" {{ $user->verified == 1 ? 'selected' : '' }}>כן</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mail_daily">עדכון יומי</label>
                    <select name="mail_daily" id="mail_daily" class="form-control">
                        <option value="0" {{ $user->mail_daily == 0 ? 'selected' : '' }}>לא</option>
                        <option value="1" {{ $user->mail_daily == 1 ? 'selected' : '' }}>כן</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mail_weekly">עדכון שבועי</label>
                    <select name="mail_weekly" id="mail_weekly" class="form-control">
                        <option value="0" {{ $user->mail_weekly == 0 ? 'selected' : '' }}>לא</option>
                        <option value="1" {{ $user->mail_weekly == 1 ? 'selected' : '' }}>כן</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="mail_monthly">עדכון חודשי</label>
                    <select name="mail_monthly" id="mail_monthly" class="form-control">
                        <option value="0" {{ $user->mail_monthly == 0 ? 'selected' : '' }}>לא</option>
                        <option value="1" {{ $user->mail_monthly == 1 ? 'selected' : '' }}>כן</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">תאריך הוספה</label>
                    <pre>{{ $user->created_at->format('d/m/Y H:i:s') }}</pre>
                </div>
                <div class="form-group">
                    <label for="name">תאריך עדכון אחרון</label>
                    <pre>{{ $user->updated_at->format('d/m/Y H:i:s') }}</pre>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">שמירה</button>
                </div>
            </form>
        </div>
    </div>
@stop