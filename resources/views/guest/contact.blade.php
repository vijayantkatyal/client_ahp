@extends('_layouts.guest')
@section('title', 'Contact')

@section('header')
@endsection

@section('content')

@if(session('status.success'))
    <div style="margin-top: 50px; background-color: #40d940; border-radius: 10px; padding: 10px; color: #fff; font-size: 20px;">
        {{ session('status.success') }}
    </div>
@endif

<div class="page pb-0">
	<div class="container block-padding">
		<div class="row">
			<div class="col-lg-5 justify-content-center align-self-center text-lg-left text-sm-center text-xs-center">
				<h2>Get in Touch</h2>
				<!-- contact icons-->
				<ul class="list-unstyled mt-3 list-contact colored-icons">
					@if(App\Models\Site::settings()['support_email'] != null)
						<li><i class="fa fa-envelope margin-icon"></i><a href="mailto:{{ App\Models\Site::settings()['support_email'] }}">{{ App\Models\Site::settings()['support_email'] }}</a></li>
					@endif
					@if(App\Models\Site::settings()['phone'] != null)
					<li><i class="fa fa-phone margin-icon"></i>{{ App\Models\Site::settings()['phone'] }}</li>
					@endif
					@if(App\Models\Site::settings()['address'] != null)
					<li><i class="fa fa-map-marker margin-icon"></i>{{ App\Models\Site::settings()['address'] }}</li>
					@endif
				</ul>
				<!-- /list-->
			</div>
			<!-- /col-lg- -->
			<!-- contact-info-->
			<div class="contact-info col-lg-6 offset-lg-1 res-margin notepad">
				<h4>Send us a message</h4>
				<!-- Form Starts -->
				<div id="contact_form">
					<form class="form-group" action="{{ route('post_contact') }}" method="post">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-md-6">
								<label>Name<span class="required">*</span></label>
								<input type="text" name="name" required class="form-control input-field" required="">
							</div>
							<div class="col-md-6">
								<label>Email Address <span class="required">*</span></label>
								<input type="email" name="email" required class="form-control input-field" required="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Phone</label>
								<input type="text" name="phone" class="form-control input-field">
							</div>
							<div class="col-md-12">
								<label>Message<span class="required">*</span></label>
								<textarea name="message" id="message" class="textarea-field form-control" rows="3" required=""></textarea>
							</div>
						</div>
						<button type="submit" id="submit_btn" value="Submit" class="btn btn-primary">Send message</button>
					</form>
					<!-- /form-group-->
					<!-- Contact results -->
					<div id="contact_results"></div>
				</div>
				<!-- /contact)form-->
			</div>
			<!-- /contact-info-->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>

@endsection

@section('footer')
@endsection