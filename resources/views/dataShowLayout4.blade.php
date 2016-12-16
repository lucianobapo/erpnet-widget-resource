@extends('erpnetWidgetResource::layouts.mainLayout')

@section('customHeadMetaTags')
    <meta property="fb:app_id" content="{{ config('services.facebook.client_id') }}">
    <meta property="og:site_name" content="{{ config('erpnetWidgetResource.siteName') }}">
    <meta property="og:url" content="{{ url($_SERVER['REQUEST_URI']) }}">

    {{--<meta property="article:published_time" content="2016-07-03T08:02:13+00:00">--}}
    {{--<meta property="article:section" content="Desenhos">--}}
    {{--<meta property="article:tag" content="Teste qual super-herói você seria">--}}

    <meta property="og:type" content="article">
    <meta property="og:image" content="{{ $dataModelSelected->fileImageUrlField('file') }}">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="420">
    <meta property="og:title" content="{{ $dataModelSelected->title }}">
    <meta property="og:description" content="{{ $dataModelSelected->description }}">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $dataModelSelected->title }}">
    <meta name="twitter:description" content="{{ $dataModelSelected->description }}">
    <meta name="twitter:image" content="{{ $dataModelSelected->fileImageUrlField('file') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(config('app.env')=='local')
                    @include('erpnetWidgetResource::unversioned.show-dist')
                @else
                    @include('erpnetWidgetResource::unversioned.show')
                @endif

            </div>
        </div>
    </div>
@endsection

@section('customFooterScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-file-upload/2.3.4/angular-file-upload.min.js"></script>
@endsection