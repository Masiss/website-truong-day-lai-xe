@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="card">
                @error('message')
                    <span class="alert m-1 ">{{$message}}</span>
                @enderror
                <div class="col-md-12">
                    <div class="card">
                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Tên học viên</th>
                                <th>Thời gian dạy</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lessons as $lesson)
                                <tr>
                                    <td>{{$lesson->date}}</td>
                                    <td>{{$lesson->start_at}}</td>
                                    <td>{{$lesson->driver->name}}</td>
                                    <td>{{$lesson->last}}</td>
                                    <td>{{$lesson->driver->phone_numbers}}</td>
                                    <td>{{$lesson->driver->email}}</td>
                                    <td>{{$lesson->status}}</td>
                                    <td>
                                        <a href="./checkin/{{$lesson->id}}" class="btn">Checkin</a>
                                    </td>
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

            {{--$(function () {--}}
            {{--    $('#table-data').DataTable({--}}
            {{--        processing: true,--}}
            {{--        serverSide: true,--}}
            {{--        ajax: '{!! route('instructors.checkinAPI') !!}',--}}
            {{--        order: [[0, 'asc'], [1, 'asc'], [6, 'asc']],--}}
            {{--        columns:--}}
            {{--            [--}}
            {{--                {data: 'date', name: 'date'},--}}
            {{--                {data: 'start_at', name: 'start_at'},--}}
            {{--                {data: 'name', name: 'name'},--}}
            {{--                {data: 'last', name: 'last'},--}}
            {{--                {data: 'phone_numbers', name: 'phone_numbers'},--}}
            {{--                {data: 'email', name: 'email'},--}}
            {{--                {--}}
            {{--                    data: 'status',--}}
            {{--                    name: 'status',--}}
            {{--                },--}}
            {{--                {--}}
            {{--                    data: 'checkin',--}}
            {{--                    name: 'checkin',--}}
            {{--                    render: function (data, type, row, meta) {--}}
            {{--                        return data ? ` <a href="./checkin/${data}" class="btn">Checkin</a>` : null;--}}
            {{--                    },--}}

            {{--                },--}}


            {{--            ]--}}
            {{--    });--}}
            {{--})--}}


        </script>
    @endpush
@endsection




