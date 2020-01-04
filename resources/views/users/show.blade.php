@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>Profile</h1>
		<hr>
		<div class="col-md-12 text-center">
		<div><img src="/storage/_profileimg/{{$user->image}}" class="profile_image"></div><br><br>
		<spam><strong>Name:</strong><br>{{$user->name}}</spam><br><br>
		<spam><strong>Email:</strong><br>{{$user->email}}</spam><br><br>
		</div>
		<hr>
		@if(auth()->user()->id == $user->id)
			<div>
			    <a href="/user/{{auth()->user()->id}}/edit" class="btn btn-primary">Editar Conta</a>&nbsp&nbsp&nbsp
			    {{Form::open(['action' => ['UsersController@destroy', auth()->user()->id], 'method' => 'POST', 'class' => 'float-right'])}}
			    {{Form::hidden('_method', 'DELETE')}}
			    {{Form::button('Eliminar Conta' , ['type' => 'submit', 'class' => 'btn btn-danger'])}}
			    {{Form::close()}}
  			</div>
		@endif
		
	</div>
@endsection