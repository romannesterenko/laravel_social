@extends('admin.layouts.layout')
@section('content')
    <h2 class="py-3">Редактирование пользователя</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            {!! implode('', $errors->all('<i class="fas fa-check-circle"></i> <div>:message</div>')) !!}
        </div>
    @endif
    <div class="col">
        <form method="post" action="{{ route('admin.users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>

            <div class="mb-3">
                <label for="exampleName" class="form-label">Name</label>
                <input name="name" value="{{ $user->name }}"  type="text" class="form-control" id="exampleName">
            </div>

            <div class="mb-3">
                <label for="exampleLastName" class="form-label">Last Name</label>
                <input name="last_name" value="{{ $user->last_name }}" type="text" class="form-control" id="exampleLastName">
            </div>
            @if($user->avatar)
                <div class="mb-3">
                    <img style="max-width: 120px" src="{{ asset('storage/avatar/'.$user->avatar) }}" alt="">
                </div>
            @endif
            <div class="mb-3">
                <label for="formFile" class="form-label">Avatar</label>
                <input class="form-control" name="avatar" type="file" id="formFile">
            </div>

            <label for="formFile1" class="form-label">Fon Image</label>

            @if($user->fon_image)
                <div class="mb-3">
                    <img style="max-width: 120px" src="{{ asset('storage/fon_image/'.$user->fon_image) }}" alt="">
                </div>
            @endif

            <div class="mb-3">
                <input class="form-control" name="fon_image" type="file" id="formFile1">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
