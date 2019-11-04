<?php
/**
 * Laravella CMS
 * File: post.blade.php
 * Created by Elman (https://linkedin.com/in/huseyn0w)
 * Date: 30.10.2019
 * Template Name: "Standart";
 */
?>

@php
    $home_page_data = get_data(1, 'page', ['slug', 'title']);

    $category_title = $data->categories[0]->title;
    $category_slug = $data->categories[0]->slug;

    $author = $data->author->name .' '.$data->author->surname;

    $post_liked = check_if_post_liked_by_current_user($data->id);

@endphp

@extends(env('TEMPLATE_NAME').'/index')

@section('content')

<section class="top-section-area section-gap">
    <div class="container">
        <div class="row justify-content-between align-items-center d-flex">
            <div class="col-lg-8 top-left">
                <h1 class="text-white mb-20">{{$data->title}}</h1>
                <ul class="breadcrumbs">
                    <li><a href="{{env('APP_URL')}}">{{$home_page_data->title}}</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><a href="{{env('APP_URL').'category/'.$category_slug}}">{{$category_title}}</a><span class="lnr lnr-arrow-right"></span></li>
                    <li><span>{{$data->title}}</span></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<div class="post-wrapper pt-100">
    <!-- Start post Area -->
    <section class="post-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="single-page-post">
                        @if(!empty($data->thumbnail))
                        <div class="post-thumbnail">
                            <img class="img-fluid" src="{{$data->thumbnail}}" alt="{{$data->title}}">
                        </div>
                        @endif
                        <div class="top-wrapper ">
                            <div class="row d-flex justify-content-between">
                                <h2 class="col-lg-8 col-md-12 text-uppercase">
                                    {{$data->title}}
                                </h2>
                                <div class="col-lg-4 col-md-12 right-side d-flex justify-content-end">
                                    <div class="desc">
                                        <h2>{{$author}}</h2>
                                        <h3>{{$data->created_at->format('d.m.Y')}}</h3>
                                    </div>
                                    <div class="user-img">
                                        <img src="{{$data->author->avatar}}" alt="{{$author}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="single-post-content">
                            {!! $data->content !!}
                        </div>
                        <div class="bottom-wrapper {{$post_liked ? 'post_liked': null}}">
                            <div class="row">
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                @if(is_logged_in())
                                    <span id="like_post">
                                        @if($post_liked)
                                            Dislike
                                        @else
                                            Like
                                        @endif
                                    </span>
                                @endif
                                <div id="like_count_cover" data-likes="{{$data->likes}}">
                                    @if($post_liked)
                                        @if($data->likes > 1)
                                            <span id="post-like-content"> You and <span id="post-like-count">{{$data->likes - 1}}</span> people like this</span>
                                        @else
                                            <span id="post-like-content">You liked this post</span>
                                        @endif
                                    @else
                                        @if($data->likes > 0)
                                            <span id="post-like-content"> <span id="post-like-count">{{$data->likes}}</span> people like this</span>
                                        @else
                                            <span id="post-like-content">Nobody likes this post yet</span>
                                        @endif
                                    @endif
                                </div>
                                </div>
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                    <i class="fa fa-comment-o" aria-hidden="true"></i> 06 comments
                                </div>
                                <div class="col-lg-4 single-b-wrap col-md-12">
                                    <ul class="social-icons">
                                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Start comment-sec Area -->
                        <section class="comment-sec-area pt-80 pb-80">
                            <div class="container">
                                <div class="row flex-column">
                                    <h5 class="text-uppercase pb-80">05 Comments</h5>
                                    <br>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME'))}}/img/asset/c1.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list left-padding">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME'))}}/img/asset/c2.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list left-padding">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME'))}}/img/asset/c3.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME'))}}/img/asset/c4.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb">
                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME'))}}/img/asset/c5.jpg" alt="">
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="#">Emilly Blunt</a></h5>
                                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                                    <p class="comment">
                                                        Never say goodbye till the end comes!
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End comment-sec Area -->

                        <!-- Start commentform Area -->
                        <section class="commentform-area  pb-120 pt-80 mb-100">
                            <div class="container">
                                <h5 class="text-uppercas pb-50">Leave a Reply</h5>
                                <div class="row flex-row d-flex">
                                    <div class="col-lg-6">
                                        <input name="name" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" class="common-input mb-20 form-control" required="" type="text">
                                        <input name="email" placeholder="Enter your email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your email'" class="common-input mb-20 form-control" required="" type="email">
                                        <input name="Subject" placeholder="Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your Subject'" class="common-input mb-20 form-control" required="" type="text">

                                    </div>
                                    <div class="col-lg-6">
                                        <textarea class="form-control mb-10" name="message" placeholder="Messege" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required=""></textarea>
                                        <a class="primary-btn mt-20" href="#">Comment</a>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- End commentform Area -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End post Area -->
</div>

@endsection

@push('extrascripts')
    <script>
        var handle_url = "<?php echo route('handle_post_likes', ['id' => $data->id]) ?>",
            post_id = "<?php echo $data->id ?>",
            user_id = "<?php echo \Auth::user()->id ?>",
            _token = '{{ csrf_token() }}';
    </script>
    <script src="{{asset('front')}}/default/js/like.js"></script>
@endpush
