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
                        <span class="alert alert-success">{{session()->get('status')}}</span>
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
                            <tbody>
                            @foreach($month_salaries as $month_salary)
                                <tr>
                                    <td>{{$month_salary->id}}</td>
                                    <td>{{$month_salary->instructor->name}}</td>
                                    <td>{{$month_salary->month}}</td>
                                    <td>{{$month_salary->total_lessons}}</td>
                                    <td>{{$month_salary->total_hours}}</td>
                                    <td>{{$month_salary->total_salaries}}</td>
                                    <td>{{$month_salary->created_at}}</td>
                                    <td>{{$month_salary->status}}</td>
                                    <td><a href="./{{$month_salary->id}}/">Chi tiết</a></td>
                                    <td>@if(!\App\Enums\SalaryStatusEnum::checkApproved($month_salary->status))
                                            <a href="./{{$month_salary->id}}/approve">Duyệt</a>
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




