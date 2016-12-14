@extends('erpnetWidgetResource::layouts.mainLayout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <h1 class="panel-heading">Gerenciamento de Registros</h1>

                    <div class="panel-body">

                        @if (Session::has('message'))
                            <div class="alert alert-info">
                                <span class="pull-right fa fa-info-circle fa-2x"></span>
                                <ul>
                                    <li>{{ Session::get('message') }}</li>
                                </ul>
                            </div>
                        @endif

                        @if (isset($errors) && count($errors) > 0)
                            <div class="alert alert-danger">
                                <span class="pull-right fa fa-warning fa-2x"></span>
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
                                            <a href="{{ Route::getRoutes()->hasNamedRoute($routePrefix.'.edit')?route($routePrefix.'.edit', [$item['id'], '#form']):route($routePrefix.'.show', [$item['id'], '#form']) }}" class="btn btn-primary" title="{{ t('Edit') }}">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>

                                            {{ Form::open(['style'=> 'display: inline-block;', 'method' => 'DELETE', 'route' => [$routePrefix.'.destroy', $item['id']] ]) }}
                                                <button type="submit" class="btn btn-danger" title="{{ t('Delete') }}">
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
                                                    {!! $field['customShow']($item) !!}
                                                @else
                                                    {{ $item[$key] }}
                                                @endif
                                            @endif
                                        @endforeach
                                    </h5>

                                    <div class="list-group-item-text" style="">

                                        <ul>
                                            @foreach(isset($fields)?$fields:[] as $key => $field)
                                                @if(is_string($field) && isset($item[$field]))
                                                    <li class="" style="">
                                                        {{ ucfirst($field) }}: {{ $item[$field] }}
                                                    </li>
                                                @elseif(is_array($field) && !isset($field['header']))
                                                    <li class="" style="{{ empty($item[$key])?'display:none':'' }}">
                                                        @if(isset($field['label']))
                                                            {{ $field['label'] }}
                                                        @else
                                                            {{ ucfirst($key) }}
                                                        @endif
                                                        :
                                                        @if(isset($field['customShow']) && get_class($field['customShow'])=='Closure')
                                                            {!! $field['customShow']($item) !!}
                                                        @else
                                                            {{ $item[$key] }}
                                                        @endif
                                                    </li>
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

{{--                            {!! Form::model(is_object($dataModelSelected)?$dataModelSelected:$dataModelInstance,--}}
                                {{--isset($customFormAttr)?$customFormAttr:[]) !!}--}}

                                @if(isset($customFormAttr))
                                    {{ Form::model(is_object($dataModelSelected)?$dataModelSelected:$dataModelInstance, $customFormAttr) }}
                                @else
                                    {{ Form::model(is_object($dataModelSelected)?$dataModelSelected:$dataModelInstance) }}
                                @endif

                            @foreach(isset($fields)?$fields:[] as $key => $field)
                                @if(is_string($field))
                                    {{ Form::widgetText($field) }}
                                @elseif(is_array($field))
                                    @if(isset($field['component']) && $field['component']=='widgetCheckbox')
                                        {!! Form::hidden($key, false) !!}
                                    @endif
                                    {{ forward_static_call(
                                        ['Form',isset($field['component'])?$field['component']:'widgetText'],
                                        $key,
                                        isset($field['label'])?$field['label']:null,
                                        isset($field['value'])?$field['value']:null,
                                        isset($field['attributes'])?$field['attributes']:[],
                                        (isset($dataModelSelected) && isset($field['component']) && $field['component']=='widgetCheckbox')?$dataModelSelected[$key]:(isset($field['data'])?$field['data']:[])
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