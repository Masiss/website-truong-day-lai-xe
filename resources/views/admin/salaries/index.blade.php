@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="card">
                        <div class="m-1">
                            <form action="{{route('admin.salaries.calculate')}}" method="GET"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('GET')
                                <div class="row">
                                    <div class="col-xl-2 col-md-3 col-sm-3 mb-2">
                                        <label>Tháng</label>
                                        <select name="month">
                                            @for($i=$month;$i>=1;$i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-xl-2 col-md-6 col-sm-12 mb-2">
                                        <label>Năm</label>
                                        <select name="year">
                                            @for($i=$year;$i>=($year-5);$i--)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div>
                                        <button type="submit" class="btn btn-outline-bitbucket">Tính lương</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên giáo viên</th>
                                <th>Tháng</th>
                                <th>Tổng buổi dạy</th>
                                <th>Tổng giờ dạy</th>
                                <th>Tổng lương</th>
                                <th>Thời gian tạo</th>
                                <th>Trạng thái</th>
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
                    ajax: '{!! route('admin.salaries.api') !!}',
                    order: [[6, "desc"], [7, "desc"]],
                    columns:
                        [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'month', name: 'month'},
                            {data: 'total_lessons', name: 'total_lessons'},
                            {data: 'total_hours', name: 'total_hours'},
                            {data: 'total_salaries', name: 'total_salaries'},
                            {data: 'created_at', name: 'created_at'},
                            {
                                data: 'status',
                                name: 'status',
                            },
                            {
                                data: 'show',
                                name: 'show',
                                render: function (data) {
                                    return `<a href="./salaries/${data}/">Chi tiết</a>`;
                                }
                            },
                            {
                                data: 'approve',
                                name: 'approve',
                                render: function (data) {
                                    if (data != null) {
                                        return `<a href="./salaries/${data}/approve">Duyệt</a>`;
                                    } else {
                                        return null;
                                    }

                                }
                            }

                        ]
                });
            })


        </script>
    @endpush
@endsection




