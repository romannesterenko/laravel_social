@extends('admin.layouts.layout')
@section('content')
    <h2 class="py-3">Список постов</h2>
    <div class="col d-flex justify-content-end pb-5">
        <a href="{{route('admin.posts.create')}}" class="btn btn-outline-success">Добавить пост</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Лайков</th>
                    <th scope="col">Коментов</th>
                    <th scope="col">Репостов</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)

                    <tr>
                        <td><a href="{{route('admin.posts.show', $post)}}">{{ $post->id }}</a></td>
                        <td><a href="{{route('admin.posts.show', $post)}}">{{ $post->title }}</a></td>
                        <td>{{ $post->author }}</td>
                        <td>{{ $post->likes }}</td>
                        <td>{{ $post->comments }}</td>
                        <td>{{ $post->shares }}</td>
                        <td></td>
                    </tr>

                @endforeach
            </tbody>
        </table>
        {{ $posts->links('') }}
    </div>
@endsection
