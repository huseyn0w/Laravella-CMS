<?php
/**
 * Laravella CMS
 * File: new_role.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 11.08.2019
 */
?>

@extends('cpanel.core.index')

@section('content')

    @php

        $user_roles = get_user_roles();
        $countries = get_countries_array();
        $role_permissions = get_user_role_permissions();

    @endphp

    <form action="{{ route('cpanel_save_user_role') }}" method="POST">
        @csrf
    <div class="container-fluid">
        <div class="row">
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add new Role</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" required class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($role_permissions as $permission)
                                @php($permission_name = str_replace('_', " ", $permission->name))
                                <div class="col-12 col-md-4">
                                    <div class="form-check">
                                        <label for="{{$permission->name}}" class="form-check-label form-checkbox">
                                            <input class="form-check-input" id="{{$permission->name}}" name="permissions[]" value="{{$permission->name}}" type="checkbox" >
                                            <span class="form-check-sign">{{$permission_name}}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Add New Role</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection

@push('extrascripts')
<script src="{{asset('admin')}}/js/userprofile.js"></script>
@endpush