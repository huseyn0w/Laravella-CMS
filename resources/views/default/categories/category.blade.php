<?php
/**
 * Laravella CMS
 * File: category.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 01.11.2019
 */
?>

@php

    $category_posts = $data->posts;

    $current_lang = get_current_lang_prefix();


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
                    @if(!empty($category_posts))
                        @foreach($category_posts as $post)
                            @php
                                $comments_count = get_post_comments_count($post->id);
                                $post_thumbnail = $post->thumbnail;

                                if(!$post_thumbnail) $post_thumbnail = asset('front/'.env('TEMPLATE_NAME').'/img/asset/l2.jpg');
                            @endphp
                            <div class="single-list flex-row d-flex salam">
                                <div class="thumb">
                                    <div class="date">
                                        <span>{{Carbon\Carbon::parse($post->updated_at)->format('d')}}</span><br>{{Carbon\Carbon::parse($post->updated_at)->format('M')}}
                                    </div>
                                    <img src="{{$post_thumbnail}}" alt="{{$post->title}}">
                                </div>
                                <div class="detail">
                                    <a href="{{env('APP_URL')}}/{{$current_lang}}posts/{{$post->slug}}"><h4 class="pb-20">{{$post->title}}</h4></a>
                                    {!! $post->preview !!}
                                    <p class="footer pt-20">
                                        <i class="fa fa-heart-o" aria-hidden="true"></i>
                                        <span>{{$post->likes}} {{$post->likes > 1 ? trans('default/category.likes') : trans('default/category.likes')}}</span>     <i class="ml-20 fa fa-comment-o" aria-hidden="true"></i>{{$comments_count}}<span> @lang('default/category.comments')</span>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        <div class="pagination_cover">
                            @php
                                $links = $category_posts->links();


                                $paginate_links = pretty_url($links);
                                echo $paginate_links;

                            @endphp
                        </div>
                    @else
                        <div class="no-posts mb-100">
                            <h2>@lang('default/category.not_found')</h2>
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

