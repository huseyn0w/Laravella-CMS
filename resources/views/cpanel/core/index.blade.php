<?php
/**
 * Laravella CMS
 * File: index.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 19.07.2019
 */
?>
@include('cpanel.core.header')
<body>
<div class="wrapper">
    <div class="sidebar" data-image="{{asset('admin')}}/img/sidebar-5.jpg">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

    Tip 2: you can also add an image using data-image tag
-->
     @include('cpanel.nav.left-nav')
    </div>
    <div class="main-panel">
        @include('cpanel.nav.top-nav')
        <!-- End Navbar -->
        <div class="content">
            @yield('content')
        </div>
@include('cpanel.core.footer')