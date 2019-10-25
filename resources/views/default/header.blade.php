<?php
/**
 * Laravella CMS
 * File: header.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 19.07.2019
 */

$author = $page_data->author->name. ' '.$page_data->author->surname;
$title = $page_data->title;

$meta_description = $page_data->meta_description;
$meta_keywords = $page_data->meta_keywords;

//extract($page_data);

?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('front/'.env('TEMPLATE_NAME').'/img/fav.png')}}">
    <!-- Author Meta -->
    <meta name="author" content="{{$author}}">
    <!-- Meta Description -->
    <meta name="description" content="{{$meta_description}}">
    <!-- Meta Keyword -->
    <meta name="keywords" content="{{$meta_keywords}}">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>{{$title}}</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <!--
CSS
    ============================================= -->
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/main.css')}}">
</head>
<body>

<!-- Start Header Area -->
<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="{{asset('front/'.env('TEMPLATE_NAME').'/img/logo.png')}}" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end align-items-center" id="navbarSupportedContent">
                @php

                $menu_params = [
                    'menu_type' => "list",
                    'menu_class' => "navbar-nav",
                    "item_class_with_submenu" => 'dropdown',
                    "item_link_class_with_submenu" => 'dropdown-toggle',
                    "submenu_class" => "dropdown-menu",
                    "sublink_class" => "dropdown-item"
                ];
                $header_menu = get_menu_data("Header Menu", $menu_params);

                @endphp
                {!! $header_menu !!}
            </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->