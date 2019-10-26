<?php
/**
 * Laravella CMS
 * File: home.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 * Template Name: "Home Page";
 */
?>

@extends(env('TEMPLATE_NAME').'/index')

@section('content')

    @php

        $headline = get_field('headline', $custom_fields);
        $headline_background = get_field('headline-image', $custom_fields);
        $about_headline = get_field('about-headline', $custom_fields);
        $about_description = get_field('about-description', $custom_fields);
        $about_big_description = get_field('about-big-text', $custom_fields);
        $authors = get_field('authors', $custom_fields);




    @endphp

<!-- start banner Area -->
<section class="banner-area relative" id="home" data-parallax="scroll" data-image-src="{{$headline_background}}">
    <div class="overlay-bg overlay"></div>
    <div class="container">
        <div class="row fullscreen">
            <div class="banner-content d-flex align-items-center col-lg-12 col-md-12">
                <h1>
                    {!! $headline  !!}
                </h1>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->



<!-- Start travel Area -->
<section class="travel-area section-gap" id="travel">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">Hot topics from Travel Section</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 travel-left">
                <div class="single-travel media pb-70">
                    <img class="img-fluid d-flex  mr-3" src="{{asset('front/'.env('TEMPLATE_NAME').'/img/t1.jpg')}}" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
                <div class="single-travel media">
                    <img class="img-fluid d-flex  mr-3" src="{{asset('front/'.env('TEMPLATE_NAME').'/img/t3.jpg')}}" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 travel-right">
                <div class="single-travel media pb-70">
                    <img class="img-fluid d-flex  mr-3" src="{{asset('front/'.env('TEMPLATE_NAME').'/img/t2.jpg')}}" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
                <div class="single-travel media">
                    <img class="img-fluid d-flex  mr-3" src="{{asset('front/'.env('TEMPLATE_NAME').'/img/t4.jpg')}}" alt="">
                    <div class="dates">
                        <span>20</span>
                        <p>Dec</p>
                    </div>
                    <div class="media-body align-self-center">
                        <h4 class="mt-0"><a href="#">Addiction When Gambling
                                Becomes A Problem</a></h4>
                        <p>inappropriate behavior Lorem ipsum dolor sit amet, consectetur.</p>
                        <div class="meta-bottom d-flex justify-content-between">
                            <p><span class="lnr lnr-heart"></span> 15 Likes</p>
                            <p><span class="lnr lnr-bubble"></span> 02 Comments</p>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="primary-btn load-more pbtn-2 text-uppercase mx-auto mt-60">Load More </a>
        </div>
    </div>
</section>
<!-- End travel Area -->


<!-- Start team Area -->
<section class="team-area section-gap" id="team">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">{{$about_headline}}</h1>
                    <p>{{$about_description}}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            <div class="col-lg-6 team-left">
                {!! $about_big_description  !!}
            </div>
            <div class="col-lg-6 team-right d-flex justify-content-center">
                <div class="row active-team-carusel">
                @foreach($authors as $author)
                    @php
                        $author_name = get_field('author-name', $author);
                        $author_image = get_field('author-image', $author);
                        $author_position = get_field('author-position', $author);
                        $author_linkedin = get_field('author-linkedin', $author);
                    @endphp


                    <div class="single-team">
                        <div class="thumb">
                            <img class="img-fluid" src="{{$author_image}}" alt="{{$author_name}}">
                            <div class="align-items-center justify-content-center d-flex">
                                <a href="{{$author_linkedin['url']}}" target="{{$author_linkedin['target'] === "1" ? '_blank' : null}}"><i class="fa fa-linkedin"></i></a>
                            </div>
                        </div>
                        <div class="meta-text mt-30 text-center">
                            <h4>{{$author_name}}</h4>
                            <p>{{$author_position}}</p>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End team Area -->

@endsection