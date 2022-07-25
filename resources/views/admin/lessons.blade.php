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
                        <a href="?choose=all" id="all" value="all" class="btn">Tất cả</a>
                    </div>
                    <div>
                        <a href="?choose=today" id="today" value="today" class="btn">Hôm nay</a>
                    </div>
                    <div>
                        <a href="?choose=this_week" id="this_week" value="this_week" class="btn">Tuần này</a>
                    </div>
                    <div>
                        <a href="?choose=this_month" id="this_month" value="this_month" class="btn">Tháng này</a>
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
                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <td>{{$lesson->id}}</td>
                                    <td>{{$lesson->driver->name}}</td>
                                    <td>{{$lesson->instructor->name}}</td>
                                    <td>{{$lesson->last}}</td>
                                    <td>{{$lesson->start_at}}</td>
                                    <td>{{$lesson->rating}}</td>
                                    <td>{{$lesson->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginate="$lessons"/>

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


                }))
            })


        </script>
    @endpush
@endsection
