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
                        <h4 class="card-title">@lang('cpanel/users.list_headline')</h4>
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
                                        <strong>@lang('cpanel/users.bulky_deleted_message')</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>@lang('cpanel/users.bulky_deleted_error_message')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('user_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>@lang('cpanel/users.user_added')</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <form method="POST" action="{{route('cpanel_users_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="users_action" required="" class="form-control">
                                    <option selected="selected">@lang('cpanel/users.bulk_action_label')</option>
                                    <option value="delete">@lang('cpanel/users.bulk_action_delete_label')</option>
                                </select>
                                <button type="submit" class="btn btn-info btn-fill">@lang('cpanel/users.bulk_action_apply')</button>
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
                                        <th>@lang('cpanel/users.table_username')</th>
                                        <th>@lang('cpanel/users.table_email')</th>
                                        <th>@lang('cpanel/users.table_name')</th>
                                        <th>@lang('cpanel/users.table_surname')</th>
                                        <th>@lang('cpanel/users.table_country')</th>
                                        <th>@lang('cpanel/users.table_city')</th>
                                        <th>@lang('cpanel/users.table_role')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php($users_count = 0)
                                @forelse($users_list as $user)
                                    @php($users_count++)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <label for="user_{{$user->id}}" class="form-check-label form-checkbox">
                                                    <input class="form-check-input users-checkbox-input" id="user_{{$user->id}}" name="users[]" type="checkbox" value="{{$user->id}}" >
                                                    <span class="form-check-sign"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{$users_count}}</td>
                                        <td>
                                            {{$user->username}}

                                            <span class="user_actions">
                                             @if (Auth::user()->can('manage_users', 'App\Http\Models\UserRoles'))
                                                <a href="{{route('cpanel_edit_user_profile', $user->id)}}" target="_blank">@lang('cpanel/users.edit_user')</a>
                                                <input type="hidden" class="deleted_user_id" value="{{$user->id}}" name="deleted_user_id">
                                                <button type="button" class="delete_user">@lang('cpanel/users.delete_user')</button>
                                             @endif
                                            </span>

                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->surname}}</td>
                                        <td>{{$user->country}}</td>
                                        <td>{{$user->city}}</td>
                                        <td>{{$user->role->name}}</td>
                                    </tr>
                                @empty
                                    <td colspan="7">@lang('cpanel/users.not_found')</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $users_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_user')}}" class="btn btn-info btn-fill pull-right">@lang('cpanel/users.add_new_user')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('finalscripts')
    <script>
        var delete_confirmation = '@lang('cpanel/users.js_delete_confirmation')',
            delete_success = '@lang('cpanel/users.js_delete_success')',
            delete_error = '@lang('cpanel/users.js_delete_error')';
    </script>
    <script src="{{asset('admin')}}/js/user.js"></script>
@endpush
