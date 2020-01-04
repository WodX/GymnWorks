@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<div class="post-view">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-8">
						<h1>{{$post->title}}</h1>
						<img src="/storage/_postimg/{{$post->cover_image}}" width="100%;"><br><br>
						<p>{{$post->body}}</p>
						<p><a href="/posts">Go back</a></p>
						<hr>
						<small>Created at {{$post->created_at}} by <a href="{{url('/user/'.$post->user->id.'/show')}}">{{$post->user->name}}</a></small>

						@if(Auth::user()->id == $post->user_id || Auth::user()->role == "admin")
							<hr>
							<a href="/posts/{{$post->id}}/edit" class="btn btn-primary edit-button">Edit</a>

							{{Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])}}
								{{Form::hidden('_method', 'DELETE')}}
								{{Form::submit('Delete', ['class' => 'btn btn-danger del-button'])}}
							{{Form::close()}}
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection