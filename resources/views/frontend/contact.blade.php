@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/product_responsive.css">

<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/styles/contact_responsive.css">


@section('content')
    @if(Session()->has('shop'))
@include('layouts.front_partial.collaps_nav')
@endif

	<div class="contact_info mt-4">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 offset-lg-1">
					<div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><i class="fas contact_info_image fa-phone"></i></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Phone</div>
								<div class="contact_info_text">{{ $setting->phone_two }}</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><i class="fas contact_info_image fa-envelope"></i></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Email</div>
								<div class="contact_info_text">{{ $setting->support_email }}</div>
							</div>
						</div>

						<!-- Contact Item -->
						<div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
							<div class="contact_info_image"><i class="fas contact_info_image fa-map-marker-alt"></i></div>
							<div class="contact_info_content">
								<div class="contact_info_title">Address</div>
								<div class="contact_info_text">{{ $setting->address }}</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact Form -->

	<div class="contact_form ">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 offset-lg-1">
					<div class="contact_form_container">
						<div class="contact_form_title">Get in Touch</div>

						<form action="{{route('contact.store')}}" method="post" id="contact_form">
                        @csrf
							<div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
								<input type="text" id="contact_form_name" class="contact_form_name input_field" name="name" placeholder="Your name" required="required" data-error="Name is required.">
								<input type="text" id="contact_form_email" class="contact_form_email input_field"name="email" placeholder="Your email" required="required" data-error="Email is required.">
								<input type="text" id="contact_form_phone" class="contact_form_phone input_field" name="phone" placeholder="Your phone number">
							</div>
							<div class="contact_form_text">
								<textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message" required="required" data-error="Please, write us a message."></textarea>
							</div>
							<div class="contact_form_button">
                            <input type="submit" class="button contact_submit_button mt-4" value="Send Message"></input>
					
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	
	</div>

	<!-- Map -->

	<div class="contact_map">
		<div id="google_map" class="google_map">
			<div class="map_container">
				<div id="map"><iframe class="link" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.357743576163!2d90.31809301493547!3d23.87692988452714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c3e275fc4da5%3A0x178faa29c19c6c57!2sDaffodil%20International%20University%2C%20Ashulia%20Campus%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1636819243012!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
			</div>
		</div>
	</div>
	




@endsection