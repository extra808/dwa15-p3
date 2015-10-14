@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
{!! Form::open() !!}
{!! Form::label('qty', 'Quantity') !!}
<input type="number" min="1" max="9" step="1" name="qty" id="qty" value="3" required>

{!! Form::label('plain', 'Plain') !!}
{!! Form::radio('format', 'plain', true) !!}

{!! Form::label('php', 'PHP Array') !!}
{!! Form::radio('format', 'php', false) !!}

{!! Form::label('html', 'HTML') !!}
{!! Form::radio('format', 'html', false) !!}

{!! Form::label('json', 'JSON') !!}
{!! Form::radio('format', 'json', false) !!}

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