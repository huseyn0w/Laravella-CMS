<?php
/**
 * Laravella CMS
 * File: pages_list.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 16.08.2019
 */


?>

@extends('cpanel.core.index')
@push('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">@lang('cpanel/pages.list_headline')</h4>
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
                                        <strong>@lang('cpanel/pages.bulky_deleted_message')</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>@lang('cpanel/pages.bulky_deleted_error_message')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('page_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/pages.page_added')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <form method="POST" action="{{route('cpanel_pages_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="pages_action" required="" class="form-control">
                                    <option selected="selected">@lang('cpanel/pages.bulk_action_label')</option>
                                    <option value="delete">@lang('cpanel/pages.bulk_action_delete_label')</option>
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">@lang('cpanel/pages.bulk_action_apply')</button>
                            </div>
                            <table class="table table-hover table-striped users-table">
                                <thead>
                                    <tr>
                                        <th>
                                           <div class="form-check">
                                               <label for="selectAll" class="form-check-label form-checkbox">
                                                   <input class="form-check-input" id="selectAll" name="allusers" type="checkbox" >
                                                   <span class="form-check-sign"></span>
                                               </label>
                                           </div>
                                        </th>
                                        <th>№</th>
                                        <th>@lang('cpanel/pages.table_name')</th>
                                        <th>@lang('cpanel/pages.table_author')</th>
                                        <th>@lang('cpanel/pages.table_publish_date')</th>
                                        <th>@lang('cpanel/pages.table_status')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($pages_count = 0)
                                @forelse($pages_list as $page)
                                    @php($pages_count++)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label for="page_{{$page->id}}" class="form-check-label form-checkbox">
                                                    <input class="form-check-input pages-checkbox-input" id="page_{{$page->id}}" name="pages[]" type="checkbox" value="{{$page->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$pages_count}}</td>
                                        <td>
                                            {{$page->title}}

                                            <span class="user_actions">
                                             @if (Auth::user()->can('manage_users', 'App\Http\Models\UserRoles'))
                                                <a href="{{route('cpanel_edit_page', ['id' => $page->id, 'lang' => get_current_lang()])}}" target="_blank">@lang('cpanel/pages.edit_page')</a>
                                                <input type="hidden" class="deleted_page_id" value="{{$page->id}}" name="deleted_page_id">
                                                <button type="button" class="delete_page">@lang('cpanel/pages.delete_page')</button>
                                             @endif
                                            </span>

                                        </td>
                                        <td>{{$page->author->username}}</td>
                                        <td>{{ Carbon\Carbon::parse($page->created_at)->format('d.m.Y')}}</td>
                                        <td>@if($page->status == 1) @lang('cpanel/pages.page_published') @else @lang('cpanel/pages.page_pending') @endif</td>
                                    </tr>
                                @empty
                                    <td colspan="7">@lang('cpanel/pages.not_found')</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $pages_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_page')}}" class="btn btn-info btn-fill pull-right">@lang('cpanel/pages.add_new_page')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('finalscripts')
    <script>
        delete_confirmation = '@lang('cpanel/pages.js_delete_confirmation')',
        delete_success = '@lang('cpanel/pages.js_delete_success')',
        error_message = '@lang('cpanel/pages.js_delete_error')';
    </script>
    <script src="{{asset('admin')}}/js/page.js"></script>
@endpush