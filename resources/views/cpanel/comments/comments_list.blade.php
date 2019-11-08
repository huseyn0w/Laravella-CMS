<?php
/**
 * Laravella CMS
 * File: comments_list.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 08.11.2019
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
                        <h4 class="card-title">Comments</h4>
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

                        @if ($update_message = Session::get('deleted'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Comments has been deleted</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif



                        <form method="POST" action="{{route('cpanel_comments_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="comments_action" required="" class="form-control">
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
                                                <input class="form-check-input" id="selectAll" name="allcomments" type="checkbox" >
                                                <span class="form-check-sign"></span>
                                            </label>
                                        </div>
                                    </th>
                                    <th>Post Title</th>
                                    <th>Name</th>
                                    <th>Author</th>
                                    <th>Publish date</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($comments_count = 0)
                                @forelse($comments_list as $comment)
                                    @php($comments_count++)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label for="comment_{{$comment->id}}" class="form-check-label form-checkbox">
                                                    <input class="form-check-input comments-checkbox-input" id="comment_{{$comment->id}}" name="comments[]" type="checkbox" value="{{$comment->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$comment->post->title}}</td>
                                        <td>
                                            {{$comment->comment}}

                                            <span class="user_actions">
                                                @if (Auth::user()->can('manage_comments', 'App\Http\Models\UserRoles'))
                                                    <button type="button" class="delete_comment">Delete</button>
                                                    @if($comment->status !== 1)
                                                        <button type="button" class="approve_comment">Approve comment</button>
                                                    @else
                                                        <button type="button" class="unapprove_comment">Unapprove comment</button>
                                                    @endif
                                                    <input type="hidden" class="action_comment_id" value="{{$comment->id}}" name="deleted_comment_id">
                                                @endif
                                            </span>

                                        </td>
                                        <td>{{$comment->user->username}}</td>
                                        <td>{{$comment->created_at->format('d.m.Y')}}</td>
                                        <td>{{$comment->status == 1 ? 'published' : 'pending'}}</td>
                                    </tr>
                                @empty
                                    <td colspan="7">No comments has been found</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $comments_list->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('finalscripts')
    <script>
        var  _token = '{{ csrf_token() }}';
    </script>
    <script src="{{asset('admin')}}/js/comments.js"></script>
@endpush
