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

    $category_title = $data->categories[0]->title;
    $category_slug = $data->categories[0]->slug;

    $author = $data->author->name .' '.$data->author->surname;

    $post_liked = check_if_post_liked_by_current_user($data->id);

    $post_comments_count = count($data->comments);

    if(is_logged_in()) $user_id = \Auth()->user()->id;

    $current_lang = get_current_lang_prefix();



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
                    <li><a href="{{env('APP_URL').'/'.$current_lang.'category/'.$category_slug}}">{{$category_title}}</a><span class="lnr lnr-arrow-right"></span></li>
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
                                        <h2><a href="{{route('show_user',['username' => $data->author->username])}}">{{$author}}</a></h2>
                                        <h3>{{Carbon\Carbon::parse($data->updated_at)->format('d.m.Y')}}</h3>
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
                                <div class="col-lg-6 single-b-wrap col-md-12">
                                @if(is_logged_in())
                                    <span id="like_post">
                                        @if($post_liked)
                                            @lang('default/post.dislike')
                                        @else
                                            @lang('default/post.like')
                                        @endif
                                    </span>
                                @endif

                                <div id="like_count_cover" data-likes="{{$data->likes}}">
                                    @if($post_liked)
                                        @if($data->likes > 1)
                                            <span id="post-like-content">@lang('default/post.you_and_multiple_like_pre') <span id="post-like-count">{{$data->likes - 1}}</span> @lang('default/post.you_and_multiple_like_after')</span>
                                        @else
                                            <span id="post-like-content">@lang('default/post.you_only_liked')</span>
                                        @endif
                                    @else
                                        @if($data->likes > 0)
                                            <span id="post-like-content"> <span id="post-like-count">{{$data->likes}}</span> @lang('default/post.multiple_like_after')</span>
                                        @else
                                            <span id="post-like-content">@lang('default/post.nobody_likes')</span>
                                        @endif
                                    @endif
                                </div>

                                </div>
                                <div class="col-lg-6 single-b-wrap col-md-12">
                                    <div class="addthis_inline_share_toolbox"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Start comment-sec Area -->
                        <section class="comment-sec-area pt-80 pb-80">
                            <div class="container">
                                <div class="row flex-column">
                                    <h5 class="text-uppercase pb-80">{{$post_comments_count}} @lang('default/post.comments')</h5>
                                    <br>
                            @if($post_comments_count > 0)
                                @foreach($data->comments as $comment)
                                    <div class="comment-list">
                                        <div class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb comment-author-thumbnail">
                                                    @if(!empty($comment->user->avatar))
                                                    <img src="{{$comment->user->avatar}}" alt="{{$comment->user->name}}">
                                                    @else
                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME').'/img/noavatar.jpg')}}" alt="{{$comment->user->name}}">
                                                    @endif
                                                </div>
                                                <div class="desc">
                                                    <h5><a href="{{route('show_user',['username' => $comment->user->username])}}">{{$comment->user->name}}</a></h5>
                                                    <p class="date">{{$comment->created_at->format('d.m.Y')}}</p>
                                                    <p class="comment">
                                                        {{$comment->comment}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="reply-btn comment-buttons">
                                                @if(is_logged_in() && $user_id !== $comment->user->id)
                                                    <button data-comment_id="{{$comment->id}}" data-username="{{$comment->user->name}}" class="btn-reply reply-to-comment text-uppercase">@lang('default/post.reply')</button>
                                                @endif
                                                @if(is_logged_in() && $comment->user->id === $user_id)
                                                    <button data-comment_id="{{$comment->id}}" data-toggle="modal" data-author="{{$comment->user->id}}" data-target="#editCommentModal" data-comment="{{$comment->comment}}" class="btn-reply edit-comment text-uppercase">@lang('default/post.edit')</button>
                                                @endif
                                                @if( (is_logged_in() && \Auth()->user()->role->id == 1) || (is_logged_in() && $comment->user->id === $user_id) )
                                                    <button data-comment_id="{{$comment->id}}" data-username="{{$comment->user->name}}" class="btn-reply delete-comment text-uppercase">@lang('default/post.delete')</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($comment->replies) > 0)
                                        <div class="comment-replies">
                                            @foreach($comment->replies as $child_comment)
                                                <div class="comment-list left-padding">
                                                    <div class="single-comment justify-content-between d-flex">
                                                        <div class="user justify-content-between d-flex">
                                                            <div class="thumb comment-author-thumbnail">
                                                                @if(!empty($child_comment->user->avatar))
                                                                    <img src="{{$child_comment->user->avatar}}" alt="{{$comment->user->name}}">
                                                                @else
                                                                    <img src="{{asset('front/'.env('TEMPLATE_NAME').'/img/noavatar.jpg')}}" alt="{{$child_comment->user->name}}">
                                                                @endif
                                                            </div>
                                                            <div class="desc">
                                                                <h5><a href="{{route('show_user',['username' => $child_comment->user->username])}}">{{$child_comment->user->name}}</a></h5>
                                                                <p class="date">{{$child_comment->created_at->format('d.m.Y')}}</p>
                                                                <p class="comment">
                                                                    {{$child_comment->comment}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="reply-btn comment-buttons">
                                                            @if(is_logged_in() && $user_id !== $child_comment->user->id)
                                                                <button data-comment_id="{{$comment->id}}" data-username="{{$child_comment->user->name}}" class="btn-reply reply-to-comment text-uppercase">@lang('default/post.reply')</button>
                                                            @endif
                                                            @if(is_logged_in() && $child_comment->user->id === $user_id)
                                                                <button data-comment_id="{{$child_comment->id}}" data-author="{{$child_comment->user->id}}" data-toggle="modal" data-comment="{{$child_comment->comment}}" data-target="#editCommentModal" class="btn-reply edit-comment text-uppercase">@lang('default/post.edit')</button>
                                                            @endif
                                                            @if( (is_logged_in() && \Auth()->user()->role->id == 1) || (is_logged_in() && $child_comment->user_id === $user_id) )
                                                                <button data-comment_id="{{$child_comment->id}}" data-username="{{$child_comment->user->username}}" class="btn-reply delete-comment text-uppercase">@lang('default/post.delete')</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                                {{ $data->comments->links() }}
                            @else
                                    <h3>@lang('default/post.no_comments')</h3>
                            @endif
                                </div>
                            </div>
                        </section>
                        <!-- End comment-sec Area -->



                        <!-- Start commentform Area -->
                        <section class="commentform-area  pb-120 pt-80 mb-100" id="comment-area">
                            <div class="container">
                            @auth
                                <h5 class="text-uppercas pb-50">@lang('default/post.leave_reply')</h5>
                                <form action="{{route('store_post_comments', ['id' => $data->id])}}" method="POST">
                                    @csrf
                                    <div class="row flex-row d-flex">
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
                                        @if ($update_message = Session::get('comment_added'))
                                            <div class="col-12">
                                                <div class="alert alert-success">
                                                @if (Auth::user()->can('manage_comments', 'App\Http\Models\UserRoles'))
                                                    <strong>@lang('default/post.comment_added')</strong>
                                                @else
                                                    <strong>@lang('default/post.comment_send_to_approve')</strong>
                                                @endif
                                                </div>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <textarea id="comment-field" class="form-control mb-10" name="comment" rows="10" placeholder="@lang('default/post.comment')"  required=""></textarea>
                                        </div>
                                    </div>
                                    <input type="hidden" name="parent_id" id="comment_parent_id" value="">
                                    <input type="hidden" name="post_id" value="{{$data->id}}">
                                    {!! app('captcha')->render(); !!}
                                    <button type="submit" class="primary-btn mt-20">@lang('default/post.comment')</button>
                                </form>
                            @else
                                <h5 class="text-uppercas pb-50">@lang('default/post.comment_auth')/h5>
                            @endauth
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


@auth
    @include('default.posts.modal')
@endauth

@endsection

@auth
    @push('extrascripts')
        <script>
        var handle_url_likes = "<?php echo route('handle_post_likes', ['id' => $data->id]) ?>",
            handle_url_comments = "<?php echo route('delete_post_comments', ['id' => $data->id]) ?>",
            post_id = "<?php echo $data->id ?>",
            user_id = "<?php echo \Auth::user()->id ?>",
            you_only_liked = '@lang("default/post.you_only_liked")',
            nobody_likes = '@lang("default/post.nobody_likes")',
            dislike_post = '@lang("default/post.dislike")',
            like_post = '@lang("default/post.like")',
            you_and = '@lang("default/post.you_and_multiple_like_pre")',
            like_added = '@lang("default/post.like_added")',
            like_deleted = '@lang("default/post.like_deleted")',
            _token = '{{ csrf_token() }}';
        </script>
        <script src="{{asset('front')}}/default/js/like.js"></script>
        <script src="{{asset('front')}}/default/js/comment.js"></script>
        <!-- Go to www.addthis.com/dashboard to customize your tools -->
    @endpush
@endauth
@push('extrascripts')
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5dc82ec69733ae4e"></script>
@endpush