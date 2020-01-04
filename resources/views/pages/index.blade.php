@extends('layouts.app')

@section('content')
	<div class="row" >
		<div class="col-md-12 col-md-12 last-plans text-center" data-aos="fade-down">
			<h1>Welcome to GymnWorks!</h1><br><br>
			<p>
				GymWorks is an online platform that helps the development of gymnasts. As a gymnast myself, I've always looked for ways to cooperate with my coach in a seamless way, wherever we are, through tasks and plans, but I had no success. That is why I decided to create Gymnworks!
With this application, you can be assigned any tasks and any plans, by your coach, in a simple and intuitive way. You will be able to access these anywhere you may be, through your Gymnast Dashboard.<br><br>
No more excuses, let's start working out and get better by the day! 
			</p>
		</div>
	</div>
	@if($plans->isNotEmpty())
		<div class="row">
			<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
				<h1>My Plans</h1>
				@foreach($plans as $plan)
					<div class="post-box" data-aos="fade-up">
						<h3><a href="/plans/{{$plan->id}}">{{$plan->title}}</h3></a>
						<small>Created at {{$plan->created_at}}</small>
						<br><br>
					</div>
				@endforeach 
			</div>
		</div>
	@endif
	<div class="row">
		<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
			<h1>Last Posts</h1>
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
		</div>
	</div>
@endsection