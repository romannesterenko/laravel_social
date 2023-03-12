@extends('partials.main.profile')
@section('profile_content')
    <!-- post status start -->
    <div class="card">
        <div class="row">
            <div class="col-3">
                <div class="thread-list">
                    @foreach($threads as $one_thread)
                        @if($one_thread->user_one==Auth::id())
                            <a href="{{route('inbox.chat', $one_thread->chatMemberTwo->id)}}" class="live-chat-title @if($one_thread->id==$thread->id) active @endif " data-id="{{$one_thread->id}}">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <img class="shadow-1-strong me-3  load_profile @if($one_thread->unread_messages()->count()>0) have_new_messages @endif" role="button" title="Popover Header" data-content="Some content inside the popover" src="{{ $one_thread->chatMemberTwo->avatar_src }}" data-toggle="popover" data-id="1" alt="{{ $one_thread->chatMemberTwo->full_name }}">
                                </div>
                                <!-- profile picture end -->
                                <div class="posted-author">
                                    <h6 class="author"><span class=" @if($one_thread->unread_messages()->count()>0) fw-bold @endif">{{ $one_thread->chatMemberTwo->full_name }}</span></h6>
                                </div>
                            </a>
                        @else
                            <a href="{{route('inbox.chat', $one_thread->chatMemberOne->id)}}" class="live-chat-title @if($one_thread->id==$thread->id) active @endif " data-id="{{$one_thread->id}}">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <img class="shadow-1-strong me-3  load_profile @if($one_thread->unread_messages()->count()>0) have_new_messages @endif" role="button" title="Popover Header" data-content="Some content inside the popover" src="{{ $one_thread->chatMemberOne->avatar_src }}" data-toggle="popover" data-id="1" alt="{{ $one_thread->chatMemberOne->full_name }}">
                                </div>
                                <!-- profile picture end -->
                                <div class="posted-author">
                                    <h6 class="author"><span class=" @if($one_thread->unread_messages()->count()>0) fw-bold @endif">{{ $one_thread->chatMemberOne->full_name }}</span></h6>
                                </div>
                            </a>
                        @endif

                    @endforeach
                </div>
            </div>
            <div class="col-9">
                <div class="chat-output-box show inbox">
                    <div class="live-chat-title">
                        <!-- profile picture end -->
                        <div class="profile-thumb">
                            <img class="shadow-1-strong me-3  load_profile" role="button" title="Popover Header" data-content="Some content inside the popover" src="{{$recipient->avatar_src}}" data-toggle="popover" data-id="1" alt="{{$recipient->full_name}}">
                        </div>
                        <!-- profile picture end -->
                        <div class="posted-author">
                            <h6 class="author"><a href="profile.html">{{$recipient->full_name}}</a></h6>
                            <span class="active-pro">active now</span>
                        </div>
                        <div class="live-chat-settings ml-auto">
                            <button class="inbox close-btn" data-close="chat-output-box"><i class="flaticon-cross-out"></i></button>
                        </div>
                    </div>
                    <div class="message-list-inner inb" data-id="{{$thread->id}}">
                        @if($thread->messages->count()==0)
                            <div class="empty_chat">
                                <img src="{{asset('assets/images/icons8-communication.gif')}}" alt="">
                                <h5 class="text-center">Na tym czacie nie było jeszcze żadnych wiadomości. Bądź pierwszy!</h5>
                            </div>
                        @else
                            <x-chat-messages :thread="$thread"></x-chat-messages>
                        @endif

                    </div>
                </div>
                <form action="{{route('inbox.message', $thread)}}" method="post" class="chat-text-field" style="border-top: 1px solid lightgrey;padding-top: 5px;">
                    @csrf
                    <input type="hidden" name="author_id" value="{{Auth::id()}}">
                    <input type="hidden" name="recipient_id" value="{{$recipient->id}}">
                    <textarea class="live-chat-field custom-scroll ps" placeholder="Napisz coś" name="message"></textarea>
                    <button class="inbox chat-message-send" type="submit" value="submit" data-thread="{{$thread->id}}">
                        <i class="flaticon-send"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- post status end -->
@endsection
@section('scripts')
    <script>
        function interval(){
            updateChatMessages($('.inb.message-list-inner').data('id'))
        }
        $(function(){
            $(".message-list-inner .message-list.my-scroll").scrollTop($(".message-list-inner .message-list.my-scroll")[0].scrollHeight)
            //setInterval(updateChatMessages($('.inb.message-list-inner').data('id')), 2000)
            setInterval(interval, 2000)
        })
    </script>
@endsection
