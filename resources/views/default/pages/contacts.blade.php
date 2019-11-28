<?php
/**
 * Laravella CMS
 * File: contacts.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 08.10.2019
 * Template Name: "Contact Page";
 */
?>


@php
    if(is_logged_in()):
        $firstname = \Auth::user()->name;
        $lastname = \Auth::user()->surname;
        $email = \Auth::user()->email;
    endif;
@endphp

@extends(env('TEMPLATE_NAME').'/index')

@section('content')

<section class="generic-banner relative">
    <!-- End Header Area -->
    <div class="container">
        <div class="row height align-items-center justify-content-center">
            <div class="col-lg-10">
                <div class="generic-banner-content">
                    <h1 class="text-white text-center">{{$data->title}}</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact-form">
    <div class="container">
        <div class="row pt-100 pb-100 align-items-center justify-content-center">
            <div class="col-md-12">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block mb-30">
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <h3>@lang('default/page.have_question')</h3>
                <form action="{{route('sendform')}}" method="post" class="contact_form">
                    @csrf
                @if(is_logged_in())
                    <input type="hidden" name="first_name" value="{{old('first_name', $firstname)}}">
                    <input type="hidden" name="last_name" value="{{old('last_name',$lastname)}}">
                    <input type="hidden" name="email" value="{{old('email',$email)}}">
                    <div class="row contact_row">
                        <div class="col-md-12">
                            <input type="text" name="subject" placeholder="@lang('default/page.subject')"  required="" class="single-input">
                        </div>
                    </div>
                @else
                    <div class="row contact_row">
                        <div class="col-12 col-md-6">
                            <input type="text" name="first_name" placeholder="@lang('default/page.first_name')" required="" class="single-input">
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="last_name" placeholder="@lang('default/page.last_name')"  required="" class="single-input">
                        </div>
                    </div>
                    <div class="row contact_row">
                        <div class="col-12 col-md-6">
                            <input type="email" name="email" placeholder="@lang('default/page.email')"  required="" class="single-input">
                        </div>
                        <div class="col-12 col-md-6">
                            <input type="text" name="subject" placeholder="@lang('default/page.subject')" required="" class="single-input">
                        </div>
                    </div>
                @endif
                    <div class="row contact_row">
                        <div class="col-12">
                            <textarea class="single-textarea" name="message" placeholder="@lang('default/page.message')"  required=""></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 button-group-area mt-40">
                            <button type="submit" class="genric-btn primary  arrow e-large">@lang('default/page.submit')<span class="lnr lnr-arrow-right"></span></button>
                        </div>
                        {!! app('captcha')->render(); !!}
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

