@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-10">
                    <div class="card">
                        <div class="m-1">
                            <a href="{{route('admin.drivers.create')}}">

                                <i data-feather="plus-circle"></i>
                                <span>Thêm</span>
                            </a>
                        </div>
                        <table class="table " id="table-data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Giới tính</th>
                                <th>CCCD</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Ngày sinh</th>
                                <th>Hình thẻ</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>

            </div>

        </div>

    </div>

    @push('javascript')
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>
        <script type="text/javascript">

            $(function () {
                $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.drivers.api') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'gender', name: 'gender'},
                        {data: 'id_numbers', name: 'id_numbers'},
                        {data: 'email', name: 'email'},
                        {data: 'phone_numbers', name: 'phone_numbers'},
                        {data: 'birthdate', name: 'birthdate'},
                        {
                            data: 'file',
                            name: 'file',
                            render: function (data) {
                                return `<img src='${data}' style="width:100px;height:100px">`;
                            },
                        },
                        {
                            data: 'edit',
                            name: 'edit',
                            render: function (data) {
                                return `<a href="drivers/${data}/edit">Sửa</a>`;
                            }
                        },
                        {
                            data: 'delete',
                            name: 'delete',
                            render: function (data) {
                                return `<form action="drivers/${data}" method="POST" >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-bitbucket" type="submit">Xóa</button>
                            </form>"`;
                            }
                        },
                    ]
                });
            })


        </script>
    @endpush
@endsection
