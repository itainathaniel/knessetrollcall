<!DOCTYPE html>
<html lang="he">
    <head>
        <title>{{ Lang::get('index.site.title') }} @yield('title', '')</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="See which Israeli Knesset Member is in the Knesset">
        <meta name="author" content="Itai Nathaniel">

        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/css/all.css">
        @yield('head', '')
    </head>

<body>
    <div class="container">
        <div class="header">
            <nav>
                <ul class="nav nav-pills pull-left">
                    <li role="presentation" @yield('nav-active-index', '')>{!! link_to_action('PagesController@index', Lang::get('site.nav.main')) !!}</li>
                    <li role="presentation" @yield('nav-active-parties', '')>{!! link_to_action('PartiesController@index', Lang::get('site.nav.parties')) !!}</li>
                    <li role="presentation" @yield('nav-active-inside', '')>{!! link_to_route('inside_path', Lang::get('site.nav.nowInside')) !!}</li>
                    <li role="presentation" @yield('nav-active-about', '')>{!! link_to_action('PagesController@about', Lang::get('site.nav.about')) !!}</li>
                    {{--<li role="presentation" @yield('nav-active-contact', '')>{!! link_to_action('PagesController@contact', Lang::get('index.footer.link-contact')) !!}</li>--}}
                </ul>
            </nav>
            <h2 class="text-muted">{!! link_to_action('PagesController@index', Lang::get('index.site.name')) !!}</h2>
        </div>

        @yield('content')

        <footer class="footer">
            <p>
                {!! link_to('http://it.ai', Lang::get('site.footer.link-itai'), ['onclick' => "trackOutboundLink('http://it.ai'); return false;"]) !!} |
                {!! link_to_action('PagesController@about', Lang::get('site.footer.link-about')) !!} |
                {!! link_to_action('PagesController@contact', Lang::get('site.footer.link-contact'))  !!}
            </p>
        </footer>

    </div> <!-- /container -->

    <script src="/js/jquery.min.js" old-src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    @include('layouts.partials.googleAnalytics')
</body>
</html>