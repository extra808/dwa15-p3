@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
{!! Form::open(); !!}
{!! Form::label('qty', 'Quantity') !!}
<input type="number" min="1" max="9" step="1" name="qty" id="qty" value="3" required>
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