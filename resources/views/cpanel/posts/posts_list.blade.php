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
                                        <strong>@lang('cpanel/posts.post_added')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('deleted'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/posts.bulky_deleted_message')</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>@lang('cpanel/posts.bulky_error_message')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if ($update_message = Session::get('restored'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/posts.bulky_restored_message')</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>@lang('cpanel/posts.bulky_error_message')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('destroyed'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/posts.bulky_destroyed_message')</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>@lang('cpanel/posts.bulky_error_message')</strong>
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
                                    <option selected="selected">@lang('cpanel/posts.bulk_action_label')</option>

                                @if($route_name == "cpanel_trashed_posts_list")
                                    <option value="destroy">@lang('cpanel/posts.bulk_action_destroy_label')</option>
                                    <option value="restore">@lang('cpanel/posts.bulk_action_restore_label')</option>
                                    @else
                                    <option value="delete">@lang('cpanel/posts.bulk_action_delete_label')</option>
                                @endif
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">@lang('cpanel/posts.bulk_action_apply_label')</button>
                                <a href="{{route('cpanel_posts_list')}}" class="btn btn-success btn-fill trashed-posts">@lang('cpanel/posts.general_posts')</a>
                                <a href="{{route('cpanel_trashed_posts_list')}}" class="btn btn-warning btn-fill trashed-posts">@lang('cpanel/posts.trashed_posts')</a>
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
                                        <th>@lang('cpanel/posts.table_name')</th>
                                        <th>@lang('cpanel/posts.table_author')</th>
                                        <th>@lang('cpanel/posts.table_publish_date')</th>
                                        <th>@lang('cpanel/posts.table_status')</th>
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
                                                <a href="{{route('cpanel_edit_post', $post->id)}}" target="_blank">@lang('cpanel/posts.edit_post')</a>
                                                <input type="hidden" class="deleted_post_id" value="{{$post->id}}" name="deleted_post_id">
                                                @if($route_name === "cpanel_posts_list")
                                                    <button type="button" class="delete_post">@lang('cpanel/posts.delete_post')</button>
                                                @else
                                                    <button type="button" class="destroy_post">@lang('cpanel/posts.destroy_post')</button>
                                                    <a href="{{route('cpanel_restore_post', $post->id)}}" class="restore_post btn-success">@lang('cpanel/posts.restore_post')</a>
                                                @endif
                                             @endif
                                            </span>

                                        </td>
                                        <td>{{$post->author->username}}</td>
                                        <td>{{Carbon\Carbon::parse($post->created_at)->format('d.m.Y')}}</td>
                                        <td>{{$post->status == 1 ? 'published' : 'private'}}</td>
                                    </tr>
                                @empty
                                    <td colspan="7">@lang('cpanel/posts.not_found')</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $posts_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_post')}}" class="btn btn-info btn-fill pull-right">@lang('cpanel/posts.add_new_post')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('finalscripts')
    <script>
        var delete_confirmation = '@lang('cpanel/posts.js_delete_confirmation')',
            destroy_confirmation = '@lang('cpanel/posts.js_destroy_confirmation')',
            delete_success = '@lang('cpanel/posts.js_delete_success')',
            destroy_success = '@lang('cpanel/posts.js_destroy_success')',
            error_message = '@lang('cpanel/posts.js_error')';
    </script>
    <script src="{{asset('admin')}}/js/post.js"></script>
@endpush