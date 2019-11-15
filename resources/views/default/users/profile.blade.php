<?php
/**
 * Laravella CMS
 * File: profile.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 14.11.2019
 */
?>
@extends(env('TEMPLATE_NAME').'/index')

@section('content')


@php
    $home_page_data = get_data(1, 'page', ['slug', 'title']);
    $logged_user_name = get_logged_user_username();
@endphp

<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">Profile</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{env('APP_URL')}}">{{$home_page_data->title}}</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><span>Profile info</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="profile_cover mb-30 mt-30">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">User info</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-image">
                                    <input id="file-upload" class type="file" name="avatar" accept="image/*" />
                                    @if(!empty($user->avatar))
                                        <img id="file-image" class="img-profile avatar border-gray" src="{{$user->avatar}}" type="file" name="fileUpload" accept="image/*" />
                                    @else
                                        <img id="file-image" class="img-profile avatar border-gray" src="{{asset('admin')}}/img/faces/noavatar.svg" type="file" name="fileUpload" accept="image/*" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Username:</strong></label>
                                    <p>{{$user->username}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Email address:</strong></label>
                                    <p>{{$user->email}}</p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Status:</strong></label>
                                    <p>{{$user->role->name}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if($user->name)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name"><strong>Name:</strong></label>
                                    <p>{{$user->name}}</p>
                                </div>
                            </div>
                            @endif
                            @if($user->surname)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="surname"><strong>Surname:</strong></label>
                                    <p>{{$user->surname}}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="row">
                            @if($user->country)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Country:</strong></label>
                                    <p>{{$user->country}}</p>
                                </div>
                            </div>
                            @endif
                            @if($user->city)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>City:</strong></label>
                                    <p>{{$user->city}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($user->about_me)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>About Me:</strong></label>
                                    <p>{{$user->about_me}}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            @if($user->facebook_url)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Facebook:</strong></label>
                                    <p>{{$user->facebook_url}}</p>
                                </div>
                            </div>
                            @endif
                            @if($user->google_url)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label><strong>Google:</strong></label>
                                    <p>{{$user->google_url}}</p>
                                </div>
                            </div>
                            @endif
                            @if($user->twitter_url)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Twitter:</strong></label>
                                        <p>{{$user->twitter_url}}</p>
                                    </div>
                                </div>
                            @endif
                            @if($user->instagram_url)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Instagram:</strong></label>
                                        <p>{{$user->instagram_url}}</p>
                                    </div>
                                </div>
                            @endif
                            @if($user->linkedin_url)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Linkedin:</strong></label>
                                        <p>{{$user->linkedin_url}}</p>
                                    </div>
                                </div>
                            @endif
                            @if($user->xing_url)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><strong>Xing:</strong></label>
                                        <p>{{$user->xing_url}}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if($user->gender)
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check form-check-radio">
                                    <label><strong>Gender:</strong></label>
                                    <p>{{$user->gender}}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($user->username === $logged_user_name)
                            <a href="{{route('get_user_info')}}">Edit</a>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

