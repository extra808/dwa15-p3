@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
<pre id="output" contenteditable="true" tabindex="0">
{{ $content }}
</pre>
@endsection

@section('equalSide')
<ol>
    <li>No Author
    <li>Herman Melville
</ol>
@endsection