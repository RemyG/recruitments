@extends('layout')

@section('content')
	<h2>{{ $employee->name }}</h2>

	<div>Phone: {{ $employee->phone }}</div>
	<div>Email: {{ $employee->email }}</div>
	<div>Position: {{ $employee->position }}</div>
	<div>Company: <a href="/companies/{{ $employee->company->id }}">{{ $employee->company->name }}</a></div>

	<a href="/employees/{{ $employee->id }}/edit" class="btn btn-default">Edit this employee</a>

	<section class="contacts">
		<h3>Contacts</h3>
		<table class="table">
			<thead>
				<th>Date</th>
				<th>Type</th>
				<th>Description</th>
				<th></th>
			</thead>
			<tbody>
			@foreach($employee->contacts as $contact)
				<tr>
					<td>{{ $contact->date }}</td>
					<td>{{ $contact->type }}</td>
					<td>{{ $contact->description }}</td>
					<td></td>
				</tr>
			@endforeach
			</tbody>
			<tfoot>
				{{ Form::open(array('url' => 'contacts', 'class' => 'form')) }}
				<tr>
					<td><input id="date" name="date" type="date" value="{{ Input::old('date') }}" class="form-control" /></td>
					<td>{{ Form::text('type', Input::old('type'), array('class' => 'form-control')) }}</td>
					<td>{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}</td>
					<td>{{ Form::hidden('employee_id', $employee->id) }}{{ Form::submit('Add contact', array('class' => 'btn btn-primary')) }}</td>
				</tr>
				{{ Form::token() . Form::close() }}
			</tfoot>
		</table>
	</section>

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($employee, array('route' => array('employees.update', $employee->id), 'method' => 'put', 'class' => 'form')) }}
	{{ Form::label('name', 'Name') . Form::text('name', Input::old('name')) }}
	{{ Form::label('phone', 'Phone') . Form::text('phone', Input::old('phone')) }}
	{{ Form::label('email', 'Email') . Form::text('email', Input::old('email')) }}
	{{ Form::label('position', 'Position') . Form::text('position', Input::old('position')) }}
	{{ Form::hidden('company_id', Input::old('company_id')) }}
	{{ Form::submit('Update') }}
	{{ Form::token() . Form::close() }}
@stop

@section('modals')
<div class="modal fade" id="deleteModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Delete Employee</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this employee? All their contacts will also be deleted.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				{{ Form::open(array('url' => 'employees/' . $employee->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Employee', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop