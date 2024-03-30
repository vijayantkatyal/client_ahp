@extends('_layouts/guest')
@section('title', 'Home')

@section('header')
@endsection

@section('content')

<!-- HEADER end --> <!-- Header slideshow start -->
<div class="overflow_hidden">
	<div class="radius_niz_mini">
		<div class="slideshow owl-carousel owl-theme">
			<!-- Start slideshow item -->
			<div class="item">
				<div class="row slideshow_heding">
					<div class="slideshow-image lozad" data-background-image="{{ asset('/assets/img/slide1.jpg') }}" id="slide1"></div>
					<h4>We Create Your<br />Healthy Smiles</h4>
					<div class="slideshow_info_block">With latest technologies and best doctors in industry</div>
					<div class="popup"><a data-effect="mfp-zoom-in" class="btn" data-cal-link="vijayant-katyal-f360uo/30min" data-cal-namespace="" data-cal-config='{"layout":"month_view"}'>Make an Appointment</a></div>
				</div>
			</div>
			<!-- End slideshow item -->
			<!-- Start slideshow item -->
			<div class="item">
				<div class="row slideshow_heding">
					<div class="slideshow-image lozad" data-background-image="{{ asset('/assets/img/slide2.jpg') }}" id="slide2"></div>
					<h4>Best Whitening<br />in Alberta</h4>
					<div class="slideshow_info_block">Get your perfect smile with best specialists in service</div>
					<div class="popup"><a data-effect="mfp-zoom-in" class="btn" data-cal-link="vijayant-katyal-f360uo/30min" data-cal-namespace="" data-cal-config='{"layout":"month_view"}'>Make an Appointment</a></div>
				</div>
			</div>
			<!-- End slideshow item -->
			<!-- Start slideshow item -->
			<div class="item">
				<div class="row slideshow_heding">
					<div class="slideshow-image lozad" data-background-image="{{ asset('/assets/img/slide3.jpg') }}" id="slide3"></div>
					<h4>Happy Kids with<br />Healthy Theeth</h4>
					<div class="slideshow_info_block">We bring dental care for patients of all ages</div>
					<div class="popup"><a data-effect="mfp-zoom-in" class="btn" data-cal-link="vijayant-katyal-f360uo/30min" data-cal-namespace="" data-cal-config='{"layout":"month_view"}'>Make an Appointment</a></div>
				</div>
			</div>
			<!-- End slideshow item -->
		</div>
	</div>
</div>
<!--  Header slideshow end -->

<!--  Main start -->
<main>
	<!-- Service start -->
	<div class="row services">
		<div class="overflow_hidden">
			<div class="radius_row_niz services_row">
				<div class="container">
					<div class="row row-15">
						<!-- Service item start -->
						<a href="/service_page.php" class="services_item">
							<span class="services_item_title">Cosmetic Dentistry</span>
							<span class="services_item_desc">Vineers, whitening, bonding, fillings etc.</span>
							<i class="dental_icon dentalic_cosmetic"></i>
						</a>
						<!-- Service item end -->
						<!-- Service item start -->
						<a href="/service_page.php" class="services_item">
							<span class="services_item_title">General Dentistry</span>
							<span class="services_item_desc">Cleanings, checkups, sleep apnea etc.</span>
							<i class="dental_icon dentalic_general"></i>
						</a>
						<!-- Service item end -->
						<!-- Service item start -->
						<a href="/service_page.php" class="services_item">
							<span class="services_item_title">Restorations</span>
							<span class="services_item_desc">Implants, crowns, dentures, bridges etc.</span>
							<i class="dental_icon dentalic_restorations"></i>
						</a>
						<!-- Service item end -->
						<!-- Service item start -->
						<a href="/service_page.php" class="services_item">
							<span class="services_item_title">Orthodontics</span>
							<span class="services_item_desc">Invisalign, metal braces, expanders</span>
							<i class="dental_icon dentalic_iorthodontics"></i>
						</a>
						<!-- Service item end -->
						<!-- Service item start -->
						<a href="/service_page.php" class="services_item">
							<span class="services_item_title">Oral Surgery</span>
							<span class="services_item_desc">Dental extractions, root canals, tissue</span>
							<i class="dental_icon dentalic_combined"></i>
						</a>
						<!-- Service item end -->
						<!-- Service item start -->
						<a href="/service_page.php" class="services_item">
							<span class="services_item_title">Pediatric Dentistry</span>
							<span class="services_item_desc">Oral health of infants, children, adolescents</span>
							<i class="dental_icon dentalic_pediatric"></i>
						</a>
						<!-- Service item end -->
					</div>
					<div class="view_servises">
						<a href="/service_page.php" class="more">View all servises</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Service end -->

	<!-- Video start -->
	<div class="row video">
		<div class="container">
			<iframe height="535" style="border:0;" class="lozad" data-src="https://www.youtube.com/embed/OHLU3cVuQ9A?rel=0&amp;showinfo=0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
		</div>
	</div>
	<!-- Video end -->

	<!-- Info Block start -->
	<div class="row info_blok">
		<div class="container">
			<div class="row">
				<!-- Open Hours start -->
				<div class="col-2 open_hours">
					<div class="info_blok_title">
						<h4>Open Hours</h4>
					</div>
					<div class="row open_hours_content">
						<!-- Open Hours Block start -->
						<div class="row hours_block">
							<div class="open_hours_title">Monday–Thursday</div>
							<div class="row open_hours_block">
								<div class="hours">
									8:30
									<span>am</span>
								</div>
								<div class="minute">
									- 5:00
									<span>pm</span>
								</div>
							</div>
						</div>
						<!-- Open Hours Block end -->
						<!-- Open Hours Block start -->
						<div class="row hours_block">
							<div class="open_hours_title">Friday</div>
							<div class="row open_hours_block">
								<div class="hours">
									8:30
									<span>am</span>
								</div>
								<div class="minute">
									- 3:00
									<span>pm</span>
								</div>
							</div>
						</div>
						<!-- Open Hours Block end -->
						<!-- Open Hours Block start -->
						<div class="row hours_block appointment_block">
							<div class="open_hours_title">Saturday - Sunday</div>
							<div class="row open_hours_block">
								<div class="appointment">
									Closed
								</div>
							</div>
						</div>
						<!-- Open Hours Block end -->
					</div>
				</div>
				<!-- Open Hours end -->

				<!-- Contact Us start -->
				<div class="col-2 contact_us">
					<div class="info_blok_title">
						<h4>Contact Us</h4>
					</div>
					<div class="row div_contact_us_content">
						<!-- Contact Us Block start -->
						<div class="row contact_us_block">
							<div class="div_contact_us_title">Phone</div>
							<div class="row div_contact_us_block">
								<div class="contact_us_phone">+1 780 514 7359</div>
							</div>
						</div>
						<!-- Contact Us Block end -->
						<!-- Contact Us Block start -->
						<div class="row contact_us_block contact_us_block_mail">
							<div class="div_contact_us_title">Email</div>
							<div class="row div_contact_us_block">
								<div class="contact_us_mail"> <a href="mailto:valleydental23@gmail.com">valleydental23@gmail.com</a> </div>
							</div>
						</div>
						<!-- Contact Us Block end -->
						<!-- Contact Us Block start -->
						<div class="row contact_us_block">
							<div class="div_contact_us_title">Address</div>
							<div class="row div_contact_us_address">
								<div class="div_contact_us_address_title">5205 Power Center Blvd #108, Drayton Valley, AB T7A 0A5</div>
								<div class="div_contact_us_address_title_map">
									<iframe class="lozad" data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3333.967410377096!2d-111.89998968453055!3d33.31966746342457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzPCsDE5JzEwLjgiTiAxMTHCsDUzJzUyLjEiVw!5e0!3m2!1sen!2sus!4v1516690469899" height="95" style="border:0" allowfullscreen></iframe>
								</div>
							</div>
						</div>
						<!-- Contact Us Block end -->
					</div>
				</div>
				<!-- Contact Us end -->
			</div>
		</div>
	</div>
	<!-- Info Block end -->

	<!-- About start -->
	<div class="container about">
		<div class="row">
			<!-- About left col start -->
			<div class="col-2 about_left">
				<div class="row">
					<h4>About Practice</h4>
					<div class="about_left_h2">
						At Valley Dental, our goal is to provide great patient care and high quality dentistry with a smile. We offer an extensive range of dentistry from preventative care appointments to smile design and replacement of broken or missing teeth.
					</div>
					<div class="about_left_text">
						Our priority is to create a warm, friendly and caring environment. If you have a question regarding any part of your dental care, don’t hesitate to give us a call. We want you to feel like part of our family. Remember your smile is one of our greatest gifts!
					</div>
					<a class="more">Learn more</a>
					<!-- Advantages start -->
					<div class="row advantages">
						<div class="advantages_item">
							<strong>12</strong>
							<span>years of experience</span>
						</div>
						<div class="advantages_item">
							<strong>Hundreds</strong>
							<span>happy clients</span>
						</div>
						<div class="advantages_item">
							<strong>15</strong>
							<span>awards in industry</span>
						</div>
					</div>
					<!-- Advantages end -->
				</div>
			</div>
			<!-- About left col end -->


			<!-- About right col start -->
			<div class="col-2 about_right">
				<!-- About image start -->
				<div class="row about_image">
					<!-- About image left col start -->
					<div class="col-2 about_image_left">
						<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/Facility-1.jpg.webp') }}" data-srcset="{{ asset('/assets/img/Facility-1.jpg.webp') }}, {{ asset('/assets/img/Facility-1.jpg.webp') }} 2x" alt="Valley Dental" />
						<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/Facility-2.jpg.webp') }}" data-srcset="{{ asset('/assets/img/Facility-2.jpg.webp') }}, {{ asset('/assets/img/Facility-2.jpg.webp') }} 2x" alt="Valley Dental" />
					</div>
					<!-- About image left col end -->
					<!-- About image right col start -->
					<div class="col-2 about_image_right">
						<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/Facility-3.jpg.webp') }}" data-srcset="{{ asset('/assets/img/Facility-3.jpg.webp') }}, {{ asset('/assets/img/Facility-3.jpg.webp') }} 2x" alt="Valley Dental" />
						<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/Facility-4.jpg.webp') }}" data-srcset="{{ asset('/assets/img/Facility-4.jpg.webp') }}, {{ asset('/assets/img/Facility-4.jpg.webp') }} 2x" alt="Valley Dental" />
						<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/Facility-5.jpg.webp') }}" data-srcset="{{ asset('/assets/img/Facility-5.jpg.webp') }}, {{ asset('/assets/img/Facility-5.jpg.webp') }} 2x" alt="Valley Dental" />
					</div>
					<!-- About image right col end -->
				</div>
				<!-- About image end -->
			</div>
			<!-- About right col end -->
		</div>
	</div>
	<!-- About end -->

	<!-- Certificates start -->
	<div class="row certificates">
		<div class="container row">
			<h4>Certificates & Associations</h4>
			<div class="navigation"></div>
		</div>
		<div class="owl_certificates owl-carousel owl-theme gallery">
			<div class="item"><a href="{{ asset('/assets/img/certificates_1.png') }}"><img class="owl-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/certificates_1.png') }}" alt="Valley Dental" /></a></div>
			<div class="item"><a href="{{ asset('/assets/img/certificates_2.png') }}"><img class="owl-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/certificates_2.png') }}" alt="Valley Dental" /></a></div>
			<div class="item"><a href="{{ asset('/assets/img/certificates_3.png') }}"><img class="owl-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/certificates_3.png') }}" alt="Valley Dental" /></a></div>
			<div class="item"><a href="{{ asset('/assets/img/certificates_4.png') }}"><img class="owl-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/certificates_4.png') }}" alt="Valley Dental" /></a></div>
		</div>
	</div>
	<!-- Certificates end -->

	<!-- Start Dentists Tabs -->
	<div id="dentists">
		<!-- Start Dentists Tabs Container -->
		<div class="container">
			<div class="row tabs">
				<!-- Start Dentists Tabs Title Left Col -->
				<div class="tabs_l row">
					<h4>Our Team</h4>
					<ul>
						<li><a href="#tab1">Dr. Manmeet</a></li>
						<li><a href="#tab2">Dr. Puneet</a></li>
						<li><a href="#tab3">Reem Masri</a></li>
						<li><a href="#tab4">Ana Bagaric</a></li>
						<li><a href="#tab5">Barbara Finch</a></li>
						<li><a href="#tab6">Ashley Seward</a></li>
						<li><a href="#tab7">Lacy Fenton</a></li>
					</ul>
					<a class="more">View all</a>
				</div>
				<!-- End Dentists Tabs Title -->

				<!-- Start Dentists Tabs Title Left Col -->
				<div class="tabs_r">
					<!-- Start tab1 content -->
					<div class="tab_content" id="tab1">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Dr. Manmeet</a>
								<div class="tab_content_profession">Doctor</div>
								<div class="tab_content_desk">
									Dr. Manmeet graduated in 2007 from H.P. University, India and did a multi-disciplinary hospital residency for 1 year which provided us with advanced training in all the branches of Dentistry including kids, oral surgery, and prosthodontics. After practicing for 4 years in India, we moved to Canada in 2012 and obtained our Dental Licence by passing the NDEB Canada Equivalency Process.  Manmeet started working as an Associate in Mississauga and we moved to Alberta in 2017.
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Dr-Manmeet.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Dr-Manmeet.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Dr-Manmeet.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>
					<!-- End tab1 content -->

					<!-- Start tab2 content -->
					<div class="tab_content" id="tab2">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Dr. Puneet</a>
								<div class="tab_content_profession">Doctor</div>
								<div class="tab_content_desk">
								Dr. Puneet graduated in 2007 from H.P. University, India and did a multi-disciplinary hospital residency for 1 year which provided us with advanced training in all the branches of Dentistry including kids, oral surgery, and prosthodontics. After practicing for 4 years in India, we moved to Canada in 2012 and obtained our Dental Licence by passing the NDEB Canada Equivalency Process.  Manmeet started working as an Associate in Mississauga and we moved to Alberta in 2017.
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/DR-Puneet.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/DR-Puneet.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/DR-Puneet.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>
					<!-- End tab2 content -->

					<!-- Start tab3 content -->
					<div class="tab_content" id="tab3">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Reem Masri</a>
								<div class="tab_content_profession">Registered Dental Assistant</div>
								<div class="tab_content_desk">
									Hi my name is Reem! I am a graduate of the KDM Dental College, and I have been an RDA (Registered Dental Assistant) for almost a year now. Born and raised here in Drayton Valley, I have also lived in Edmonton and Lebanon. I speak, read, and write both Arabic and English. When I am not at work, I love to spend quality time with friends and family, paint, shop, travel, eat good food, and watch movies! I am still learning all about the dental field, but so far, I am loving it and I hope I can create a comfortable environment for you to love it as well!
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Reem-Marsi-400x467.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Reem-Marsi-400x467.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Reem-Marsi-400x467.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>
					<!-- End tab3 content -->

					<!-- Start tab4 content -->
					<div class="tab_content" id="tab4">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Ana Bagaric</a>
								<div class="tab_content_profession">Administration / Sterilization Assistant</div>
								<div class="tab_content_desk">
									Hello, my name is Ana. I enjoy working with patients but above all patients with special needs and seniors. Being the first person our patients see when they walk in, I strive to make them feel welcome and comfortable. I always look forward to seeing new faces in our office!
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Ana-Bagaric-400x467.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Ana-Bagaric-400x467.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Ana-Bagaric-400x467.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>
					<!-- End tab4 content -->

					<div class="tab_content" id="tab5">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Barbara Finch</a>
								<div class="tab_content_profession">Registered Dental Assistant</div>
								<div class="tab_content_desk">
									I am a registered dental assistant here at Valley Dental. I have been a dental assistant since 2014 from the SAIT program. I look forward to achieving higher educational goals in the dental field. I feel I bring knowledge and experience to Valley Dental. I specialize in patient education and am a caring and compassionate individual with a professional attitude. When I am not working at Valley Dental you will find me out camping, roller skating, or on an outdoor adventure with my family.
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Barb-Finch-400x467.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Barb-Finch-400x467.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Barb-Finch-400x467.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>

					<div class="tab_content" id="tab6">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Ashley Seward</a>
								<div class="tab_content_profession">Registered Dental Assistant / Office Manager</div>
								<div class="tab_content_desk">
									Hello, my name is Ashley. I am a registered dental assistant here at Valley Dental. I graduated from KDM dental college in 2014 and have been enjoying learning new things in our field ever since. Although I was trained to be working alongside the dentist, I took greater interest in more of an administrative role at the office. You may see me as the first face when you enter the office or by your side in the chair. No matter where I may be, I always strive to make your experience smile worthy. When I am not at the office you may find me out enjoying Drayton Valley with my family.
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Ashley-Seward-400x467.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Ashley-Seward-400x467.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Ashley-Seward-400x467.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>

					<div class="tab_content" id="tab7">
						<div class="row">
							<div class="tab_content_l col-2">
								<a href="#" class="tab_content_name">Lacy Fenton</a>
								<div class="tab_content_profession">Administration</div>
								<div class="tab_content_desk">
									Hello, my name is Lacy. I began working at Valley Dental as a receptionist in April of 2019 after completing my Medical Office Assistant Diploma. I enjoy working in the dental industry and am always looking for new ways to improve each patient’s experience. I am often the voice on the other end of the phone and one of the first faces you will see when you walk in our office. I plan to keep learning new skills and technology to further my education in this business. When I am not working, I can be found out in my garden, camping, or spending time with my family.
								</div>
							</div>
							<div class="tab_content_r col-2">
								<a class="radius_left" href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Lacy-Fenton-400x467.jpg.webp" data-srcset="https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Lacy-Fenton-400x467.jpg.webp, https://www.valleydentalalberta.com/wp-content/uploads/2020/07/Lacy-Fenton-400x467.jpg.webp 2x" alt="Valley Dental" /></a>
							</div>
						</div>
					</div>
				</div>
				<!-- End Dentists Tabs Title Left Col -->
			</div>
		</div>
		<!-- End Dentists Tabs Container -->
	</div>
	<!-- End Dentists Tabs -->

	<!-- Start Brands -->
	<div class="brands">
		<div class="container">
			<div class="row brands_title">We Accept Dental Insurance</div>
			<!-- <div class="row brands_item">
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_1.png') }}" alt="Valley Dental" /></a>
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_2.png') }}" alt="Valley Dental" /></a>
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_3.png') }}" alt="Valley Dental" /></a>
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_4.png') }}" alt="Valley Dental" /></a>
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_5.png') }}" alt="Valley Dental" /></a>
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_6.png') }}" alt="Valley Dental" /></a>
				<a href="#"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/brands_7.png') }}" alt="Valley Dental" /></a>
			</div> -->
		</div>
		<div class="row brands_desc">
			<strong>Don’t have an insurance? No problem!</strong>
			Just contact our team and we will find a solution suitable for you
		</div>
	</div>
	<!-- End Brands -->

	<!-- Start Testimonials -->
	<div class="testimonials">
		<div class="row">
			<div class="row testimonials_title">
				<div class="container">
					<div class="row testimonials_title_row">
						<div class="col-2 testimonials_title_l">
							<h3>Testimonials</h3>
						</div>
						<div class="col-2 testimonials_title_r">
							<a href="#" class="btn_transparent">Leave Feedback</a>
						</div>
					</div>
				</div>
			</div>
			<div class="owl_testimonials owl-carousel owl-theme">
				<!-- Start Testimonials Item-->
				<div class="item">
					<div class="slideshow-image"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/story_avatar_1.png') }}" alt="Valley Dental"></div>
					<div class="ale_bg_overlay" style="background-color: rgba(0,0,0,0.20)"></div>
					<div class="container">
						<div class="row owl_testimonials_top">
							<div class="owl_testimonials_top_img"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/story_avatar_1.png') }}" data-srcset="{{ asset('/assets/img/story_avatar_1.png') }}, {{ asset('/assets/img/story_avatar_1@2x.png') }} 2x" alt="Valley Dental" /></div>
							<div class="owl_testimonials_top_r">
								<div class="owl_testimonials_top_r_name">Jennifer White</div>
								<div class="rating">
									<span>4.0</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star deactivate"></i>
								</div>
							</div>
						</div>
						<div class="row owl_testimonials_text">
							“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum”
						</div>
						<div class="rating_date">
							<i class="fa fa-yelp"></i>
							12/7/2017
						</div>
					</div>
				</div>
				<!-- End Testimonials Item -->
				<!-- Start Testimonials Item -->
				<div class="item">
					<div class="slideshow-image"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/story_avatar_2.png') }}" alt="Valley Dental"></div>
					<div class="ale_bg_overlay" style="background-color: rgba(0,0,0,0.20)"></div>
					<div class="container">
						<div class="row owl_testimonials_top">
							<div class="owl_testimonials_top_img"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/story_avatar_2.png') }}" data-srcset="{{ asset('/assets/img/story_avatar_1.png') }}, {{ asset('/assets/img/story_avatar_1@2x.png') }} 2x" alt="Valley Dental" /></div>
							<div class="owl_testimonials_top_r">
								<div class="owl_testimonials_top_r_name">Kate Washington</div>
								<div class="rating">
									<span>4.0</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star deactivate"></i>
								</div>
							</div>
						</div>
						<div class="row owl_testimonials_text">
							“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.”
						</div>
						<div class="rating_date">
							<i class="fa fa-yelp"></i>
							12/7/2017
						</div>
					</div>
				</div>
				<!-- End Testimonials Item -->
				<!-- Start Testimonials Item -->
				<div class="item">
					<div class="slideshow-image"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/gallery_4.png') }}" alt="Valley Dental"></div>
					<div class="ale_bg_overlay" style="background-color: rgba(0,0,0,0.20)"></div>
					<div class="container">
						<div class="row owl_testimonials_top">
							<div class="owl_testimonials_top_img"><img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/gallery_4.png') }}" data-srcset="{{ asset('/assets/img/story_avatar_1.png') }}, {{ asset('/assets/img/story_avatar_1@2x.png') }} 2x" alt="Valley Dental" /></div>
							<div class="owl_testimonials_top_r">
								<div class="owl_testimonials_top_r_name">Adrainne Prestomelt</div>
								<div class="rating">
									<span>4.0</span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star deactivate"></i>
								</div>
							</div>
						</div>
						<div class="row owl_testimonials_text">
							“Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum”
						</div>
						<div class="rating_date">
							<i class="fa fa-yelp"></i>
							12/7/2017
						</div>
					</div>
				</div>
				<!-- End Testimonials Item -->
			</div>
		</div>
	</div>
	<!-- End Testimonials -->

	<!-- Start Get Service -->
	<div class="row get_service">
		<div class="container">
			<h4>Get the best service in your city</h4>
			<div class="popup"><a data-effect="mfp-zoom-in" class="btn" data-cal-link="vijayant-katyal-f360uo/30min" data-cal-namespace="" data-cal-config='{"layout":"month_view"}'>Make an Appointment</a></div>
		</div>
	</div>
	<!-- End Get Service -->

	<!-- Start Recent News -->
	<div class="row news">
		<div class="container">
			<h4>Recent News</h4>
			<div class="row row-15">
				<!-- Start Recent News Item -->
				<div class="col-3 news_item">
					<div class="news_item_vn">
						<a href="/blog_post.php" class="radius_niz">
							<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/img_news_1.png') }}" data-srcset="{{ asset('/assets/img/img_news_1.png') }}, {{ asset('/assets/img/img_news_1@2x.png') }} 2x" alt="Valley Dental" />
						</a>
						<div class="news_item_content">
							<a href="/blog_post.php" class="news_item_content_title">Tips from Our Main Dentist</a>
							<div class="news_item_content_date">12/7/2018</div>
							<div class="news_item_content_desk">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inci ut labore et dolore magna aliqua sit amet…
							</div>
							<a href="/blog_post.php" class="more">Learn more</a>
						</div>
					</div>
				</div>
				<!-- End Recent News Item -->
				<!-- Start Recent News Item -->
				<div class="col-3 news_item">
					<div class="news_item_vn">
						<a href="/blog_post.php" class="radius_niz">
							<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/img_news_2.png') }}" data-srcset="{{ asset('/assets/img/img_news_2.png') }}, {{ asset('/assets/img/img_news_2@2x.png') }} 2x" alt="Valley Dental" />
						</a>
						<div class="news_item_content">
							<a href="/blog_post.php" class="news_item_content_title">Dental Implants: 10 Things You S…</a>
							<div class="news_item_content_date">01/5/2018</div>
							<div class="news_item_content_desk">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inci ut labore et dolore magna aliqua sit amet…
							</div>
							<a href="/blog_post.php" class="more">Learn more</a>
						</div>
					</div>
				</div>
				<!-- End Recent News Item -->
				<!-- Start Recent News Item -->
				<div class="col-3 news_item">
					<div class="news_item_vn">
						<a href="/blog_post.php" class="radius_niz">
							<img class="lozad" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('/assets/img/img_news_3.png') }}" data-srcset="{{ asset('/assets/img/img_news_3.png') }}, {{ asset('/assets/img/img_news_3@2x.png') }} 2x" alt="Valley Dental" />
						</a>
						<div class="news_item_content">
							<a href="/blog_post.php" class="news_item_content_title">Invisalign for Adults</a>
							<div class="news_item_content_date">22/10/2018</div>
							<div class="news_item_content_desk">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inci ut labore et dolore magna aliqua sit amet…
							</div>
							<a href="/blog_post.php" class="more">Learn more</a>
						</div>
					</div>
				</div>
				<!-- End Recent News Item -->
			</div>
		</div>
	</div>
	<!-- End Recent News -->
</main>
<!--  Main end -->

@endsection

@section('footer')
@endsection