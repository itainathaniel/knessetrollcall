@extends('email')

<h1>{{ $report_title }}</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>שם</th>
            <th>מפלגה</th>
            <th>דקות השבוע</th>
            <th>שעות השבוע</th>
        </tr>
    </thead>
    <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->party_id }}</td>
                <td>{{ $member->presence_week() }}</td>
                <td>{{ ($member->presence_week()/60) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>