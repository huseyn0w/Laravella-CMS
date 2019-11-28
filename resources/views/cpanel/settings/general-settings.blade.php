<?php
/**
 * Laravella CMS
 * File: general-settings.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>

@extends('cpanel.core.index')

@section('content')

    @php

        $website_name = $general_settings->website_name;
        $tagline = $general_settings->tagline;
        $email = $general_settings->contact_email;
        $membership = $general_settings->membership;
        $active_template_name = $general_settings->active_template_name;
        $posts_per_page = $general_settings->posts_per_page;
        $comments_per_page = $general_settings->comments_per_page;

    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cpanel/settings.general_settings_headline')</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cpanel_update_general_settings') }}" method="POST">
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
                                                <strong>@lang('cpanel/settings.general_settings_updates_success')</strong>
                                            </div>
                                        @else
                                            <div class="alert alert-danger">
                                                <strong>{{$update_message}}</strong>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.website_name')</label>
                                        <input type="text" required name="website_name" class="form-control" value="{{ old('website_name', $website_name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.tagline')</label>
                                        <p>@lang('cpanel/settings.tagline_content')</p>
                                        <textarea rows="4" required cols="80" name="tagline" class="form-control">{{ old('tagline', $tagline) }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.contact_email')</label>
                                        <input type="email" required name="contact_email" class="form-control" value="{{ old('contact_email', $email) }}">
                                    </div>
                                    <div class="form-check">
                                        <label for="membership" class="form-check-label form-checkbox">
                                            <input class="form-check-input" id="membership" name="membership" type="checkbox" {{$membership == 1 ? 'checked=checked value=1'  : null}}>
                                            <span class="form-check-sign"></span>
                                            @lang('cpanel/settings.membership')
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">@lang('cpanel/settings.active_template')</label>
                                        @php

                                            $directories  = get_front_templates_array();

                                        @endphp
                                        <select id="inputState" name="active_template_name" required class="form-control">
                                            @forelse($directories as $key => $value)
                                                @if($value === $active_template_name)
                                                    <option value="{{$value}}" selected="selected">{{$value}}</option>
                                                @else
                                                    <option value="{{$value}}">{{$value}}</option>
                                                @endif
                                            @empty
                                                <p>@lang('cpanel/settings.no_template')</p>
                                            @endforelse
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.posts_per_page')</label>
                                        <input type="number" min="1" required name="posts_per_page" class="form-control" value="{{ old('posts_per_page', $posts_per_page) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.comments_per_page')</label>
                                        <input type="number" min="1" required name="comments_per_page" class="form-control" value="{{ old('comments_per_page', $comments_per_page) }}">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/settings.update_button_label')</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection