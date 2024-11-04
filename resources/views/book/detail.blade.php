@extends('frontlayout.master')
@section('page-title')
	{{ $book->title }}
@endsection
@section('main-content')
<main class="main-content">

	<!-- Book Detail -->
	<div class="book-detail">
		<div class="container">
			
			<!-- Alert -->
			<div class="add-cart-alert">
				<p><i class="fa fa-check-circle"></i>{{ $book->title }} </p>
			</div>
			<!-- Alert -->

			<!-- Single Book Detail -->
			<div class="single-boook-detail">
				<div class="row">
					
					<!-- Book Thumnbnail -->
					<div class="col-lg-4 col-md-5">
						<div class="product-thumnbnail">
							<ul class="product-slider">
							  	<li>
							  		@if($book->book_img == 'No image found')
							  		<img src="/uploads/no-img.jpg" alt="No Image found">
							  		@else
							  		<img src="/uploads/{{ $book->book_img }}" alt="{{ $book->title }}">
							  		@endif
							  		<a class="expand" href="#"><i class="fa fa-expand"></i></a>
							  	</li>
							</ul>
						</div>
					</div>
					<!-- Book Thumnbnail -->

					<!-- book Detail -->
					<div class="col-lg-8 col-md-7">
						<div class="single-product-detail">
							<span class="availability">Availability :<strong>{{ $book->availability }}<i class="fa fa-check-circle"></i></strong></span>
							<h3>{{ $book->title }}</h3>
							<h4>Overview</h4>
							<p>{{ $book->description }}</p>
						</div>
					</div>
					<!-- book Detail -->

				</div>
			</div>
			<!-- Single Book Detail -->

			<!-- Disc Nd Description -->
			<div class="disc-nd-Description tc-padding-bottom">
				<div class="row">
					<div id="disc-reviews-tabs" class="disc-reviews-tabs">

						<!-- Tabs Nav -->
						<div class="col-sm-3">
							<div class="tabs-nav">
								<ul>
									<li><a href="#tab-1">Reviews</a></li>
									<li><a href="#tab-2">Description</a></li>
								</ul>
							</div>
						</div>
						<!-- Tabs Nav -->

						<!-- Tabs Content -->
						<div class="col-sm-9">
							<div class="tabs-content">
								<!-- Book Info List -->
								<div id="tab-2">
									<div class="book-info-list">
										<ul>
											<li><span>ISBN: </span>{{ $book->isbn }}</li>
											<li><span>ISBN-10: </span>{{ $book->isbn_10 }}</li>
											<li><span>Audience: </span>{{ $book->audience }}</li>
											<li><span>Format: </span>{{ $book->format }}</li>
											<li><span>Language: </span>{{ $book->language }}</li>
											<li><span>Number Of Pages: </span>{{ $book->total_pages }}</li>
											<li><span>Published: </span>{{ $book->publisher }}</li>
											<li><span>Country of Publication: </span>{{ $book->country_of_publisher }}</li>
											<li><span>Edition Number: </span>{{ $book->edition_number }}</li>
										</ul>
									</div>
								</div>
								<!-- Book Info List -->
									
								<!-- Description & Products -->
								<div id="tab-1">	

									<!-- Description -->
									<div class="description"></div>
									<!-- Description -->

									<!-- Related Products -->
									<div class="related-products" >
										<h5>You May <span>also like this</span></h5>
										<div class="related-produst-slider" >
											@foreach($relatedBooks as $book)
											<div class="item" >
												<div class="product-box">
							    					<div class="product-img">
							    						@if($book->book_img == 'No image found')
							    						<img src="/uploads/no-img.jpg" alt="No image found" width="132" height="197">
							    						@else
							    						<img src="/uploads/{{ $book->book_img }}" alt="{{ $book->title }}" width="132" height="197">
							    						@endif
							    						<ul class="product-cart-option position-center-x">
							    							<li><a href="#"><i class="fa fa-eye"></i></a></li>
							    							<li><a href="#"><i class="fa fa-cart-arrow-down"></i></a></li>
							    							<li><a href="#"><i class="fa fa-share-alt"></i></a></li>
							    						</ul>
							    					</div>
							    					<div class="product-detail">
							    						<a href="{{ Route('book.show', $book->slug) }}"><span>{{ $book->category->title }}</span></a>
							    						<a href="{{ Route('book.show', $book->slug) }}"><h5>{{ $book->title }}</h5></a>
							    						<p>{{ Str::limit($book->description, 120, '...') }}</p>
							    						<div class="rating-nd-price">
							    							<strong>Rs/ {{ number_format($book->price) }}</strong>
							    						</div>
							    					</div>
							    				</div>
											</div>
											@endforeach
										</div>
									</div>
									<!-- Related Products -->

								</div>
								<!-- Description & Products -->

							</div>
						</div>
						<!-- Tabs Content -->

					</div>
				</div>
			</div>
			<!-- Disc Nd Description -->

		</div>
	</div>
	<!-- Book Detail -->

</main>
@endsection