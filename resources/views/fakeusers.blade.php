@extends('layouts.master')

@section('title')
{{ $title or '' }} {{ $sitetitle }}
@endsection

@section('content')
{!! Form::open() !!}
{!! Form::label('qty', 'Quantity') !!}
{!! Form::number('qty', old('qty', 6), array('required'
    , 'min'=>'1'
    , 'max'=>'99'
    , 'step'=>'1'
    )) !!}

<fieldset>
<legend>Generate Names as</legend>
{!! Form::label('incName_full', 'Full Name') !!}
{!! Form::radio('incName', 'full', old('incName', true), array('id'=>'incName_full') ) !!}
{!! Form::label('incName_component', 'Name in Components') !!}
{!! Form::radio('incName', 'component', old('incName', false), array('id'=>'incName_component') ) !!}
{!! Form::label('incName_both', 'Both') !!}
{!! Form::radio('incName', 'both', old('incName', false), array('id'=>'incName_both') ) !!}
</fieldset>

<fieldset>
<legend>Include Title (Dr., Ms., Mr.)</legend>
{!! Form::label('incTitle_some', 'Sometimes') !!}
{!! Form::radio('incTitle', 'some', old('incTitle', true), array('id'=>'incTitle_some') ) !!}
{!! Form::label('incTitle_yes', 'Yes') !!}
{!! Form::radio('incTitle', 'yes', old('incTitle', false), array('id'=>'incTitle_yes') ) !!}
{!! Form::label('incTitle_no', 'No') !!}
{!! Form::radio('incTitle', 'no', old('incTitle', false), array('id'=>'incTitle_no') ) !!}
</fieldset>

<fieldset>
<legend>Include Suffix (Jr., MD, III)</legend>
{!! Form::label('incSuffix_some', 'Sometimes') !!}
{!! Form::radio('incSuffix', 'some', old('incSuffix', true), array('id'=>'incSuffix_some') ) !!}
{!! Form::label('incSuffix_yes', 'Yes') !!}
{!! Form::radio('incSuffix', 'yes', old('incSuffix', false), array('id'=>'incSuffix_yes') ) !!}
{!! Form::label('incSuffix_no', 'No') !!}
{!! Form::radio('incSuffix', 'no', old('incSuffix', false), array('id'=>'incSuffix_no') ) !!}
</fieldset>
{!! Form::submit('Submit') !!}
{!! Form::close() !!}

<pre id="output" contenteditable="true" tabindex="0">
@forelse ($fusers as $fuser)
    {{ $fuser }}
@empty
    No users
@endforelse
</pre>
@endsection
