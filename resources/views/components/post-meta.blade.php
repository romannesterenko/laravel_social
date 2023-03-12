<div class="d-flex py-2">
    <button class="post-meta-like like-button @if($post->isLiked()) clicked @endif d-flex align-items-center mr-3" data-action="like" data-entity="post" data-id="{{ $post->id }}">
        <i class="bi bi-like fw-bolder"></i>
        <span>{{ $post->likes_cnt }}</span>
    </button>
    <button class="post-meta-like like-button @if($post->isDisliked()) clicked @endif d-flex align-items-center" data-action="dislike" data-entity="post" data-id="{{ $post->id }}">
        <i class="bi bi-dislike"></i>
        <span>{{ $post->dislikes_cnt}}</span>
    </button>
</div>
<ul class="comment-share-meta">
    <li>
        <a href="{{ route('posts.show', $post) }}#comments" class="post-comment d-flex align-items-center">
            <i class="bi bi-chat-bubble-single"></i>
            <span>{{ $post->all_comments_count }}</span>
        </a>
    </li>
    <li>
        <button class="post-share d-flex align-items-center">
            <i class="bi bi-share"></i>
            <span>{{ $post->shares }}</span>
        </button>
    </li>
</ul>
