<?php
/**
 * Laravella CMS
 * File: myprofile.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>

@extends('cpanel.index')

@section('content')

    @php
        $countries = get_countries_array();


    @endphp

    <form action="{{ route('cpanel_update_user_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="container-fluid">
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
                        <strong>Settings has been updated</strong>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <strong>{{$update_message}}</strong>
                    </div>
                @endif
            </div>
             @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <p>{{$user->username}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $user->name) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Surname</label>
                                    <input type="text" class="form-control" name="surname" placeholder="Surname" value="{{ old('surname', $user->surname) }}">
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
                                    <label class="form-check-label form-checkbox-label">
                                        <input class="form-check-input" type="radio" name="gender" {{$user->gender === "male" ? 'checked' : null}} value="male" id="male">
                                        <span class="form-check-sign"></span>
                                        Male
                                    </label>
                                    <label class="form-check-label form-checkbox-label">
                                        <input class="form-check-input" type="radio" name="gender" {{$user->gender === "female" ? 'checked' : null}} value="female" id="female">
                                        <span class="form-check-sign"></span>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-image">
                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author uploader">
                            <a href="#">
                                <span class="user-avatar">
                                    <input id="file-upload" class type="file" name="avatar" accept="image/*" />
                                    <label for="file-upload" id="file-drag">
                                    @if(!empty($user->avatar))
                                        <img id="file-image" class="avatar border-gray" src="{{env('APP_URL')}}uploads/images/avatars/{{$user->id}}/{{$user->avatar}}" type="file" name="fileUpload" accept="image/*" />
                                    @else
                                        <img id="file-image" class="avatar border-gray" src="{{asset('admin')}}/img/faces/noavatar.svg" type="file" name="fileUpload" accept="image/*" />
                                    @endif
                                        <div id="start">
                                          <div id="notimage" class="hidden">Please select an image</div>
                                        </div>
                                        <div id="response" class="hidden">
                                          <div id="messages"></div>
                                        </div>
                                      </label>
                                </span>
                                <h5 class="title">{{$user->name}} {{$user->surname}}</h5>
                            </a>
                            <p class="description">
                                {{$user->username}}
                            </p>
                        </div>
                        <p class="description text-center">
                            {{$user->about_me}}
                        </p>
                    </div>
                    <hr>
                    <div class="button-container mr-auto ml-auto">
                        @if($user->facebook_url)
                        <a href="{{ old('facebook_url', $user->facebook_url) }}" target="_blank" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-facebook-square"></i>
                        </a>
                        @endif
                        @if($user->google_url)
                        <a href="{{ old('google_url', $user->google_url) }}" target="_blank" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-google-plus-square"></i>
                        </a>
                        @endif
                        @if($user->twitter_url)
                        <a href="{{ old('twitter_url', $user->twitter_url) }}" target="_blank" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-twitter"></i>
                        </a>
                        @endif
                        @if($user->instagram_url)
                        <a href="{{ old('instagram_url', $user->instagram_url) }}" target="_blank" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-instagram"></i>
                        </a>
                        @endif
                        @if($user->linkedin_url)
                        <a href="{{ old('linkedin_url', $user->linkedin_url) }}" target="_blank" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-linkedin-square"></i>
                        </a>
                        @endif
                        @if($user->xing_url)
                        <a href="{{ old('xing_url', $user->xing_url) }}" target="_blank" class="btn btn-simple btn-link btn-icon">
                            <i class="fa fa-xing-square"></i>
                        </a>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection

@push('extrascripts')
<script src="{{asset('admin')}}/js/laravella.js"></script>
@endpush