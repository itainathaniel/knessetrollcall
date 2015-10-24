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
        <link rel="stylesheet" href="/css/all.css">
        @yield('head', '')
    </head>

<body>
    <div class="container">
        <div class="header">
            <nav>
                <ul class="nav nav-pills pull-left">
                    @if (Auth::check())
                        <li role="presentation" @yield('nav-active-profile', '')>{!! link_to_action('UsersController@edit', Auth::user()->name) !!}</li>
                        @if (Auth::user()->admin)
                            <li role="presentation" @yield('nav-active-admin', '')>{!! link_to_action('Admin\AdminController@index', 'אדמין') !!}</li>
                        @endif
                    @endif
                    <li role="presentation" @yield('nav-active-index', '')>{!! link_to_action('PagesController@index', Lang::get('site.nav.main')) !!}</li>
                    <li role="presentation" @yield('nav-active-parties', '')>{!! link_to_action('PartiesController@index', Lang::get('site.nav.parties')) !!}</li>
                    <li role="presentation" @yield('nav-active-inside', '')>{!! link_to_route('inside_path', Lang::get('site.nav.nowInside')) !!}</li>
                    <li role="presentation" @yield('nav-active-table', '')>{!! link_to_action('KnessetMembersController@allTimeTable', Lang::get('site.nav.table')) !!}</li>
                    <li role="presentation" @yield('nav-active-about', '')>{!! link_to_action('PagesController@about', Lang::get('site.nav.about')) !!}</li>
                    {{--<li role="presentation" @yield('nav-active-contact', '')>{!! link_to_action('PagesController@contact', Lang::get('index.footer.link-contact')) !!}</li>--}}
                    @if (Auth::check())
                        <li role="presentation">{!! link_to_action('Auth\AuthController@getLogout', 'התנתקות') !!}</li>
                    @endif
                </ul>
            </nav>
            <h2 class="text-muted">{!! link_to_action('PagesController@index', Lang::get('index.site.name')) !!}</h2>
        </div>

        @yield('content')

        <footer class="footer">
            <p>
                {!! link_to('http://it.ai', Lang::get('site.footer.link-itai'), ['onclick' => "trackOutboundLink('http://it.ai'); return false;"]) !!} |
                {!! link_to_action('PagesController@about', Lang::get('site.footer.link-about')) !!} |
                {!! link_to_action('PagesController@contact', Lang::get('site.footer.link-contact'))  !!} |
                <a href="https://www.facebook.com/knessetrollcall" style="color:rgb(58,87,149);">{{ Lang::get('site.footer.link-facebook') }}</a>
            </p>
        </footer>

    </div> <!-- /container -->

    @include('layouts.partials.googleAnalytics')
</body>
</html>