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
                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>Tháng</th>
                                <th>Tổng buổi dạy</th>
                                <th>Tổng giờ dạy</th>
                                <th>Tổng lương</th>
                                <th>Trạng thái</th>
                                <th></th>
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
                    ajax: '{!! route('instructors.salaries.api') !!}',
                    columns:
                        [
                            {data: 'month', name: 'month'},
                            {data: 'total_lessons', name: 'total_lessons'},
                            {data: 'total_hours', name: 'total_hours'},
                            {data: 'total_salaries', name: 'total_salaries'},
                            {
                                data: 'status',
                                name: 'status',
                            },
                            {
                                data: 'show',
                                name: 'show',
                                render: function (data) {
                                    return `<a href="salaries/show/${data}">Chi tiết</a>`;
                                }
                            },


                        ]
                });
            })


        </script>
    @endpush
@endsection




