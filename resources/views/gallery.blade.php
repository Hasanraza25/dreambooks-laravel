@extends('frontlayout.master')
@section('page-title')
	Gallery
@endsection
@section('main-content')
<main class="main-content">

		<!-- Gallery -->
        <div class="gallery tc-padding">
      		<div class="container">
      			<div class="row no-gutters">
      				@forelse($galleries as $gallery)
      				<div class="col-lg-3 col-xs-6 r-full-width">
      					<div class="gallery-figure style-2"> 
      						@if($gallery->media_img == 'No image found')
	                  		<img src="/uploads/no-img.jpg" width="283" height="283" alt="No image found">
	                  		@else
	                  		<img src="/uploads/{{ $gallery->media_img }}" width="283" height="283" alt="{{ $gallery->fullname }}">
	                  		@endif
	                  		<div class="overlay"></div>
	                  	</div>
      				</div>
      				@empty
      				<div class="alert alert-danger">No Record found!</div>
      				@endforelse
      				<div class="col-xs-12">
      					<div class="pagination-holder">
		           			{{ $galleries->links('pagination.default') }}
		           		</div>
      				</div>
      			</div>
            </div>
      	</div>
		<!-- Gallery -->

	</main>
@endsection