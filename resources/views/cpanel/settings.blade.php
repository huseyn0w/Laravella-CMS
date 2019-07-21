<?php
/**
 * Laravella CMS
 * File: settings.blade.php
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
                        <form>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Website name</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Tagline</label>
                                        <p>In a few words, explain what this site is about.</p>
                                        <textarea rows="4" cols="80" class="form-control" value=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Email</label>
                                        <input type="email" class="form-control" value="">
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="">
                                            <span class="form-check-sign"></span>
                                            Membership
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">State</label>
                                        @php

                                            $directories  = get_front_templates_array();

                                        @endphp
                                        <select id="inputState" class="form-control">
                                            @forelse($directories as $key => $value)
                                                <option>{{$value}}</option>
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