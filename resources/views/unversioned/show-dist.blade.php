<div class="panel panel-default">
    <div class="panel-heading">
        <h1>{{ $dataModelSelected['title'] }}</h1>
    </div>

    <div class="panel-body text-center">
        <p><em>{{ $dataModelSelected['description'] }}</em></p>
        @if(isset($dataModelSelected['file']))
            <p>
                @if(isset($customFormAttr['foundUser']))
                    <img class="img-responsive" src="{{ $dataModelSelected->fileImageUrlField('file', true, $customFormAttr['foundUser']) }}">
                @else
                    <img class="img-responsive" src="{{ $dataModelSelected->fileImageUrlField('file', true) }}">
                @endif

            </p>
        @else
            <div class="well"><em>Sem Imagem</em></div>
        @endif

        <div class="well">
            <div class="fb-like"
                 data-href="{{ (Request::route()->getName()=='post.random' && Auth::check())?route('post.showRandom', [Auth::user()->provider_id, $dataModelSelected->file]):url($_SERVER['REQUEST_URI']) }}"
                 data-layout="button_count"
                 data-action="like"
                 data-size="large"
                 data-show-faces="false"
                 data-share="false">
            </div>

            <div class="fb-share-button"
                 data-href="{{ (Request::route()->getName()=='post.random' && Auth::check())?route('post.showRandom', [Auth::user()->provider_id, $dataModelSelected->file]):url($_SERVER['REQUEST_URI']) }}"
                 data-layout="button_count" data-size="large"
                 data-mobile-iframe="true">
                <a class="fb-xfbml-parse-ignore" target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u={{ (Request::route()->getName()=='post.random' && Auth::check())?route('post.showRandom', [Auth::user()->provider_id, $dataModelSelected->file]):url($_SERVER['REQUEST_URI']) }}&amp;src=sdkpreparse">
                    Compartilhar
                </a>
            </div>
        </div>

        {{--Botão "Fazer Teste"--}}
        @if(Auth::check() && (Request::route()->getName()!='post.random') )
            <p><a href="{{ Route::getRoutes()->hasNamedRoute('post.random')?route('post.random', $dataModelSelected):url('/') }}" class="btn btn-primary">
                    <i class="fa fa-question-circle" aria-hidden="true"></i> Fazer Teste</a></p>
        @endif

        {{--Botão "Refazer Teste"--}}
        @if(Auth::check() && (Request::route()->getName()=='post.random') )
            <p>
                <a href="{{ Route::getRoutes()->hasNamedRoute('post.random')?route('post.random', $dataModelSelected):url('/') }}" class="btn btn-primary">
                    <i class="fa fa-repeat" aria-hidden="true"></i> Tente novamente</a>
            </p>
        @endif

        {{--Botão "Login"--}}
        @if(Auth::guest())
            <p>
                <a href="{{ Route::getRoutes()->hasNamedRoute('auth.redirect')?route('auth.redirect'):url('/') }}" class="btn btn-primary">
                    <i class="fa fa-facebook-official"></i> Conecte-se com Facebook
                </a>
            </p>
        @endif

        @if(config('app.env')=='local')
            @include('erpnetWidgetResource::unversioned.home-dist')
        @else
            @include('erpnetWidgetResource::unversioned.home')
        @endif

    </div>
</div>