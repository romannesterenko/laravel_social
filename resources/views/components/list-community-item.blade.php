<li style="display:flex; justify-content:space-between; align-items:center;">
    <span class="unorder-list">
        <div class="profile-thumb">
            <a href="#">
                <figure class="profile-thumb-middle">
                    <img src="{{ $community->avatar_src }}" alt="profile picture">
                </figure>
            </a>
        </div>
        <div class="unorder-list-info">
            <h3 class="list-title"><a href="{{route('groups.detail', $community)}}">{{$community->title}}</a></h3>
            <p class="list-subtitle">{{$community->category>0?$community->type->title:'Bez kategorii'}}, <b>{{$community->subscribers->count()}}</b> zapisanych</p>
        </div>
    </span>
    <span>
        @if(Auth::id()==$community->authorInfo->id)
            <span>
                <a href="{{route('groups.edit', $community)}}" class="post-share-btn text-white" style="padding: 10px;">Zarządzanie</a>
            </span>
        @else
            @if($community->isIamASubscriber())
                <a href="#" class="post-share-btn text-white unsubscribe subscribe_request_list" data-url="{{route('groups.subscribe')}}" data-action="unsubscribe" data-user="{{\Auth::id()}}" data-community="{{$community->id}}" style="padding: 10px;">Opuść grupę</a>
            @else
                <a href="#" class="post-share-btn text-white subscribe subscribe_request_list" data-url="{{route('groups.subscribe')}}" data-action="subscribe" data-user="{{\Auth::id()}}" data-community="{{$community->id}}" style="padding: 10px;">Dołącz do grupy</a>
            @endif
        @endif
    </span>
</li>
