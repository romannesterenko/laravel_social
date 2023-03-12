<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Adda - Social Network HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="token" content="{{@csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    {{--<!-- Icon Font CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">--}}
    <link rel="stylesheet" href="{{asset('assets/css/vendor/vendor.min.css')}}">
    <!-- Flat Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/flaticon.css') }}">
    <!-- audio & video player CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/plyr.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.min.css') }}">
    <!-- nice-select CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
    <!-- perfect scrollbar css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/perfect-scrollbar.css') }}">
    <!-- light gallery css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/lightgallery.min.css') }}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @yield('styles')
</head>

<body>

<!-- header area start -->
<header>
    <div class="header-top sticky bg-white d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <!-- header top navigation start -->
                    <div class="header-top-navigation">
                        <nav>
                            <ul>
                                <li class="active"><a href="{{ route('home') }}">Strona główna</a></li>
                                @if (Auth::guest())
                                    <li class="msg-trigger">
                                        <a class="" href="{{ route('login') }}">Zaloguj się</a>
                                    </li>
                                @else
                                    <li><a href="{{ route('profile.post.add') }}">Napisz posta</a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                    <!-- header top navigation start -->
                </div>

                <div class="col-md-2">
                    <!-- brand logo start -->
                    <div class="brand-logo text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="brand logo">
                        </a>
                    </div>
                    <!-- brand logo end -->
                </div>

                <div class="col-md-5">
                    <div class="header-top-right d-flex align-items-center justify-content-end">
                        <!-- header top search start -->
                        <div class="header-top-search">
                            <form class="top-search-box">
                                <input type="text" placeholder="Szukaj" class="top-search-field">
                                <button class="top-search-btn"><i class="flaticon-search"></i></button>
                            </form>
                        </div>
                        <!-- header top search end -->
                    @if(Auth::check())
                        <!-- profile picture start -->
                            <div class="profile-setting-box">
                                <div class="profile-thumb-small">
                                    <a href="javascript:void(0)" class="profile-triger">
                                        <figure>
                                            <img src="{{ Auth::user()->avatar_src }}" alt="profile picture">
                                        </figure>
                                    </a>
                                    <div class="profile-dropdown">
                                        <div class="profile-head">
                                            <h5 class="name"><a href="#">{{Auth::user()->name}} {{Auth::user()->last_name}}</a></h5>
                                            <a class="mail" href="mailto: {{ Auth::user()->email }}">{{Auth::user()->email}}</a>
                                        </div>
                                        <div class="profile-body">
                                            <ul>
                                                <li><a href="{{ route('profile.index') }}"><i class="flaticon-user"></i>Profile</a></li>
                                                <li><a href="#"><i class="flaticon-message"></i>Inbox</a></li>
                                                <li><a href="#"><i class="flaticon-document"></i>Activity</a></li>
                                            </ul>
                                            <ul>
                                                <li><a href="{{ route('profile.edit') }}"><i class="flaticon-settings"></i>Setting</a></li>
                                                <li><a href="{{ route('logout') }}"><i class="flaticon-unlock"></i>Sing out</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- profile picture end -->
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
<!-- header area start -->
<header>
    <div class="mobile-header-wrapper sticky d-block d-lg-none">
        <div class="mobile-header position-relative ">
            <div class="mobile-logo">
                <a href="{{ route('home') }}">
                    <img src="assets/images/logo/logo-white.png" alt="logo">
                </a>
            </div>
            <div class="mobile-menu w-100">
                <ul>
                    <li>
                        <button class="notification request-trigger"><i class="flaticon-users"></i>
                            <span>03</span>
                        </button>
                        @if(Auth::check())
                            <ul class="frnd-request-list">
                                <li>
                                    <div class="frnd-request-member">
                                        <figure class="request-thumb">
                                            <a href="{{ route('profile.index') }}">
                                                <img src="{{ Auth::user()->avatar_src }}" alt="proflie author">
                                            </a>
                                        </figure>
                                        <div class="frnd-content">
                                            <h6 class="author"><a href="{{ route('profile.index') }}">merry watson</a></h6>
                                            <p class="author-subtitle">Works at HasTech</p>
                                            <div class="request-btn-inner">
                                                <button class="frnd-btn">confirm</button>
                                                <button class="frnd-btn delete">delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="frnd-request-member">
                                        <figure class="request-thumb">
                                            <a href="{{ route('profile.index') }}">
                                                <img src="assets/images/profile/profile-midle-2.jpg" alt="proflie author">
                                            </a>
                                        </figure>
                                        <div class="frnd-content">
                                            <h6 class="author"><a href="{{ route('profile.index') }}">merry watson</a></h6>
                                            <p class="author-subtitle">Works at HasTech</p>
                                            <div class="request-btn-inner">
                                                <button class="frnd-btn">confirm</button>
                                                <button class="frnd-btn delete">delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="frnd-request-member">
                                        <figure class="request-thumb">
                                            <a href="{{ route('profile.index') }}">
                                                <img src="assets/images/profile/profile-midle-3.jpg" alt="proflie author">
                                            </a>
                                        </figure>
                                        <div class="frnd-content">
                                            <h6 class="author"><a href="{{ route('profile.index') }}">merry watson</a></h6>
                                            <p class="author-subtitle">Works at HasTech</p>
                                            <div class="request-btn-inner">
                                                <button class="frnd-btn">confirm</button>
                                                <button class="frnd-btn delete">delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        @endif

                    </li>
                    <li>
                        <button class="notification"><i class="flaticon-notification"></i>
                            <span>03</span>
                        </button>
                    </li>
                    <li>
                        <button class="chat-trigger notification"><i class="flaticon-chats"></i>
                            <span>04</span>
                        </button>
                        <div class="mobile-chat-box">
                            <div class="live-chat-title">
                                <!-- profile picture end -->
                                <div class="profile-thumb">
                                    <a href="{{ route('profile.index') }}">
                                        <figure class="profile-thumb-small profile-active">
                                            <img src="assets/images/profile/profile-small-15.jpg" alt="profile picture">
                                        </figure>
                                    </a>
                                </div>
                                <!-- profile picture end -->
                                <div class="posted-author">
                                    <h6 class="author"><a href="{{ route('profile.index') }}">Robart Marloyan</a></h6>
                                    <span class="active-pro">active now</span>
                                </div>
                                <div class="live-chat-settings ml-auto">
                                    <button class="chat-settings"><img src="assets/images/icons/settings.png" alt=""></button>
                                    <button class="close-btn"><img src="assets/images/icons/close.png" alt=""></button>
                                </div>
                            </div>
                            <div class="message-list-inner">
                                <ul class="message-list custom-scroll">
                                    <li class="text-friends">
                                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text</p>
                                        <div class="message-time">10 minute ago</div>
                                    </li>
                                    <li class="text-author">
                                        <p>Many desktop publishing packages and web page editors</p>
                                        <div class="message-time">5 minute ago</div>
                                    </li>
                                    <li class="text-friends">
                                        <p>packages and web page editors </p>
                                        <div class="message-time">2 minute ago</div>
                                    </li>
                                    <li class="text-friends">
                                        <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text</p>
                                        <div class="message-time">10 minute ago</div>
                                    </li>
                                    <li class="text-author">
                                        <p>Many desktop publishing packages and web page editors</p>
                                        <div class="message-time">5 minute ago</div>
                                    </li>
                                    <li class="text-friends">
                                        <p>packages and web page editors </p>
                                        <div class="message-time">2 minute ago</div>
                                    </li>
                                </ul>
                            </div>
                            <div class="chat-text-field mob-text-box">
                                <textarea class="live-chat-field custom-scroll" placeholder="Text Message"></textarea>
                                <button class="chat-message-send" type="submit" value="submit">
                                    <img src="assets/images/icons/plane.png" alt="">
                                </button>
                            </div>
                        </div>
                    </li>
                    <li>
                        <button class="search-trigger">
                            <i class="search-icon flaticon-search"></i>
                            <i class="close-icon flaticon-cross-out"></i>
                        </button>
                        <div class="mob-search-box">
                            <form class="mob-search-inner">
                                <input type="text" placeholder="Search Here" class="mob-search-field">
                                <button class="mob-search-btn"><i class="flaticon-search"></i></button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mobile-header-profile">
                <!-- profile picture end -->
                <div class="profile-thumb profile-setting-box">
                    <a href="javascript:void(0)" class="profile-triger">
                        <figure class="profile-thumb-middle">
                            <img src="assets/images/profile/profile-small-1.jpg" alt="profile picture">
                        </figure>
                    </a>
                    <div class="profile-dropdown text-left">
                        <div class="profile-head">
                            <h5 class="name"><a href="#">Madison Howard</a></h5>
                            <a class="mail" href="#">mailnam@mail.com</a>
                        </div>
                        <div class="profile-body">
                            <ul>
                                <li><a href="{{ route('profile.index') }}"><i class="flaticon-user"></i>Profile</a></li>
                                <li><a href="#"><i class="flaticon-message"></i>Inbox</a></li>
                                <li><a href="#"><i class="flaticon-document"></i>Activity</a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><i class="flaticon-settings"></i>Setting</a></li>
                                <li><a href="signup.html"><i class="flaticon-unlock"></i>Sing out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- profile picture end -->
            </div>
        </div>
    </div>
