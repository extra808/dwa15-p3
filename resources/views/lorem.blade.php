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
{!! Form::number('quantity', old('quantity', $qty ), array('required'
    , 'min'=>'1'
    , 'max'=>'99'
    , 'step'=>'1'
    )) !!}

<div>
{!! Form::label('badcow', 'Lorem Ipsum') !!}
{!! Form::radio('text&nbsp;generator', 'badcow', old('text&nbsp;generator', true), array('id'=>'badcow') ) !!}

{!! Form::label('elvish', 'Elvish') !!}
{!! Form::radio('text&nbsp;generator', 'elvish', old('text&nbsp;generator', false), array('id'=>'elvish') ) !!}

{!! Form::label('faker', 'Faker\'s Lorem Ipsum') !!}
{!! Form::radio('text&nbsp;generator', 'faker', old('text&nbsp;generator', false), array('id'=>'faker') ) !!}
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