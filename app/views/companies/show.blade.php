@extends('layout')

@section('content')
	<h2>{{ $company->name }}</h2>

	<div>
		Address:
		<address>{{ nl2br(e($company->address)) }}</address>
	</div>

	<div>
		Description:
		<p>{{ nl2br(e($company->description)) }}</p>
	</div>

	<div>
		<a href="/companies/{{ $company->id }}/edit" class="btn btn-default">Edit</a>
	</div>

	<h3>Employees</h3>
	<table class="table">
		<thead>
			<th>Name</th>
			<th>Phone</th>
			<th>Email</th>
			<th>Position</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($company->employees->sortBy('name') as $employee)
			<tr>
				<td>{{ $employee->name }}</td>
				<td>{{ $employee->phone }}</td>
				<td>{{ $employee->email }}</td>
				<td>{{ $employee->position }}</td>
				<td><a href="/employees/{{ $employee->id }}">View</a></td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
			{{ Form::open(array('url' => 'employees', 'method' => 'post', 'class' => 'form')) }}
				<td>{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}</td>
				<td>{{ Form::text('phone', Input::old('phone'), array('class' => 'form-control', 'placeholder' => 'Phone')) }}</td>
				<td>{{ Form::text('email', Input::old('email'), array('class' => 'form-control', 'placeholder' => 'Email')) }}</td>
				<td>{{ Form::text('position', Input::old('position'), array('class' => 'form-control', 'placeholder' => 'Position')) }}</td>
				<td>{{ Form::hidden('company_id', $company->id) }}{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}</td>
			{{ Form::token() . Form::close() }}
			</tr>
		</tfoot>
	</table>
@stop