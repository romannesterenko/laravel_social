@php
    \Carbon\Carbon::setLocale('pl');
@endphp
<ul class="message-list my-scroll">
    @foreach($messages as $message)
        @if($message->author_id==Auth::id())
            <li class="text-author">
        @else
            <li class="text-friends">
        @endif
            <p>{{ $message->message }}</p>
            <div class="message-time">{{$message->created_at->diffForHumans()}}</div>
        </li>
    @endforeach
</ul>
