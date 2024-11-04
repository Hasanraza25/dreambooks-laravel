@extends('frontlayout.master')
@section('page-title')
	Contact Us
@endsection
@section('main-content')
<main class="main-content">

		<!-- Contant Holder -->
		<div class="tc-padding">
			<div class="container">

				<!-- Address Columns -->
				<div class="tc-padding-bottom">
					<div class="row">
				
						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-map-marker"></i></span>
								<h6>Address</h6>
								<strong>off#91, Falak Corporate City Bolton Market.</strong>
							</div>
						</div>
						<!-- Column -->

						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-volume-control-phone"></i></span>
								<h6>Phone No.</h6>
								<strong>+92 322 3411811</strong>
							</div>
						</div>
						<!-- Column -->

						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-envelope"></i></span>
								<h6>Email</h6>
								<strong>info@dreambooks.com</strong>
							</div>
						</div>
						<!-- Column -->

						<!-- Column -->
						<div class="col-lg-3 col-xs-6 r-full-width">
							<div class="address-column">
								<span class="address-icon"><i class="fa fa-share-alt"></i></span>
								<h6>Fallow us</h6>
								<ul class="social-icons">
				                	<li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
				                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
				                    <li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
				                    <li><a class="pinterest" href="#"><i class="fa fa-pinterest-p"></i></a></li>
				                </ul>
							</div>
						</div>
						<!-- Column -->

					</div>
				</div>
				<!-- Address Columns -->

				<!-- Contact Map -->
				<div class="tc-padding-bottom">
					<div>
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.404355527688!2d66.99895027442933!3d24.850035645676304!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e01777bd7b3%3A0x894b5cdbd0d13dc3!2sAl-Fateem%20Academy%20-%20Web%20Development%20Course%20Training%20Institute!5e0!3m2!1sen!2s!4v1723754273145!5m2!1sen!2s" width="600" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				</div>
				<!-- Contact Map -->

				<!-- Form -->
				<div class="form-holder">

					<!-- Secondary heading -->
	        		<div class="sec-heading">
	        			<h3>Contact Form</h3>
	        		</div>
	        		<!-- Secondary heading -->

	        		<!-- Sending Form -->
	        		<form class="sending-form" action="{{ Route('send-mail') }}" method="POST">
	        			@csrf
	        			<div class="row">
	        				<div class="col-sm-12">
			        			<div class="form-group">
			        				<textarea name="message" class="form-control" required="required" rows="5" placeholder="Text here..."></textarea>
			        				<i class="fa fa-pencil-square-o"></i>
			        			</div>
		        			</div>
		        			<div class="col-sm-4">
			        			<div class="form-group">
			        				<input name="full_name" class="form-control" required="required" placeholder="Full name">
			        				<i class="fa fa-user"></i>
			        			</div>
		        			</div>
		        			<div class="col-sm-4">
			        			<div class="form-group">
			        				<input name="phone" class="form-control" required="required" placeholder="Phone no.">
			        				<i class="fa fa-phone"></i>
			        			</div>
		        			</div>
		        			<div class="col-sm-4">
			        			<div class="form-group">
			        				<input name="email" class="form-control" required="required" placeholder="Email">
			        				<i class="fa fa-envelope"></i>
			        			</div>
		        			</div>
		        			<div class="col-xs-12">
			        			<button type="submit" class="btn-1 shadow-0 sm">send message</button>
		        			</div>
	        			</div>
	        		</form>
	        		<!-- Sending Form -->

				</div>
				<!-- Form -->

			</div>
		</div>
		<!-- Contant Holder -->

	</main>
@endsection