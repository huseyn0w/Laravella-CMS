<?php
/**
 * Laravella CMS
 * File: home.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>
@extends('cpanel.core.index')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">@lang('cpanel/home.dashboard')</h4>
                </div>
                <div class="card-body ">
                    @lang('cpanel/home.greetings')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">@lang('cpanel/home.last_posts')</h4>
                </div>
                <div class="card-body ">
                    @forelse($posts as $post)
                        <p>{{$post->title}}</p>
                    @empty
                        @lang('cpanel/home.no_posts')
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">@lang('cpanel/home.last_comments')</h4>
                </div>
                <div class="card-body ">
                    @forelse($comments as $comment)
                        <p>{{$comment->comment}}</p>
                    @empty
                        @lang('cpanel/home.no_comments')
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">@lang('cpanel/home.last_users')</h4>
                </div>
                <div class="card-body ">
                    @forelse($users as $user)
                        <p>{{$user->username}}</p>
                    @empty
                        @lang('cpanel/home.no_users')
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
