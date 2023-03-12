@extends('admin.layouts.layout')
@section('content')

    <div class="d-flex flex-column align-items-start gap-2 py-4">
        <h3 class="fw-bold">{{ $post->title }}</h3>
        <p class="text-muted py-3">{!! $post->text !!}</p>
        <div class="d-flex justify-content-between">
            <img src="{{ asset('storage/post/'.$post->picture) }}" alt="">
        </div>
        <div class="row">
            @foreach($post->images() as $image)
                <div class="col-md-3">
                    <img src="{{ asset('storage/u_images/'.$image->url) }}" alt="" style="width: 100%">
                </div>
            @endforeach

        </div>
        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary">Edit post</a>
    </div>

@endsection
