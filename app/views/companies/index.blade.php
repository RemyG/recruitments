@extends('layout')

@section('content')
	<h2>Companies</h2>

	@foreach($companies as $company)
		<p><a href="companies/{{ $company->id }}">{{ $company->name }}</a></p>
	@endforeach

	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'companies', 'method' => 'post', 'class' => 'form-inline')) }}
	<div class="form-group">
		{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}
	</div>
	{{ Form::submit('Register!', array('class' => 'btn btn-primary')) }}
	{{ Form::token() . Form::close() }}
@stop