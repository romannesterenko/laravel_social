@extends('admin.layouts.layout')
@section('content')
    <h2 class="py-3">Создание пользователя</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            {!! implode('', $errors->all('<i class="fas fa-check-circle"></i> <div>:message</div>')) !!}
        </div>
    @endif
    <div class="col">
        <form method="post" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleName" class="form-label">Name</label>
                <input name="name" value="{{ old('name') }}"  type="text" class="form-control" id="exampleName">
            </div>

            <div class="mb-3">
                <label for="exampleLastName" class="form-label">Last Name</label>
                <input name="last_name" value="{{ old('last_name') }}" type="text" class="form-control" id="exampleLastName">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Avatar</label>
                <input class="form-control" name="avatar" type="file" id="formFile">
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">Fon Image</label>
                <input class="form-control" name="fon_image" type="file" id="formFile">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
