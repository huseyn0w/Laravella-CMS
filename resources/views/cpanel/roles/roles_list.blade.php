<?php
/**
 * Laravella CMS
 * File: users_list.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
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
                        <h4 class="card-title">@lang('cpanel/roles.list_headline')</h4>
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
                        @if ($update_message = Session::get('role_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/roles.role_added')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <table class="table table-hover table-striped users-table">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>@lang('cpanel/roles.table_name')</th>
                                    <th>@lang('cpanel/roles.table_action')</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($roles_count = 0)
                            @forelse($roles_list as $role)
                                @php($roles_count++)
                                <tr>
                                    <td>
                                        {{$roles_count}}
                                    </td>
                                    <td>
                                        {{$role->name}}
                                    </td>
                                    <td>
                                        <span class="user_actions">
                                         @if (Auth::user()->can('manage_user_roles', 'App\Http\Models\UserRoles'))
                                                <a href="{{route('cpanel_edit_user_role', $role->id)}}" target="_blank">@lang('cpanel/roles.edit')</a>
                                                @if($role->id !== 1 && $role->id !== 2)
                                                <input type="hidden" class="deleted_role_id" value="{{$role->id}}" name="deleted_role_id">
                                                <button type="button" class="delete_role">@lang('cpanel/roles.delete')</button>
                                                @endif
                                         @endif
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">@lang('cpanel/roles.not_found')</td>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {{ $roles_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_user_role')}}" class="btn btn-info btn-fill pull-right">@lang('cpanel/roles.add_new_role')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('finalscripts')
    <script>
        var delete_confirmation = '@lang('cpanel/roles.js_delete_confirmation')',
            delete_success = '@lang('cpanel/roles.js_delete')',
            error_message = '@lang('cpanel/roles.js_error')';
    </script>
    <script src="{{asset('admin')}}/js/role.js"></script>
@endpush