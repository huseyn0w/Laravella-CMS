<?php
/**
 * Laravella CMS
 * File: new_category.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 31.08.2019
 */
?>

@extends('cpanel.index')



@section('content')

    @php

        $categories_list = get_post_categories_list();

    @endphp

    <form action="{{ route('cpanel_save_new_category') }}" method="POST">
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
                <div class="col-xs-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add new Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Title</label>
                                        <input type="text" id="cpanel_title" required class="form-control" name="name" value="{{ old('name') }}" >
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
                                        <input type="text" id="cpanel_slug" required class="form-control" name="slug" value="{{ old('slug') }}">
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
                                            @foreach($categories_list as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
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
                                        <textarea name="description"  class="form-control">{{old('description')}}</textarea>
                                        <div class="field-desc">
                                            <p>
                                                The description is not prominent by default; however, some themes may show it.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Create</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection