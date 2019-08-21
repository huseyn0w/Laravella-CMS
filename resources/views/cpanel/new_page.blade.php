<?php
/**
 * Laravella CMS
 * File: new_page.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 16.08.2019
 */
?>

@extends('cpanel.index')

@push('extrastyles')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('admin')}}/css/datepicker.min.css" rel="stylesheet">
@endpush

@section('content')

    @php

        $users_list = get_authors_list();

    @endphp

    <form action="{{ route('cpanel_save_new_page') }}" method="POST" enctype="multipart/form-data">
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
                            <h4 class="card-title">Add new Page</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="username">Title</label>
                                        <input type="text" id="title" required class="form-control" name="title" value="{{ old('title') }}" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" id="slug" required class="form-control" name="slug" value="{{ old('slug') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea name="content" required id="editor"  class="form-control">{{old('content')}}</textarea>
                                    </div>
                                </div>
                            </div>
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
                                        <label>Publish date</label>
                                        <input class="form-control" autocomplete="off" name="created_at" required id="date_time_picker" type="text" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="user_role" class="form-control">
                                            <option value="0">Private</option>
                                            <option value="1" selected>Published</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Publish</button>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('extrascripts')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script src="{{asset('admin')}}/js/datepicker.min.js"></script>
    <script src="{{asset('admin')}}/js/i18n/datepicker.en.js"></script>
@endpush