@extends('erpnetWidgetResource::layouts.mainLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(config('app.env')=='local')
                    @include('erpnetWidgetResource::unversioned.show-dist', ['routeName'=> $routeName])
                @else
                    @include('erpnetWidgetResource::unversioned.show', ['routeName'=> $routeName])
                @endif

            </div>
        </div>
    </div>
@endsection

@section('customFooterScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-file-upload/2.3.4/angular-file-upload.min.js"></script>
@endsection