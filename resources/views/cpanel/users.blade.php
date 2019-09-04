<?php
/**
 * Laravella CMS
 * File: users.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
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
                        <h4 class="card-title">Users Table</h4>
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
                        @if ($update_message = Session::get('user_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>User has been added.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <form method="POST" action="{{route('cpanel_users_bulk_delete')}}">
                            @csrf
                            @method('DELETE')
                            <div class="select-cover">
                                <select id="inputState" name="users_action" required="" class="form-control">
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
                                                   <input class="form-check-input" id="selectAll" name="allusers" type="checkbox" >
                                                   <span class="form-check-sign"></span>
                                               </label>
                                           </div>
                                        </th>
                                        <th>№</th>
                                        <th>username</th>
                                        <th>Email</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Country</th>
                                        <th>City</th>
                                        <th>Role</th>
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
                                             @if (Auth::user()->can('manage_users', 'App\User'))
                                                <a href="{{route('cpanel_edit_user_profile', $user->id)}}" target="_blank">Edit</a>
                                                <input type="hidden" class="deleted_user_id" value="{{$user->id}}" name="deleted_user_id">
                                                <button type="button" class="delete_user">Delete</button>
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
                                    <td colspan="7">No users</td>
                                @endforelse
                                </tbody>
                            </table>
                        </form>
                        <div class="col-md-12">
                            {{ $users_list->links() }}
                        </div>
                        <div class="col-md-12">
                            <a href="{{route('cpanel_add_new_user')}}" class="btn btn-info btn-fill pull-right">Add new user</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
