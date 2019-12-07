<?php
/**
 * Laravella CMS
 * File: edit_post.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 01.08.2019
 */
?>

@extends('cpanel.core.index')

@push('extrastyles')
    <link rel="stylesheet" href="{{asset('admin')}}/css/datepicker.min.css" rel="stylesheet">
@endpush

@section('content')

    @php


        $categories_ids = [];

        foreach($entity->categories as $category) $categories_ids[] = $entity->id;


    @endphp

    <form action="{{ route('cpanel_update_post', ['id' => $entity->id]) }}" method="POST" enctype="multipart/form-data">
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
                                <strong>@lang('cpanel/posts.updated_success')</strong>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <strong>@lang('cpanel/posts.updated_error')</strong>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="col-xs-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('cpanel/posts.edit_headline')</h4>
                            <p>@lang('cpanel/posts.url_preview') <strong><a href="{{env('APP_URL')}}posts/{{ old('slug',$entity->slug) }}">{{env('APP_URL')}}posts/{{ old('slug',$entity->slug) }}</a></strong></p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_title">@lang('cpanel/posts.title')</label>
                                        <input type="text" id="cpanel_title" required class="form-control" name="title" value="{{ old('title', $entity->title) }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">@lang('cpanel/posts.slug')</label>
                                        <input type="text" id="cpanel_slug" required class="form-control" name="slug" value="{{ old('slug',$entity->slug) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/posts.preview')</label>
                                        <textarea name="preview"  id="editor"  class="my-editor form-control">{{old('preview',$entity->preview)}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/posts.content')</label>
                                        <textarea name="content"  id="editor"  class="my-editor form-control">{{old('content',$entity->content)}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="likes">@lang('cpanel/posts.likes') {{$entity->likes}}</label>
                                    </div>
                                </div>
                            </div>
                            @include('cpanel.core.seo')
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                @include('cpanel.core.translation')
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/posts.category')</label>
                                        <select name="category[]" multiple class="form-control category_list multiple_list" id="post_category">
                                            @foreach($categories_list as $category)
                                                <option value="{{$category->category_id}}" {{$entity->id === $category->category_id ? 'selected': null}} >{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/posts.author')</label>
                                        <select name="author_id" id="author_id" class="form-control">
                                         @foreach($users_list as $user)
                                            @if($user->id === $entity->author_id)
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
                                        <label>@lang('cpanel/posts.publish_date')</label>
                                        <input class="form-control" value="{{old('updated_at', $entity->updated_at)}}" autocomplete="off" name="updated_at" required id="date_time_picker" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/posts.status')</label>
                                        <select name="status" id="user_role" class="form-control">
                                            <option value="0" {{$entity->status === 0 ? 'selected' :null}}>@lang('cpanel/posts.status_private')</option>
                                            <option value="1" {{$entity->status === 1 ? 'selected' :null}}>@lang('cpanel/posts.status_published')</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="custom_input_image">@lang('cpanel/posts.thumbnail')</label>
                                        <span class="input-group-btn">
                                          <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary choose-image">
                                            <i class="fa fa-picture-o"></i> @lang('cpanel/posts.thumbnail_label')
                                          </a>
                                        </span>
                                        <input id="thumbnail" class="form-control" type="hidden" name="thumbnail" value="{{ old('thumbnail', $entity->thumbnail) }}">
                                        <div class="post-thumbnail" {{ empty($entity->thumbnail) ? "style=display:none;" : null}}>
                                            <button type="button" class="remove_thumbnail">X</button>
                                            <img src="{{ old('logo_url', $entity->thumbnail) }}" id="post-thumbnail" alt="Post Thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/posts.update_button_label')</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('extrascripts')
    <script src="https://cdn.tiny.cloud/1/4vyoa49f4irghhao6v5lpc7z5z2hvhgau8wsjj1y9g65ovse/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="{{asset('admin')}}/js/datepicker.min.js"></script>
    <script src="{{asset('admin')}}/js/i18n/datepicker.en.js"></script>
@endpush

@push('finalscripts')
    <script src="{{asset('')}}/vendor/laravel-filemanager/js/lfm.js"></script>
    <script src="{{asset('admin')}}/js/post.js"></script>
    <script>
        var site_url = "<?php echo env('APP_URL'); ?>";
    </script>
    <script src="{{asset('admin')}}/js/thumbnail.js"></script>
@endpush