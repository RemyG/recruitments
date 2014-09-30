@extends('layout')

@section('content')
<div class="row_12">
	<div class="col-md-6 login">
		<h2>Login</h2>
		@if (Session::has('flash_error'))
	        <div id="flash_error">{{ Session::get('flash_error') }}</div>
	    @endif
		{{ Form::open(array('url' => '/login', 'class' => 'box login form')) }}
		<div class="form-group">
			{{ Form::label('username', 'Username') . Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('password', 'Password') . Form::password('password', array('class' => 'form-control')) }}
		</div>
		<div class="checkbox">
			<label>
				{{ Form::checkbox('rememberme', 'on') }} Remember me
			</label>
		</div>
		{{ Form::submit('Login', array('class' => 'btn btn-primary')) }}
		{{ Form::token() . Form::close() }}
	</div>
	<div class="col-md-6 signup">
		<h2>Sign Up</h2>
		{{ HTML::ul($errors->signup->all()) }}
		{{ Form::open(array('url' => '/signup', 'class' => 'box login form')) }}
		<div class="form-group">
			{{ Form::label('signup_username', 'Username') . Form::text('signup_username', Input::old('signup_username'), array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('signup_password', 'Password') . Form::password('signup_password', array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('signup_password_confirmation', 'Confirm Password') . Form::password('signup_password_confirmation', array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('signup_email', 'Email') . Form::text('signup_email', Input::old('signup_email'), array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('signup_email_confirmation', 'Confirm Email') . Form::text('signup_email_confirmation', Input::old('signup_email_confirmation'), array('class' => 'form-control')) }}
		</div>
		{{ Form::submit('Sign Up', array('class' => 'btn btn-primary')) }}
		{{ Form::token() . Form::close() }}
	</div>
</div>

@stop