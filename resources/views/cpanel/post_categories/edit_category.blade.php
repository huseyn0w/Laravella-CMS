<?php
/**
 * Laravella CMS
 * File: edit_category.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 31.08.2019
 */
?>

@extends('cpanel.core.index')



@section('content')

    @php

        $entity = $category;

        $categories_list = get_post_categories_list();

    @endphp

    <form action="{{ route('cpanel_update_category', ['id' => $category->id]) }}" method="POST">
        @csrf
        @method('PUT')
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
                                <strong>@lang('cpanel/categories.updated_success')</strong>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <strong>@lang('cpanel/categories.updated_error')</strong>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">@lang('cpanel/categories.edit_category_headline')</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_title">@lang('cpanel/categories.title')</label>
                                        <input type="text" id="cpanel_title" required class="form-control" name="title" value="{{ old('title', $category->title) }}" >
                                        <div class="field-desc">
                                            <p>
                                                @lang('cpanel/categories.title_desc')
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_slug">@lang('cpanel/categories.slug')</label>
                                        <input type="text" id="cpanel_slug" required class="form-control" name="slug" value="{{ old('slug', $category->slug) }}">
                                        <div class="field-desc">
                                            <p>
                                                @lang('cpanel/categories.slug_desc')
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/categories.parent_category')</label>
                                        <select name="parent_category" class="form-control">
                                            <option value="">@lang('cpanel/categories.no_parent_category')</option>
                                            @foreach($categories_list as $category_item)
                                                @if($category_item->id === $category->id) @continue @endif
                                                <option value="{{$category_item->id}}" {{$category_item->id === $category->parent_category ? 'selected': null}}>{{$category_item->title}}</option>
                                            @endforeach
                                        </select>
                                        <div class="field-desc">
                                            <p>
                                                @lang('cpanel/categories.parent_category_desc')
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>@lang('cpanel/categories.description')</label>
                                        <textarea name="description"  class="form-control">{{ old('description', $category->description) }}</textarea>
                                        <div class="field-desc">
                                            <p>
                                                @lang('cpanel/categories.description_content')
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('cpanel.core.seo')
                            <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/categories.update_button_label')</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection