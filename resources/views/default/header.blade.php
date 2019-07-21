<?php
/**
 * Laravella CMS
 * File: header.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 19.07.2019
 */
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('front/'.env('TEMPLATE_NAME').'/img/fav.png')}}">
    <!-- Author Meta -->
    <meta name="author" content="colorlib">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <title>Laravella</title>

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
                <ul class="navbar-nav">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#news">News</a></li>
                    <li><a href="#travel">Travel</a></li>
                    <!-- Dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="single.html">Single</a>
                            <a class="dropdown-item" href="category.html">Category</a>
                            <a class="dropdown-item" href="search.html">Search</a>
                            <a class="dropdown-item" href="archive.html">Archive</a>
                            <a class="dropdown-item" href="generic.html">Generic</a>
                            <a class="dropdown-item" href="elements.html">Elements</a>
                        </div>
                    </li>
                @guest
                    <li><a href="{{ url('/login') }}">cPanel Area</a></li>
                @endguest
                @auth
                    <li><a href="{{ url('/cpanel') }}">cPanel Area</a></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->