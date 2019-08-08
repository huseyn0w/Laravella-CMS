<?php
/**
 * Laravella CMS
 * File: left-nav.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>
<div class="sidebar-wrapper">
    <div class="logo">
        <span>Laravella CMS</span>
    </div>
    <ul class="nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('cpanel_home')}}">
                <i class="nc-icon nc-chart-pie-35"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route('cpanel_myprofile')}}">
                <i class="nc-icon nc-circle-09"></i>
                <p>Edit Profile</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
                <i class="nc-icon nc-bullet-list-67"></i>
                <p>Pages</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
                <i class="nc-icon nc-notes"></i>
                <p>Posts</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="#">
                <i class="nc-icon nc-credit-card"></i>
                <p>Categories</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route('cpanel_all_users_list')}}">
                <i class="nc-icon nc-atom"></i>
                <p>Users</p>
            </a>
        </li>
        <li>
            <a data-toggle="collapse" href="#siteSettings" class="collapsed nav-link" aria-expanded="false">
                <i class="nc-icon nc-settings-gear-64"></i>
                <p>Settings</p>
            </a>

            <div class="collapse" id="siteSettings" aria-expanded="false" style="height: 0px;">
                <ul class="nav">
                    @if (Auth::user()->can('changeCpanelGeneralSettings', 'App\Http\Models\Cpanel\CPanelGeneralSettings'))
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_general_settings')}}">
                            <p>General Settings</p>
                        </a>
                    </li>
                    @endif
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_menus')}}">
                            <p>Menus</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_roles')}}">
                            <p>User Roles</p>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

</div>
