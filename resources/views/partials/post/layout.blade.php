@extends('partials.main.main_layout')
@section('layout')
    <main>

        <div class="main-wrapper pt-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 order-1 order-lg-2">
                        @yield('content')
                    </div>

                    <div class="col-lg-3 order-3">
                        <aside class="widget-area">
                            <x-profile-block></x-profile-block>
                            @if($post->community>0)
                                <x-community-block-component :id="$post->community"></x-community-block-component>
                            @endif
                            <x-last-posts-component></x-last-posts-component>
                            <x-advert></x-advert>
                            <x-random-comunities></x-random-comunities>
                        </aside>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
