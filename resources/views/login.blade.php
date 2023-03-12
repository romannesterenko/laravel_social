<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Adda - Social Network HTML Template</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSS
	============================================ -->
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bicon.min.css') }}">
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

</head>

<body class="bg-transparent">

<main>
    <div class="main-wrapper pb-0 mb-0">
        <div class="timeline-wrapper">
            <div class="timeline-header">
                <div class="container-fluid p-0">
                    <div class="row no-gutters align-items-center">
                        <div class="col-lg-6">
                            <div class="timeline-logo-area d-flex align-items-center">
                                <div class="timeline-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="timeline logo">
                                    </a>
                                </div>
                                <div class="timeline-tagline">
                                    <h6 class="tagline">Pomaga ci łączyć się i dzielić z ludźmi w twoim życiu</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="login-area">
                                <form class="row align-items-center" method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="col-12 col-sm">
                                        <input type="text" placeholder="Email" name="email" class="single-field">
                                    </div>
                                    <div class="col-12 col-sm">
                                        <input type="password" placeholder="Hasło" name="password" class="single-field">
                                    </div>
                                    <div class="col-12 col-sm-auto">
                                        <button class="login-btn" type="submit">Zaloguj Się</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timeline-page-wrapper">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">
                        <div class="col-lg-6 order-2 order-lg-1">
                            <div class="timeline-bg-content bg-img" data-bg="{{ asset('assets/images/timeline/login_fon_image.webp') }}">
                                <h3 class="timeline-bg-title">Zobaczmy, co się dzieje z tobą i twoim światem. Witamy w Rajdr.</h3>
                            </div>
                        </div>
                        <div class="col-lg-6 order-1 order-lg-2 d-flex align-items-center justify-content-center">
                            <div class="signup-form-wrapper">
                                <h1 class="create-acc text-center">Utwórz konto</h1>
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                                    </div>
                                @endif
                                @if($errors->any())
                                    <div class="alert alert-danger">
                                    {!! implode('', $errors->all('<i class="fas fa-check-circle"></i> <div>:message</div>')) !!}
                                    </div>
                                @endif
                                <div class="signup-inner text-center">
                                    <h3 class="title">Witamy w Rajdr</h3>
                                    <form class="signup-inner--form" method="post" action="{{ route('register') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="email" name="email" class="single-field" placeholder="Email" value="{{old('email')}}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="name" class="single-field" placeholder="Imię" value="{{old('name')}}">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" name="last_name" class="single-field" placeholder="Nazwisko" value="{{old('last_name')}}">
                                            </div>
                                            <div class="col-12">
                                                <input type="password" name="password" class="single-field" placeholder="Hasło">
                                            </div>
                                            <div class="col-12">
                                                <input type="password" name="password_confirmation" class="single-field" placeholder="Potwierdź hasło">
                                            </div>
                                            <div class="col-12">
                                                <button class="submit-btn" type="submit">Utwórz konto</button>
                                            </div>
                                        </div>
                                        <h6 class="terms-condition">Przeczytałem i akceptuję <a href="#">warunki użytkowania</a></h6>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- JS
============================================ -->

<!-- Modernizer JS -->
<script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<!-- jQuery JS -->
<script src="{{ asset('assets/js/vendor/jquery-3.3.1.min.js') }}"></script>
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

</body>

</html>
