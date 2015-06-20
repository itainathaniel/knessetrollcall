<meta property="og:site_name"   content="{{ Lang::get('index.site.title') }}" />
<meta property="og:type"        content="profile" />
@yield('facebook-tag-profile')
<meta property="og:url"         content="{{ Request::url() }}" />
<meta property="og:title"       content="@yield('title')" />
<meta property="og:description" content="@yield('tweeter-card-description')" />
<meta property="og:image"       content="@yield('image', 'http://knessetrollcall.com/images/knessetrollcall_logo.png')" />