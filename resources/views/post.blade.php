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
    @foreach($posts as $row)
        <div class="slider">
            <div class="display-table  center-text">
                <h1 class="title display-table-cell"><b>@foreach($row->categories as $postcat)
                            {{$postcat->name.(!$postcat->count()  == 0 ? ',' : ' ')}}
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
                                                src="{{ asset('/public/storage/profile')}}/{{$row->user->image }}"
                                                alt="Profile Image"></a>
                                    </div>

                                    <div class="middle-area">
                                        <a class="name" href="#"><b>{{$row->user->name }}</b></a>
                                        <h6 class="date">on {{$row->created_at->diffForHumans()}}</h6>
                                    </div>

                                </div><!-- post-info -->

                                <h3 class="title"><a href="#"><b>{{$row->tittle}}</b></a></h3>


                                <div class="post-image"><img src="{{ asset('/public/storage/post')}}/{{$row->image }}"
                                                             alt="Blog Image"></div>

                                <p class="para">{!! $row->body !!}</p>

                                <ul class="tags">
                                    @foreach($row->tags as $tag)
                                        <li><a href="#">{{$tag->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div><!-- blog-post-inner -->

                            <div class="post-icons-area">
                                <ul class="post-icons">

                                    <li>
                                        @guest
                                            <a href="javascript:void(0);"
                                               onclick="toastr.error('you need to login first ');"><i
                                                    class="ion-heart"></i>{{$row->favourite_to_users->count()}}</a>
                                        @else
                                            <a onclick="document.getElementById('add-{{$row->id}}').submit();"
                                               class="{{ !Auth::user()->favourite_posts->where('pivot.post_id',$row->id)->count()  == 0 ? 'fav_post' : ''}}"
                                               href="javascript:void(0);"><i
                                                    class="ion-heart"></i>{{$row->favourite_to_users->count()}}</a>
                                            <form id="add-{{$row->id}}"
                                                  action="{{route('post.favourite.add',$row->id)}}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        @endguest

                                    </li>
                                    <li><a href="#"><i class="ion-chatbubble"></i>6</a></li>
                                    <li><a href="#"><i class="ion-eye"></i>{{$row->view_count}}</a></li>

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
                                <h4 class="title"><b>ABOUT {{$row->user->name }}</b></h4>
                                <p>{{$row->user->about }}</p>
                            </div>

                            <div class="sidebar-area subscribe-area">

                                <h4 class="title"><b>SUBSCRIBE</b></h4>
                                <div class="input-area">
                                    <form method="post" action="{{route('admin.subscriber.store')}}">
                                        @csrf


                                        <input class="email-input" type="email" placeholder="Enter your email" name="email">
                                        <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                                    </form>
                                </div>

                            </div><!-- subscribe-area -->

                            <div class="tag-area">

                                <h4 class="title"><b>CATEGORIES</b></h4>
                                <ul>
                                    @foreach($row->categories as $category)
                                        <li><a href="#">{{$category->name}}</a></li>
                                    @endforeach
                                </ul>

                            </div><!-- subscribe-area -->

                        </div><!-- info-area -->

                    </div><!-- col-lg-4 col-md-12 -->

                </div><!-- row -->

            </div><!-- container -->
        </section><!-- post-area -->

    @endforeach


    <section class="recomended-area section">
        <div class="container">
            <div class="row">
                @foreach($allposts as $post)
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
            <h4><b>POST COMMENT</b></h4>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="comment-form">
                        <form method="post">
                            <div class="row">

                                <div class="col-sm-6">
                                    <input type="text" aria-required="true" name="contact-form-name"
                                           class="form-control"
                                           placeholder="Enter your name" aria-invalid="true" required>
                                </div><!-- col-sm-6 -->
                                <div class="col-sm-6">
                                    <input type="email" aria-required="true" name="contact-form-email"
                                           class="form-control"
                                           placeholder="Enter your email" aria-invalid="true" required>
                                </div><!-- col-sm-6 -->

                                <div class="col-sm-12">
									<textarea name="contact-form-message" rows="2" class="text-area-messge form-control"
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

                    <h4><b>COMMENTS(12)</b></h4>

                    <div class="commnets-area">

                        <div class="comment">

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg"
                                                                    alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn"><a href="#"><b>REPLY</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>

                        </div>

                        <div class="comment">
                            <h5 class="reply-for">Reply for <a href="#"><b>Katy Lui</b></a></h5>

                            <div class="post-info">

                                <div class="left-area">
                                    <a class="avatar" href="#"><img src="images/avatar-1-120x120.jpg"
                                                                    alt="Profile Image"></a>
                                </div>

                                <div class="middle-area">
                                    <a class="name" href="#"><b>Katy Liu</b></a>
                                    <h6 class="date">on Sep 29, 2017 at 9:48 am</h6>
                                </div>

                                <div class="right-area">
                                    <h5 class="reply-btn"><a href="#"><b>REPLY</b></a></h5>
                                </div>

                            </div><!-- post-info -->

                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur
                                Ut enim ad minim veniam</p>

                        </div>

                    </div><!-- commnets-area -->


                    <a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>

                </div><!-- col-lg-8 col-md-12 -->

            </div><!-- row -->

        </div><!-- container -->
    </section>



@endsection

@push('js')
    <!------------------------Pages Custom Script START------------------------------->

    <!------------------------Pages Custom Script END------------------------------->
@endpush
