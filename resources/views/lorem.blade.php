@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{!! Form::open() !!}
{!! Form::label('quantity', 'Quantity') !!}
{!! Form::number('quantity', old('quantity', session('lorem.qty.default') ), array('required'
    , 'min'=> session('lorem.qty.range.min')
    , 'max'=> session('lorem.qty.range.max')
    , 'step'=>'1'
    )) !!}

<fieldset>
<legend>Generator</legend>
<div class="btn-group" role="group" data-toggle="buttons">
<label class="btn btn-default <?php if( (null !== session('_old_input.generator') ) && session('_old_input.generator') == 'badcow') { echo 'active'; } ?>">Lorem Ipsum
{!! Form::radio('generator', 'badcow', old('generator', true), array('id'=>'badcow') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.generator') ) && session('_old_input.generator') == 'elvish') { echo 'active'; } ?>">Elvish
{!! Form::radio('generator', 'elvish', old('generator', false), array('id'=>'elvish') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.generator') ) && session('_old_input.generator') == 'faker') { echo 'active'; } ?>">Faker&#039;s Lorem Ipsum
{!! Form::radio('generator', 'faker', old('generator', false), array('id'=>'faker') ) !!}
</label>
</div>
</fieldset>

<fieldset>
<legend>Format</legend>
<div class="btn-group" role="group" data-toggle="buttons">
<label class="btn btn-default <?php if( (null !== session('_old_input.format') ) && session('_old_input.format') == 'plain') { echo 'active'; } ?>">Plain
{!! Form::radio('format', 'plain', old('format', true), array('id'=>'plain') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.format') ) && session('_old_input.format') == 'php') { echo 'active'; } ?>">PHP Array
{!! Form::radio('format', 'php', old('format', false), array('id'=>'php') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.format') ) && session('_old_input.format') == 'html') { echo 'active'; } ?>">HTML
{!! Form::radio('format', 'html', old('format', false), array('id'=>'html') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.format') ) && session('_old_input.format') == 'json') { echo 'active'; } ?>">JSON
{!! Form::radio('format', 'json', old('format', false), array('id'=>'json') ) !!}
</label>
</div>
</fieldset>

<fieldset>
<div class="btn-group" role="group">
{!! Form::submit('Submit', array('class'=>'btn btn-default')) !!}
{!! Form::submit('Reset', array('name'=>'reset', 'class'=>'btn btn-default')) !!}
</div>
</fieldset>
{!! Form::close() !!}

<pre id="output" tabindex="0">
{{ $content or '' }}
</pre>
@endsection

@section('equalSide')
<ol>
    <li>No Author
    <li>Herman Melville
</ol>
@endsection
