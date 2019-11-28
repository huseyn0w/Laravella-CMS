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
                        <h4 class="card-title">@lang('cpanel/comments.list_headline')</h4>
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
                                        <strong>@lang('cpanel/comments.bulky_deleted_message')</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>@lang('cpanel/comments.bulky_deleted_error_message')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif



                        <form method="POST" action="{{route('cpanel_comments_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="comments_action" required="" class="form-control">
                                    <option selected="selected">@lang('cpanel/comments.bulk_action_label')</option>
                                    <option value="delete">@lang('cpanel/comments.bulk_action_delete_label')</option>
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">@lang('cpanel/comments.bulk_action_apply')</button>
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
                                    <th>@lang('cpanel/comments.table_title')</th>
                                    <th>@lang('cpanel/comments.table_name')</th>
                                    <th>@lang('cpanel/comments.table_author')</th>
                                    <th>@lang('cpanel/comments.table_publish_date')</th>
                                    <th>@lang('cpanel/comments.table_status')</th>
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
                                                    <button type="button" class="delete_comment">@lang('cpanel/comments.delete')</button>
                                                    @if($comment->status !== 1)
                                                        <button type="button" class="approve_comment">@lang('cpanel/comments.approve')</button>
                                                    @else
                                                        <button type="button" class="unapprove_comment">@lang('cpanel/comments.unapprove')</button>
                                                    @endif
                                                    <input type="hidden" class="action_comment_id" value="{{$comment->id}}" name="deleted_comment_id">
                                                @endif
                                            </span>

                                        </td>
                                        <td>{{$comment->user->username}}</td>
                                        <td>{{$comment->created_at->format('d.m.Y')}}</td>
                                        <td>@if($comment->status == 1)  @lang('cpanel/comments.status_approved') @else @lang('cpanel/comments.status_pending') @endif</td>
                                    </tr>
                                @empty
                                    <td colspan="7">@lang('cpanel/comments.not_found')</td>
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
        var  _token = '{{ csrf_token() }}',
            delete_confirmation = '@lang('cpanel/comments.js_delete_confirmation')',
            approve_confirmation = '@lang('cpanel/comments.js_approve_confirmation')',
            unapprove_confirmation = '@lang('cpanel/comments.js_unapprove_confirmation')',
            approve_success = '@lang('cpanel/comments.js_approve')',
            delete_success = '@lang('cpanel/comments.js_delete')',
            unapprove_success = '@lang('cpanel/comments.js_unapprove')',
            error_message = '@lang('cpanel/comments.js_error')';
    </script>
    <script src="{{asset('admin')}}/js/comments.js"></script>
@endpush
