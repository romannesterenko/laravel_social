@extends('admin.layouts.layout')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Сообщества</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                        <li class="breadcrumb-item active">Сообщества</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Список комментариев</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Post</th>
                                    <th scope="col">Level</th>
                                    <th scope="col">Parent</th>
                                    <th scope="col">Text</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coments as $coment)
                                    <tr>
                                        <td>{{ $coment->id }}</td>
                                        <td>{{ $coment->comentUser->full_name }}</td>
                                        <td>{{ $coment->commentPost->title }} ({{ $coment->commentPost->id }})</td>
                                        <td>{{ $coment->level }}</td>
                                        <td>{{ $coment->parent_id }}</td>
                                        <td>{!! $coment->text !!}</td>
                                        <td>
                                            <a class="btn btn-outline-success btn-sm edit" href="" title="Edit">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-outline-secondary btn-sm edit" href="" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm edit" title="Edit">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="row">
                        {{ $coments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
