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
                        <div class="mt-1">

                            <table class="table" id="table-data">
                                <thead>
                                <tr>
                                    <th>@sortablelink('date','Ngày')</th>
                                    <th>@sortablelink('start_at','Giờ')</th>
                                    <th>@sortablelink('driver.name','Tên học viên')</th>
                                    <th>Thời gian dạy</th>
                                    <th>Số điện thoại</th>
{{--                                    <th>Email</th>--}}
                                    <th>@sortablelink('status','Trạng thái')</th>
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
{{--                                        <td>{{$lesson->driver->email}}</td>--}}
                                        <td>{{$lesson->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <x-pagination :paginate="$lessons"/>

                </div>
            </div>

        </div>

    </div>

    @push('javascript')
    @endpush
@endsection




