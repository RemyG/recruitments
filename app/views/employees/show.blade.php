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
	<h2>{{ $employee->name }}</h2>

	<div>Phone: {{ $employee->phone }}</div>
	<div>Email: {{ $employee->email }}</div>
	<div>Position: {{ $employee->position }}</div>
	<div>Company: <a href="/companies/{{ $employee->company->id }}">{{ $employee->company->name }}</a></div>

	<a href="/employees/{{ $employee->id }}/edit" class="btn btn-default">Edit</a>

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
			@foreach($employee->contacts->sortByDesc('date') as $contact)
				<tr>
					<td>{{ $contact->date }}</td>
					<td>{{ $contact->type }}</td>
					<td>{{ $contact->description }}</td>
					<td><a href="{{ URL::to('contacts/' . $contact->id . '/edit') }}">Edit</a></td>
				</tr>
			@endforeach
			</tbody>
			<tfoot>
				{{ Form::open(array('url' => 'contacts', 'class' => 'form')) }}
				<tr>
					<td><input id="date" name="date" type="text" value="{{ Input::old('date') }}" class="form-control" /></td>
					<td>{{ Form::text('type', Input::old('type'), array('class' => 'form-control')) }}</td>
					<td>{{ Form::textarea('description', Input::old('description'), array('class' => 'form-control')) }}</td>
					<td>{{ Form::hidden('employee_id', $employee->id) }}{{ Form::submit('Add contact', array('class' => 'btn btn-primary')) }}</td>
				</tr>
				{{ Form::token() . Form::close() }}
			</tfoot>
		</table>
	</section>
@stop