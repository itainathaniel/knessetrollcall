<!DOCTYPE html>
<html lang="he">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="http://getbootstrap.com/favicon.ico">

    <title>{{ Lang::get('admin.title') }}</title>

    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {!! link_to_action('Admin\AdminController@index', Lang::get('admin.nav.top.home'), null, ['class' => 'navbar-brand']) !!}
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>{!! link_to_action('Admin\UsersController@index', Lang::get('admin.nav.top.users')) !!}</li>
                <li>{!! link_to_action('Admin\KnessetMembersController@index', Lang::get('admin.nav.top.knessetmembers')) !!}</li>
                <li>{!! link_to_action('Admin\PartiesController@index', Lang::get('admin.nav.top.parties')) !!}</li>
            </ul>
            <form class="navbar-form navbar-left">
                <input type="text" class="form-control" placeholder="חיפוש...">
            </form>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li>{!! link_to_action('Admin\AdminController@index', Lang::get('admin.nav.top.home')) !!}</li>
                <li>{!! link_to_action('UsersController@edit', Auth::user()->name) !!}</li>
            </ul>
            <ul class="nav nav-sidebar">
                <li>{!! link_to_action('Admin\UsersController@index', Lang::get('admin.nav.top.users')) !!}</li>
            </ul>
            <ul class="nav nav-sidebar">
                <li>{!! link_to_action('Admin\KnessetMembersController@index', Lang::get('admin.nav.top.knessetmembers')) !!}</li>
            </ul>
            <ul class="nav nav-sidebar">
                <li>{!! link_to_action('Admin\PartiesController@index', Lang::get('admin.nav.top.parties')) !!}</li>
            </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            @yield('content')
        </div>
    </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>