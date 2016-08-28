@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h1>Gerenciamento de Registros</h1></div>

                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <h2>Lista de Registros:</h2>
                            @forelse(isset($data)?$data:[] as $item)
                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action">
                                        <div>{{ app('trans',['Code']) }}: {{ $item->id }}</div>
                                        @foreach(isset($fields)?$fields:[] as $key => $field)
                                            @if(is_string($field) && !empty($item[$field]))
                                                <div>{{ ucfirst($field) }}: {{ $item[$field] }}</div>
                                            @elseif(is_array($field) && !empty($item[$field['name']]))
                                                @if(isset($field['component']) && $field['component']=='customFile')
                                                    <div style="display: inline-block">
                                                        <img class="img-responsive" src="/fileFit/200x100/{{ $item[$field['name']] }}"
                                                             title="{{ $item->title }}"
                                                             alt="{{ $item->title }}">
                                                    </div>
                                                @else
                                                    <p>
                                                        {{ isset($field['label'])?$field['label']:ucfirst($field['name']) }}:
                                                        {{ $item[$field['name']] }}
                                                    </p>
                                                @endif
                                            @endif

                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="well">
                                    <em>Sem registros</em>
                                </div>

                            @endforelse

                            {!! get_class($data)==Illuminate\Pagination\LengthAwarePaginator::class?$data->render():'' !!}

                            @if(!Auth::guest())
                                <a name="form"></a><h2>Formulário de Registros:</h2>
                                {!! Form::model(isset($dataModel)?$dataModel:$dataModelInstance,
                                    isset($customFormAttr)?$customFormAttr:[]) !!}

                                @foreach(isset($fields)?$fields:[] as $key => $field)
                                    @if(is_string($field))
                                        {{ Form::customText($field) }}
                                    @elseif(is_array($field))
                                        {{ forward_static_call(
                                            ['Form',$field['component']],
                                            $field['name'],
                                            isset($field['label'])?$field['label']:null,
                                            isset($field['value'])?$field['value']:null,
                                            isset($field['attributes'])?$field['attributes']:null,
                                            (isset($dataModel) && $field['component']=='customCheckbox')?$dataModel[$field['name']]:null
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