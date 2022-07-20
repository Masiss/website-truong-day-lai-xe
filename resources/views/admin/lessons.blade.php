@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="d-flex">
                    <div>
                        <button id="all" value="all" class="btn">Tất cả</button>
                    </div>
                    <div>
                        <button id="today" value="today" class="btn">Hôm nay</button>
                    </div>
                    <div>
                        <button id="this_week" value="this_week" class="btn">Tuần này</button>
                    </div>
                    <div>
                        <button id="this_month" value="this_month" class="btn">Tháng này</button>
                    </div>

                </div>
                <div class="col-md-12">

                    <div class="card">

                        <table class="table " id="table-data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên học viên</th>
                                <th>Tên giáo viên</th>
                                <th>Thời gian học</th>
                                <th>Thời gian bắt đầu</th>
                                <th>Đánh giá</th>
                                <th>Trạng thái</th>
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
                let today = document.getElementById('today'),
                    this_week = document.getElementById('this_week'),
                    this_month = document.getElementById('this_month'),
                    all = document.getElementById('all');
                [today, this_week, this_month, all].map(element => element.addEventListener("click", function () {
                    let table = $('#table-data').DataTable();
                    table.destroy();
                    $('#table-data').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            "url": '{!! route('admin.lessons.api') !!}',
                            "data": {
                                limit: this.value,
                            }
                        },
                        order: [[4, 'asc']],
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'driver_name', name: 'driver_name'},
                            {data: 'ins_name', name: 'ins_name'},
                            {data: 'last', name: 'last'},
                            {data: 'date', name: 'date'},
                            {data: 'rating', name: 'rating'},
                            {data: 'status', name: 'status'},

                        ]
                    })
                }))
            })


        </script>
    @endpush
@endsection
