@extends('admin.layouts.layout')
@section('content')
    <h2 class="py-3">Список пользователей</h2>
    <div class="col d-flex justify-content-end pb-5">
        <a href="{{route('admin.users.create')}}" class="btn btn-outline-success">Добавить пользователя</a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Аватар</th>
                    <th scope="col">Пол</th>
                    <th scope="col">Дата</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)

                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <img style="max-width: 60px" src="{{ asset('storage/avatar/'.$user->avatar) }}" alt="">
                        </td>
                        <td>{{ $user->gender }}</td>
                        <td>{{ $user->birthday }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary">Изменить</a>
                            </div>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
        {{ $users->links('') }}
    </div>
@endsection
