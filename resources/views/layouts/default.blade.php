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
    <div class="container">
        <div class="header">
            <nav>
                <ul class="nav nav-pills pull-left">
                    @if (Auth::check())
                        <li role="presentation" @yield('nav-active-profile', '')>
                            <a href="{{ action('UsersController@edit') }}">{{ Auth::user()->name }}</a>
                        </li>
                        @if (Auth::user()->admin)
                            <li role="presentation" @yield('nav-active-admin', '')>
                                <a href="{{ action('Admin\AdminController@index') }}">אדמין</a>
                            </li>
                        @endif
                    @endif
                    <li role="presentation" @yield('nav-active-index', '')>
                        <a href="{{ action('PagesController@index') }}">{{ Lang::get('site.nav.main') }}</a>
                    </li>
                    <li role="presentation" @yield('nav-active-parties', '')>
                        <a href="{{ action('PartiesController@index') }}">{{ Lang::get('site.nav.parties') }}</a>
                    </li>
                    <li role="presentation" @yield('nav-active-inside', '')>
                        <a href="{{ route('inside_path') }}">{{ Lang::get('site.nav.nowInside') }}</a>
                    </li>
                    <li role="presentation" @yield('nav-active-table', '')>
                        <a href="{{ action('KnessetMembersController@allTimeTable') }}">{{ Lang::get('site.nav.table') }}</a>
                    </li>
                    <li role="presentation" @yield('nav-active-about', '')>
                        <a href="{{ action('PagesController@about') }}">{{ Lang::get('site.nav.about') }}</a>
                    </li>
                    @if (Auth::check())
                        <li role="presentation">
                            <a href="{{ action('Auth\AuthController@getLogout') }}">התנתקות</a>
                        </li>
                    @endif
                </ul>
            </nav>
            <h2 class="text-muted">
                <a href="{{ action('PagesController@index') }}">{{ Lang::get('index.site.name') }}</a>
            </h2>
        </div>

        @yield('content')

        <footer class="footer">
            <p>
                <a href="http://it.ai" onclick="trackOutboundLink('http://it.ai'); return false;">
                    {{ Lang::get('site.footer.link-itai') }}
                </a> |
                <a href="{{ action('PagesController@about') }}">
                    {{ Lang::get('site.footer.link-about') }}
                </a> |
                <a href="{{ action('PagesController@contact') }}">
                    {{ Lang::get('site.footer.link-contact') }}
                </a> |
                <a href="https://www.facebook.com/knessetrollcall" style="color:rgb(58,87,149);">
                    {{ Lang::get('site.footer.link-facebook') }}
                </a>
            </p>
        </footer>

    </div> <!-- /container -->

    <script src="{{ asset('js/app.js') }}"></script>

    @include('layouts.partials.googleAnalytics')
</body>
</html>