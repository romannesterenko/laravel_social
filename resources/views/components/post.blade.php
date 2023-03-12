<!-- post status start -->
<div class="card post_element" data-id="{{ $post->id }}">
    @if($post->community>0)
        <!-- post title start -->
            <div class="post-title d-flex align-items-center">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                        <figure class="profile-thumb-middle">
                            <img src="{{ $post->communityInfo->avatar_src }}" alt="profile picture_community">
                        </figure>
                    </a>
                    <a href="#" class="user_avatar_in_community">
                        <figure class="profile-thumb-middle">
                            <img src="{{ $post->post_author->avatar_src }}" alt="profile picture_user">
                        </figure>
                    </a>
                </div>
                <!-- profile picture end -->

                <div class="posted-author">
                    <h6 class="author"><a href="{{route('posts.show', $post)}}">{{ $post->title }}</a></h6>
                    <span class="post-time"><a href="{{route('groups.detail', $post->communityInfo->id)}}" style="font-weight: 500;">{{ $post->communityInfo->title }}</a> / <a href="#">{{ $post->post_author!=null?$post->post_author->name:'' }} {{ $post->post_author!=null?$post->post_author->last_name:'' }}</a></span>
                    <span class="post-time">{{$post->created_at->diffForHumans()}}</span>
                </div>

                <div class="post-settings-bar">
                    <span></span>
                    <span></span>
                    <span></span>
                    <div class="post-settings arrow-shape">
                        <ul>
                            <li><button>copy link to adda</button></li>
                            @if($post->post_author->id==Auth::id())
                                <li><a href="{{route('profile.post.edit', $post)}}">edit post</a></li>
                                <li>
                                    <form action="{{route('profile.post.delete', $post)}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">Delete</button>
                                    </form>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <!-- post title start -->
    @else
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
            <h6 class="author"><a href="{{route('posts.show', $post)}}">{{ $post->title }}</a></h6>
            <span class="post-time"><a href="">{{ $post->post_author!=null?$post->post_author->name:'' }} {{ $post->post_author!=null?$post->post_author->last_name:'' }}</a></span>
            <span class="post-time">
                {{$post->created_at->diffForHumans()}}
            </span>
        </div>

        <div class="post-settings-bar">
            <span></span>
            <span></span>
            <span></span>
            <div class="post-settings arrow-shape">
                <ul>
                    <li><button>copy link to adda</button></li>
                    @if($post->post_author->id==Auth::id())
                        <li><a href="{{route('profile.post.edit', $post)}}">edit post</a></li>
                        <li>
                            <form action="{{route('profile.post.delete', $post)}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- post title start -->
    @endif
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
