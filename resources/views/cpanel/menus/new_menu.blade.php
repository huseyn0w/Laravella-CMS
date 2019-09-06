<?php
/**
 * Laravella CMS
 * File: new_menu.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 04.09.2019
 */
?>

@extends('cpanel.core.index')

@push('extrastyles')
    <link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
@endpush

@php
    $fields = ['id', 'title', 'slug'];

    $posts_list = get_post_list($fields);
    $categories_list = get_post_categories_list($fields);
    $pages_list = get_pages_list($fields);


@endphp

@section('content')

    <form action="{{ route('cpanel_save_new_menu') }}" id="add_menu_form" method="POST">
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
                <div class="col-xs-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add new menu</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="menu_title">Menu Name</label>
                                        <input type="text" id="menu_title" required class="form-control" name="title" value="{{ old('title') }}" >
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="accordion" id="menusAccordion">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#pages_tab" aria-expanded="false" aria-controls="collapseOne">
                                                        Pages
                                                    </button>
                                                </h2>
                                            </div>

                                            <div id="pages_tab" class="collapse" aria-labelledby="headingOne" data-parent="#menusAccordion">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <select name="pages" multiple class="form-control multiple_list menu_item" id="pages_list" data-type="pages">
                                                            @forelse($pages_list as $page)
                                                                <option value="{{$page->slug}}">{{$page->title}}</option>
                                                            @empty
                                                                No pages
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#posts_tab" aria-expanded="false" aria-controls="collapseTwo">
                                                        Posts
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="posts_tab" class="collapse" aria-labelledby="headingTwo" data-parent="#menusAccordion">
                                                <div class="card-body">
                                                    <select name="posts" multiple class="form-control multiple_list menu_item" id="posts_list" data-type="posts">
                                                        @forelse($posts_list as $post)
                                                            <option value="{{$post->slug}}">{{$post->title}}</option>
                                                        @empty
                                                            No posts
                                                        @endforelse
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#categories_tab" aria-expanded="false" aria-controls="collapseThree">
                                                        Categories
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="categories_tab" class="collapse" aria-labelledby="headingThree" data-parent="#menusAccordion">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <select name="category" multiple class="form-control multiple_list menu_item" id="categories_list" data-type="categories">
                                                            @forelse($categories_list as $category)
                                                                <option value="{{$category->slug}}">{{$category->title}}</option>
                                                            @empty
                                                                No categories
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" id="headingFour">
                                                <h2 class="mb-0">
                                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#custom_link_tap" aria-expanded="false" aria-controls="collapseFour">
                                                        Custom link
                                                    </button>
                                                </h2>
                                            </div>
                                            <div id="custom_link_tap" class="collapse" aria-labelledby="headingFour" data-parent="#menusAccordion">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="link_label">Label</label>
                                                        <input type="text" id="link_label" class="form-control menu_item" name="link_label" >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="link_url">URL</label>
                                                        <input type="text" id="link_url" class="form-control menu_item" name="link_url" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info btn-fill pull-right add_menu_item">Add to Menu</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="menu-box">
                                        <ul class="menu-list sortable" id="sortable">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="content" id="menuContent">
                            <button type="submit" class="btn btn-info btn-fill pull-right create_menu">Create menu</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('extrascripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{asset('admin')}}/js/jquery.mjs.nestedSortable.js"></script>
@endpush