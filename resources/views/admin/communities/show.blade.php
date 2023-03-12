@extends('admin.layouts.layout')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">{{$community->title}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Главная</a></li>
                        <li class="breadcrumb-item active"><a href="{{route('admin.communities.index')}}">Сообщества</a></li>
                        <li class="breadcrumb-item active">{{$community->title}}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <div class="p-2">
                                    <h3 class="font-size-16"><strong>{{$community->title}}</strong></h3>
                                </div>

                                <div class="">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                <tr>
                                                    <td>Название</td>
                                                    <td>{{$community->title}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Дата создания</td>
                                                    <td>{{$community->created_at}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Администратор</td>
                                                    <td><a href="">{{$community->authorInfo->full_name}}</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-print-none">
                                        <div class="float-end">
                                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light"><i class="fa fa-print"></i></a>
                                            <a href="#" class="btn btn-primary waves-effect waves-light ms-2">Send</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end row -->

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
