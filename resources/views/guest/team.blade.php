@extends('_layouts.guest')
@section('title', 'Team')

@section('header')
<style>
	.img-fluid {
		max-height: 360px;
	}
</style>
@endsection

@section('content')
<br/>
<div class="container block-padding">
	<h3 class="text-center">Board Members</h3>
	
	<div class="carousel-3items owl-carousel owl-theme mt-5 col-md-12">
		
		@foreach($users as $user)
		<div class="col-lg-12 team-style3 bg-secondary pattern2">
			@if($user->profile_pic)
				<img src="{{ asset($user->profile_pic) }}" class="img-fluid rounded" alt="">
			@else
				<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzBXNuO6PezhC18aYH_2cYtS0I7KbxoKYdwA&s" class="img-fluid rounded" alt="">
			@endif
			<div class="team-caption">
				<a href="team-single.php">
					<h4>{{ $user->first_name }} {{ $user->last_name }}</h4>
				</a>
				<h6>{{ $user->title }}</h6>
				<p>
					{{ $user->description }}
				</p>
			</div>
		</div>
		@endforeach
		
	</div>
</div>
@endsection

@section('footer')
@endsection