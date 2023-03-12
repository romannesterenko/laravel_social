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
                    <h4 class="card-title">Список сообществ</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>

                                </th>
                                <th>
                                    Наименование
                                </th>
                                <th>
                                    Автор
                                </th>
                                <th>
                                    Категория
                                </th>
                                <th>
                                    Дата создания
                                </th>
                                <th>

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($communities as $community)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{$community->avatar_src}}" style="height: 40px" alt="image">
                                        </td>
                                        <td>
                                            <a href="{{route('admin.communities.show', $community)}}">{{$community->title}}</a>
                                        </td>
                                        <td>
                                            <a href="#">{{$community->authorInfo->full_name}}</a>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            {{$community->created_at}}
                                        </td>
                                        <td>
                                            <a class="btn btn-outline-success btn-sm edit" href="{{route('admin.communities.show', $community)}}" title="Edit">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a class="btn btn-outline-secondary btn-sm edit" href="{{route('admin.communities.edit', $community)}}" title="Edit">
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
                        {{ $communities->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
