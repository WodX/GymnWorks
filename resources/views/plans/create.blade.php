@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>Create Plan</h1>
		<hr>
		{{ Form::open(['action' => 'PlansController@store', 'method' => 'POST']) }}
		<div class="form-group">
			{{Form::label('title', 'Title')}}
			{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
		</div>
		<div class="form-group">
			{{Form::label('body', 'Description')}}
			{{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Description Text'])}}
		</div>
		<div class="form-group">
			{{Form::label('body', 'Gymnasts')}}
			<div>
				@foreach($users as $user)
					<div class="radio-wrapper">
		          		<input @if($user->id)) checked="checked" @endif type="radio" id="user-id-{{ $user->id }}" name="users[]" value="{{ $user->id }}">
		           		<label class="radio-label" for="user-id-{{ $user->id }}">{{ $user->name }}</label>
				    </div>
				@endforeach
			</div>
		</div>
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{{ Form::close() }}
	</div>
@endsection