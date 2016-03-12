<!DOCTYPE html>
<html lang="he">
	<head>
		<title>{{ Lang::get('index.site.title') }} @yield('title')</title>

		<meta charset="utf-8">
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
{{-- <nav id="menu">
	<ul>
		<li class="Label">Website</li>
		<li><a href="/">Home</a></li>
		<li><a href="/about/">About us</a></li>
		<li>
			<em class="Counter"></em>
			<a href="/about/">About us</a>
		</li>
		<li class="Selected"><a href="/contact/">Contact</a></li>
	</ul>
</nav> --}}
<div id="page"> <!-- the wrapper -->
	{{-- <div id="header">
		<a href="#menu" class="hamburger"></a>
		כנסת רול קול
	</div> --}}
	<div id="content">
		<div id="full-screen" class="show-all orientation-wide">
			@foreach ($members as $member)
				<a href="{{ route('member_path', ['id' => $member->id]) }}">
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
		<table class="table table-striped">
			<thead>
				<tr>
					<th colspan="2">קואליציה: 61 מתוך 61 ח״כים</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($parties->where('is_coalition', 1) as $party)
					<tr>
						<td>{{ $party->name }}</td>
						<td>{{ $party->inside() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<table class="table table-striped">
			<thead>
				<tr>
					<th colspan="2">אופוזיציה: 59 מתוך 59 ח״כים</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($parties->where('is_coalition', 0) as $party)
					<tr>
						<td>{{ $party->name }}</td>
						<td>{{ $party->inside() }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	{{-- <div id="footer">&copy; איתי משה-חי נתנאל, {{ date('Y') }}</div> --}}
</div>


{{-- <div id="menu">
	<div class="menu-wrapper">
		<h3>חלוקה</h3>
		<ul class="items">
			<li>
				<a href="#" class="js-click-side" data-side="1">קואליציה</a>
			</li>
			<li>
				<a href="#" class="js-click-side" data-side="0">אופוזיציה</a>
			</li>
		</ul>
	</div>
	<div class="menu-wrapper">
		<h3>מפלגות</h3>
		<ul class="items">
			@foreach (\KnessetRollCall\Party::all() as $party)
				@if ($party->name !== '')
					<li>
						<a href="#" class="js-click-party" data-party="{{ $party->id }}">{{ $party->name }}</a>
					</li>
				@endif
			@endforeach
		</ul>
	</div>
</div> --}}

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/homepage.js') }}"></script>

@include('layouts.partials.googleAnalytics')

</body>
</html>