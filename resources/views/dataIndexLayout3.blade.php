@extends('erpnetWidgetResource::mainLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <h1 class="panel-heading">Gerenciamento de Registros</h1>

                    <div class="panel-body">
                        @if (isset($errors) && count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <h2>Lista de Registros:</h2>

                        {!! $data instanceof Illuminate\Pagination\LengthAwarePaginator?$data->render():(isset($render)?$render:'') !!}

                        <div class="list-group">
                            @forelse(isset($data)?$data:[] as $item)
                                <div class="list-group-item list-group-item-action">
                                    @if($showToAdmin)
                                        <div class="pull-right">
                                            <a class="btn btn-primary" title="{{ t('More Data') }}">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route($routePrefix.'.show', [$item['id'], '#form']) }}" class="btn btn-primary" title="{{ t('Edit') }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            {{ Form::open(['style'=> 'display: inline-block;', 'method' => 'DELETE', 'route' => [$routePrefix.'.destroy', $item['id']] ]) }}
                                                <button type="submit" class="btn btn-danger" title="{{ t('Cancel') }}">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </button>
                                            {{ Form::close() }}
                                        </div>
                                    @endif

                                    <h5 class="list-group-item-heading">
                                        @foreach(isset($fields)?$fields:[] as $key => $field)
                                            @if(is_array($field) && isset($field['header']) && ($field['header']===true))
                                                {{ $item['id'] }}::
                                                @if(isset($field['customShow']) && get_class($field['customShow'])=='Closure')
                                                    {{ $field['customShow']($item) }}
                                                @else
                                                    {{ $item[$name] }}
                                                @endif
                                            @endif
                                        @endforeach
                                    </h5>

                                    <div class="list-group-item-text" style="">

                                        <ul>
                                            @foreach(isset($fields)?$fields:[] as $key => $field)
                                                @if(is_string($field) && isset($item[$field]))
                                                    <div class="well well-sm" style="display: inline-block; margin-bottom: 5px;">
                                                        {{ ucfirst($field) }}: {{ $item[$field] }}
                                                    </div>
                                                @elseif(is_array($field) && !isset($field['header']))
                                                    <?php $name = $field['name']; ?>
                                                    @if(isset($field['component']) && $field['component']=='widgetFile')
                                                        <div style="display: inline-block">
                                                            <img class="img-responsive" src="/fileFit/200x100/{{ $item[$name] }}"
                                                                 title="{{ $item->title }}"
                                                                 alt="{{ $item->title }}">
                                                        </div>
                                                    @else
                                                        <li class="" style="">
                                                            @if(isset($field['label']))
                                                                {{ $field['label'] }}
                                                            @else
                                                                {{ ucfirst($field['name']) }}
                                                            @endif
                                                            :
                                                            @if(isset($field['customShow']) && get_class($field['customShow'])=='Closure')
                                                                {{ $field['customShow']($item) }}
                                                            @else
                                                                {{ $item[$name] }}
                                                            @endif
                                                        </li>
                                                    @endif
                                                @else
                                                    {{--<li>{{ (get_class($item)) }}</li>--}}
                                                @endif
                                            @endforeach
                                        </ul>

                                    </div>

                                </div>
                            @empty
                                <div class="list-group-item list-group-item-action">
                                    <em>Sem registros</em>
                                </div>
                            @endforelse
                        </div>
                        {!! $data instanceof Illuminate\Pagination\LengthAwarePaginator?$data->render():(isset($render)?$render:'') !!}

                        @if($showToAdmin)
                            <a name="form"></a><h2>Formulário de Registros:</h2>
                            {!! Form::model(isset($dataModel)?$dataModel:$dataModelInstance,
                                isset($customFormAttr)?$customFormAttr:[]) !!}

                            @foreach(isset($fields)?$fields:[] as $key => $field)
                                @if(is_string($field))
                                    {{ Form::widgetText($field) }}
                                @elseif(is_array($field))
                                    {{ forward_static_call(
                                        ['Form',$field['component']],
                                        $field['name'],
                                        isset($field['label'])?$field['label']:null,
                                        isset($field['value'])?$field['value']:null,
                                        isset($field['attributes'])?$field['attributes']:[],
                                        isset($field['data'])?$field['data']:[],
                                        (isset($dataModel) && $field['component']=='widgetCheckbox')?$dataModel[$field['name']]:null
                                        ) }}
                                @endif
                            @endforeach

                        <!-- Enviar Form Input -->
                            <div class="form-group">
                                {!! Form::submit('Enviar',['class'=>'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}

                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('customFooterScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-file-upload/2.3.4/angular-file-upload.min.js"></script>
@endsection