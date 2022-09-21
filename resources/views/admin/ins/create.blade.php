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
        <section class="bs-validation">
            <div class="row">
                <form enctype="multipart/form-data" id="form-data-1" class="needs-validation"
                      name="form1" novalidate>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thêm giáo viên</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <span id="success" class="alert alert-success"></span>
                            </div>

                            @csrf

                            <div class="card-content collapse show">

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="name">Tên</label>

                                            <input
                                                type="text"
                                                id="name"
                                                class="form-control"
                                                placeholder="Họ và tên"
                                                name="name"
                                                required
                                            />
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">Vui lòng điền tên.</div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12 mb-1">
                                            <label class="form-label" class="d-block">Giới tính</label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check my-50">
                                                    <input
                                                        type="radio"
                                                        value="0"
                                                        name="gender"
                                                        class="form-check-input"
                                                        required
                                                    />
                                                    <label class="form-check-label" for="validationRadio3">Nam</label>
                                                </div>
                                                <div class="form-check my-50">
                                                    <input
                                                        type="radio"
                                                        value="1"
                                                        name="gender"
                                                        class="form-check-input"
                                                        required
                                                    />
                                                    <label class="form-check-label" for="validationRadio4">Nữ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 mb-1">
                                            <label class="form-label" for="dob">
                                                Ngày tháng năm sinh
                                            </label>

                                            <input
                                                type="text"
                                                name="birthdate"
                                                id="fp-human-friendly"
                                                class="form-control picker flatpickr-human-friendly "
                                                placeholder=""
                                                required
                                            />
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="phone_numbers">Số điện thoại</label>

                                            <input
                                                type="number"
                                                id="phone_numbers"
                                                class="form-control"
                                                placeholder="Số điện thoại"
                                                name="phone_numbers"
                                                required
                                            />
                                            <div class="invalid-feedback">Vui lòng điền số điện thoại.</div>
                                        </div>

                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input
                                                type="email"
                                                id="email"
                                                class="form-control"
                                                placeholder="email"
                                                name="email"
                                                required
                                            />
                                            <div class="invalid-feedback">Vui lòng điền email</div>
                                        </div>
                                        <div class="col-xl-5 col-md-6 col-sm-12 mb-2">
                                            <label for="customFile1" class="form-label">File hình thẻ</label>
                                            <input class="form-control" name="avatar" type="file" id="file"/>
                                        </div>
                                        <div class="col-xl-1 center-layout">
                                            <button class="btn btn-primary " id="btn-submit">
                                                Submit
                                            </button>
                                        </div>


                                    </div>
                                </div>

                            </div>


                        </div>


                    </div>
                </form>
                <!-- /Bootstrap Validation -->
            </div>
        </section>
    </div>

    @push('javascript')
        // Page JS
        <script src={{asset('js/picker.js')}}></script>
        <script src={{asset('js/picker.date.js')}}></script>
        {{--        <script src={{asset('js/picker.time.js')}}></script>--}}
        <script src={{asset('js/legacy.js')}}></script>
        <script src={{asset('js/flatpickr.min.js')}}></script>
        {{--        <script src={{asset('js/form-pickers.min.js')}}></script>--}}
        <script src={{asset('js/select2.full.min.js')}}></script>
        <script src={{asset('js/jquery.validate.min.js')}}></script>
        <script src={{asset('js/form-select2.min.js')}}></script>
        <script src={{asset('js/form-validation.js')}}></script>
        <script type="text/javascript">

            $(document).ready(function () {
                $("#btn-submit").click(function (event) {
                    //validate
                    var form = document.getElementById('form-data-1');
                    form.dispatchEvent(new Event('submit'));
                    // Form data
                    var form1 = new FormData(document.getElementById('form-data-1'));
                    event.preventDefault();
                    //ajax
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{route('admin.instructors.store')}}',
                        type: 'POST',
                        dataType: "JSON",
                        data: form1,
                        contentType: false,
                        processData: false,
                        success: function (event) {
                            document.getElementById('success').innerHTML = event.status;
                            setTimeout(function () {
                                window.location = "{{route('admin.instructors.store')}}";

                            }, 3000)
                        },
                        error: function () {
                            console.log(0);
                        },

                    });
                })
            });
            var picker = $('.picker');
            window.onload = function () {
                if (picker.length) {
                    let now = new Date(),
                        currY = now.getFullYear(),
                        currM = now.getMonth(),
                        currD = now.getDate(),
                        max = currY - 18,
                        min = currY - 70;
                    flatpickr('#fp-human-friendly', {
                        maxDate: new Date(max, currM, currD),
                        minDate: new Date(min, currM, currD),
                        allowInput: true,
                    });
                }
            }
        </script>

    @endpush
@endsection
