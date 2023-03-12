@if(Auth::check())
    <!-- widget single item start -->
    <div class="card card-profile widget-item p-0">
        <div class="profile-banner">
            <figure class="profile-banner-small">
                <a href="{{ route('profile.index') }}">
                    <img src="{{ Auth::user()->fon_src }}" alt="">
                </a>
                <a href="{{ route('profile.index') }}" class="profile-thumb-2">
                    <img src="{{ Auth::user()->avatar_src }}" alt="">
                </a>
            </figure>
            <div class="profile-desc text-center">
                <h6 class="author"><a href="{{ route('profile.index') }}">{{Auth::user()->name}} {{Auth::user()->last_name}}</a></h6>
                <p>{!! Auth::user()->about !!}</p>
            </div>
        </div>
    </div>
    <!-- widget single item start -->
@endif
