<?php
/**
 * Laravella CMS
 * File: edit_role.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 11.08.2019
 */
?>

@extends('cpanel.core.index')

@section('content')

    @php

        $user_roles = get_user_roles();
        $countries = get_countries_array();
        $role_all_permissions = get_user_role_permissions();
        $user_permissions = json_decode($role->permissions, true);



    @endphp

    <form action="{{ route('cpanel_update_user_role',['id' => $role->id]) }}" method="POST">
        @csrf
        @method('PUT')
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
            @if ($update_message = Session::get('message'))
                <div class="col-12">
                    @if ($update_message)
                        <div class="alert alert-success">
                            <strong>@lang('cpanel/roles.role_updated')</strong>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <strong>@lang('cpanel/roles.role_error')</strong>
                        </div>
                    @endif
                </div>
            @endif
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">@lang('cpanel/roles.edit_role_headline')</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">@lang('cpanel/roles.role_name')</label>
                                    <input type="text" id="name" required class="form-control" name="name" value="{{ old('name', $role->name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($role_all_permissions as $permission)
                                @php($permission_name = str_replace('_', " ", $permission->name))
                                <div class="col-12 col-md-4">
                                    <div class="form-check">
                                        <label for="{{$permission->name}}" class="form-check-label form-checkbox">
                                            @if($user_permissions[$permission->name] === 1)
                                                <input class="form-check-input" id="{{$permission->name}}" name="permissions[]" value="{{$permission->name}}" checked="checked" type="checkbox" >
                                            @else
                                            <input class="form-check-input" id="{{$permission->name}}" name="permissions[]" value="{{$permission->name}}" type="checkbox" >
                                            @endif
                                            <span class="form-check-sign">{{$permission_name}}</span>
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">@lang('cpanel/roles.update_role')</button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection

@push('finalscripts')
    <script src="{{asset('admin')}}/js/role.js"></script>
@endpush