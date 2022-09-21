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
                                    <li value="{{$instructor->id}}" id="id" hidden></li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Tên:</span>
                                        <span>{{$instructor->name}}</span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Giới tính:</span>
                                        <span>{{$instructor->gender}}</span>

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
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Chi tiết</h4>
                            <small>
                                <i>*Những dòng bên dưới không thể sửa*</i>
                            </small>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2 pb-50">
                                        <h5>Tổng số buổi đã dạy</h5>
                                        <input class="form-control-sm"
                                               value="{{$month_salary->total_lessons}}"
                                               readonly
                                        >
                                    </div>
                                    <div class="mb-2 pb-50">
                                        <h5>Đánh giá trung bình</h5>
                                        <input class="form-control-sm"
                                               value="{{$detail_salary->rating}}"
                                               readonly

                                        >
                                    </div>
                                    <div class="mb-2 mb-md-1">
                                        <h5>Lương cuối </h5>
                                        <input class="form-control-sm"
                                               value="{{$detail_salary->total}}"
                                               readonly
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ User Sidebar -->


                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Project table -->
                    <div class="card">
                        <h4 class="card-header">Số buổi dạy: {{$month_salary->total_lessons}}</h4>
                        <div id="list-lesson" class="table-responsive">

                        </div>
                        <x-pagination :paginate="$lessons"/>
                    </div>
                    <!-- /Project table -->
                    <!-- current plan -->
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lương</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="./approve">
                                    @if(!\App\Enums\SalaryStatusEnum::checkApproved($month_salary->status))
                                        @csrf
                                        @method('PUT')
                                    @endif
                                    <div class="col-md-6">
                                        <div class="mb-2 pb-50">
                                            <h5>Lương ban đầu</h5>
                                            <input class="form-control"
                                                   name="base"
                                                   id="base"
                                                   value="{{$detail_salary->base}}"
                                                   required
                                            >

                                            <small>
                                                <i>*Được tính bằng công thức: Lương = tổng buổi đã dạy x lương mỗi
                                                    buổi</i>
                                            </small>
                                        </div>
                                        <div class="mb-2 pb-50">
                                            <h5>Lương bị trừ</h5>
                                            <input class="form-control"
                                                   id="minus"
                                                   name="minus"
                                                   value="{{$detail_salary->minus}}"
                                                   required
                                            >
                                            <small>
                                                <i>*Được tính bằng công thức: Lương bị trừ = (5 - điểm đánh giá) x
                                                    lương
                                                    vi phạm</i>
                                            </small>
                                        </div>
                                        <div class="mb-2 mb-md-1">
                                            <h5>Lương cuối </h5>
                                            <input class="form-control"
                                                   id="total"
                                                   name="total"
                                                   value="{{$detail_salary->total}}"
                                                   required
                                            >
                                        </div>
                                    </div>
                                    @if(!\App\Enums\SalaryStatusEnum::checkApproved($month_salary->status))

                                        <div class="col-12">
                                            <button class="btn btn-primary me-1 mt-1">
                                                Duyệt
                                            </button>
                                        </div>
                                    @endif
                                    @foreach($errors->all() as $message)
                                        <span class="alert alert-danger">{{$message}}</span>
                                    @endforeach
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- / current plan -->
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
        {{--                <script src={{asset('js/flatpickr.min.js')}}></script>--}}
        {{--        <script src={{asset('js/form-pickers.min.js')}}></script>--}}
        {{--        <script src={{asset('js/select2.full.min.js')}}></script>--}}
        {{--        <script src={{asset('js/jquery.validate.min.js')}}></script>--}}
        {{--        <script src={{asset('js/form-select2.min.js')}}></script>--}}
        <script type="text/javascript">
            let a = document.getElementById('base'),
                b = document.getElementById('minus'),
                c = document.getElementById('total');
            [a, b].forEach(e => e.addEventListener('keyup', function () {
                c.value = a.value - b.value;
            }))
            window.onload = function () {
                let id = document.getElementById('id').value;
                $.ajax({
                    header: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                    },
                    url: '{{route('admin.salaries.lessons.api',)}}',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        document.getElementById('list-lesson').innerHTML = data;
                    }
                })
            }
        </script>
        {{--        <script src={{asset('js/form-validation.js')}}></script>--}}

    @endpush
@endsection
