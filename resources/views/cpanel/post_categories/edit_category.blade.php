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
                                <strong>Category has been updated</strong>
                            </div>
                        @else
                            <div class="alert alert-danger">
                                <strong>Some problem has been occured. Please try again later.</strong>
                            </div>
                        @endif
                    </div>
                @endif
                <div class="col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_title">Title</label>
                                        <input type="text" id="cpanel_title" required class="form-control" name="title" value="{{ old('title', $category->title) }}" >
                                        <div class="field-desc">
                                            <p>
                                                The name is how it appears on your site.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpanel_slug">Slug</label>
                                        <input type="text" id="cpanel_slug" required class="form-control" name="slug" value="{{ old('slug', $category->slug) }}">
                                        <div class="field-desc">
                                            <p>
                                                The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Parent Category</label>
                                        <select name="parent_category" class="form-control">
                                            <option value="">No</option>
                                            @foreach($categories_list as $category_item)
                                                @if($category_item->id === $category->id) @continue @endif
                                                <option value="{{$category_item->id}}" {{$category_item->id === $category->parent_category ? 'selected': null}}>{{$category_item->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="field-desc">
                                            <p>
                                                Categories, unlike tags, can have a hierarchy. You might have a Jazz category, and under that have children categories for Bebop and Big Band. Totally optional.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description"  class="form-control">{{ old('description', $category->description) }}</textarea>
                                        <div class="field-desc">
                                            <p>
                                                The description is not prominent by default; however, some themes may show it.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection