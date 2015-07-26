@extends('email')

@section('content')
    <h1>{{ Lang::get('emails.monthly-report.title', ['date' => $dates_title]) }}</h1>

    <h2>כמה מספרים</h2>

    <table class="table table-striped">
        <tbody>
        <tr>
            <td>דקות כוללות</td>
            <td>{{ $minutes }}</td>
        </tr>
        <tr>
            <td>שעות כוללות</td>
            <td>{{ minutesToHours($minutes) }}</td>
        </tr>
        <tr>
            <td>ממוצע דקות לח״כ</td>
            <td>{{ $minutesPerKM }}</td>
        </tr>
        <tr>
            <td>ממוצע שעות לח״כ</td>
            <td>{{ minutesToHours($minutesPerKM) }}</td>
        </tr>
        </tbody>
    </table>

    <h2>נוכחות לפי מפלגות</h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>מפלגה</th>
            <th>נכחו</th>
            <th>סך הכל דקות</th>
            <th>סך הכל שעות</th>
            <th>ממוצע דקות</th>
            <th>ממוצע שעות</th>
        </tr>
        </thead>
        <tbody>
        @foreach($parties as $party)
            <tr>
                <td>{{ $party['name'] }}</td>
                <td>{{ $party['members'] }}</td>
                <td>{{ $party['minutes'] }}</td>
                <td>{{ minutesToHours($party['minutes']) }}</td>
                <td>{{ round($party['minutes']/$party['members'],3) }}</td>
                <td>{{ minutesToHours(round($party['minutes']/$party['members'])) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>{{ Lang::get('emails.monthly-report.absent', ['count' => count($absent)]) }}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ Lang::get('emails.monthly-report.name') }}</th>
                <th>{{ Lang::get('emails.monthly-report.party') }}</th>
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

    <h2>{{ Lang::get('emails.monthly-report.present', ['count' => count($present)]) }}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ Lang::get('emails.monthly-report.name') }}</th>
                <th>{{ Lang::get('emails.monthly-report.party') }}</th>
                <th>{{ Lang::get('emails.monthly-report.monthly_minutes') }}</th>
                <th>{{ Lang::get('emails.monthly-report.monthly_hours') }}</th>
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