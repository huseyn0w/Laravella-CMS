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
            <a class="nav-link" href="{{url('cpanel')}}">
                <i class="nc-icon nc-chart-pie-35"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{url('cpanel/myprofile')}}">
                <i class="nc-icon nc-circle-09"></i>
                <p>Edit Profile</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{url('cpanel/pages')}}">
                <i class="nc-icon nc-bullet-list-67"></i>
                <p>Pages</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{url('cpanel/posts')}}">
                <i class="nc-icon nc-notes"></i>
                <p>Posts</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{url('cpanel/categories')}}">
                <i class="nc-icon nc-credit-card"></i>
                <p>Categories</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{url('cpanel/users')}}">
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
                    <li>
                        <a class="nav-link sub-nav-link" href="{{url('cpanel/settings')}}">
                            <p>General Settings</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link sub-nav-link" href="{{url('cpanel/menus')}}">
                            <p>Menus</p>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link sub-nav-link" href="{{url('cpanel/roles')}}">
                            <p>User Roles</p>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>

</div>
