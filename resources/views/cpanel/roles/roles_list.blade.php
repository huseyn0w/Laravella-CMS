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
                        <h4 class="card-title">Roles</h4>
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
                                        <strong>Users has been deleted</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('role_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Role has been added successfully</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <table class="table table-hover table-striped users-table">
                            <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Role</th>
                                    <th>Action</th>
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
                                                <a href="{{route('cpanel_edit_user_role', $role->id)}}" target="_blank">Edit</a>
                                                @if($role->id !== 1 && $role->id !== 2)
                                                <input type="hidden" class="deleted_role_id" value="{{$role->id}}" name="deleted_role_id">
                                                <button type="button" class="delete_role">Delete</button>
                                                @endif
                                         @endif
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">No roles</td>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="col-md-12">
                            {{ $roles_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_user_role')}}" class="btn btn-info btn-fill pull-right">Add new role</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
