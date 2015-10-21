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
{!! Form::number('quantity', old('quantity', session('fakeuser.qty.default') ), array('required'
    , 'min'=> session('fakeuser.qty.range.min')
    , 'max'=> session('fakeuser.qty.range.max')
    , 'step'=>'1'
    )) !!}

<fieldset>
<legend>Format</legend>
{!! Form::label('plain', 'Plain') !!}
{!! Form::radio('format', 'plain', old('format', true), array('id'=>'plain') ) !!}

{!! Form::label('csv', 'CSV') !!}
{!! Form::radio('format', 'csv', old('format', false), array('id'=>'csv') ) !!}

{!! Form::label('tab', 'Tab-delimited') !!}
{!! Form::radio('format', 'tab', old('format', false), array('id'=>'tab') ) !!}

{!! Form::label('json', 'JSON') !!}
{!! Form::radio('format', 'json', old('format', false), array('id'=>'json') ) !!}
</fieldset>

<fieldset>
<legend>Generate Names as</legend>
{!! Form::label('incName_full', 'Full Name') !!}
{!! Form::radio('includeName', 'full', old('includeName', true), array('id'=>'incName_full') ) !!}
{!! Form::label('incName_component', 'Name in Components') !!}
{!! Form::radio('includeName', 'component', old('includeName', false), array('id'=>'incName_component') ) !!}
{!! Form::label('incName_both', 'Both') !!}
{!! Form::radio('includeName', 'both', old('includeName', false), array('id'=>'incName_both') ) !!}
</fieldset>

<fieldset>
<legend>Include Title (Dr., Ms., Mr.)</legend>
{!! Form::label('incTitle_some', 'Sometimes') !!}
{!! Form::radio('includeTitle', 'some', old('includeTitle', true), array('id'=>'incTitle_some') ) !!}
{!! Form::label('incTitle_yes', 'Yes') !!}
{!! Form::radio('includeTitle', 'yes', old('includeTitle', false), array('id'=>'incTitle_yes') ) !!}
{!! Form::label('incTitle_no', 'No') !!}
{!! Form::radio('includeTitle', 'no', old('includeTitle', false), array('id'=>'incTitle_no') ) !!}
</fieldset>

<fieldset>
<legend>Include Suffix (Jr., MD, III)</legend>
{!! Form::label('incSuffix_some', 'Sometimes') !!}
{!! Form::radio('includeSuffix', 'some', old('includeSuffix', true), array('id'=>'incSuffix_some') ) !!}
{!! Form::label('incSuffix_yes', 'Yes') !!}
{!! Form::radio('includeSuffix', 'yes', old('includeSuffix', false), array('id'=>'incSuffix_yes') ) !!}
{!! Form::label('incSuffix_no', 'No') !!}
{!! Form::radio('includeSuffix', 'no', old('includeSuffix', false), array('id'=>'incSuffix_no') ) !!}
</fieldset>

<div class="btn-group" role="group">
{!! Form::submit('Submit', array('class'=>'btn btn-default')) !!}
<a href="{!! Request::url() !!}" class="btn btn-default">Reset</a>
</div>
{!! Form::close() !!}

<pre id="output" contenteditable="true" tabindex="0">
{{ $content or '' }}
</pre>
@endsection
