@extends('layout')

@section('content')
	<section class="companies">
		<h2>Companies</h2>

		{{ HTML::ul($errors->all()) }}

		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			@foreach($companies as $company)
				<tr>
					<td>
						<a href="companies/{{ $company->id }}">{{ $company->name }}</a>
					</td>
					<td></td>
				</tr>
			@endforeach
			</tbody>
			<tfoot>
				<tr>
					{{ Form::open(array('url' => 'companies', 'method' => 'post', 'class' => 'form')) }}
					<td>{{ Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder' => 'Name')) }}</td>
					<td>{{ Form::submit('Add', array('class' => 'btn btn-primary')) }}</td>
					{{ Form::token() . Form::close() }}
				</tr>
			</tfoot>
		</table>
	</section>
@stop