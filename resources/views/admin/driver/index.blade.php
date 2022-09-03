@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="d-flex col justify-content-between align-items-center">
                            <button type="button" class="btn btn-primary h-25 ">
                                <a class="text-white" href="{{route('admin.drivers.create')}}">
                                    <i data-feather="plus-circle"></i>
                                    <span>Thêm</span>
                                </a>
                            </button>
                            <div class="col-sm-3 row">
                                <div class="search-bar">
                                    Tìm kiếm:
                                    <input id="search-bar" class="form-control" type="search">
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="alert alert-success">
                             {{session()->get('status')}}
                        </span>
                    <div class="card-body p-0">
                        <table class="table table-striped " id="table-data" data-table="drivers">
                            <thead>
                            <tr>
                                <th>@sortablelink('id')</th>
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
                                        <a class="form-control" href="drivers/{{$driver->id}}">Chi tiết</a>
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
            document.getElementById('search-bar').addEventListener('keyup', function () {
                let value = this.value,
                    table = document.getElementById('table-data').getAttribute('data-table');
                $.ajax({
                    header:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
                    },
                    url: '{{route('search')}}',
                    data: {
                        table, value,
                    },
                    dataType:"JSON",
                    success:function(data){
                        console.log(data);
                    }

                })
            })

        </script>
    @endpush
@endsection
