@extends('layouts.app')

@section('content')
<div class="row last-plans" data-aos="fade-in">
	<div class="col-md-12 ">
		<h1>Your Gymnasts</h1>
		<hr>
	</div>
	@foreach($gymnasts as $gymnast)
		<div class="col-md-8" data-aos="fade-up">
			<img class="dashimg float-left mr-2" src="/storage/_profileimg/{{$gymnast->user->image}}">
			<h4 class="float-left">{{ $gymnast->user->name }}<h4>
		</div>
		<div class="col-md-4 text-right" data-aos="fade-up">
			{{Form::open(['action' => ['UserGymnastsController@destroy', $gymnast->id], 'method' => 'POST'])}}
			{{Form::hidden('_method', 'DELETE')}}
			{{Form::button('<img src='.'../storage/_images/delete.png'.' width=100%>' , ['type' => 'submit', 'class' => 'delete_button_icon'])}}
			{{Form::close()}}
		</div>


	@endforeach
</div>

@if($usersNotAdded->isNotEmpty())
	<div class="row last-plans" data-aos="fade-in">
		<div class="col-md-12">
			<h1>All Gymnasts</h1>
			<hr>
		</div>
		@foreach($usersNotAdded as $user)
			<div class="col-md-8" data-aos="fade-up">
				<img class="dashimg float-left mr-2" src="/storage/_profileimg/{{$user->image}}">
				<h4 class="float-left">{{$user->name}}</h4>
			</div>
			<div class="col-md-4" data-aos="fade-up">
				<form action="/user/{{$user->id}}/gymnasts" method="POST">
					@csrf
					<button type="submit" class=" btn btn-add-gymn float-right">Add Gymnast</button>
				</form>
			</div>
		@endforeach
	</div>
@endif

@endsection