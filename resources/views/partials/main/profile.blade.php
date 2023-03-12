@extends('partials.main.main_layout')
@section('layout')
    <main>

        <div class="main-wrapper">
            <div class="profile-banner-large bg-img" data-bg="{{ Auth::user()->fon_src }}">
            </div>
            <div class="profile-menu-area bg-white">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-3">
                            <div class="profile-picture-box">
                                <figure class="profile-picture">
                                    <a href="profile.html">
                                        <img src="{{ Auth::user()->avatar_src }}" alt="profile picture" style="max-width: 210px">
                                    </a>
                                </figure>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 offset-lg-1">
                            <div class="profile-menu-wrapper">
                                <div class="main-menu-inner header-top-navigation">
                                    <nav>
                                        <ul class="main-menu">
                                            <li class="active"><a href="{{route('profile.index')}}">Moje posty</a></li>
                                            <li><a href="photos.html">Zdjęcia</a></li>
                                            <li><a href="friends.html">Przyjaciele</a></li>
                                            <!-- <li class="d-inline-block d-md-none"><a href="profile.html">edit profile</a></li> -->
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 d-none d-md-block">
                            <div class="profile-edit-panel">
                                <a href="{{ route('profile.edit') }}" class="edit-btn">Edytuj profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 order-2 order-lg-1">
                        <aside class="widget-area profile-sidebar">
                            <x-main-menu></x-main-menu>
                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h4>
                                <div class="widget-body">
                                    <div class="about-author">
                                        <p>{!! Auth::user()->about !!}</p>
                                        <ul class="author-into-list">
                                            @if(Auth::user()->gender)
                                                <li><a href="#"><i class="bi bi-gender-{{ Auth::user()->gender }}"></i>{{ ucfirst(Auth::user()->gender) }}</a></li>
                                            @endif
                                            @if(Auth::user()->profession)
                                                    <li><a href="#"><i class="bi bi-office-bag"></i>{{ Auth::user()->profession }}</a></li>
                                            @endif
                                            @if(Auth::user()->country)
                                                    <li><a href="#"><i class="bi bi-home"></i>{{ Auth::user()->country }}</a></li>
                                            @endif
                                            @if(Auth::user()->hobby)
                                                    <li><a href="#"><i class="bi bi-heart-beat"></i>{{ Auth::user()->hobby }}</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- widget single item end -->

                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Wspomnienia ze słodyczy</h4>
                                <div class="widget-body">
                                    <div class="sweet-galley img-gallery">
                                        <div class="row row-5">
                                            @foreach(Auth::user()->myImages(9) as $image)
                                                <div class="col-4">
                                                    <div class="gallery-tem" style="height: 90%;">
                                                        <figure class="post-thumb"  style="height: 100%;">
                                                            <a class="gallery-selector" href="{{ asset('storage/u_images/'.$image->url) }}">
                                                                <img class="fit-cover" src="{{ asset('storage/u_images/'.$image->url) }}" alt="sweet memory">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- widget single item end -->
                        </aside>
                    </div>

                    <div class="col-lg-9 order-1 order-lg-2 posts_block">
                        @yield('profile_content')
                    </div>

                    {{--<div class="col-lg-3 order-3">
                        <aside class="widget-area">
                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Recent Notifications</h4>
                                <div class="widget-body">
                                    <ul class="like-page-list-wrapper">
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-9.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Any one can join with us if you want</a></h3>
                                                <p class="list-subtitle">5 min ago</p>
                                            </div>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-35.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Any one can join with us if you want</a></h3>
                                                <p class="list-subtitle">10 min ago</p>
                                            </div>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-15.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Any one can join with us if you want</a></h3>
                                                <p class="list-subtitle">18 min ago</p>
                                            </div>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-6.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Any one can join with us if you want</a></h3>
                                                <p class="list-subtitle">25 min ago</p>
                                            </div>
                                        </li>
                                        <li class="unorder-list">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-34.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="unorder-list-info">
                                                <h3 class="list-title"><a href="#">Any one can join with us if you want</a></h3>
                                                <p class="list-subtitle">39 min ago</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- widget single item end -->

                            <!-- widget single item start -->
                            <div class="card widget-item">
                                <h4 class="widget-title">Advertizement</h4>
                                <div class="widget-body">
                                    <div class="add-thumb">
                                        <a href="#">
                                            <img src="assets/images/banner/advertise.jpg" alt="advertisement">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- widget single item end -->


                        </aside>
                    </div>--}}
                </div>
            </div>
        </div>

    </main>
@endsection
