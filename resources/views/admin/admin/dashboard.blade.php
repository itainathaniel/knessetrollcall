@extends('admin.layout')

@section('content')
    <h1 class="page-header">Dashboard</h1>

    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
    </div>

    <h2 class="sub-header">Latest Users</h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th rowspan="2">#</th>
                <th rowspan="2">Name</th>
                <th rowspan="2">Email</th>
                <th rowspan="2">Verified</th>
                <th rowspan="2">Join date</th>
                <th colspan="3">Email Digest</th>
            </tr>
            <tr>
                <th>Daily</th>
                <th>Weekly</th>
                <th>Monthly</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->verified }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                                    <span class="glyphicon
                                    @if ($user->mail_daily)
                                            glyphicon-ok
                                        @else
                                            glyphicon-remove
                                        @endif
                                            " aria-hidden="true"></span>
                    </td>
                    <td>
                                    <span class="glyphicon
                                    @if ($user->mail_weekly)
                                            glyphicon-ok
                                        @else
                                            glyphicon-remove
                                        @endif
                                            " aria-hidden="true"></span>
                    </td>
                    <td>
                                    <span class="glyphicon
                                    @if ($user->mail_monthly)
                                            glyphicon-ok
                                        @else
                                            glyphicon-remove
                                        @endif
                                            " aria-hidden="true"></span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop