<?php
/**
 * Laravella CMS
 * File: header.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 19.07.2019
 */


if(isset($data)):
    if(isset($data->author)):
    $author = $data->author->name. ' '.$data->author->surname;
    endif;

    $title = $data->title;

    $meta_description = $data->meta_description;
    $meta_keywords = $data->meta_keywords;
else:
    $user = Auth::user();
    $author = $user->name. ' '.$user->surname;
    $title = "Edit Profile";

    $meta_description = "Edit Profile";
    $meta_keywords = "profile,interface,edit,user";
endif;


$logo_url = get_site_options('logo_url');



?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('front/'.env('TEMPLATE_NAME').'/img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('front/'.env('TEMPLATE_NAME').'/img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('front/'.env('TEMPLATE_NAME').'/img/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('front/'.env('TEMPLATE_NAME').'site.webmanifest')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
@auth
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endauth

@if(isset($data->author))
    <!-- Author Meta -->
    <meta name="author" content="{{$author}}">
    @endif
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
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/custom.css')}}">
</head>
<body>

<!-- Start Header Area -->
<header class="default-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{env('APP_URL')}}">
                <img src="{{$logo_url}}" alt="">
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
                <ul class="navbar-nav user-panel">
                    @auth
                    <li>
                        @if (Auth::user()->can('see_admin_panel', 'App\Http\Models\UserRoles'))
                            <a href="{{route('cpanel_home')}}">cPanel</a>
                        @endif
                        <a href="{{route('get_user_info')}}">Profile</a>
                        <a href="{{route('logout')}}">Logout</a>
                    </li>
                    @else
                    <li>
                        <a href="{{route('login')}}">Login</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-- End Header Area -->