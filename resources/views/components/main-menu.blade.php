<!-- widget single item start -->
<div class="card widget-item">
    <div class="widget-body">
        <ul class="like-page-list-wrapper main-menu-component">
            <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                       <i class="bi bi-server"></i>
                    </a>
                </div>
                <!-- profile picture end -->
                <div class="unorder-list-info d-flex align-items-center">
                    <h3 class="list-title"><a href="{{ route('profile.index') }}">Moja strona</a></h3>
                </div>
            </li>
            <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                       <i class="bi bi-article"></i>
                    </a>
                </div>
                <!-- profile picture end -->
                <div class="unorder-list-info d-flex align-items-center">
                    <h3 class="list-title"><a href="{{ route('home') }}">Nowości</a></h3>
                </div>
            </li>
            <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                       <i class="bi bi-chat-bubble-single"></i>
                    </a>
                </div>
                <!-- profile picture end -->
                <div class="unorder-list-info d-flex align-items-center">
                    <h3 class="list-title"><a href="{{ route('inbox.index') }}">Messenger</a></h3>
                    @if($count_messages>0)
                        <div class="badge-success-custom">{{$count_messages}}</div>
                    @endif
                </div>
            </li>
            <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                       <i class="bi bi-user-ID"></i>
                    </a>
                </div>
                <!-- profile picture end -->
                <div class="unorder-list-info d-flex align-items-center">
                    <h3 class="list-title"><a href="{{ route('groups.index') }}">Społeczności</a></h3>
                </div>
            </li>
            <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                       <i class="bi bi-shopping-cart-full"></i>
                    </a>
                </div>
                <!-- profile picture end -->
                <div class="unorder-list-info d-flex align-items-center">
                    <h3 class="list-title"><a href="{{ route('profile.index') }}">Pchli targ</a></h3>
                </div>
            </li>

        </ul>
    </div>
</div>
<!-- widget single item end -->
