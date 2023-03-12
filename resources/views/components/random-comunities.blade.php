<!-- widget single item start -->
<div class="card widget-item">
    <h4 class="widget-title">Losowe społeczności</h4>
    <div class="widget-body">
        <ul class="like-page-list-wrapper">
            @foreach($communities as $community)
            <li class="unorder-list">
                <!-- profile picture end -->
                <div class="profile-thumb">
                    <a href="#">
                        <figure class="profile-thumb-small">
                            <img src="{{$community->avatar_src}}" alt="profile picture">
                        </figure>
                    </a>
                </div>
                <!-- profile picture end -->

                <div class="unorder-list-info">
                    <h3 class="list-title"><a href="{{route('groups.detail', $community)}}">{{$community->title}}</a></h3>
                    <p class="list-subtitle"><a href="#">{{$community->category>0?$community->type->title:'Bez kategorii'}}</a></p>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- widget single item end -->
