@extends('admin.layout')

@section('content')
    <h1 class="page-header">מפלגות</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>שם</th>
                    <th>חברי כנסת פעילים</th>
                    <th>כל חברי הכנסת</th>
                    <th>תאריך הוספה</th>
                    <th>תאריך עדכון אחרון</th>
                </tr>
            </thead>
            <tbody>
            @foreach($parties as $party)
                <tr>
                    <td>
                        <a href="{{ action('Admin\PartiesController@edit', $party) }}">{{ $party->id }}</a>
                    </td>
                    <td>
                        <a href="{{ action('Admin\PartiesController@edit', $party) }}">{{ $party->name }}</a>
                    </td>
                    <td>{{ count($party->allknessetmembers) }}</td>
                    <td>
                        <a href="{{ action('Admin\KnessetMembersController@index') }}?party_id={{ $party->id }}">{{ count($party->knessetMembers) }}</a>
                    </td>
                    <td>{{ $party->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $party->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop