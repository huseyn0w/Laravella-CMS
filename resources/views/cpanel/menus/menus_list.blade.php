<?php
/**
 * Laravella CMS
 * File: menus_list.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 04.09.2019
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
                        <h4 class="card-title">@lang('cpanel/menus.list_headline')</h4>
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
                        @if ($update_message = Session::get('menu_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/menus.menu_added')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <table class="table table-hover table-striped users-table">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>@lang('cpanel/menus.table_name')</th>
                                    <th>@lang('cpanel/menus.table_action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($menus_count = 0)
                            @forelse($menus_list as $menu)
                                @php($menus_count++)
                                <tr>
                                    <td>
                                        {{$menus_count}}
                                    </td>
                                    <td>
                                        {{$menu->title}}
                                    </td>
                                    <td>
                                        <span class="user_actions">
                                         @if (Auth::user()->can('manage_menus', 'App\Http\Models\UserRoles'))
                                                <a href="{{route('cpanel_edit_menu', $menu->id)}}" target="_blank">@lang('cpanel/menus.edit')</a>
                                                <input type="hidden" class="deleted_menu_id" value="{{$menu->id}}" name="deleted_menu_id">
                                            @if($menu->id > 1)
                                                <button type="button" class="delete_menu">@lang('cpanel/menus.delete')</button>
                                            @endif
                                         @endif
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">@lang('cpanel/menus.not_found')</td>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {{ $menus_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_menu')}}" class="btn btn-info btn-fill pull-right">@lang('cpanel/menus.add_new_menu')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('finalscripts')
    <script>
        var delete_confirmation = '@lang('cpanel/menus.js_delete_confirmation')',
            delete_success = '@lang('cpanel/menus.js_delete')',
            error_message = '@lang('cpanel/menus.js_error')';
    </script>
    <script src="{{asset('admin')}}/js/menu.js"></script>
@endpush