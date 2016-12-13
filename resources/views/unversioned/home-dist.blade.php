<div class="panel panel-default">
    <div class="panel-heading">{{ app('trans',['Dashboard']) }}</div>

    <div class="panel-body">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{{ app('trans',['List']) }}</h1>
                {!! $data instanceof Illuminate\Pagination\LengthAwarePaginator?$data->render():(isset($render)?$render:'') !!}
            </div>


            {{--Lista de repetição, mostra todos os registros de teste--}}
            @forelse(isset($data)?$data:[] as $item)
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                    {{--Mostra o título do teste--}}
                    <a class="jokeTitle" href="{{ route($routePrefix.'.show',[$item]) }}">{{ $item->title }}</a>
                    <p class="text-right"><em>{{ $item->description }}</em></p>

                    {{--Mostra a imagem do teste com um link para o teste--}}
                    <a class="thumbnail" href="{{ route($routePrefix.'.show',[$item]) }}">
                        <img class="img-responsive" src="{{ $item->fileImageUrlField('file') }}"
                             title="{{ $item->title }}" alt="{{ $item->title }}">
                        {{--<img class="img-responsive" src="{{ route('file.fit',['350x200', $item->file]) }}"--}}
                             {{--title="{{ $item->title }}"--}}
                             {{--alt="{{ $item->title }}">--}}
                    </a>
                </div>
            @empty
                {{--Mostra caso nao tenha nenhum teste cadastrado--}}
                <div class="col-lg-12">
                    <div class="well"><em>Sem Registros</em></div>
                </div>
            @endforelse

            <div class="col-lg-12">
                {!! $data instanceof Illuminate\Pagination\LengthAwarePaginator?$data->render():(isset($render)?$render:'') !!}
            </div>

        </div>
    </div>
</div>