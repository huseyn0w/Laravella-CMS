<?php
/**
 * Laravella CMS
 * File: profile.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 12.11.2019
 */
?>
@extends(env('TEMPLATE_NAME').'/index')

@section('content')


@php
    $home_page_data = get_data(1, 'page', ['slug', 'title']);
    $countries = get_countries_array();

    $user_roles = get_user_roles();

@endphp

<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">Profile</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{env('APP_URL')}}">{{$home_page_data->title}}</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><span>Edit profile</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="profile_cover mb-30 mt-30">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <form action="{{ route('update_user_info') }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        @if ($errors->any())
                            <div class="col-12">
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if ($update_message = Session::get('message'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>User has been updated</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="{{route('get_change_password_interface')}}">Change password</a>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-image user-profile">
                                                <input id="file-upload" class type="file" name="avatar" accept="image/*" />
                                                @if(!empty($user->avatar))
                                                    <img id="file-image" class="img-profile avatar border-gray" src="{{$user->avatar}}" type="file" name="fileUpload" accept="image/*" />
                                                @else
                                                    <img id="file-image" class="img-profile avatar border-gray" src="{{asset('admin')}}/img/faces/noavatar.svg" type="file" name="fileUpload" accept="image/*" />
                                                @endif
                                                <label for="file-upload" id="file-drag">
                                                    <div id="start">
                                                        <div id="notimage" class="hidden">Edit</div>
                                                    </div>
                                                    <div id="response" class="hidden">
                                                        <div id="messages"></div>
                                                    </div>
                                                </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <p>{{$user->username}}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="surname">Surname</label>
                                                <input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="{{ old('surname', $user->surname) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <select name="country" id="country" class="form-control">
                                                    @foreach($countries as $country)
                                                        @if($country['code'] === $user->country)
                                                            <option value="{{$country['code']}}" selected>{{$country['name']}}</option>
                                                        @else
                                                            <option value="{{$country['code']}}">{{$country['name']}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="city" class="form-control" placeholder="City" value="{{ old('city', $user->city) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <textarea rows="4" cols="80" class="form-control" name="about_me" placeholder="Here can be your description">{{ old('about_me', $user->about_me) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Facebook</label>
                                                <input type="text" class="form-control" name="facebook_url" placeholder="https://" value="{{ old('facebook_url', $user->facebook_url) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Google</label>
                                                <input type="text" class="form-control" name="google_url" placeholder="https://" value="{{ old('google_url', $user->google_url) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Twitter</label>
                                                <input type="text" class="form-control" name="twitter_url" placeholder="https://" value="{{ old('twitter_url', $user->twitter_url) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Instagram</label>
                                                <input type="text" class="form-control" name="instagram_url" placeholder="https://" value="{{ old('instagram_url', $user->instagram_url) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Linkedin</label>
                                                <input type="text" class="form-control" name="linkedin_url" placeholder="https://" value="{{ old('linkedin_url', $user->linkedin_url) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Xing</label>
                                                <input type="text" class="form-control" name="xing_url" placeholder="https://" value="{{ old('xing_url', $user->xing_url) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-check form-check-radio">
                                                <label>Gender</label>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12 col-md-6 radio-cover">
                                                        <p>Male</p>
                                                        <div class="primary-radio">
                                                            <input type="radio" name="gender" {{$user->gender === "male" ? 'checked' : null}} value="male" id="male">
                                                            <label for="male"></label>
                                                        </div>
                                                    </div>


                                                    <div class="col-12 col-md-6 radio-cover">
                                                        <p>Female</p>
                                                        <div class="primary-radio">
                                                            <input type="radio" name="gender" {{$user->gender === "female" ? 'checked' : null}} value="female" id="female">
                                                            <label for="female"></label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {!! app('captcha')->render(); !!}
                                    <button type="submit" class="genric-btn primary e-large pull-right">Update Profile</button>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('extrascripts')
    <script src="{{asset('front')}}/default/js/userprofile.js"></script>
@endpush