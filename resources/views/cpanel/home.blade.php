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
                    <h4 class="card-title">Dashboard</h4>
                </div>
                <div class="card-body ">
                    Welcome to Laravella CMS Dashboard page. This is main page of admin area.
                    Here is some last statistic
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Last 5 posts</h4>
                </div>
                <div class="card-body ">
                    @forelse($posts as $post)
                        <p>{{$post->title}}</p>
                    @empty
                        No posts
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Last 5 comments</h4>
                </div>
                <div class="card-body ">
                    Here will be last 5 comments
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header ">
                    <h4 class="card-title">Last 5 registerd users</h4>
                </div>
                <div class="card-body ">
                    @forelse($users as $user)
                        <p>{{$user->username}}</p>
                    @empty
                        No users
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
