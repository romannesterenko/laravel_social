@extends('partials.main.layout')
@section('content')

    @include('groups.partials.top_block')

    <!-- post status start -->
    <div class="card widget-item">
        <div class="widget-body">
            <ul class="like-page-list-wrapper">
                @if($communities->count()>0)
                    @foreach($communities as $community)
                        <x-list-community-item :community="$community" />
                    @endforeach
                @else
                    Nie znaleziono społeczności
                @endif
            </ul>
        </div>
    </div>
    <!-- post status end -->
@endsection
