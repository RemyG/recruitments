@extends('layout')

@section('css')
<link rel="stylesheet" href="/css/jquery-ui-smoothness.css">
@stop

@section('javascript')
<script src="/js/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
	$( "#date" ).datepicker({ dateFormat: "yy-mm-dd" });
});
</script>
@stop

@section('content')

	<h2>Edit Contact</h2>

	{{ HTML::ul($errors->all()) }}

	{{ Form::model($contact, array('route' => array('contacts.update', $contact->id), 'method' => 'put', 'class' => 'form')) }}
	<div class="form-group">
		{{ Form::label('date', 'Date') }}<input id="date" name="date" type="text" value="{{{ null !== Input::old('date') ? Input::old('date') : $contact->date }}}" class="form-control" />
	</div>
	<div class="form-group">
		{{ Form::label('type', 'Type') . Form::text('type', Input::old('type'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('description', 'Description') . Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}
	</div>
	{{ Form::hidden('employee_id', Input::old('employee_id')) }}
	<a href=".." class="btn btn-default">Back</a>
	{{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
	{{ Form::token() . Form::close() }}

	<div class="delete-section">
		<a data-toggle="modal" href="#deleteModal" class="btn btn-warning">Delete this contact</a>
	</div>
@stop

@section('modals')
<div class="modal fade" id="deleteModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title">Delete Contact</h4>
			</div>
			<div class="modal-body">
				<p>Are you sure you want to delete this contact?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				{{ Form::open(array('url' => 'contacts/' . $contact->id, 'class' => 'pull-right')) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('Delete this Contact', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop