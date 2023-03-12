<div class="card widget-item">
    <div class="share-box-inner d-flex flex-column">
        <div class="share-content-box w-100 d-flex align-items-center justify-content-between pt-2">
            <span>
                <a href="{{route('groups.index')}}" class="post-share-btn text-white @if(\Request::route()->getName()=='groups.index') active @endif" style="padding: 10px;">Wszystkie</a>
                <a href="{{route('groups.subscribed')}}" class="post-share-btn text-white @if(\Request::route()->getName()=='groups.subscribed') active @endif" style="padding: 10px;">Zapisany</a>
                <a href="{{route('groups.my')}}" class="post-share-btn text-white @if(\Request::route()->getName()=='groups.my') active @endif" style="padding: 10px;">Zarządzanie</a>
            </span>
            <span>
                <a href="{{route('groups.create')}}" class="post-share-btn text-white @if(\Request::route()->getName()=='groups.create') active @endif" style="padding: 10px;">Utwórz społeczność</a>
            </span>
        </div>
        <div class="mt-3">
            <div class="share-content-box w-100">
                <form class="share-text-box" style="padding-left: 0px;">
                    <textarea name="share" class="share-text-field" aria-disabled="true" placeholder="Wyszukiwanie społeczności" data-toggle="modal" data-target="#textbox" id="email"></textarea>
                    <button class="btn-share" type="submit"><i class="bi bi-search fw-bolder"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
