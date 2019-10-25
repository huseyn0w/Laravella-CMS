<?php
/**
 * Laravella CMS
 * File: edit_page.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 16.08.2019
 */
?>

@extends('cpanel.core.index')

@push('extrastyles')
    <link rel="stylesheet" href="{{asset('admin')}}/css/datepicker.min.css" rel="stylesheet">
@endpush

@section('content')

    @php

        $entity = $page;

        $users_list = get_authors_list();

        $page_templates = get_page_templates_list();

        $page_slug = $page->slug === "/" ? '' : $page->slug;

    @endphp

    <form action="{{ route('cpanel_update_page', ['id' => $page->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
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
                                <strong>Page has been updated</strong>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <strong>Some problem has been occured. Please try again later.</strong>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="col-xs-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Page</h4>
                            <p>Page url: <strong><a href="{{env('APP_URL')}}{{ old('slug',$page_slug) }}">{{env('APP_URL')}}{{ old('slug',$page_slug) }}</a></strong></p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Title</label>
                                        <input type="text" id="cpanel_title" required class="form-control" name="title" value="{{ old('title', $page->title) }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="cpanel_slug" required class="form-control" name="slug" value="{{ old('slug',$page->slug) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea name="content"  id="editor"  class="my-editor form-control">{{old('content',$page->content)}}</textarea>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Author</label>
                                        <select name="author_id" id="author_id" class="form-control">
                                         @foreach($users_list as $user)
                                            @if($user->id === $page->author_id)
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
                                        <label>Publish date</label>
                                        <input class="form-control" value="{{old('created_at', $page->created_at)}}" autocomplete="off" name="created_at" required id="date_time_picker" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="user_role" class="form-control">
                                            <option value="0" {{$page->status === 0 ? 'selected' :null}}>Private</option>
                                            <option value="1" {{$page->status === 1 ? 'selected' :null}}>Published</option>
                                        </select>
                                    </div>
                                </div>
                                @if(!empty($page_templates) && $page_templates)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Page Template</label>
                                            <select name="template" class="form-control">
                                                <option value="page">Standart</option>
                                                @foreach($page_templates as $file_name => $template_header)
                                                    <option value="{{$file_name}}" {{$page->template === $file_name ? 'selected' : null}} >{{$template_header}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
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
    <script src="{{asset('')}}/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin')}}/js/page.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-text.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-textarea.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-image.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-link.js"></script>
    <script src="{{asset('admin')}}/js/custom-fields/custom-repeater.js"></script>
@endpush