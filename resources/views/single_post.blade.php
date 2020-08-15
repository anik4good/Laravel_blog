@extends('layouts.frontend.app')
@section('tittle', 'Dashboard')

@push('css')
    <!------------------------Pages Custom CSS START------------------------------->

    <link href="{{asset('public/assets/frontend')}}/single-post-1/css/styles.css" rel="stylesheet">

    <link href="{{asset('public/assets/frontend')}}/single-post-1/css/responsive.css" rel="stylesheet">
    <style>
        .fav_post {
            color: blue;
        }
    </style>
    <!------------------------Pages Custom CSS END------------------------------->
@endpush

@section('content')
    <div class="slider">
        <div class="display-table  center-text">
            <h1 class="title display-table-cell"><b>@foreach($posts->categories as $categories)
                        {{$categories->name.(!$categories->count()  == 0 ? ',' : ' ')}}
                    @endforeach</b></h1>

        </div>
    </div><!-- slider -->

    <section class="post-area section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12 no-right-padding">

                    <div class="main-post">

                        <div class="blog-post-inner">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img
                                            src="{{ asset('/public/storage/profile')}}/{{$posts ->user->image }}"
                                            alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>{{$posts->user->name }}</b></a>
                                    <h6 class="date">on {{$posts->created_at->diffForHumans()}}</h6>
                                </div>

                            </div><!-- post-info -->

                            <h3 class="title"><a href="#"><b>{{$posts->tittle}}</b></a></h3>


                            <div class="post-image"><img src="{{ asset('/public/storage/post')}}/{{$posts->image }}"
                                                         alt="Blog Image"></div>

                            <p class="para">{!! $posts->body !!}</p>

                            <ul class="tags">
                                @foreach($posts->tags as $tag)
                                    <li><a href="{{ route('tag.post',$tag->slug) }}">{{$tag->name}}</a></li>
                                @endforeach
                            </ul>
                        </div><!-- blog-post-inner -->

                        <div class="post-icons-area">
                            <ul class="post-icons">

                                <li>
                                    @guest
                                        <a href="javascript:void(0);"
                                           onclick="toastr.error('you need to login first ');"><i
                                                class="ion-heart"></i>{{$posts->favourite_to_users->count()}}</a>
                                    @else
                                        <a onclick="document.getElementById('add-{{$posts->id}}').submit();"
                                           class="{{ !Auth::user()->favourite_posts->where('pivot.post_id',$posts->id)->count()  == 0 ? 'fav_post' : ''}}"
                                           href="javascript:void(0);"><i
                                                class="ion-heart"></i>{{$posts->favourite_to_users->count()}}</a>
                                        <form id="add-{{$posts->id}}"
                                              action="{{route('post.favourite.add',$posts->id)}}" method="POST"
                                              style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest

                                </li>
                                <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                <li><a href="#"><i class="ion-eye"></i>{{$posts->view_count}}</a></li>

                            </ul>

                            <ul class="icons">
                                <li>SHARE :</li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                            </ul>
                        </div>


                    </div><!-- main-post -->
                </div><!-- col-lg-8 col-md-12 -->

                <div class="col-lg-4 col-md-12 no-left-padding">

                    <div class="single-post info-area">

                        <div class="sidebar-area about-area">
                            <h4 class="title"><b>ABOUT {{$posts->user->name }}</b></h4>
                            <p>{{$posts->user->about }}</p>
                        </div>

                        <div class="sidebar-area subscribe-area">

                            <h4 class="title"><b>SUBSCRIBE</b></h4>
                            <div class="input-area">
                                <form method="post" action="{{route('admin.subscriber.store')}}">
                                    @csrf


                                    <input class="email-input" type="email" placeholder="Enter your email" name="email">
                                    <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i>
                                    </button>
                                </form>
                            </div>

                        </div><!-- subscribe-area -->

                        <div class="tag-area">

                            <h4 class="title"><b>CATEGORIES</b></h4>
                            <ul>
                                @foreach($posts->categories as $category)
                                    <li><a href="{{ route('category.post',$category->slug) }}">{{$category->name}}</a></li>
                                @endforeach
                            </ul>

                        </div><!-- subscribe-area -->

                    </div><!-- info-area -->

                </div><!-- col-lg-4 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section><!-- post-area -->


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($random_posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100">
                            <div class="single-post post-style-1">

                                <div class="blog-image"><img src="{{ asset('/public/storage/post')}}/{{$post->image }}"
                                                             alt="Blog Image"></div>

                                <a class="avatar" href="#"><img
                                        src="{{ asset('/public/storage/profile')}}/{{$post->user->image }}"
                                        alt="Profile Image"></a>

                                <div class="blog-info">
                                    <h6 class="pre-title"><a href="#"><b>@foreach($post->categories as $postcat)
                                                    {{$postcat->name}}
                                                @endforeach</b></a></h6>

                                    <h4 class="title"><a
                                            href="{{route('post.single',$post->slug)}}"><b>{{$post->tittle}}</b></a>
                                    </h4>


                                    <ul class="post-footer">
                                        <li>
                                            @guest
                                                <a href="javascript:void(0);"
                                                   onclick="toastr.error('you need to login first ');"><i
                                                        class="ion-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                            @else
                                                <a onclick="document.getElementById('add-{{$post->id}}').submit();"
                                                   class="{{ !Auth::user()->favourite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'fav_post' : ''}}"
                                                   href="javascript:void(0);"><i
                                                        class="ion-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                                <form id="add-{{$post->id}}"
                                                      action="{{route('post.favourite.add',$post->id)}}" method="POST"
                                                      style="display: none;">
                                                    @csrf
                                                </form>
                                            @endguest

                                        </li>
                                        <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                        <li><a href="#"><i class="ion-eye"></i>{{$post->view_count}}</a></li>
                                    </ul>

                                </div><!-- blog-info -->
                            </div><!-- single-post -->
                        </div><!-- card -->
                    </div><!-- col-md-6 col-sm-12 -->

                @endforeach
            </div><!-- row -->

        </div><!-- container -->
    </section>

    <section class="comment-section">
        <div class="container">

            <div class="row">

                <div class="col-lg-8 col-md-12">

                    @guest
                        <a class="more-comment-btn" href="{{route('login')}}"><b>login and comment</a>
                    @else
                        <h4><b>COMMENTS({{$posts->comments()->count()}})</b></h4>
                        <div class="comment-form">
                            <form method="post" action="{{route('post.comment.store',$posts->id)}}">
                                @csrf
                                <div class="row">

                                    <div class="col-sm-12">
									<textarea name="comment" rows="2" class="text-area-messge form-control"
                                              placeholder="Enter your comment" aria-required="true"
                                              aria-invalid="false"></textarea>
                                    </div><!-- col-sm-12 -->
                                    <div class="col-sm-12">
                                        <button class="submit-btn" type="submit" id="form-submit"><b>POST COMMENT</b>
                                        </button>
                                    </div><!-- col-sm-12 -->

                                </div><!-- row -->
                            </form>
                        </div><!-- comment-form -->
                        @foreach($comments as $comment)
                            <div class="commnets-area">

                                <div class="comment">

                                    <div class="post-info">

                                        <div class="left-area">
                                            <a class="avatar" href="#"><img
                                                    src="{{ asset('/public/storage/profile')}}/{{$comment->user->image }}"
                                                    alt="Profile Image"></a>
                                        </div>

                                        <div class="middle-area">
                                            <a class="name" href="#"><b>{{$comment->user->name}}</b></a>
                                            <h6 class="date">on {{$comment->created_at->diffForHumans()}}</h6>
                                        </div>

                                        <div class="right-area">
                                            <h5 class="reply-btn"><a href="#"><b>REPLY</b></a></h5>
                                        </div>

                                    </div><!-- post-info -->

                                    <p>{{$comment->comment}}</p>

                                </div>

                                {{--                        <div class="comment">--}}
                                {{--                            <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>--}}

                                {{--                            <div class="post-info">--}}

                                {{--                                <div class="left-area">--}}
                                {{--                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg"--}}
                                {{--                                                                    alt="Profile Image"></a>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="middle-area">--}}
                                {{--                                    <a class="name" href="#"><b>Katy Liu</b></a>--}}
                                {{--                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="right-area">--}}
                                {{--                                    <h5 class="reply-btn"><a href="#"><b>REPLY</b></a></h5>--}}
                                {{--                                </div>--}}

                                {{--                            </div><!-- post-info -->--}}

                                {{--                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt--}}
                                {{--                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur--}}
                                {{--                                Ut enim ad minim veniam</p>--}}

                                {{--                        </div>--}}

                            </div><!-- commnets-area -->
                        @endforeach
                    @endguest




                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>



@endsection

@push('js')
    <!------------------------Pages Custom Script START------------------------------->

    <!------------------------Pages Custom Script END------------------------------->
@endpush