</header>
<!-- header area end -->
@yield('layout')

<!-- Scroll to top start -->
<div class="scroll-top not-visible">
    <i class="bi bi-finger-index"></i>
</div>
<button class="custom_modal_button" data-toggle="modal" data-target="#custom_modal" style="display: none"></button>
<div class="modal fade form-modal" id="custom_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Usuwanie obrazu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Czy na pewno chcesz usunąć ten obraz?
            </div>
        </div>
    </div>
</div>
<!-- Scroll to Top End -->

{{--<!-- footer area start -->
<footer class="d-none d-lg-block">
    <div class="footer-area reveal-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="footer-wrapper">
                        <div class="footer-card position-relative">
                            <div class="friends-search">
                                <form class="search-box">
                                    <input type="text" placeholder="Search Your Friends" class="search-field">
                                    <button class="search-btn"><i class="flaticon-search"></i></button>
                                </form>
                            </div>
                            <div class="friend-search-list">
                                <div class="frnd-search-title">
                                    <button class="frnd-search-icon"><i class="flaticon-settings"></i></button>
                                    <p>search friends</p>
                                    <button class="close-btn" data-close="friend-search-list"><i class="flaticon-cross-out"></i></button>
                                </div>
                                <div class="frnd-search-inner custom-scroll">
                                    <ul>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-1.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author">Jon Wilime</h6>
                                                <p>Many desktop publishing</p>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-2.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Jon Wileyam</a></h6>
                                                <button class="add-frnd">add friend</button>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-3.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Mili Raoulin</a></h6>
                                                <button class="add-frnd">add friend</button>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-4.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Jon Wilime</a></h6>
                                                <button class="add-frnd">10 mutual friends</button>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-5.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Robart faul</a></h6>
                                                <button class="add-frnd">12 mutual friends</button>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-3.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Mili Raoulin</a></h6>
                                                <button class="add-frnd">add friend</button>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-4.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Jon Wilime</a></h6>
                                                <button class="add-frnd">10 mutual friends</button>
                                            </div>
                                        </li>
                                        <li class="d-flex align-items-center profile-active">
                                            <!-- profile picture end -->
                                            <div class="profile-thumb active">
                                                <a href="#">
                                                    <figure class="profile-thumb-small">
                                                        <img src="assets/images/profile/profile-small-5.jpg" alt="profile picture">
                                                    </figure>
                                                </a>
                                            </div>
                                            <!-- profile picture end -->

                                            <div class="posted-author">
                                                <h6 class="author"><a href="{{ route('profile.index') }}">Robart faul</a></h6>
                                                <button class="add-frnd">12 mutual friends</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card card-small mb-0 active-profile-wrapper">
                            <div class="active-profiles-wrapper">
                                <div class="active-profile-carousel slick-row-20 slick-arrow-style">
                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="#">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-1.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-1.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-2.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-3.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-4.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-1.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-5.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-6.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-7.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-8.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-9.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-10.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-11.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->
                                </div>
                            </div>
                        </div>
                        <div class="footer-card position-relative">
                            <div class="live-chat-inner">
                                <div class="chat-text-field">
                                    <textarea class="live-chat-field custom-scroll" placeholder="Text Message"></textarea>
                                    <button class="chat-message-send" type="submit" value="submit">
                                        <img src="assets/images/icons/plane.png" alt="">
                                    </button>
                                </div>
                                <div class="chat-output-box">
                                    <div class="live-chat-title">
                                        <!-- profile picture end -->
                                        <div class="profile-thumb active">
                                            <a href="#">
                                                <figure class="profile-thumb-small">
                                                    <img src="assets/images/profile/profile-small-15.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                        <!-- profile picture end -->
                                        <div class="posted-author">
                                            <h6 class="author"><a href="{{ route('profile.index') }}">Robart Marloyan</a></h6>
                                            <span class="active-pro">active now</span>
                                        </div>
                                        <div class="live-chat-settings ml-auto">
                                            <button class="chat-settings"><i class="flaticon-settings"></i></button>
                                            <button class="close-btn" data-close="chat-output-box"><i class="flaticon-cross-out"></i></button>
                                        </div>
                                    </div>
                                    <div class="message-list-inner">
                                        <ul class="message-list custom-scroll">
                                            <li class="text-friends">
                                                <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text</p>
                                                <div class="message-time">10 minute ago</div>
                                            </li>
                                            <li class="text-author">
                                                <p>Many desktop publishing packages and web page editors</p>
                                                <div class="message-time">5 minute ago</div>
                                            </li>
                                            <li class="text-friends">
                                                <p>packages and web page editors </p>
                                                <div class="message-time">2 minute ago</div>
                                            </li>
                                            <li class="text-friends">
                                                <p>Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text</p>
                                                <div class="message-time">10 minute ago</div>
                                            </li>
                                            <li class="text-author">
                                                <p>Many desktop publishing packages and web page editors</p>
                                                <div class="message-time">5 minute ago</div>
                                            </li>
                                            <li class="text-friends">
                                                <p>packages and web page editors </p>
                                                <div class="message-time">2 minute ago</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->
<!-- footer area start -->
<footer class="d-block d-lg-none">
    <div class="footer-area reveal-footer">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mobile-footer-inner d-flex">
                        <div class="mobile-frnd-search">
                            <button class="search-toggle-btn"><i class="flaticon-search"></i></button>
                        </div>
                        <div class="mob-frnd-search-inner">
                            <form class="mob-frnd-search-box d-flex">
                                <input type="text" placeholder="Search Your Friends" class="mob-frnd-search-field">
                            </form>
                        </div>
                        <div class="card card-small mb-0 active-profile-mob-wrapper">
                            <div class="active-profiles-mob-wrapper slick-row-10">
                                <div class="active-profile-mobile">
                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="#">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-1.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-8.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-2.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-3.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-4.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-5.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->

                                    <!-- profile picture end -->
                                    <div class="single-slide">
                                        <div class="profile-thumb active profile-active">
                                            <a href="javascript:void(0)">
                                                <figure class="profile-thumb-small profile-active">
                                                    <img src="assets/images/profile/profile-small-9.jpg" alt="profile picture">
                                                </figure>
                                            </a>
                                        </div>
                                    </div>
                                    <!-- profile picture end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->--}}

