<!DOCTYPE html>
<html lang="he">
	<head>
		<title>{{ Lang::get('index.site.title') }} @yield('title')</title>

		<meta charset="utf-8">
		<meta http-equiv="refresh" content="300">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="See which Israeli Knesset Member is in the Knesset">
		<meta name="author" content="Itai Nathaniel">

		@include('layouts.partials.twitter-cards')
		@include('layouts.partials.facebook')

		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="{{ asset('css/all.css') }}">
		<link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
		@yield('head', '')
	</head>

<body>
<div id="page"> <!-- the wrapper -->
	<div id="content">
		<div id="full-screen" class="show-all orientation-wide">
			@foreach ($members as $member)
				<a href="{{ route('member_path', ['id' => $member->id]) }}" data-member="{{ $member }}" data-party="{{ $member->party }}">
					<div class="face {{ ($member->isInside) ? 'face-inside' : 'face-outside' }} js-party-{{ $member->party_id }} js-side-{{ $member->party->is_coalition }}">
						<img src="{{ $member->image_path() }}" alt="{{ $member->name }}" title="{{ $member->name }}">
						<h4>
							<span>{{ $member->name }}</span>
						</h4>
					</div>
				</a>
			@endforeach
		</div>
	</div>
	<div id="data">
		@for ($i = 1; $i >= 0; $i--)
			<table class="table table-striped">
				<tbody>
					<?php $count_in = 0; ?>
					<?php $count_out = 0; ?>
					@foreach ($parties->where('is_coalition', $i) as $party)
						<?php $party_count_out = $members->where('party_id', $party->id)->count(); ?>
						@if ($party_count_out)
							<?php $party_count_in = $party->inside(); ?>
							<tr>
								<td>
									<a href="{{ route('party_path', [$party->id]) }}">{{ $party->name }}</a>
								</td>
								<td>{{ Lang::get('fullscreen.tables.out_of', ['inside' => $party->inside(), 'total' => $party_count_out]) }}</td>
							</tr>
							<?php $count_in += $party_count_in; ?>
							<?php $count_out += $party_count_out; ?>
						@endif
					@endforeach
				</tbody>
				<thead>
					<tr>
						<th colspan="2">
							{{ Lang::get('fullscreen.tables.thead.title', [
								'side' => Lang::get('fullscreen.tables.thead.side.'.$i),
								'in' => $count_in,
								'out' => $count_out
							]) }}
						</th>
					</tr>
				</thead>
			</table>
		@endfor
	</div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/homepage.js') }}"></script>

@include('layouts.partials.googleAnalytics')

</body>
</html>