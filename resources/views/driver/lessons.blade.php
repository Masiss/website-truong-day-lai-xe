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
                            <button class="btn btn-primary">
                                <a class="text-white" href="{{route('drivers.lessons.create')}}">
                                    <i data-feather="plus-circle"></i>
                                    <span>Thêm</span>
                                </a>
                            </button>
                        </div>
                        <span class="alert alert-success">{{session()->get('status')}}</span>
                        <span class="alert alert-danger">@error('message'){{$message}}@enderror</span>

                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>@sortablelink('date','Ngày')</th>
                                <th>@sortablelink('start_at','Giờ')</th>
                                <th>Thời gian học</th>
                                <th>Tên giáo viên</th>
                                <th>Số điện thoại giáo viên</th>
                                <th>@sortablelink('status','Trạng thái')</th>
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
                                    {{--                                <td>{{$lesson->instructor->email}}</td>--}}
                                    <td>{{$lesson->status}}</td>
                                    <td><a href="./lessons/{{$lesson->id}}/edit">Sửa</a></td>
                                    <td>@if(\App\Enums\LessonStatusEnum::CanBeCancelled($lesson->status))
                                            <a href="{{route('drivers.lessons.cancel',$lesson->id)}}">Hủy</a>
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

    @endpush
@endsection




