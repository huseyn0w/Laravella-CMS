<?php
/**
 * Laravella CMS
 * File: new_page.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 16.08.2019
 */
?>

@extends('cpanel.core.index')

@push('extrastyles')
    <link rel="stylesheet" href="{{asset('admin')}}/css/datepicker.min.css" rel="stylesheet">
@endpush

@php
    $form_action = route('cpanel_save_new_page');

    if(!empty(request()->route('id')))  $form_action = route('cpanel_save_new_page', ['id' => request()->route('id')]);
@endphp
@section('content')


    <form action="{{$form_action}}" method="POST" enctype="multipart/form-data">
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
                <div class="col-xs-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('cpanel/pages.new_page_headline')</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_title">@lang('cpanel/pages.title')</label>
                                        <input type="text" id="cpanel_title" required class="form-control" name="title" value="{{ old('title') }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_slug">@lang('cpanel/pages.slug')</label>
                                        <input type="text" id="cpanel_slug" required class="form-control" name="slug" value="{{ old('slug') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/pages.content')</label>
                                        <textarea name="content" id="editor"  class="my-editor form-control">{{old('content')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @include('cpanel.core.seo')
                            @include('cpanel.core.custom-fields')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('cpanel.core.translation')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/pages.author')</label>
                                        <select name="author_id" id="author_id" class="form-control">
                                            @foreach($users_list as $user)
                                                @if($user->username === Auth::user()->username)
                                                    <option value="{{$user->id}}" selected>{{$user->username}}</option>
                                                @else
                                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/pages.publish_date')</label>
                                        <input class="form-control" autocomplete="off" name="created_at" value="{{ \Carbon\Carbon::now() }}" required id="date_time_picker" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="user_role" class="form-control">
                                            <option value="0">@lang('cpanel/pages.status_private')</option>
                                            <option value="1" selected>@lang('cpanel/pages.status_published')</option>
                                        </select>
                                    </div>
                                </div>
                                @if(!empty($page_templates) && $page_templates)
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/pages.page_template')</label>
                                        <select name="template" class="form-control">
                                        @foreach($page_templates as $file_name => $template_header)
                                                <option value="{{$file_name}}" {{$file_name === 'page' ? 'selected' : null}}>{{$template_header}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/pages.publish_button_label')</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('cpanel.core.modals')
@endsection

@push('extrascripts')
    <script src="https://cdn.tiny.cloud/1/4vyoa49f4irghhao6v5lpc7z5z2hvhgau8wsjj1y9g65ovse/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admin')}}/js/datepicker.min.js"></script>
    <script src="{{asset('admin')}}/js/i18n/datepicker.en.js"></script>

@endpush
@push('finalscripts')
    @include('cpanel.core.custom-fields-variables')
    <script src="{{asset('')}}/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin')}}/js/page.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-text.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-textarea.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-image.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-link.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-category.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-repeater.js"></script>
@endpush