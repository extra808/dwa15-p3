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
{!! Form::label('badcow', 'Lorem Ipsum') !!}
{!! Form::radio('generator', 'badcow', old('generator', true), array('id'=>'badcow') ) !!}

{!! Form::label('elvish', 'Elvish') !!}
{!! Form::radio('generator', 'elvish', old('generator', false), array('id'=>'elvish') ) !!}

{!! Form::label('faker', 'Faker\'s Lorem Ipsum') !!}
{!! Form::radio('generator', 'faker', old('generator', false), array('id'=>'faker') ) !!}
</fieldset>
<fieldset>
<legend>Format</legend>
{!! Form::label('plain', 'Plain') !!}
{!! Form::radio('format', 'plain', old('format', true), array('id'=>'plain') ) !!}

{!! Form::label('php', 'PHP Array') !!}
{!! Form::radio('format', 'php', old('format', false), array('id'=>'php') ) !!}

{!! Form::label('html', 'HTML') !!}
{!! Form::radio('format', 'html', old('format', false), array('id'=>'html') ) !!}

{!! Form::label('json', 'JSON') !!}
{!! Form::radio('format', 'json', old('format', false), array('id'=>'json') ) !!}
</fieldset>

<div class="btn-group" role="group">
{!! Form::submit('Submit', array('class'=>'btn btn-default')) !!}
<a href="{!! Request::url() !!}" class="btn btn-default">Reset</a>
</div>
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
