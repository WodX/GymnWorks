@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>Create Post</h1>
		<hr>
		{{ Form::open(['action' => 'PostsController@store', 'method' => 'POST', "enctype" => "multipart/form-data"]) }}
		<div class="form-group">
			{{Form::label('title', 'Title')}}
			{{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
		</div>
		<div class="form-group">
			{{Form::label('body', 'Body')}}
			{{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body Text'])}}
		</div>
		<div class="form-group">
			{{Form::file('cover_image')}}
		</div>
		{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
		{{ Form::close() }}
	</div>
@endsection