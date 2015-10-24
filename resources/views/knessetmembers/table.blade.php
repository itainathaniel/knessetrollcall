@extends('layouts.default')

@section('title', Lang::get('knessetmember.alltime_table.header'))

@section('nav-active-table', 'class="active"')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h1>{{ Lang::get('knessetmember.alltime_table.header') }}</h1>

			<table class="table table-striped">
				<thead>
					<tr>
						<th>{{ Lang::get('knessetmember.alltime_table.name') }}</th>
						<th>{{ Lang::get('knessetmember.alltime_table.party') }}</th>
						<th>{{ Lang::get('knessetmember.alltime_table.custom_hours') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($members as $km)
						<tr>
							<td>
								<a href="{{ route('member_path', [$km->knessetmember]) }}">{{ $km->knessetmember->name }}</a>
							</td>
							<td>
								<a href="{{ route('party_path', [$km->knessetmember->party]) }}">{{ $km->knessetmember->party->name }}</a>
							</td>
							<td>{{ minutesToHours($km->minutes) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@stop