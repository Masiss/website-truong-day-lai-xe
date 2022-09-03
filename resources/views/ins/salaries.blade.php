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
                                <th>@sortablelink('month','Tháng')</th>
                                <th>@sortablelink('total_lessons','Tổng buổi dạy')</th>
                                <th>@sortablelink('total_hours','Tổng giờ dạy')</th>
                                <th>@sortablelink('total_salaries','Tổng lương')</th>
                                <th>@sortablelink('status','Trạng thái')</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($salaries as $salary)
                                <tr>
                                    <td>{{$salary->month}}</td>
                                    <td>{{$salary->total_lessons}}</td>
                                    <td>{{$salary->total_hours}}</td>
                                    <td>{{$salary->total_salaries}}</td>
                                    <td>{{$salary->status}}</td>
                                    <td>
                                        <a href="salaries/show/{{$salary->id}}">Chi tiết</a>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginate="$salaries"/>

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

            {{--$(function () {--}}
            {{--    $('#table-data').DataTable({--}}
            {{--        processing: true,--}}
            {{--        serverSide: true,--}}
            {{--        ajax: '{!! route('instructors.salaries.api') !!}',--}}
            {{--        columns:--}}
            {{--            [--}}
            {{--                {data: 'month', name: 'month'},--}}
            {{--                {data: 'total_lessons', name: 'total_lessons'},--}}
            {{--                {data: 'total_hours', name: 'total_hours'},--}}
            {{--                {data: 'total_salaries', name: 'total_salaries'},--}}
            {{--                {--}}
            {{--                    data: 'status',--}}
            {{--                    name: 'status',--}}
            {{--                },--}}
            {{--                {--}}
            {{--                    data: 'show',--}}
            {{--                    name: 'show',--}}
            {{--                    render: function (data) {--}}
            {{--                        return `<a href="salaries/show/${data}">Chi tiết</a>`;--}}
            {{--                    }--}}
            {{--                },--}}


            {{--            ]--}}
            {{--    });--}}
            {{--})--}}


        </script>
    @endpush
@endsection




