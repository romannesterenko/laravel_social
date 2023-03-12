    <!-- widget single item start -->
    <div class="card card-profile widget-item p-0 mb-4">
        <div class="profile-banner">
            <figure class="profile-banner-small">
                <a href="{{ route('profile.index') }}">
                    <img src="{{ $community->avatar_src }}" alt="">
                </a>
                <a href="{{ route('profile.index') }}" class="profile-thumb-2">
                    <img src="{{ $community->authorInfo->avatar_src }}" alt="">
                </a>
            </figure>
            <div class="profile-desc text-center">
                <h6 class="author"><a href="{{ route('profile.index') }}">{{$community->title}}</a></h6>
                <p class="">Obserwujących {{$community->subscribers->count()}}</p>
                <p>{{$community->description}}</p>
            </div>
        </div>
    </div>
    <!-- widget single item start -->
