@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>Edit User</h1>
		<hr>
		{{ Form::open(['action' => ['UsersController@update', $user->id], 'method' => 'POST', "enctype" => "multipart/form-data"]) }}
		
		<div class="col-md-12 text-center">
			<div>
				<img src="/storage/_profileimg/{{$user->image}}" class="profile_image">
			</div>
			<br>
			<div class="form-group">
				{{Form::file('image')}}
			</div>
		</div>

		<div class="form-group">
			{{Form::label('name', 'Name')}}
			{{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Name'])}}
		</div>
		<div class="form-group">
			{{Form::label('email', 'Email')}}
			{{Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'Email'])}}
		</div>
		<div class="form-group">
			{{Form::label('password', 'Password')}}
			{{Form::password('password', ['id' => 'password','class' => 'form-control', 'placeholder' => 'Write only if you want to change password'])}}
		</div>
		@if(auth()->user()->role == 'admin')
			{{Form::label('role', 'Role')}}
			{{Form::select('role', ['gymnast' => 'Gymnast','coach'=>'Coach','admin'=>'Admin'], ['selected' => $user->role], ['class' => 'form-control'])}}
		@endif
		<br>
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{{ Form::close() }}
	</div>
@endsection