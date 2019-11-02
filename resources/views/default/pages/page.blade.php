<?php
/**
 * Laravella CMS
 * File: page.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 25.10.2019
 * Template Name: "Standart";
 */
?>


@extends(env('TEMPLATE_NAME').'/index')

@section('content')

<section class="generic-banner relative">
    <!-- End Header Area -->
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="generic-banner-content">
                    <h1 class="text-white text-center">{{$data->title}}</h1>
                    <p class="text-white">{{$data->meta_description}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="main-wrapper">
    <!-- Start Generic Area -->
    <section class="about-generic-area pt-100 pb-100">
        <div class="container border-top-generic">
            <div class="row">
                <div class="col-md-12">
                @if(!empty($data->content))
                    {!! $data->content !!}
                @else
                    <h2>No content</h2>
                @endif
                </div>
            </div>
        </div>
    </section>
    <!-- End Generic Start -->
</div>



@endsection