<?php
/**
 * Laravella CMS
 * File: new_user.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 11.08.2019
 */
?>

@extends('cpanel.core.index')

@section('content')

    <form action="{{ route('cpanel_save_new_user') }}" method="POST">
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cpanel/users.new_user_headline')</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">@lang('cpanel/users.username')</label>
                                    <input type="text" id="username" class="form-control" name="username" value="{{ old('username') }}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">@lang('cpanel/users.email')</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">@lang('cpanel/users.password')</label>
                                    <input type="password" id="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">@lang('cpanel/users.confirm_password')</label>
                                    <input type="password" id="confirm_password" class="form-control" name="password_confirmation" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">@lang('cpanel/users.name')</label>
                                    <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname">@lang('cpanel/users.surname')</label>
                                    <input type="text" id="surname" class="form-control" name="surname" value="{{ old('surname') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.country')</label>
                                    <select name="country" id="country" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country['name']}}">{{$country['name']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.city')</label>
                                    <input type="text" name="city" class="form-control"  value="{{ old('city') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.status')</label>
                                    <select name="role_id" id="user_role" class="form-control">
                                        @foreach($user_roles as $role)
                                            <option value="{{$role['id']}}">{{$role['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.about')</label>
                                    <textarea rows="4" cols="80" class="form-control" name="about_me" placeholder="Here can be your description">{{ old('about_me') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.facebook')</label>
                                    <input type="text" class="form-control" name="facebook_url" placeholder="https://" value="{{ old('facebook_url') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.google')</label>
                                    <input type="text" class="form-control" name="google_url" placeholder="https://" value="{{ old('google_url') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.twitter')</label>
                                    <input type="text" class="form-control" name="twitter_url" placeholder="https://" value="{{ old('twitter_url') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.instagram')</label>
                                    <input type="text" class="form-control" name="instagram_url" placeholder="https://" value="{{ old('instagram_url') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.linkedin')</label>
                                    <input type="text" class="form-control" name="linkedin_url" placeholder="https://" value="{{ old('linkedin_url') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.xing')</label>
                                    <input type="text" class="form-control" name="xing_url" placeholder="https://" value="{{ old('xing_url') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check form-check-radio">
                                    <label>@lang('cpanel/users.gender')</label>
                                    <br>
                                    <label class="form-check-label form-checkbox-label">
                                        <input class="form-check-input" type="radio" name="gender"  value="male" id="male">
                                        <span class="form-check-sign"></span>
                                        Male
                                    </label>
                                    <label class="form-check-label form-checkbox-label">
                                        <input class="form-check-input" type="radio" name="gender"  value="female" id="female">
                                        <span class="form-check-sign"></span>
                                        Female
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/users.add_new_user')</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection

@push('extrascripts')
<script src="{{asset('admin')}}/js/userprofile.js"></script>
@endpush

@push('finalscripts')
    <script src="{{asset('admin')}}/js/user.js"></script>
@endpush