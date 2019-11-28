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

        $logo_url = $site_options->logo_url;
        $copyright = $site_options->copyright;
        $github_url = $site_options->github_url;
        $linkedin_url = $site_options->linkedin_url;

    @endphp

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cpanel/settings.site_options_headline')</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cpanel_update_site_options') }}" method="POST">
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
                                                <strong>@lang('cpanel/settings.site_options_updates_success')</strong>
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
                                        <label for="custom_input_image">@lang('cpanel/settings.logo')</label>
                                        <span class="input-group-btn">
                                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary choose-image">
                                            <i class="fa fa-picture-o"></i> @lang('cpanel/settings.choose_image')
                                          </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="text" name="logo_url" value="{{ old('logo_url', $logo_url) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.footer_copyright')</label>
                                        <input type="text" required name="copyright" class="form-control" value="{{ old('copyright', $copyright) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.linkedin_url')</label>
                                        <input type="text" required name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $linkedin_url) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>@lang('cpanel/settings.github_url')</label>
                                        <input type="text" required name="github_url" class="form-control" value="{{ old('github_url', $github_url) }}">
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

@push('finalscripts')
    <script>
        var site_url = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="{{asset('')}}/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-image.js"></script>
@endpush