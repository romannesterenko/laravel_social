@extends('partials.main.layout')
@section('content')
    @foreach($posts as $post)
        <x-post :post="$post" />
    @endforeach
    {{$posts->links('vendor.pagination.ajax')}}
@endsection
