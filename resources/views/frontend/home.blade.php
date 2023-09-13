@extends('frontend.layouts.master')

@section('content')
<!-- breaking news  carousel-->
@include('frontend.home-componets.breaking-news')
<!-- End Tranding news carousel -->

<!-- Hero news section -->
@include('frontend.home-componets.hero-slider')
<!-- Hero news section -->

<div class="large_add_banner">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="large_add_banner_img">
                    <img src="images/placeholder_large.jpg" alt="adds">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Popular news category -->
@include('frontend.home-componets.main-news')
<!-- End Popular news category -->



@endsection
