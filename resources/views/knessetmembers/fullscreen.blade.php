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
        @yield('head', '')
    </head>

<body>
	<div class="clearfix">
        <div class="users-sniplet">
            @include('layouts.partials.membersList', ['members' => $members])
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>

    @include('layouts.partials.googleAnalytics')
</body>
</html>