@extends('layout.master')
@push('vendor')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/flatpickr.min.css')}}">
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-pickadate.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <section class="app-user-view-account">
            <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card">
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img
                                        class="img-fluid rounded mt-3 mb-2"
                                        src="{{$instructor->avatar}}"
                                        height="110"
                                        width="110"
                                        alt="User avatar"
                                    />
                                    <div class="user-info text-center">
                                        <h4>{{$instructor->name}}</h4>
                                        <span class="badge bg-light-secondary">{{$instructor->level}}</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fw-bolder border-bottom pb-50 mb-1">Chi tiết</h4>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Tên:</span>
                                        <span>{{$instructor->name}}</span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Giới tính:</span>
                                        <span>{{$instructor->gender}}</span>

                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Ngày sinh:</span>
                                        <span>{{$instructor->birthdate}}</span>

                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Email:</span>
                                        <span>{{$instructor->email}}</span>

                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Số điện thoại:</span>
                                        <span>{{$instructor->phone_numbers}}</span>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Project table -->
                    <div class="card">
                        <h4 class="card-header">Các buổi học</h4>
                        <div class="table-responsive">
                            <table class="table datatable-project">
                                <thead>
                                <tr>
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
                                        <td>{{$lesson->driver->name}}</td>
                                        <td>{{$lesson->last}}</td>
                                        <td>{{$lesson->start_at ." ". $lesson->date}}</td>
                                        <td>{{$lesson->report}}</td>
                                        <td>{{$lesson->status}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <x-pagination :paginate="$lessons"/>

                        </div>
                    </div>
                    <!-- /Project table -->
                    <!-- Invoice table -->
                    <div class="card">
                        <div class="card-header pt-1 pb-25">
                            <div class="head-label">
                                <h4 class="card-title">
                                    Bảng lương
                                </h4>
                            </div>
                        </div>
                        <table class="invoice-table table text-nowrap">
                            <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Tháng</th>
                                <th>Số buổi</th>
                                <th>Số giờ</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($month_salaries as $month_salary)
                                <tr>
                                    <td>{{$month_salary->id}}</td>
                                    <td>{{$month_salary->month}}</td>
                                    <td>{{$month_salary->total_lessons}}</td>
                                    <td>{{$month_salary->total_hours}}</td>
                                    <td>{{$month_salary->total_salaries}}</td>
                                    <td>{{$month_salary->status}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /Invoice table -->
                </div>
                <!--/ User Content -->
            </div>
        </section>
    </div>

    @push('javascript')
        // Page JS
        {{--        <script src={{asset('js/picker.js')}}></script>--}}
        {{--        <script src={{asset('js/picker.date.js')}}></script>--}}
        {{--        <script src={{asset('js/picker.time.js')}}></script>--}}
        {{--        <script src={{asset('js/legacy.js')}}></script>--}}
        {{--        <script src={{asset('js/flatpickr.min.js')}}></script>--}}
        {{--        <script src={{asset('js/form-pickers.min.js')}}></script>--}}
        {{--        <script src={{asset('js/select2.full.min.js')}}></script>--}}
        {{--        <script src={{asset('js/jquery.validate.min.js')}}></script>--}}
        {{--        <script src={{asset('js/form-select2.min.js')}}></script>--}}
        {{--        <script type="text/javascript">--}}

        {{--        </script>--}}
        {{--        <script src={{asset('js/form-validation.js')}}></script>--}}

    @endpush
@endsection
