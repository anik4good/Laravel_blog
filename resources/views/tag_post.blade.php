@extends('layouts.frontend.app')
@section('tittle', 'Tag_Posts')

@push('css')
    <!------------------------Pages Custom CSS START------------------------------->

    <link href="{{asset('public/assets/frontend')}}/category/css/styles.css" rel="stylesheet">

    <link href="{{asset('public/assets/frontend')}}/category/css/responsive.css" rel="stylesheet">
    <style>
        .fav_post {
            color: blue;
        }


    </style>
    <!------------------------Pages Custom CSS END------------------------------->
@endpush

@section('content')
    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>{{ $tag->name }}</b></h1>
    </div><!-- slider -->
    <section class="blog-area section">
        <div class="container">

            <div class="row">

                @if ($tag->posts->count()>0)
                @foreach($posts as $post)
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

                                <h4 class="title"><a href="{{route('post.single',$post->slug)}}"><b>{{$post->tittle}}</b></a></h4>


                                <ul class="post-footer">
                                    <li>
                                        @guest
                                            <a href="javascript:void(0);" onclick="toastr.error('you need to login first ');"><i class="ion-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                        @else
                                            <a onclick="document.getElementById('add-{{$post->id}}').submit();" class="{{ !Auth::user()->favourite_posts->where('pivot.post_id',$post->id)->count()  == 0 ? 'fav_post' : ''}}" href="javascript:void(0);" ><i class="ion-heart"></i>{{$post->favourite_to_users->count()}}</a>
                                            <form id="add-{{$post->id}}" action="{{route('post.favourite.add',$post->id)}}" method="POST" style="display: none;">
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
                </div><!-- col-lg-4 col-md-6 -->

            @endforeach()
                    @else
                    <h1 class="text-danger center">There is no post!</h1>

                @endif



            </div><!-- row -->


        </div><!-- container -->
    </section><!-- section -->








@endsection

@push('js')
    <!------------------------Pages Custom Script START------------------------------->

    <!------------------------Pages Custom Script END------------------------------->
@endpush
