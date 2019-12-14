<?php
/**
 * Laravella CMS
 * File: top-nav.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */

$languages = get_languages();
?>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
        <a class="navbar-brand" href="#pablo"> @lang('cpanel/nav/top.logged_in_as') {{$current_user->username}} </a>
        <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('front_pages',['slug' => '/'])}}">
                        <span class="no-icon">@lang('cpanel/nav/top.homepage')</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="no-icon">@lang('cpanel/nav/top.change_language')</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach($languages as $code => $language)
                            <a href="{{route('lang_route', ['locale' => $code])}}" class="dropdown-item">
                                <img src="{{$language['icon']}}" alt="{{$language['title']}}" />
                                <span>{{$language['title']}}</span>
                            </a>
                        @endforeach
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">
                        <span class="no-icon">@lang('cpanel/nav/top.log_out')</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
