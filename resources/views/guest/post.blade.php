@extends('_layouts/guest')
@section('title', 'Blog')

@section('header')
<meta name="description" content="{{ $post->summary }}" />
@endsection

@section('content')
<br/><br/>
<main class="aboutus">
	<!-- Contact -->
	<div class="container">
		<div class="">
			<!-- Get in Touch -->
			<div class="">
				<h3>{{ $post->title }}</h3>
			</div>

            <br/>

            @if($post->image != null)
            <!-- Post Image Start -->
            <div class="overflow_hidden post_img">
                <div class="radius" style="border-radius: 0px;"><img class="" src="{{ asset($post->image) }}"></div>
            </div>
            <!-- Post Image End -->
            @endif
            <br/>
			<!-- Get in Touch -->
            {!! $post->content !!}
		</div>
	</div>
	<!-- Contact -->
</main>

<br/><br/><br/><br/><br/><br/><br/><br/>

@endsection