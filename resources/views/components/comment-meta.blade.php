<button class="post-meta-like mr-3 like-button d-flex align-items-center @if($coment->isLiked()) clicked @endif " data-action="like" data-entity="coment" data-id="{{ $coment->id }}">
    <i class="bi bi-like"></i>
    <span>{{ $coment->likes_cnt }}</span>
</button>
<button class="post-meta-like mr-3 like-button d-flex align-items-center @if($coment->isDisliked()) clicked @endif " data-action="dislike" data-entity="coment" data-id="{{ $coment->id }}">
    <i class="bi bi-dislike"></i>
    <span>{{ $coment->dislikes_cnt }}</span>
</button>
