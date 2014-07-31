@extends('layout')

@section('content')
	<h2>Edit {{ $employee->name }}</h2>

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($employee, array('route' => array('employees.update', $employee->id), 'method' => 'put', 'class' => 'form')) }}
	<div class="form-group">
		{{ Form::label('name', 'Name') . Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('phone', 'Phone') . Form::text('phone', Input::old('phone'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('email', 'Email') . Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('position', 'Position') . Form::text('position', Input::old('position'), array('class' => 'form-control')) }}
	</div>
	{{ Form::hidden('company_id', Input::old('company_id')) }}
	<a href=".." class="btn btn-default">Back</a>
	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
	{{ Form::token() . Form::close() }}

	<div class="delete-section">
		<a data-toggle="modal" href="#deleteModal" class="btn btn-warning">Delete this employee</a>
	</div>
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