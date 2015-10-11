@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
{{ $content }}
@endsection

@section('equalSide')
<ol>
    <li>No Author
    <li>Herman Melville
</ol>
@endsection