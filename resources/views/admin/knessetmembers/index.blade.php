@extends('admin.layout')

@section('content')
    <div class="page-header">
        <a href="#" class="btn btn-warning pull-left hide">סינון</a>
        <h1>חברי כנסת</h1>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>שם</th>
                <th>מפלגה</th>
                <th>בכנסת עכשיו?</th>
                <th>מספר בכנסת</th>
                <th>פעיל</th>
                <th>תאריך הוספה</th>
                <th>תאריך עדכון אחרון</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <a href="{{ action('Admin\KnessetMembersController@edit', $user) }}">{{ $user->id }}</a>
                    </td>
                    <td>
                        <a href="{{ action('Admin\KnessetMembersController@edit', $user) }}">{{ $user->name }}</a>
                    </td>
                    <td>
                        <a href="{{ action('Admin\PartiesController@edit', $user->party) }}">{{ $user->party->name }}</a>
                    </td>
                    <td>
                        @if ($user->isInside)
                            <span class="text-success glyphicon glyphicon-ok"></span>
                        @else
                            <span class="text-danger glyphicon glyphicon-remove"></span>
                        @endif
                    </td>
                    <td>
                        <a href="http://knesset.gov.il/mk/heb/mk.asp?mk_individual_id_t={{ $user->knesset_id }}" target="_blank">{{ $user->knesset_id }}</a>
                    </td>
                    <td>
                        @if ($user->active)
                            <span class="text-success glyphicon glyphicon-ok"></span>
                        @else
                            <span class="text-danger glyphicon glyphicon-remove"></span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop