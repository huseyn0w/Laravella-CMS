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

        $posts_from_category_headline = get_field('posts-from-category-headline', $custom_fields);
        $posts_from_category_description = get_field('posts-from-category-description', $custom_fields);
        $posts_from_category_category_id = get_field('posts-from-category-cat-id', $custom_fields);

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


@php
    $fields = ['post_translations.title', 'post_translations.slug', 'post_translations.preview','post_translations.updated_at','post_translations.thumbnail','post_translations.likes'];
    $args = ['fields' => $fields, 'category_id' => $posts_from_category_category_id, 'count' => 4];
    $category_posts = get_category_posts($args);
@endphp
@if(!empty($category_posts))
<!-- Start travel Area -->
<section class="travel-area section-gap" id="travel">
    <div class="container">

        <div class="row d-flex justify-content-center">
            <div class="menu-content pb-70 col-lg-8">
                <div class="title text-center">
                    <h1 class="mb-10">{{$posts_from_category_headline}}</h1>
                    <p>{{$posts_from_category_description}}</p>
                </div>
            </div>
        </div>


        <div class="row">
        @foreach($category_posts as $post)
            <div class="col-12 col-md-6 single-travel media">
                <div class="thumb">
                    <img class="img-fluid d-flex post-  mr-3" src="{{$post->thumbnail}}" alt="">
                </div>
                <div class="dates">
                    <span>{{Carbon\Carbon::parse($post->updated_at)->format('d')}}</span>
                    <p>{{Carbon\Carbon::parse($post->updated_at)->format('M')}}</p>
                </div>
                <div class="media-body align-self-center">
                    <h4 class="mt-0"><a href="{{env('APP_URL')}}posts/{{$post->slug}}">{{$post->title}}</a></h4>
                    <p>{{$post->preview}}</p>
                    <div class="meta-bottom d-flex justify-content-between">
                        <p><span class="lnr lnr-heart"></span> {{$post->likes}} {{$post->likes > 1 ? trans('default/category.likes') : trans('default/category.likes')}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>


    </div>
</section>
<!-- End travel Area -->
@endif;

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