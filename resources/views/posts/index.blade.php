@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>Blog</h1>
		<hr>
		@if(count($posts) > 0)
			@foreach($posts as $post)
				<div class="post-box" data-aos="fade-up">
					<a href="/posts/{{$post->id}}" class="post-link">
						<div class="row">
							<div class="col-xl-4 col-sm-12">
								<img src="/storage/_postimg/{{$post->cover_image}}" width="100%;">
							</div>
							<div class="col-xl-8 col-sm-12">
								<h3>{{$post->title}}</h3>
								<small>Created at {{$post->created_at}} by {{$post->user->name}}</small>
							</div>
						</div>
					</a>	
				</div>
			@endforeach 
		@else
			<p>No posts</p>
		@endif
	</div>
@endsection