<!-- JS
============================================ -->

<!-- Modernizer JS -->
<script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<!-- jQuery JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
<script src="https://www.youtube.com/iframe_api"></script>

<!-- Popper JS -->
<script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('assets/js/vendor/bootstrap.min.js') }}"></script>
<!-- Slick Slider JS -->
<script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
<!-- nice select JS -->
<script src="{{ asset('assets/js/plugins/nice-select.min.js') }}"></script>
<!-- audio video player JS -->
<script src="{{ asset('assets/js/plugins/plyr.min.js') }}"></script>
<!-- perfect scrollbar js -->
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<!-- light gallery js -->
<script src="{{ asset('assets/js/plugins/lightgallery-all.min.js') }}"></script>
<!-- image loaded js -->
<script src="{{ asset('assets/js/plugins/imagesloaded.pkgd.min.js') }}"></script>
<!-- isotope filter js -->
<script src="{{ asset('assets/js/plugins/isotope.pkgd.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<link href="{{asset('assets/css/fileinput.min.css')}}" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js" type="text/javascript"></script>

<!-- piexif.min.js is needed for auto orienting image files OR when restoring exif data in resized images and when you
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/piexif.min.js" type="text/javascript"></script>

<!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview.
    This must be loaded before fileinput.min.js -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/sortable.min.js" type="text/javascript"></script>

