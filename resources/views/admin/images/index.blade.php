@extends('admin.layouts.layout')
@section('content')
    <h2 class="py-3">Список картинок</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Автор</th>
                <th scope="col">Пост</th>
                <th scope="col">Сущность</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                @foreach($images as $image)
                    <tr>
                        <td>{{ $image->id }}</td>
                        <td><a href="{{ route('admin.users.edit', $image->author()) }}">{{ $image->author()->name }} {{ $image->author()->last_name }}</a></td>
                        <td>
                            @if($image->post())
                                <a href="{{ route('admin.posts.show', $image->post()) }}">{{ $image->post()->title }}</a>
                            @endif
                        </td>
                        <td>{{ $image->entity }}</td>
                        <td><img src="{{asset('storage/u_images/'.$image->url)}}" width="150px" alt=""></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $images->links('') }}
    </div>
@endsection
