@extends('layouts.app')

@section('content')
	<div class="col-md-12 col-md-12 last-plans" data-aos="fade-in">
		<h1>{{ $title }}</h1>

		@if(count($plans) > 0)
			@foreach($plans as $plan)
				<div class="post-box" data-aos="fade-up">
					<h3><a href="/plans/{{$plan->id}}">{{$plan->title}}</a></h3>
					<small>Created at {{$plan->created_at}}</small>
					<br><br>
				</div>
			@endforeach 
		@else
			<p>No Plans</p>
		@endif
	</div>
@endsection