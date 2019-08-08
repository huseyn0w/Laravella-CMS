<?php
/**
 * Laravella CMS
 * File: users.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 09.08.2019
 */
?>

@extends('cpanel.index')

@section('content')



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Users Table</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped users-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>username</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Surname</th>
                                    <th>Country</th>
                                    <th>City</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($users_count = 0)
                            @forelse($users_list as $user)
                                @php($users_count++)
                                <tr>
                                    <td>{{$users_count}}</td>
                                    <td>
                                        {{$user->username}}
                                        <span class="user_actions">
                                            <a href="{{route('cpanel_edit_user_profile', $user->id)}}">Edit</a>
                                            <button>Delete</button>
                                        </span>
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->surname}}</td>
                                    <td>{{$user->country}}</td>
                                    <td>{{$user->city}}</td>
                                </tr>
                            @empty
                                <td colspan="7">No users</td>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $users_list->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
