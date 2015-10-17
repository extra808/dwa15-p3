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

<div>
{!! Form::label('badcow', 'Lorem Ipsum') !!}
{!! Form::radio('generator', 'badcow', old('generator', true), array('id'=>'badcow') ) !!}

{!! Form::label('elvish', 'Elvish') !!}
{!! Form::radio('generator', 'elvish', old('generator', false), array('id'=>'elvish') ) !!}

{!! Form::label('faker', 'Faker\'s Lorem Ipsum') !!}
{!! Form::radio('generator', 'faker', old('generator', false), array('id'=>'faker') ) !!}
</div>
<div>
{!! Form::label('plain', 'Plain') !!}
{!! Form::radio('format', 'plain', old('format', true), array('id'=>'plain') ) !!}

{!! Form::label('php', 'PHP Array') !!}
{!! Form::radio('format', 'php', old('format', false), array('id'=>'php') ) !!}

{!! Form::label('html', 'HTML') !!}
{!! Form::radio('format', 'html', old('format', false), array('id'=>'html') ) !!}

{!! Form::label('json', 'JSON') !!}
{!! Form::radio('format', 'json', old('format', false), array('id'=>'json') ) !!}
</div>
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