@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>{{$plan->title}}</h1>
		<hr>
		<p>{{$plan->body}}</p>
		<br><br>	
		<h3>Tasks</h3>
		@if($plan->tasks->count() > 0)
			<div class="box">
				@foreach($plan->tasks as $task)
					<div class="container">
						
					{{-- <label class="checkbox {{$task->completed ? 'is-complete' : ''}}" for="completed">
						<input type="checkbox" name="completed" onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
						{{$task->description}}
					</label> --}}

					<div class="row">
						<div class="col-md-11">
							<form method="POST" action="/tasks/{{$task->id}}">
							@method('PATCH')
							@csrf
								<div class="checkbox-wrapper">
					          		<input type="checkbox" id="task-id-{{ $task->id }}" name="completed" onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
					           		<label class="checkbox-label" for="task-id-{{ $task->id }}">{{$task->description}}</label>
					           	</div>
							</form>
			           	</div>
						<div class="col-md-1">
							@if(Auth::user()->can('create', App\Plan::class))
								{{Form::open(['action' => ['PlanTasksController@destroy', $task->id], 'method' => 'POST'])}}
								{{Form::hidden('_method', 'DELETE')}}
								{{Form::button('<img src='.'../storage/_images/delete.png'.' width=100%>' , ['type' => 'submit', 'class' => 'delete_button_icon'])}}
								{{Form::close()}}
							@endif
						</div>
					</div>
				</div>
				@endforeach
			</div>
		@endif	

		@if(Auth::user()->can('create', App\Plan::class))
			<form method="POST" action="/plans/{{$plan->id}}/tasks" class="box">
				@csrf
				<div class="field mt-3">
					<div class="control">
					<input type="text" class="input" name="description" placeholder="New Task">
				</div>
				<div class="field mt-1">
					<div class="control">
						<button type="submit" class="btn btn-primary">New Task</button>
					</div>
				</div>
				</div>
				
			</form>
		@endif

		<hr>
		@if(Auth::user()->id == $plan->user_id)
			<a href="/plans/{{$plan->id}}/edit" class="btn btn-primary">Edit Plan</a>
			{{Form::open(['action' => ['PlansController@destroy', $plan->id], 'method' => 'POST', 'class' => 'float-right'])}}
				{{Form::hidden('_method', 'DELETE')}}
				{{Form::submit('Delete Plan', ['class' => 'btn btn-danger'])}}
			{{Form::close()}}
		@endif
	</div>
@endsection