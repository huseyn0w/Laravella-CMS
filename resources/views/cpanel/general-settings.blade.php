<?php
/**
 * Laravella CMS
 * File: general-settings.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 21.07.2019
 */
?>

@extends('cpanel.index')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Website settings</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('cpanel_update_general_settings') }}" method="POST">
                            @csrf
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
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Website name</label>
                                        <input type="text" name="website_name" class="form-control" value="{{ old('website_name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Tagline</label>
                                        <p>In a few words, explain what this site is about.</p>
                                        <textarea rows="4" cols="80" name="tagline" class="form-control" value="{{ old('tagline') }}"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Email</label>
                                        <input type="email" name="contact_email" class="form-control" value="{{ old('contact_email') }}">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" name="membership" type="checkbox">
                                            <span class="form-check-sign"></span>
                                            Membership
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">State</label>
                                        @php

                                            $directories  = get_front_templates_array();

                                        @endphp
                                        <select id="inputState" name="active_template" class="form-control">
                                            @forelse($directories as $key => $value)
                                                @if($value === env('TEMPLATE_NAME'))
                                                    <option value="{{$value}}" selected="selected">{{$value}}</option>
                                                @else
                                                    <option value="{{$value}}">{{$value}}</option>
                                                @endif
                                            @empty
                                                <p>No templates</p>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Settings</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection