@extends('partials.main.group')
@section('content')
    <div class="card card-profile widget-item p-0 mb-4">
        <div class="profile-banner">
            <figure class="profile-banner-small">
                <a href="{{ route('profile.index') }}">
                    <img src="{{ $community->avatar_src }}" alt="">
                </a>
                <a href="{{ route('profile.index') }}" class="profile-thumb-2" title="Administrator {{$community->authorInfo->full_name}}">
                    <img src="{{ $community->authorInfo->avatar_src }}" alt="">
                </a>
            </figure>
            <div class="profile-desc" id="main_group_block">
                <h6 class="author"><a href="{{ route('profile.index') }}">{{$community->title}}</a></h6>
                <p class="">Obserwujących {{$community->subscribers->count()}}</p>
                <p class="">Administrator <a href=""><span style="font-weight: 500;">{{$community->authorInfo->full_name}}</span></a></p>
                <p class="d-flex justify-content-between main_info_about_subscription_block">
                    <span id="main_info_about_subscription">
                        @if($community->isIamASubscriber())
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                  <path fill-rule="evenodd" clip-rule="evenodd" d="M17.5303 5.21967C17.8232 5.51256 17.8232 5.98744 17.5303 6.28033L8.03033 15.7803C7.73744 16.0732 7.26256 16.0732 6.96967 15.7803L2.46967 11.2803C2.17678 10.9874 2.17678 10.5126 2.46967 10.2197C2.76256 9.92678 3.23744 9.92678 3.53033 10.2197L7.5 14.1893L16.4697 5.21967C16.7626 4.92678 17.2374 4.92678 17.5303 5.21967Z" fill="#99A2AD"></path>
                            </svg>
                            Jesteś zapisany
                        @endif
                    </span>
                    @if(Auth::id()==$community->authorInfo->id)
                        <span>
                            <a href="{{route('groups.edit', $community)}}" class="post-share-btn text-white" style="padding: 10px;">Zarządzanie</a>
                        </span>
                    @else
                        @if($community->isIamASubscriber())
                            <span>
                                <a href="#" class="post-share-btn text-white subscribe_request unsubscribe" data-url="{{route('groups.subscribe')}}" data-action="unsubscribe" data-user="{{Auth::id()}}" data-community="{{$community->id}}" style="padding: 10px;">Opuść grupę</a>
                            </span>
                        @else
                            <span>
                                <a href="#" class="post-share-btn text-white subscribe_request subscribe" data-url="{{route('groups.subscribe')}}" data-action="subscribe" data-user="{{Auth::id()}}" data-community="{{$community->id}}" style="padding: 10px;">Dołącz do grupy</a>
                            </span>
                        @endif
                    @endif
                </p>
                @if($community->isIamASubscriber()||$community->authorInfo->id==\Auth::id())
                    <span id="add_post_in_group" style="width: 100%; display: flex; justify-content: center; align-items: center; text-align: center; margin-top: 15px;">
                        <a href="{{ route('profile.post.add') }}?in_community={{$community->id}}" class="post-share-btn text-white w-100" style="padding: 10px;">Napisz post w społeczności</a>
                    </span>
                @endif
                <span style="width: 100%; display: flex; justify-content: center; align-items: center; text-align: center; margin-top: 15px;">
                    <a href="{{route('groups.detail', $community)}}" class="post-share-btn text-white w-100 @if(\Request::route()->getName()=='groups.detail') active @endif" style="padding: 10px;">Posty społeczności</a>
                    <a href="{{route('groups.subscribers', $community)}}" class="post-share-btn text-white w-100 @if(\Request::route()->getName()=='groups.subscribers') active @endif" style="padding: 10px;">Osoby Zapisane ({{$community->subscribers->count()}})</a>
                </span>
            </div>
        </div>
    </div>
    <!-- post status start -->
    {{--@foreach($posts as $post)
        <x-post :post="$post" />
    @endforeach--}}
    <!-- post status end -->
    <div class="card card-profile widget-item p-0 pt-3 mb-4">
        <div class="content-box" style="box-shadow: none">
            <h5 class="content-title">Osoby Zapisane ({{$community->subscribers->count()}})</h5>
            <div class="content-body">
                <div class="row mt--20">
                    @foreach($subscribers as $subscriber)
                        <div class="col-lg-6 col-sm-12">
                            <div class="friend-list-view">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="#">
                                        <figure class="profile-thumb-middle">
                                            <img src="{{$subscriber->user->avatar_src}}" alt="{{$subscriber->user->full_name}}">
                                        </figure>
                                    </a>
                                </div>
                                <!-- profile picture end -->

                                <div class="posted-author" style="display: flex; flex-direction: column">
                                    <h6 class="author"><a href="profile.html">{{$subscriber->user->full_name}}</a></h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{--<div class="col-12">
                        <div class="load-more text-center">
                            <button class="load-more-btn">load more</button>
                        </div>
                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection

