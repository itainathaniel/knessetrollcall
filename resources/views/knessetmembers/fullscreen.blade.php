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
		<style>
			body,html{padding:0; margin:0;height:100%;width:100%;}
			#full-screen {
				width: 100%;
				height: 100%;
			}
			.face {
				width: 6.6667%;
				width: calc(100%/15);
				float: right;
				position: relative;
				height: 12.5%;
				height: calc(100%/8);
				overflow: hidden;
			}
			.face-outside {
				opacity: 0.4;
			}
			.face img {
				width: 92%;
				margin: 0 4%;
			}
			.face h4 {
				position: absolute;
				bottom: 0;
				right: 0;
				margin: 0 4%;
				left: 0;
				padding: 5px;
			}
			.face h4 span {
				color: white;
				letter-spacing: -0.75px;
				text-shadow: -1px -1px 6px black,
							  1px  1px 6px black,
							 -1px  1px 6px black,
							  1px -1px 6px black;
				font-size: 15px;
			}
		</style>
		@yield('head', '')
	</head>

<body>
	<div id="full-screen">
		@foreach ($members as $member)
			<a href="{{ route('member_path', ['id' => $member->id]) }}">
				<div class="face {{ ($member->isInside) ? 'face-inside' : 'face-outside' }}">
					<img src="{{ $member->image_path() }}" alt="{{ $member->name }}" title="{{ $member->name }}">
					<h4>
						<span>{{ $member->name }}</span>
					</h4>
				</div>
			</a>
		@endforeach
	</div>

	<script src="{{ asset('js/app.js') }}"></script>

	@include('layouts.partials.googleAnalytics')
</body>
</html>