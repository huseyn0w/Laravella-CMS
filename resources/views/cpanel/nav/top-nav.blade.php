<?php
/**
 * Laravella CMS
 * File: top-nav.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
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
                        <span class="no-icon">@lang('cpanel/nav/top.settings')</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @if (Auth::user()->can('manage_general_settings', 'App\Http\Models\UserRoles'))
                        <a class="dropdown-item" href="{{route('cpanel_general_settings')}}">@lang('cpanel/nav/top.general_settings')</a>
                        @endif
                        @if (Auth::user()->can('manage_menus', 'App\Http\Models\UserRoles'))
                        <a class="dropdown-item" href="{{route('cpanel_menu_list')}}">@lang('cpanel/nav/top.menus')</a>
                        @endif
                        @if (Auth::user()->can('manage_user_roles', 'App\Http\Models\UserRoles'))
                        <a class="dropdown-item" href="{{route('cpanel_user_roles')}}">@lang('cpanel/nav/top.user_roles')</a>
                        @endif
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
