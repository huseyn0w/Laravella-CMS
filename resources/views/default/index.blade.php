<?php
/**
 * Laravella CMS
 * File: index.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 19.07.2019
 */
?>
@include(env('TEMPLATE_NAME').'.header')

@yield('content')

@include(env('TEMPLATE_NAME').'.footer')