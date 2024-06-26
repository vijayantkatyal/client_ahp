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
	<!-- team carousel -->
	<div class="carousel-3items owl-carousel owl-theme mt-5 col-md-12">
		<!-- Team member 1 -->
		<div class="col-lg-12 team-style3 bg-secondary pattern2">
			<!-- image -->
			<a href="team-single.php">
				<img src="http://ahpschool.ca/Ref/images/board/amit.jpg" class="img-fluid rounded" alt="">
			</a>
			<!-- caption -->
			<div class="team-caption">
				<a href="team-single.php">
					<h4>Amit Aery</h4>
				</a>
				<h6>President</h6>
				<!-- <p>
					Incidunt accusamus necessitatibus modi adipisci officia libero accusantium esse hic, obcaecati, ullam, laboriosa
				</p> -->
			</div>
			<!-- social icons -->
			<div class="icons bg-primary">
				<a href="#"><i class="fa fa-envelope"></i></a>
				<a href="#"><i class="fab fa-facebook-f"></i></a>
				<a href="#"><i class="fab fa-instagram"></i></a>
			</div>
		</div>
		<!-- /team-style3 -->
		<!-- Team member 2 -->
		<div class="col-lg-12 team-style3 bg-secondary pattern2">
			<!-- image -->
			<a href="team-single.php">
				<img src="http://ahpschool.ca/Ref/images/board/jitu.png" class="img-fluid rounded" alt="">
			</a>
			<!-- caption -->
			<div class="team-caption">
				<a href="team-single.php">
					<h4>Jitendra Pariyani</h4>
				</a>
				<h6>V. P. (I) Admin.</h6>
			</div>
			<!-- social icons -->
			<div class="icons bg-tertiary">
				<a href="#"><i class="fa fa-envelope"></i></a>
				<a href="#"><i class="fab fa-facebook-f"></i></a>
				<a href="#"><i class="fab fa-instagram"></i></a>
			</div>
		</div>
		<!-- /team-style3 -->
		<!-- Team member 3 -->
		<div class="col-lg-12 team-style3 bg-secondary pattern2">
			<!-- image -->
			<a href="team-single.php">
				<img src="http://ahpschool.ca/Ref/images/board/rajiv.jpeg" class="img-fluid rounded" alt="">
			</a>
			<!-- caption -->
			<div class="team-caption">
				<a href="team-single.php">
					<h4>Rajiv Ranjan</h4>
				</a>
				<h6>V. P. (II) School</h6>
				<!-- <p>
					Incidunt accusamus necessitatibus modi adipisci officia libero accusantium esse hic, obcaecati, ullam, laboriosa
				</p> -->
			</div>
			<!-- social icons -->
			<div class="icons bg-primary">
				<a href="#"><i class="fa fa-envelope"></i></a>
				<a href="#"><i class="fab fa-facebook-f"></i></a>
				<a href="#"><i class="fab fa-instagram"></i></a>
			</div>
		</div>
		<!-- /team-style3 -->
	</div>
</div>
@endsection

@section('footer')
@endsection