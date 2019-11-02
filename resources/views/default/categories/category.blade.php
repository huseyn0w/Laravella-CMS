<?php
/**
 * Laravella CMS
 * File: category.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 01.11.2019
 */
?>

@php
    $home_page_data = get_data(1, 'page', ['slug', 'title']);

    $category_posts = $data->posts;

    $overall_posts_count = get_category_posts_count($data->id);

    $loaded_posts_count = count($category_posts);



@endphp

@extends(env('TEMPLATE_NAME').'/index')

@section('content')

<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-start align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">{{$data->title}}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{env('APP_URL')}}">{{$home_page_data->title}}</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><span>{{$data->title}}</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="post-wrapper pt-100">
    <!-- Start post Area -->
    <section class="post-area">
        <div class="container">
            <div class="row justify-content-center d-flex">
                <div class="col-lg-12">
                    <div class="post-lists search-list">
                    @if($loaded_posts_count > 0)
                        @foreach($category_posts as $post)
                            <div class="single-list flex-row d-flex salam">
                                <div class="thumb">
                                    <div class="date">
                                        <span>{{$post->created_at->format('d')}}</span><br>{{$post->created_at->format('M')}}
                                    </div>
                                    <img src="{{$post->thumbnail}}" alt="{{$post->title}}">
                                </div>
                                <div class="detail">
                                    <a href="{{env('APP_URL')}}posts/{{$post->slug}}"><h4 class="pb-20">{{$post->title}}</h4></a>
                                    {!! $post->preview !!}
                                    <p class="footer pt-20">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        <span>{{$post->likes}} Likes</span>     <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i> <span>02 Comments</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination_cover">
                            {{ $category_posts->links() }}
                        </div>
                    @else
                        <div class="no-posts mb-100">
                            <h2>No posts found</h2>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End post Area -->
</div>

@endsection

