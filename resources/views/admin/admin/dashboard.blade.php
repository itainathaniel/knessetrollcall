@extends('admin.layout')

@section('content')
    <h1 class="page-header">{{ Lang::get('admin.title') }}</h1>

    <div class="row stats">
        <div class="col-xs-6 col-sm-3 text-center">
            <div class="stat">
                <span class="number">{{ $total_users }}</span>
                <h4>משתמשים</h4>
                <span class="text-muted">מתוכם {{ $total_users_admins }} אדמינים</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 text-center">
            <div class="stat">
                <span class="number">{{ $total_knessetmembers }}</span>
                <h4>חברי כנסת</h4>
                <span class="text-muted">מתוכם {{ $total_knessetmembers_inactive }} לא פעילים</span>
            </div>
        </div>
        <div class="col-xs-6 col-sm-3 text-center">
            <div class="stat">
                <span class="number">{{ $total_parties }}</span>
                <h4>מפלגות</h4>
                <span class="text-muted">מתוכן {{ $total_parties_coalition }} בקואליציה</span>
            </div>
        </div>
    </div>

    <h2 class="sub-header">משתמשים אחרונים</h2>
    <div class="table-responsive">
        @include ('admin.users._list')
    </div>
@stop