@extends('partials.post.layout')
@section('content')
    <!-- post status start -->
    <div class="card">
        <!-- post title start -->
        <div class="post-title d-flex align-items-center">
            <!-- profile picture end -->
            <div class="profile-thumb">
                <a href="#">
                    <figure class="profile-thumb-middle">
                        <img src="{{ $post->post_author->avatar_src }}" alt="profile picture">
                    </figure>
                </a>
            </div>
            <!-- profile picture end -->

            <div class="posted-author">
                <h1 class="">{{ $post->title }}</h1>
                <span class="post-time"><a href="">{{ $post->post_author!=null?$post->post_author->name:'' }} {{ $post->post_author!=null?$post->post_author->last_name:'' }}</a></span>
                <span class="post-time">
                {{$post->created_at->diffForHumans()}}
            </span>
            </div>

        </div>
        <!-- post title start -->
        <div class="post-content">
            @if($post->typePost=='video')
                <div class="video">
                    <div class="youtube_player" id="player_{{ $post->id }}" data-code="{{ $post->video_code }}"></div>
                </div>
            @else
                @if(count($post->images)>0)
                    @if(count($post->images)==1)
                        @foreach($post->images as $image)
                            <figure class="post-thumb img-popup">
                                <a href="{{ asset('storage/u_images/'.$image->url) }}">
                                    <img class="fit-cover"  src="{{ asset('storage/u_images/'.$image->url) }}" alt="{{$post->title}}">
                                </a>
                            </figure>
                        @endforeach
                    @endif
                    @if(count($post->images)==2)
                        <div class="post-thumb-gallery img-gallery">
                            <div class="row no-gutters">
                                @foreach($post->images as $key => $image)
                                    <div class="col-6">
                                        <figure class="post-thumb" style="height: 100%">
                                            <a class="gallery-selector" href="{{ asset('storage/u_images/'.$image->url) }}">
                                                <img class="fit-cover"  src="{{ asset('storage/u_images/'.$image->url) }}" alt="{{$post->title}}">
                                            </a>
                                        </figure>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if(count($post->images)>=3)
                        <div class="post-thumb-gallery img-gallery">
                            <div class="row no-gutters">
                                @foreach($post->images as $key => $image)
                                    <div class="col-8">
                                        <figure class="post-thumb" style="height: 100%">
                                            <a class="gallery-selector" href="{{ asset('storage/u_images/'.$image->url) }}">
                                                <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="{{$post->title}}_{{$key}}">
                                            </a>
                                        </figure>
                                    </div>
                                    @if($key==0)
                                        @break
                                    @endif
                                @endforeach
                                <div class="col-4">
                                    <div class="row" style="height: 100%">
                                        @foreach($post->images as $key => $image)
                                            @if($key==0)
                                                @continue
                                            @endif
                                            <div class="col-12">
                                                <figure class="post-thumb" style="height: 100%">
                                                    <a class="gallery-selector" href="{{ asset('storage/u_images/'.$image->url) }}">
                                                        <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="{{$post->title}}_{{$key}}">
                                                    </a>
                                                </figure>
                                            </div>
                                            @if($key==3)
                                                @break
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endif
            <p class="post-desc">
                {!! $post->text !!}
            </p>
                <div class="post-meta post-meta-block" data-id="{{ $post->id }}">
                    <x-post-meta :post="$post"></x-post-meta>
                </div>
        </div>
    </div>
    <!-- post status end -->

    <x-comments :post="$post"></x-comments>
@endsection

