<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}">
    <meta property="og:site_name" content="{{ config('erpnetWidgetResource.siteName') }}">
    <meta property="og:url" content="{{ url($_SERVER['REQUEST_URI']) }}">

    {{--<meta property="article:published_time" content="2016-07-03T08:02:13+00:00">--}}
    {{--<meta property="article:section" content="Desenhos">--}}
    {{--<meta property="article:tag" content="Teste qual super-herói você seria">--}}

    <meta property="og:type" content="article">
    <meta property="og:image" content="{{ isset($dataModelSelected)?:(Request::route()->getName()=='post.showRandom'?route('post.showFile', [$dataModelSelected, $customFormAttr['providerId'], $dataModelSelected->file]):$dataModelSelected->fileImageUrlField('file')) }}">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="420">
    <meta property="og:title" content="{{ isset($dataModelSelected)?:$dataModelSelected->title }}">
    <meta property="og:description" content="{{ isset($dataModelSelected)?:$dataModelSelected->description }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ isset($dataModelSelected)?:$dataModelSelected->title }}">
    <meta name="twitter:description" content="{{ isset($dataModelSelected)?:$dataModelSelected->description }}">
    <meta name="twitter:image" content="{{ isset($dataModelSelected)?:(Request::route()->getName()=='post.showRandom'?route('post.showFile', [$dataModelSelected, $customFormAttr['providerId'], $dataModelSelected->file]):$dataModelSelected->fileImageUrlField('file')) }}">

    @yield('customHeadMetaTags')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('erpnetWidgetResource.siteName') }}</title>

    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = '{{ json_encode(['csrfToken' => csrf_token(),]) }}';
    </script>

    @yield('customHeadStylesheet')
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            @if(config('erpnetWidgetResource.siteLogo')!==false)
                <a class="navbar-brand" href="{{ url('/') }}" style="padding: 0px 15px">
                    <img src="{{ config('erpnetWidgetResource.siteLogo') }}"
                         alt="{{ 'Logomarca do Site '.url('/') }}"
                         title="{{ url('/') }}"
                         style="max-height: 100%;">
                </a>
            @endif

            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('erpnetWidgetResource.siteName') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a href="{{ route('post.home') }}">home</a></li>
                @if(Auth::check() && is_callable([Auth::user(), 'isAdmin']) && Auth::user()->isAdmin())
                    <li><a href="{{ route('post.index') }}">post</a></li>
                    <li><a href="{{ route('user.index') }}">user</a></li>
                @endif
                {{--<li><a href="{{ route('partners.index') }}">partners</a></li>--}}
                {{--<li><a href="{{ route('productGroups.index') }}">productGroups</a></li>--}}
                {{--<li><a href="{{ route('cloudFiles.index') }}">Cloud File Storage</a></li>--}}
            </ul>

            <!-- Right Side Of Navbar -->
            @if(config('app.env')=='local')
                @include('erpnetWidgetResource::unversioned.navbar-dist')
            @else
                @include('erpnetWidgetResource::unversioned.navbar')
            @endif

        </div>
    </div>
</nav>

@yield('content')

<!-- Scripts -->
<script src="/js/app.js"></script>
@yield('customFooterScripts')
</body>
</html>
