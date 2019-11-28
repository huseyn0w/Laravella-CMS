<?php
/**
 * Laravella CMS
 * File: change_password.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 12.11.2019
 */
?>

@extends(env('TEMPLATE_NAME').'/index')

@section('content')


    @php
        $home_page_data = get_data(1, 'page', ['slug', 'title']);

    @endphp

    <section class="top-section-area section-gap">
        <div class="container">
            <div class="row justify-content-between align-items-center d-flex">
                <div class="col-lg-8 top-left">
                    <h1 class="text-white mb-20">@lang('default/change_password.headline')</h1>
                    <ul class="breadcrumbs">
                        <li><a href="{{env('APP_URL')}}">{{$home_page_data->title}}</a><span class="lnr lnr-arrow-right"></span></li>
                        <li><a href="{{route('get_user_info')}}">@lang('default/change_password.edit_profile')</a><span class="lnr lnr-arrow-right"></span></li>
                        <li><span>@lang('default/change_password.change_password')</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="profile_cover mb-30 mt-30">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <form action="{{ route('change_password_action') }}" method="POST" enctype="multipart/form-data">
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
                                            <strong>@lang('default/change_password.password_updated')</strong>
                                        </div>
                                    @else
                                        <div class="alert alert-danger">
                                            <strong>@lang('default/change_password.problem_occurred')</strong>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">@lang('default/change_password.edit_profile')</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="current_password">@lang('default/change_password.current_password')</label>
                                                            <input type="password" required id="current_password" class="form-control" name="current_password" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="password">@lang('default/change_password.new_password')</label>
                                                            <input type="password" required id="password" class="form-control" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="confirm_password">@lang('default/change_password.confirm_new_password')</label>
                                                            <input type="password" required id="confirm_password" class="form-control" name="password_confirmation">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {!! app('captcha')->render(); !!}
                                        <button type="submit" class="genric-btn primary e-large pull-right">@lang('default/change_password.change_password')</button>
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