<!-- bootstrap.bundle.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 5.x or 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<!-- the main fileinput plugin script JS file -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

<!-- following theme script is needed to use the Font Awesome 5.x theme (`fa5`). Uncomment if needed. -->
<!-- script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/themes/fa5/theme.min.js"></script -->

<!-- optionally if you need translation for your language then include the locale file as mentioned below (replace LANG.js with your language locale) -->
<script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/locales/LANG.js"></script>


@yield('scripts')
<script>
    $(document).ready(function() {
        async function uploadFile(files, editor) {
            const data = new FormData();
            for (let i = 0; i < files.length; i++) {
                data.append("files[]", files[i]);
            }
            try {
                const images = (await axios({
                    data,
                    method: 'post',
                    url: "{{ route('summernote.upload') }}",
                })).data;
                for (let i = 0; i < images.length; i++) {
                    console.log(images[i]);
                    editor.summernote('insertImage', '/storage/' + images[i], function ($image) {
                        //$image.css('width', '100%');
                    });
                }
            } catch (e) {
                console.log(e);
            }
        }

        async function deleteFile(file) {
            const data = new FormData();
            data.append('file', file);
            try {
                await axios({
                    data,
                    method: 'post',
                    url: "{{ route('summernote.delete') }}",
                });
            } catch (e) {
                console.log(e);
            }
        }

        var editor = $('#top_editorr');
        var config = {
            tabsize: 1,
            height: 120,
            toolbar: [
                ['font', ['bold', 'underline', 'italic']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture', 'video']],
            ],
            callbacks: {
                onImageUpload: function (files) {
                    uploadFile(files, editor);
                },
                onMediaDelete: function ($target) {
                    console.log($target)
                    const url = $target[0].src,
                        cut = "{{ URL::to('/') }}" + "/storage/post_coments",
                        image = url.replace(cut, '');
                    deleteFile(image);
                }
            }
        }
        editor.summernote(config);
    });
</script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
