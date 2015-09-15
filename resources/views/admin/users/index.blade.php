@extends ('admin.layout')

@section ('content')
    <div class="page-header">
        <h1>
            משתמשים
            <small class="pull-left">
                <a href="{{ action('Admin\UsersController@index') }}?admin=1">אדמין</a>
                <a href="{{ action('Admin\UsersController@index') }}?verified=0">לא מאומת</a>
                <a href="{{ action('Admin\UsersController@index') }}?mail_daily=1">עדכון יומי</a>
                <a href="{{ action('Admin\UsersController@index') }}?mail_weekly=1">עדכון שבועי</a>
                <a href="{{ action('Admin\UsersController@index') }}?mail_monthly=1">עדכון חודשי</a>
            </small>
        </h1>
    </div>

    <div class="table-responsive">
        @include ('admin.users._list')
    </div>
@stop