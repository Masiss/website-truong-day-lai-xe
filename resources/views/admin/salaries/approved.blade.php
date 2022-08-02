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
                                <th>#</th>
                                <th>Tên giáo viên</th>
                                <th>Tháng</th>
                                <th>Tổng buổi dạy</th>
                                <th>Tổng giờ dạy</th>
                                <th>Tổng lương</th>
                                <th>Thời gian tạo</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($month_salaries as $month_salary)
                                <tr>
                                    <td>{{$month_salary->id}}</td>
                                    <td>{{$month_salary->instructorWithTrashed->name}}</td>
                                    <td>{{$month_salary->month}}</td>
                                    <td>{{$month_salary->total_lessons}}</td>
                                    <td>{{$month_salary->total_hours}}</td>
                                    <td>{{$month_salary->total_salaries}}</td>
                                    <td>{{$month_salary->created_at}}</td>
                                    <td>{{$month_salary->status}}</td>
                                    <td>
                                        @if(!$month_salary->instructorWithTrashed->deleted_at)
                                            <a href="./{{$month_salary->id}}/">Chi tiết</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginate="$month_salaries"/>
                </div>
            </div>

        </div>

    </div>

    @push('javascript')

    @endpush
@endsection




