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
{{--    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">--}}

@endpush
@section('content')

    <div class="content-body">
        <section class="app-user-view-account">
            <div class="row">
                <!-- User Sidebar -->
                <div class="col-xl-5 col-lg-5 col-md-5 order-1 order-md-0">
                    <!-- User Card -->
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h4 class="card-title"> Giáo viên</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img
                                        class="img-fluid rounded mt-3 mb-2"
                                        src="{{$lesson->instructor->avatar}}"
                                        height="110"
                                        width="110"
                                        alt="User avatar"
                                    />
                                    <div class="user-info text-center">
                                        <h4>{{$lesson->instructor->name}}</h4>
                                        <span class="badge bg-light-secondary">{{$lesson->instructor->level}}</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fw-bolder border-bottom pb-50 mb-1">Chi tiết</h4>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Tên:</span>
                                        <span>{{$lesson->instructor->name}}</span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Email:</span>
                                        <span>{{$lesson->instructor->email}}</span>

                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Số điện thoại:</span>
                                        <span>{{$lesson->instructor->phone_numbers}}</span>

                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-7 col-lg-7 col-md-7 order-0 order-md-1">
                    @if($instructors)
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h4 class="card-title">Chọn giáo viên khác</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="user-avatar-section">
                                    <div class="d-flex align-items-center flex-column">
                                        <img
                                            id="img"
                                            class="img-fluid rounded mt-3 mb-2"
                                            src=""
                                            height="110"
                                            width="110"
                                            alt="User avatar"
                                        />
                                        <div class="user-info text-center">
                                            <h4></h4>
                                            <span class="badge bg-light-secondary">INSTRUCTOR</span>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="fw-bolder border-bottom pb-50 mb-1">Chi tiết</h4>
                                <div class="info-container">
                                    <ul class="list-unstyled">
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Tên:</span>
                                            <select id="name" class="form-select" required>
                                                @foreach($instructors as $instructor)
                                                    <option value="{{$instructor->id}}">{{$instructor->name}}</option>
                                                @endforeach
                                            </select>
                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Email:</span>
                                            <input id="email" class="form-control"
                                                   value="{{$instructor->first()->email}}"
                                            readonly
                                            >

                                        </li>
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Số điện thoại:</span>
                                            <input id="phone_numbers" class="form-control"
                                                   value="{{$instructor->first()->phone_numbers}}"
                                                   readonly
                                            >

                                        </li>
                                    </ul>
                                    <div class="col-xl-12">
                                        <form action="">

                                        </form>
                                        <button id="btn-change" class="btn btn-primary">
                                            Đổi
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @endif

                        <!-- /Invoice table -->
                </div>
                <div class="col-xl-9 col-lg-5 col-md-5 order-1 order-md-0">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <h4 class="card-title">Chi tiết buổi học</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="user-avatar-section">
                                <div class="d-flex align-items-center flex-column">
                                    <img
                                        id="img"
                                        class="img-fluid rounded mt-3 mb-2"
                                        src=""
                                        height="110"
                                        width="110"
                                        alt="User avatar"
                                    />
                                    <div class="user-info text-center">
                                        <h4></h4>
                                        <span class="badge bg-light-secondary">INSTRUCTOR</span>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fw-bolder border-bottom pb-50 mb-1">Chi tiết</h4>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Thời gian:</span>
                                        <input class="form-control" id="last" name="last">
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Bắt đầu lúc:</span>
                                        <input class="form-control" id="start_at" name="start_at">


                                    </li>
                                    @if(!\App\Enums\LessonStatusEnum::CanBeCancel($lesson->id))
                                    <li class="mb-75">
                                        <h4 class="fw-bolder me-25">Đánh giá:</h4>
                                        @include('layout.rating')
                                    </li>
                                        @endif
                                </ul>
                                <div class="col-xl-12 ">
                                    <form>
                                        <button id="btn-change" class="btn btn-primary">
                                            Đổi
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>
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
        <script type="text/javascript">
            let name = document.getElementById('name'),
                email = document.getElementById('email'),
                phone_numbers = document.getElementById('phone_numbers'),
                img = document.getElementById('img'),
                btn = document.getElementById('btn-change');
            name.addEventListener('change', function () {
                let id = name.value;
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{route('drivers.newInsApi')}}",
                    // method: "POST",
                    data: {id},
                    dataType: "JSON",
                    success: function (event) {
                        email.value = event.email;
                        phone_numbers.value = event['phone_numbers'];
                        img.src = event.avatar;
                    }
                });

                // request.done(function( msg ) {
                //     $( "#log" ).html( msg );
                // });
                //
                // request.fail(function( jqXHR, textStatus ) {
                //     alert( "Request failed: " + textStatus );
                // });
            })
        </script>
        <script src={{asset('js/form-validation.js')}}></script>

    @endpush
@endsection
