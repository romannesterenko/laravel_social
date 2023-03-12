@if ($paginator->hasPages())
    @if ($paginator->hasMorePages())
        <span id="load_more_posts" style="display: none" data-url="{{ $paginator->nextPageUrl() }}&ajax=Y"></span>
    @endif
@endif
