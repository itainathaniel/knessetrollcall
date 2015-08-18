@extends('admin.layout')

@section('content')
    <h1 class="page-header">Users</h1>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Knesset Members (Active)</th>
                    <th>Knesset Members (All)</th>
                    <th>Add date</th>
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
                    <td>{{ count($party->knessetMembers) }}</td>
                    <td>{{ $party->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop