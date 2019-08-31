<?php
/**
 * Laravella CMS
 * File: media.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 23.08.2019
 */
?>

@extends('cpanel.index')
@push('extrastyles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.0/min/dropzone.min.css">
@endpush

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Media</h4>
                    </div>
                    <div class="card-body">
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
                                        <strong>Pages has been deleted</strong>
                                    </div>
                                @else
                                    <div class="alert alert-danger">
                                        <strong>Some problem has been occured. Please try again later.</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                        @if ($update_message = Session::get('page_added'))
                            <div class="col-12">
                                @if ($update_message)
                                    <div class="alert alert-success">
                                        <strong>Media has been created successfully</strong>
                                    </div>
                                @endif
                            </div>
                        @endif
                            <iframe src="/filemanager" style="width: 100%; height: 500px; overflow: hidden; border: none;"></iframe>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('extrascripts')
    <script src="{{base_path('vendor')}}/laravel-filemanager/js/stand-alone-button.js"></script>
@endpush