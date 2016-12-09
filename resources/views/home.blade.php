@extends('erpnetWidgetResource::layouts.unversionedLayout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @if(config('app.env')=='local')
                    @include('erpnetWidgetResource::unversioned.home-dist')
                @else
                    @include('erpnetWidgetResource::unversioned.home')
                @endif

            </div>
        </div>
    </div>
@endsection