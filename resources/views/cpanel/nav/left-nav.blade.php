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
        <span class="simple-text">Laravella CMS</span>
    </div>
    <ul class="nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('cpanel_home')}}">
                <i class="nc-icon nc-chart-pie-35"></i>
                <p>@lang('cpanel/nav/left.dashboard')</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route('cpanel_myprofile')}}">
                <i class="nc-icon nc-circle-09"></i>
                <p>@lang('cpanel/nav/left.edit_profile')</p>
            </a>
        </li>
        <li>
            <a class="nav-link" href="{{route('cpanel_all_media')}}">
                <i class="nc-icon nc-album-2"></i>
                <p>@lang('cpanel/nav/left.media')</p>
            </a>
        </li>
        @if (Auth::user()->can('manage_pages', 'App\Http\Models\UserRoles'))
            <li>
            <a class="nav-link" href="{{route('cpanel_pages_list')}}">
                <i class="nc-icon nc-paper-2"></i>
                <p>@lang('cpanel/nav/left.pages')</p>
            </a>
        </li>
        @endif
        <li>
            <a data-toggle="collapse" href="#posts" class="collapsed nav-link" aria-expanded="false">
                <i class="nc-icon nc-notes"></i>
                <p>@lang('cpanel/nav/left.posts')</p>
            </a>
            <div class="collapse" id="posts" aria-expanded="false" style="height: 0px;">
                <ul class="nav">
                    @if (Auth::user()->can('manage_post_categories', 'App\Http\Models\UserRoles'))
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_category_list')}}">
                            <i class="nc-icon nc-credit-card"></i>
                            <p>@lang('cpanel/nav/left.categories')</p>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->can('manage_posts', 'App\Http\Models\UserRoles'))
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_posts_list')}}">
                            <i class="nc-icon nc-single-copy-04"></i>
                            <p>@lang('cpanel/nav/left.all_posts')</p>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->can('manage_comments', 'App\Http\Models\UserRoles'))
                        <li>
                            <a class="nav-link sub-nav-link" href="{{route('cpanel_comments_list')}}">
                                <i class="nc-icon nc-chat-round"></i>
                                <p>@lang('cpanel/nav/left.comments')</p>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
        <li>
            <a class="nav-link" href="{{route('cpanel_all_users_list')}}">
                <i class="nc-icon nc-single-02"></i>
                <p>@lang('cpanel/nav/left.users')</p>
            </a>
        </li>
        <li>
            <a data-toggle="collapse" href="#siteSettings" class="collapsed nav-link" aria-expanded="false">
                <i class="nc-icon nc-settings-gear-64"></i>
                <p>@lang('cpanel/nav/left.settings')</p>
            </a>

            <div class="collapse" id="siteSettings" aria-expanded="false" style="height: 0px;">
                <ul class="nav">
                    @if (Auth::user()->can('manage_general_settings', 'App\Http\Models\UserRoles'))
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_general_settings')}}">
                            <i class="nc-icon nc-settings-tool-66"></i>
                            <p>@lang('cpanel/nav/left.general_settings')</p>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->can('manage_general_settings', 'App\Http\Models\UserRoles'))
                        <li>
                            <a class="nav-link sub-nav-link" href="{{route('cpanel_site_options')}}">
                                <i class="nc-icon nc-preferences-circle-rotate"></i>
                                <p>@lang('cpanel/nav/left.site_options')</p>
                            </a>
                        </li>
                    @endif
                    @if (Auth::user()->can('manage_menus', 'App\Http\Models\UserRoles'))
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_menu_list')}}">
                            <i class="nc-icon nc-bullet-list-67"></i>
                            <p>@lang('cpanel/nav/left.menus')</p>
                        </a>
                    </li>
                    @endif
                    @if (Auth::user()->can('manage_user_roles', 'App\Http\Models\UserRoles'))
                    <li>
                        <a class="nav-link sub-nav-link" href="{{route('cpanel_user_roles')}}">
                            <i class="nc-icon nc-lock-circle-open"></i>
                            <p>@lang('cpanel/nav/left.user_roles')</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </li>
    </ul>

</div>
