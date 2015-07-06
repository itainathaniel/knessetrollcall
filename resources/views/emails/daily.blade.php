@extends('email')

@section('content')
    <h1>{{ Lang::get('emails.daily-report.title', ['date' => $dates_title]) }}</h1>

    <h2>{{ Lang::get('emails.daily-report.absent', ['count' => count($absent)]) }}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ Lang::get('emails.daily-report.name') }}</th>
                <th>{{ Lang::get('emails.daily-report.party') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absent as $km)
                <tr>
                    <td>{{ $km->name }}</td>
                    <td>{{ $km->party->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>{{ Lang::get('emails.daily-report.present', ['count' => count($present)]) }}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ Lang::get('emails.daily-report.name') }}</th>
                <th>{{ Lang::get('emails.daily-report.party') }}</th>
                <th>{{ Lang::get('emails.daily-report.daily_minutes') }}</th>
                <th>{{ Lang::get('emails.daily-report.daily_hours') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($present as $km)
                <tr>
                    <td>{{ $km->knessetmember->name }}</td>
                    <td>{{ $km->knessetmember->party->name }}</td>
                    <td>{{ $km->minutes }}</td>
                    <td>{{ minutesToHours($km->minutes) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop