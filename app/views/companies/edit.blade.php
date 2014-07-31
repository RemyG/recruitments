@extends('layout')

@section('content')
	<h2>Edit {{ $company->name }}</h2>

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($company, array('route' => array('companies.update', $company->id), 'method' => 'put')) }}
		<div class="form-group">
			{{ Form::label('name', 'Name') . Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('address', 'Address') . Form::textarea('address', Input::old('address'), array('class' => 'form-control')) }}
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Description') . Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>
		<a href="/companies/{{ $company->id }}" class="btn btn-default">Back</a>
		{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
	{{ Form::token() . Form::close() }}

	<div class="delete-section">
		<a data-toggle="modal" href="#deleteModal" class="btn btn-warning">Delete this company</a>
	</div>
@stop

@section('modals')
<div class="modal fade" id="deleteModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Delete Company</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this company? All employees and their contacts will also be deleted.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				{{ Form::open(array('url' => 'companies/' . $company->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Company', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop