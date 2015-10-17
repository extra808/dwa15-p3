@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
{!! Form::open() !!}
{!! Form::label('qty', 'Quantity') !!}
{!! Form::number('qty', old('qty', 3), array('required'
    , 'min'=>'1'
    , 'max'=>'99'
    , 'step'=>'1'
    )) !!}

{!! Form::label('plain', 'Plain') !!}
{!! Form::radio('format', 'plain', old('format', true) ) !!}

{!! Form::label('php', 'PHP Array') !!}
{!! Form::radio('format', 'php', old('format', false) ) !!}

{!! Form::label('html', 'HTML') !!}
{!! Form::radio('format', 'html', old('format', false) ) !!}

{!! Form::label('json', 'JSON') !!}
{!! Form::radio('format', 'json', old('format', false) ) !!}

{!! Form::submit('Submit') !!}
{!! Form::close() !!}

<pre id="output" contenteditable="true" tabindex="0">
{{ $content or '' }}
</pre>
@endsection

@section('equalSide')
<ol>
    <li>No Author
    <li>Herman Melville
</ol>
@endsection