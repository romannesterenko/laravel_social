<!-- widget single item start -->
<div class="card widget-item">
    <h4 class="widget-title">Ostatnie powiadomienia</h4>
    <div class="widget-body">
        <ul class="like-page-list-wrapper">
            @foreach($posts as $post)
                <li class="unorder-list">
                    <!-- profile picture end -->
                    <div class="profile-thumb">
                        <a href="#">
                            <figure class="profile-thumb-small">
                                <img src="{{ $post->post_author->avatar_src }}" alt="profile picture">
                            </figure>
                        </a>
                    </div>
                    <!-- profile picture end -->

                    <div class="unorder-list-info">
                        <h3 class="list-title"><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h3>
                        <p class="list-subtitle">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<!-- widget single item end -->
