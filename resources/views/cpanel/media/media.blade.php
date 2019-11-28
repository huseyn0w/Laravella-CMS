<?php
/**
 * Laravella CMS
 * File: media.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 23.08.2019
 */
?>

@extends('cpanel.core.index')
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
                        <h4 class="card-title">@lang('cpanel/media.headline')</h4>
                    </div>
                    <div class="card-body">
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