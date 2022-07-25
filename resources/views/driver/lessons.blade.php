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
                            <a href="{{route('drivers.lessons.create')}}">

                                <i data-feather="plus-circle"></i>
                                <span>Thêm</span>
                            </a>
                        </div>
                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>Ngày</th>
                                <th>Giờ</th>
                                <th>Thời gian học</th>
                                <th>Tên giáo viên</th>
                                <th>Số điện thoại giáo viên</th>
                                <th>Email giáo viên</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($lessons as $lesson)
                            <tr>
                                <td>{{$lesson->date}}</td>
                                <td>{{$lesson->start_at}}</td>
                                <td>{{$lesson->last}}</td>
                                <td>{{$lesson->instructor->name}}</td>
                                <td>{{$lesson->instructor->phone_numbers}}</td>
                                <td>{{$lesson->instructor->email}}</td>
                                <td>{{$lesson->status}}</td>
                                <td>@if(\App\Enums\LessonStatusEnum::CanBeCancel($lesson->status))
                                        <a href=./lessons/{{$lesson->id}}/update>Hủy</a>
                                    @endif
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
            {{--        ajax: '{!! route('drivers.api') !!}',--}}
            {{--        order: [[0, 'asc'], [1, 'asc']],--}}
            {{--        columns:--}}
            {{--            [--}}
            {{--                {data: 'date', name: 'date'},--}}
            {{--                {data: 'start_at', name: 'start_at'},--}}
            {{--                {data: 'last', name: 'last'},--}}
            {{--                {data: 'name', name: 'name'},--}}
            {{--                {data: 'phone_numbers', name: 'phone_numbers'},--}}
            {{--                {data: 'email', name: 'email'},--}}
            {{--                {--}}
            {{--                    data: 'status',--}}
            {{--                    name: 'status',--}}
            {{--                },--}}
            {{--                {--}}
            {{--                    data: 'cancel',--}}
            {{--                    name: 'cancel',--}}
            {{--                    render: function (data) {--}}
            {{--                        if (data) {--}}
            {{--                            return `<a href=./lessons/${data}/update>Hủy</a>`;--}}

            {{--                        } else {--}}
            {{--                            return null;--}}
            {{--                        }--}}
            {{--                    }--}}
            {{--                }--}}


            {{--            ]--}}
            {{--    });--}}
            {{--})--}}


        </script>
    @endpush
@endsection




