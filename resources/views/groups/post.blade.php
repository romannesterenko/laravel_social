@extends('partials.main.layout')
@section('content')
    <div class="card widget-item">
        <div class="share-box-inner d-flex flex-column">
            <div class="share-content-box w-100 d-flex align-items-center justify-content-between pt-2">
                <span>
                    <a href="{{route('groups.index')}}" class="post-share-btn text-white" style="padding: 10px;">Wszystkie społeczności</a>
                    <a href="{{route('groups.my')}}" class="post-share-btn text-white" style="padding: 10px;">Zarządzanie</a>
                </span>
                <span>
                    <a href="{{route('groups.create')}}" class="post-share-btn text-white" style="padding: 10px;">Utwórz społeczność</a>
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
    <!-- post status start -->
    <div class="card widget-item">
        <div class="widget-body">
            <ul class="like-page-list-wrapper">
                @foreach($communities as $community)
                    <li class="unorder-list">
                        <div class="profile-thumb">
                            <a href="#">
                                <figure class="profile-thumb-middle">
                                    <img src="http://localhost:8000/storage/avatar/Bwx2LHsq2LoRdRFMol6Gvmr4SCbRpecHDk7WEUWg.jpg" alt="profile picture">
                                </figure>
                            </a>
                        </div>
                        <div class="unorder-list-info">
                            <h3 class="list-title"><a href="#">{{$community->title}}</a></h3>
                            <p class="list-subtitle">{{$community->subscribers->count()}} zapisanych</p>
                        </div>
                        <div class="post-settings-bar">
                            <span></span>
                            <span></span>
                            <span></span>
                            <div class="post-settings arrow-shape">
                                <ul>
                                    <li><button>copy link to adda</button></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- post status end -->
@endsection
