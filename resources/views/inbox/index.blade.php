@extends('partials.main.profile')
@section('profile_content')
    <!-- post status start -->
    <div class="card">
        <div class="row">
        <div class="col-3">
            <div class="thread-list">
                @foreach($threads as $one_thread)
                    @if($one_thread->user_one==Auth::id())
                        <a href="{{route('inbox.chat', $one_thread->chatMemberTwo->id)}}" class="live-chat-title" data-id="{{$one_thread->id}}">
                            <!-- profile picture end -->
                            <div class="profile-thumb">
                                <img class="shadow-1-strong me-3  load_profile @if($one_thread->unread_messages()->count()>0) have_new_messages @endif" role="button" title="Popover Header" data-content="Some content inside the popover" src="{{ $one_thread->chatMemberTwo->avatar_src }}" data-toggle="popover" data-id="1" alt="{{ $one_thread->chatMemberTwo->full_name }}">
                            </div>
                            <!-- profile picture end -->
                            <div class="posted-author">
                                <h6 class="author">
                                    <span class=" @if($one_thread->unread_messages()->count()>0) fw-bold @endif">{{ $one_thread->chatMemberTwo->full_name }}</span>
                                </h6>
                            </div>
                        </a>
                    @else
                        <a href="{{route('inbox.chat', $one_thread->chatMemberOne->id)}}" class="live-chat-title" data-id="{{$one_thread->id}}">
                            <!-- profile picture end -->
                            <div class="profile-thumb">
                                <img class="shadow-1-strong me-3 load_profile @if($one_thread->unread_messages()->count()>0) have_new_messages @endif" role="button" title="Popover Header" data-content="Some content inside the popover" src="{{ $one_thread->chatMemberOne->avatar_src }}" data-toggle="popover" data-id="1" alt="{{ $one_thread->chatMemberOne->full_name }}">
                            </div>
                            <!-- profile picture end -->
                            <div class="posted-author">
                                <h6 class="author">
                                    <span class=" @if($one_thread->unread_messages()->count()>0) fw-bold @endif">{{ $one_thread->chatMemberOne->full_name }}</span>
                                </h6>
                            </div>
                        </a>
                    @endif

                @endforeach
            </div>
        </div>
        <div class="col-9">
            <div class="chat-output-box show inbox">
                <div class="message-list-inner">
                    <div class="empty_chat">
                        <img src="{{asset('assets/images/icons8-communication.gif')}}" alt="">
                        <h5>Wybierz czat z listy</h5>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
    <!-- post status end -->
@endsection
