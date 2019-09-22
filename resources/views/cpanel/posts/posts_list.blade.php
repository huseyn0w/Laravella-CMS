<?php
/**
 * Laravella CMS
 * File: posts_list.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 01.09.2019
 */
?>

@extends('cpanel.core.index')
@push('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@php
$route_name = Route::current()->getName();
@endphp

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Posts</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
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
                        @if ($update_message = Session::get('post_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Post has been created successfully</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('deleted'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Posts has been deleted</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if ($update_message = Session::get('restored'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Posts has been restored</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('destroyed'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Posts has been totally removed</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if($route_name == "cpanel_trashed_posts_list")
                            <form method="POST" action="{{route('cpanel_posts_bulk_action')}}">
                        @else
                            <form method="POST" action="{{route('cpanel_posts_bulk_delete')}}">
                        @endif
                            @csrf
                        @if($route_name == "cpanel_trashed_posts_list")
                            @method('POST')
                        @else
                            @method('DELETE')
                        @endif
                            <div class="select-cover">
                                <select id="inputState" name="posts_action" required="" class="form-control">
                                    <option selected="selected">Bulk action</option>

                                @if($route_name == "cpanel_trashed_posts_list")
                                    <option value="destroy">Destroy</option>
                                    <option value="restore">Restore</option>
                                    @else
                                    <option value="delete">Delete</option>
                                @endif
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">Apply</button>
                                <a href="{{route('cpanel_posts_list')}}" class="btn btn-success btn-fill trashed-posts">General posts</a>
                                <a href="{{route('cpanel_trashed_posts_list')}}" class="btn btn-warning btn-fill trashed-posts">Trashed posts</a>
                            </div>
                            <table class="table table-hover table-striped users-table">
                                <thead>
                                    <tr>
                                        <th>
                                           <div class="form-check">
                                               <label for="selectAll" class="form-check-label form-checkbox">
                                                   <input class="form-check-input" id="selectAll" name="allposts" type="checkbox" >
                                                   <span class="form-check-sign"></span>
                                               </label>
                                           </div>
                                        </th>
                                        <th>№</th>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Publish date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($posts_count = 0)
                                @forelse($posts_list as $post)
                                    @php($posts_count++)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label for="post_{{$post->id}}" class="form-check-label form-checkbox">
                                                    <input class="form-check-input posts-checkbox-input" id="post_{{$post->id}}" name="posts[]" type="checkbox" value="{{$post->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$posts_count}}</td>
                                        <td>
                                            {{$post->title}}

                                            <span class="user_actions">
                                             @if (Auth::user()->can('manage_posts', 'App\Http\Models\UserRoles'))
                                                <a href="{{route('cpanel_edit_post', $post->id)}}" target="_blank">Edit</a>
                                                <input type="hidden" class="deleted_post_id" value="{{$post->id}}" name="deleted_post_id">
                                                @if($route_name === "cpanel_posts_list")
                                                    <button type="button" class="delete_post">Delete</button>
                                                @else
                                                    <button type="button" class="destroy_post">Destroy</button>
                                                    <a href="{{route('cpanel_restore_post', $post->id)}}" class="restore_post btn-success">Restore</a>
                                                @endif
                                             @endif
                                            </span>

                                        </td>
                                        <td>{{$post->author->username}}</td>
                                        <td>{{$post->created_at}}</td>
                                        <td>{{$post->status == 1 ? 'published' : 'private'}}</td>
                                    </tr>
                                @empty
                                    <td colspan="7">No posts has been found</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $posts_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_post')}}" class="btn btn-info btn-fill pull-right">Add new post</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('finalscripts')
    <script src="{{asset('admin')}}/js/post.js"></script>
@endpush