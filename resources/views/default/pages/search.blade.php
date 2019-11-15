<?php
/**
 * Laravella CMS
 * File: search.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 15.11.2019
 */
?>
@extends(env('TEMPLATE_NAME').'/index')

@push('extrastyles')
    <link rel="stylesheet" href="{{asset('front/'.env('TEMPLATE_NAME').'/css/nice-select.css')}}">
@endpush

@section('content')
    <section class="top-section-area section-gap">
        <div class="container">
            <div class="row justify-content-center align-items-center d-flex">
                <div class="col-lg-8">
                    <form action="{{route('get_search_result')}}" method="POST">
                        @csrf
                        <div id="imaginary_container">
                            <div class="input-group stylish-input-group">
                                <input type="text" class="form-control" name="query" placeholder="Type keyword here and press ENTER" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Type keyword here and press ENTER '" required="">
                                <span class="input-group-addon">
                                <button type="submit">
                                    <span class="lnr lnr-magnifier"></span>
                                </button>
                            </span>
                            </div>
                        </div>
                        <div class="search-filter default-select" id="default-select">
                            <h4>Filter By: </h4>
                            <select style="display: none;" name="filter">
                                <option value="post">Post</option>
                                <option value="page">Page</option>
                                <option value="user">User</option>
                            </select>
                        </div>

                        @if(isset($searchData) && count($searchData) > 0)
                            @php
                                $results_word = $searchData['result']->total() >1 ? "results" : "result";
                            @endphp
                        <p class="mt-20 text-center text-white search-result-count">{{$searchData['result']->total()}} {{$results_word}} found for “{{$searchData['query']}}”</p>
                        @endif

                        {!! app('captcha')->render(); !!}
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="search_results pb-50 pt-50">
        <div class="container">
            <div class="row">
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
                    @if(isset($searchData) && $searchData['result']->total() > 0)
                        <h2>Results for: "{{$searchData['query']}}"</h2>
                        <div class="search-items-cover mt-30">
                            @foreach($searchData['result'] as $item)
                                <div class="single-list flex-row d-flex">
                                    <div class="search-item-detail">
                                        @if($searchData['type'] === "post")
                                            <a href="{{env('APP_URL').'posts/'.$item->slug}}"><h4 class="pb-20">{{$item->title}}</h4></a>
                                        @elseif($searchData['type'] === "page")
                                            <a href="{{env('APP_URL').$item->slug}}"><h4 class="pb-20">{{$item->title}}</h4></a>
                                        @elseif($searchData['type'] === "user")
                                            <a href="{{env('APP_URL').'users/'.$item->username}}"><h4 class="pb-20">{{$item->username}}</h4></a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @php
                            $links =  $searchData['result']->links();

                            $search_pagination_links = pretty_search_url($links,$searchData['type'], $searchData['query']);

                            echo $search_pagination_links;
                        @endphp
                    @elseif(isset($searchData) && $searchData['result']->total() === 0)
                        <h4>Nothing found</h4>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('extrascripts')
    <script src="{{asset('front/'.env('TEMPLATE_NAME').'/js/jquery.nice-select.min.js')}}"></script>
@endpush