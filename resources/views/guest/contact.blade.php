@extends('_layouts.guest')
@section('title', 'Contact')

@section('header')
@endsection

@section('content')

<div class="page pb-0">
	<div class="container block-padding">
		<div class="row">
			<div class="col-lg-5 justify-content-center align-self-center text-lg-left text-sm-center text-xs-center">
				<h2>Get in Touch</h2>
				<span class="h7 mt-0">Contact us today for a quote</span>
				<p class="mt-2">Etiam rhoncus leo a dolor placerat, nec elem entum ipsum conval Qui quaerat fugit quas veniam perferendis repudiandae sequi, dolore quisquam illum.</p>
				<!-- contact icons-->
				<ul class="list-unstyled mt-3 list-contact colored-icons">
					<li><i class="fa fa-envelope margin-icon"></i><a href="mailto:albertahindischool@gmail.com">albertahindischool@gmail.com</a></li>
					<li><i class="fa fa-phone margin-icon"></i>(780) 432-3674</li>
					<li><i class="fa fa-map-marker margin-icon"></i>#104, 3907-98 Street, Edmonton, Alberta, T6E 6M3</li>
				</ul>
				<!-- /list-->
			</div>
			<!-- /col-lg- -->
			<!-- contact-info-->
			<div class="contact-info col-lg-6 offset-lg-1 res-margin notepad">
				<h4>Send us a message</h4>
				<!-- Form Starts -->
				<div id="contact_form">
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>Name<span class="required">*</span></label>
								<input type="text" name="name" class="form-control input-field" required="">
							</div>
							<div class="col-md-6">
								<label>Email Address <span class="required">*</span></label>
								<input type="email" name="email" class="form-control input-field" required="">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label>Subject</label>
								<input type="text" name="subject" class="form-control input-field">
							</div>
							<div class="col-md-12">
								<label>Message<span class="required">*</span></label>
								<textarea name="message" id="message" class="textarea-field form-control" rows="3" required=""></textarea>
							</div>
						</div>
						<button type="submit" id="submit_btn" value="Submit" class="btn btn-primary">Send message</button>
					</div>
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
	<!-- map-->
	<div id="map-canvas" class="container-fluid leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0" style="position: relative;">
		<div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(-419px, 0px, 0px);">
			<div class="leaflet-pane leaflet-tile-pane">
				<div class="leaflet-layer " style="z-index: 1; opacity: 1;">
					<div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 22; transform: translate3d(0px, 0px, 0px) scale(1);"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/19/154360/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(770px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/19/154360/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(770px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/19/154359/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(514px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/19/154361/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1026px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/19/154359/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(514px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/19/154361/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1026px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/19/154358/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(258px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/19/154362/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1282px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/19/154358/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(258px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/19/154362/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1282px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/19/154357/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(2px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/19/154363/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1538px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/19/154357/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(2px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/19/154363/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1538px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/19/154356/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-254px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://b.tile.openstreetmap.org/19/154364/197072.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1794px, -151px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://a.tile.openstreetmap.org/19/154356/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(-254px, 105px, 0px); opacity: 1;"><img alt="" role="presentation" src="https://c.tile.openstreetmap.org/19/154364/197073.png" class="leaflet-tile leaflet-tile-loaded" style="width: 256px; height: 256px; transform: translate3d(1794px, 105px, 0px); opacity: 1;"></div>
				</div>
			</div>
			<div class="leaflet-pane leaflet-shadow-pane"></div>
			<div class="leaflet-pane leaflet-overlay-pane"></div>
			<div class="leaflet-pane leaflet-marker-pane"><img src="img/mapmarker.png" class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0" style="margin-left: -32px; margin-top: -63px; width: 64px; height: 64px; transform: translate3d(952px, 175px, 0px); z-index: 175;"></div>
			<div class="leaflet-pane leaflet-tooltip-pane"></div>
			<div class="leaflet-pane leaflet-popup-pane"></div>
			<div class="leaflet-proxy leaflet-zoom-animated" style="transform: translate3d(3.95163e+07px, 5.04508e+07px, 0px) scale(262144);"></div>
		</div>
		<div class="leaflet-control-container">
			<div class="leaflet-top leaflet-left">
				<div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a><a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button" aria-label="Zoom out">−</a></div>
			</div>
			<div class="leaflet-top leaflet-right"></div>
			<div class="leaflet-bottom leaflet-left"></div>
			<div class="leaflet-bottom leaflet-right">
				<div class="leaflet-control-attribution leaflet-control"><a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | © <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a></div>
			</div>
		</div>
	</div>
	<!-- /map-->
</div>

@endsection

@section('footer')
@endsection