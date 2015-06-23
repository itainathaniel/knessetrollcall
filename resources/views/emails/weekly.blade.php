@extends('email')

<h1>{{ $report_title }}</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>שם</th>
            <th>מפלגה</th>
            <th>דקות אתמול</th>
            <th>דקות השבוע</th>
            <th>שעות השבוע</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr @if($member->presence_yesterday()==0)class="danger"@endif>
                <td>{{ $member->name }}</td>
                <td>{{ $member->party->name }}</td>
                <td>{{ $member->presence_yesterday() }}</td>
                <td>{{ $member->presence_week() }}</td>
                <td>{{ ($member->presence_week()/60) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>