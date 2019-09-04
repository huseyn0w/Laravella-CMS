<?php
/**
 * Laravella CMS
 * File: posts.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 01.09.2019
 */
?>

@extends('cpanel.index')
@push('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

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
                        @if ($update_message = Session::get('message'))
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
                        @if ($update_message = Session::get('post_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Post has been created successfully</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <form method="POST" action="{{route('cpanel_posts_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="posts_action" required="" class="form-control">
                                    <option selected="selected">Bulk action</option>
                                    <option value="delete">Delete</option>
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">Apply</button>
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
                                                    <input class="form-check-input users-checkbox-input" id="post_{{$post->id}}" name="posts[]" type="checkbox" value="{{$post->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$posts_count}}</td>
                                        <td>
                                            {{$post->title}}

                                            <span class="user_actions">
                                             @if (Auth::user()->can('manage_posts', 'App\Http\Models\Post'))
                                                <a href="{{route('cpanel_edit_post', $post->id)}}" target="_blank">Edit</a>
                                                <input type="hidden" class="deleted_post_id" value="{{$post->id}}" name="deleted_post_id">
                                                <button type="button" class="delete_post">Delete</button>
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
