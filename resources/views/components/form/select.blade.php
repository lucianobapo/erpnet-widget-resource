<!-- Form Input -->
<div class="form-group">
    {{ Form::label($name, $label, ['class' => 'control-label']) }}
    {{ Form::select($name, $data, $value, array_merge(['class' => 'form-control'], count($attributes)>0?$attributes:[]) ) }}
</div>