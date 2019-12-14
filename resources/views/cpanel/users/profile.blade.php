<?php
/**
 * Laravella CMS
 * File: yourprofile.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>

@extends('cpanel.core.index')

@section('content')

    <form action="{{ route('cpanel_update_user_profile', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
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
                        <strong>@lang('cpanel/users.updated_success')</strong>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <strong>@lang('cpanel/users.updated_error')</strong>
                    </div>
                @endif
            </div>
            @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cpanel/users.profile_headline')</h4>
                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.username')</label>
                                    <p>{{$user->username}}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">@lang('cpanel/users.email')</label>
                                    <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">@lang('cpanel/users.new_password')</label>
                                    <input type="password" id="password" class="form-control" name="password" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="confirm_password">@lang('cpanel/users.new_password_confirmation')</label>
                                    <input type="password" id="confirm_password" class="form-control" name="password_confirmation" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">@lang('cpanel/users.name')</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="surname">@lang('cpanel/users.surname')</label>
                                    <input type="text" class="form-control" id="surname" name="surname"  value="{{ old('surname', $user->surname) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.country')</label>
                                    <select name="country" id="country" class="form-control">
                                    @foreach($countries as $country)
                                        @if($country['name'] === $user->country)
                                            <option value="{{$country['name']}}" selected>{{$country['name']}}</option>
                                        @else
                                            <option value="{{$country['name']}}">{{$country['name']}}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.city')</label>
                                    <input type="text" name="city" class="form-control"  value="{{ old('city', $user->city) }}">
                                </div>
                            </div>
                        </div>
                        @if (Auth::user()->can('manage_users', 'App\Http\Models\UserRoles'))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.status')</label>
                                    <select name="role_id" id="user_role" class="form-control">
                                        @foreach($user_roles as $role)
                                            @if($user->role->name === $role->name)
                                                <option value="{{$role->id}}" selected>{{$role->name}}</option>
                                            @else
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.about')</label>
                                    <textarea rows="4" cols="80" class="form-control" name="about_me" >{{ old('about_me', $user->about_me) }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.facebook')</label>
                                    <input type="text" class="form-control" name="facebook_url" placeholder="https://" value="{{ old('facebook_url', $user->facebook_url) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.google')</label>
                                    <input type="text" class="form-control" name="google_url" placeholder="https://" value="{{ old('google_url', $user->google_url) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.twitter')</label>
                                    <input type="text" class="form-control" name="twitter_url" placeholder="https://" value="{{ old('twitter_url', $user->twitter_url) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.instagram')</label>
                                    <input type="text" class="form-control" name="instagram_url" placeholder="https://" value="{{ old('instagram_url', $user->instagram_url) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.linkedin')</label>
                                    <input type="text" class="form-control" name="linkedin_url" placeholder="https://" value="{{ old('linkedin_url', $user->linkedin_url) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>@lang('cpanel/users.xing')</label>
                                    <input type="text" class="form-control" name="xing_url" placeholder="https://" value="{{ old('xing_url', $user->xing_url) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-check form-check-radio">
                                    <label>@lang('cpanel/users.gender')</label>
                                    <br>
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
                        <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/users.update_button_label')</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-user">
                    <div class="card-image">
                        <img src="{{asset('admin')}}/img/avatar-bg.jpg" alt="...">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <span class="user-avatar">
                                @if(!empty($user->avatar))
                                    <img id="file-image" class="avatar border-gray" src="{{$user->avatar}}" alt="User profile" />
                                @else
                                    <img id="file-image" class="avatar border-gray" src="{{asset('admin')}}/img/faces/noavatar.svg" type="file" name="fileUpload" accept="image/*" />
                                @endif
                                <span class="input-group-btn">
                                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary choose-image">
                                    @lang('cpanel/users.avatar_edit')
                                  </a>
                                </span>
                                <input id="file-upload" value="{{old('avatar', $user->avatar)}}" class type="hidden" name="avatar" />
                            </span>
                            <h5 class="title">{{$user->name}} {{$user->surname}}</h5>
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
    <script src="{{asset('')}}/vendor/laravel-filemanager/js/lfm.js"></script>
@endpush

@push('finalscripts')
    <script src="{{asset('admin')}}/js/user.js"></script>
    <script>
        var site_url = "<?php echo env('APP_URL'); ?>/";
    </script>
    <script src="{{asset('admin')}}/js/thumbnail.js"></script>
@endpush