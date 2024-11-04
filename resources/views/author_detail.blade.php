@extends('frontlayout.master')
@section('page-title')
	Author
@endsection
@section('main-content')
<main class="main-content">

	<!-- Arthor Detail -->
	<div class="single-aurthor-detail tc-padding">
		<div class="container">
			<div class="row">
				
				<!-- Aside -->
				<aside class="col-lg-4 col-md-5">
					<div class="arthor-detail-column">
						<div class="arthor-img">
							@if($author->author_img == 'No image found')
							<img src="/uploads/no-img.jpg" width="207" height="197	" alt="No image found">
							@else
							<img src="/uploads/{{ $author->author_img }}"  width="207" height="197" alt="{{ $author->title }}">
							@endif
						</div>
						<div class="arthor-detail">
							<h6>{{ $author->title }}</h6>
							<span>{{ $author->designation }}</span>
						</div>
						<div class="social-activity">
							<div>
								<ul class="social-icons">
				                	<li><a class="facebook" target="_blank" href="{{ $author->facebook_id }}"><i class="fa fa-facebook"></i></a></li>
				                    <li><a class="twitter" target="_blank" href="{{ $author->twitter_id }}"><i class="fa fa-twitter"></i></a></li>
				                    <li><a class="youtube" target="_blank" href="{{ $author->youtube_id }}"><i class="fa fa-youtube-play"></i></a></li>
				                    <li><a class="pinterest" target="_blank" href="{{ $author->pinterest_id }}"><i class="fa fa-pinterest-p"></i></a></li>
				                </ul>
			                </div>
			         	</div>
					</div>
				</aside>
				<!-- Aside -->

				<!-- Content -->
				<div class="col-lg-8 col-md-7">
					<div class="single-arthor-detail">

						<!-- Widget -->
						<div class="single-arthor-widget">
							<h5>Author Overview</h5>
							<div class="author-overview">
								<p>{{ $author->description }}</p>
							</div>
						</div>
						<!-- Widget -->

						<!-- Widget -->
						<!-- Widget -->
<div class="single-arthor-widget">
    <h5>Recommended <strong style="color: red">{{ $author->title }}</strong> Titles</h5>

    <!-- Recommended -->
    <div id="filter-masonry" class="gallery-masonry">
        @foreach($author->author_books as $book)
            <!-- Product Box -->
            <div class="col-lg-3 col-xs-6 r-full-width masonry-grid most-recent">
                <div class="recommended-book">
                    <div class="recommended-book-img">
                        <!-- Assuming you have a 'cover_image' field for the book -->
                        @if($book->book_img == 'No image found')
                        <img src="/uploads/no-img.jpg" alt="No Image found" width="158" height="216">
                        @else
                        <img src="/uploads/{{ $book->book_img }}" alt="{{ $book->title }}" width="158" height="216">
                        @endif
                    </div>
                    <div class="recommended-book-detail">
                        <a href="{{ Route('book.show', $book->slug) }}"><h6>{{ $book->title }}</h6></a>
                        <span>By {{ $author->title }}</span>
                        <ul class="rating-stars">
                            <!-- Example of static stars, you might want to make this dynamic as well -->
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star-half-o"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Product Box -->
        @endforeach
    </div>
    <!-- Recommended -->

</div>
<!-- Widget -->

						<!-- Widget -->
					</div>
				</div>
				<!-- Content -->
			</div>
		</div>
	</div>
		<!-- Arthor Detail -->
</main>
@endsection