@extends('layout')

@section('content')
	{{ Form::open(array('url' => '/login', 'class' => 'box login form')) }}
	<div class="form-group">
		{{ Form::label('username', 'Username') . Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('password', 'Password') . Form::text('password', Input::old('password'), array('class' => 'form-control')) }}
	</div>
	<div class="checkbox">
		<label>
			{{ Form::checkbox('rememberme', 'on') }} Remember me
		</label>
	</div>
	{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
	{{ Form::token() . Form::close() }}

@stop