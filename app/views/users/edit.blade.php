@extends('layout')

@section('content')
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($user, array('url' => '/profile', 'method' => 'post')) }}
	<div class="form-group">
		{{ Form::label('username', 'Username') . Form::text('username', Input::old('username'), array('class' => 'form-control', 'readonly' => 'readonly')) }}
	</div>
	<div class="form-group">
		{{ Form::label('password', 'Password') . Form::password('password', array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('password_confirmation', 'Confirm Password') . Form::password('password_confirmation', array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('email', 'Email') . Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('email_confirmation', 'Confirm Email') . Form::text('email_confirmation', Input::old('email_confirmation'), array('class' => 'form-control')) }}
	</div>
	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
	{{ Form::token() . Form::close() }}
@stop