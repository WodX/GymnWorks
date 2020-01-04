@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>Edit Post</h1>
		<hr>
		{{ Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', "enctype" => "multipart/form-data"]) }}
		<div class="form-group">
			{{Form::label('title', 'Title')}}
			{{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
		</div>
		<div class="form-group">
			{{Form::label('body', 'Body')}}
			{{Form::textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
		</div>
		<div class="form-group">
			<img src="/storage/_postimg/{{$post->cover_image}}" width="200px;">
		</div>
		<div class="form-group">
			{{Form::file('cover_image')}}
		</div>
		{{Form::hidden('_method', 'PUT')}}
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{{ Form::close() }}
	</div>
@endsection