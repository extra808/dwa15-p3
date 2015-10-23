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
{!! Form::label('json', 'JSON') !!}
{!! Form::radio('format', 'json', old('format', true), array('id'=>'json') ) !!}

{!! Form::label('csv', 'CSV') !!}
{!! Form::radio('format', 'csv', old('format', false), array('id'=>'csv') ) !!}

{!! Form::label('tab', 'Tab-delimited') !!}
{!! Form::radio('format', 'tab', old('format', false), array('id'=>'tab') ) !!}

{!! Form::label('plain', 'Plain') !!}
{!! Form::radio('format', 'plain', old('format', false), array('id'=>'plain') ) !!}
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

<fieldset>
<legend>Additional options</legend>
<div class="btn-group" role="group" data-toggle="buttons">
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('all', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">ALL
{!! Form::checkbox('includeOptions[]', 'all', null, array('id'=>'incOptions_all') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('address', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Address
{!! Form::checkbox('includeOptions[]', 'address', null, array('id'=>'incOptions_address') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('phoneNumber', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Phone Number
{!! Form::checkbox('includeOptions[]', 'phoneNumber', null, array('id'=>'incOptions_phoneNumber') ) !!}
</label>
<label id="dob" class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('dob', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Date of Birth
{!! Form::checkbox('includeOptions[]', 'dob', null, array('id'=>'incOptions_dob') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('email', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Email
{!! Form::checkbox('includeOptions[]', 'email', null, array('id'=>'incOptions_email') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('userName', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Username
{!! Form::checkbox('includeOptions[]', 'userName', null, array('id'=>'incOptions_userName') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('url', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">URL
{!! Form::checkbox('includeOptions[]', 'url', null, array('id'=>'incOptions_url') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('creditCard', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Credit Card
{!! Form::checkbox('includeOptions[]', 'creditCard', null, array('id'=>'incOptions_creditCard') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('uuid', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">UUID
{!! Form::checkbox('includeOptions[]', 'uuid', null, array('id'=>'incOptions_uuid') ) !!}
</label>
<label class="btn btn-default <?php if( (null !== session('_old_input.includeOptions') ) && in_array('bio', session('_old_input.includeOptions') ) ) { echo 'active'; } ?>">Bio
{!! Form::checkbox('includeOptions[]', 'bio', null, array('id'=>'incOptions_bio') ) !!}
</label>
</div>
</fieldset>


<div class="btn-group" role="group">
{!! Form::submit('Submit', array('class'=>'btn btn-default')) !!}
{!! Form::submit('Reset', array('name'=>'reset', 'class'=>'btn btn-default')) !!}
</div>
{!! Form::close() !!}

<pre id="output" contenteditable="true" tabindex="0">
{{ $content or '' }}
</pre>
@endsection
