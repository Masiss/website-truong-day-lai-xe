@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <style>
        th {
            cursor: pointer;
        }
    </style>
    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="card">
                        <div class="m-1">
                            <a href="{{route('admin.drivers.create')}}">

                                <i data-feather="plus-circle"></i>
                                <span>Thêm</span>
                            </a>
                        </div>
                        <div class=" ">
                            <table class="table  " id="table-data">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Loại bằng</th>
                                    <th scope="col">SĐT</th>
                                    <th scope="col">Hình thẻ</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($drivers as $driver)
                                    <tr>
                                        <td>{{$driver->id}}</td>
                                        <td>{{$driver->name}}</td>
                                        <td>{{$driver->gender}}</td>
                                        <td>{{$driver->course->type}}</td>
                                        <td>{{$driver->phone_numbers}}</td>
                                        <td>
                                            <img src="{{$driver->file}}" width="100px" height="100px">
                                        </td>
                                        <td>
                                            <a class="form-control" href="drivers/{{$driver->id}}/">Chi tiết</a>
                                        </td>
                                        <td>
                                            <form action="drivers/{{$driver->id}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="form-control" class="btn btn-outline-bitbucket"
                                                        type="submit">Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- Bootstrap Pagination with icon starts -->

                            <x-pagination :paginate="$drivers"/>

                        <!-- Bootstrap Pagination with icon ends -->
                    </div>
                </div>

            </div>

        </div>

    </div>

    @push('javascript')
        {{--        <script src="{{asset('js/jquery.bootpag.min.js')}}"></script>--}}
        {{--        <script src="{{asset('js/jquery.twbsPagination.min.js')}}"></script>--}}

        {{--        <script type="text/javascript"--}}
        {{--                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>--}}
        {{--        <script type="text/javascript"--}}
        {{--                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>--}}
        {{--        <script type="text/javascript"--}}
        {{--                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>--}}
        <script type="text/javascript">

            {{--$(function () {--}}
            {{--    $('#table-data').DataTable({--}}
            {{--        processing: true,--}}
            {{--        serverSide: true,--}}
            {{--        ajax: '{!! route('admin.drivers.api') !!}',--}}
            {{--        columns: [--}}
            {{--            {data: 'id', name: 'id'},--}}
            {{--            {data: 'name', name: 'name'},--}}
            {{--            {data: 'gender', name: 'gender'},--}}
            {{--            {data: 'id_numbers', name: 'id_numbers'},--}}
            {{--            {data: 'email', name: 'email'},--}}
            {{--            {data: 'phone_numbers', name: 'phone_numbers'},--}}
            {{--            {data: 'birthdate', name: 'birthdate'},--}}
            {{--            {--}}
            {{--                data: 'file',--}}
            {{--                name: 'file',--}}
            {{--                render: function (data) {--}}
            {{--                    return `<img src='${data}' style="width:100px;height:100px">`;--}}
            {{--                },--}}
            {{--            },--}}
            {{--            {--}}
            {{--                data: 'edit',--}}
            {{--                name: 'edit',--}}
            {{--                render: function (data) {--}}
            {{--                    return `<a href="drivers/${data}/edit">Sửa</a>`;--}}
            {{--                }--}}
            {{--            },--}}
            {{--            {--}}
            {{--                data: 'delete',--}}
            {{--                name: 'delete',--}}
            {{--                render: function (data) {--}}
            {{--                    return `<form action="drivers/${data}" method="POST" >--}}
            {{--                    @csrf--}}
            {{--                    @method('DELETE')--}}
            {{--                    <button class="btn btn-outline-bitbucket" type="submit">Xóa</button>--}}
            {{--                </form>"`;--}}
            {{--                }--}}
            {{--            },--}}
            {{--        ]--}}
            {{--    });--}}
            {{--})--}}

        </script>
    @endpush
@endsection
