@extends('layout.master')
@push('vendor')
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/flatpickr.min.css')}}">

    {{--        <link rel="stylesheet" type="text/css" href="{{asset('css/pickadate.css')}}">--}}

    {{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">--}}
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-flat-pickr.min.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/form-pickadate.min.css')}}">--}}

@endpush
@section('content')

    <div class="content-body">
        <section class="bs-validation">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm học viên</h4>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate>
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
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-sm-12 mb-1">
                                        <label class="form-label" class="d-block">Giới tính</label>
                                        <div class="demo-inline-spacing">
                                            <div class="form-check my-50">
                                                <input
                                                    type="radio"
                                                    name="gender"
                                                    class="form-check-input"
                                                    required
                                                />
                                                <label class="form-check-label" for="validationRadio3">Nam</label>
                                            </div>
                                            <div class="form-check my-50">
                                                <input
                                                    type="radio"
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
                                            id="dob"
                                            class="form-control flatpickr-human-friendly"
                                            placeholder="October 14, 2020"
                                        />
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="phone_numbers">Số điện thoại</label>

                                        <input
                                            type="number"
                                            id="phone_numbers"
                                            class="form-control"
                                            placeholder="Số điện thoại"
                                            name="id_numbers"
                                            required
                                        />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="id_numbers">CCCD/CMND</label>

                                        <input
                                            type="number"
                                            id="id_numbers"
                                            class="form-control"
                                            placeholder="Căn cước công dân"
                                            name="id_numbers"
                                            required
                                        />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your name.</div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input
                                            type="email"
                                            id="email"
                                            class="form-control"
                                            placeholder="email"
                                            name="Email"
                                            required
                                        />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter a valid email</div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="password">Mật khẩu</label>
                                        <input
                                            type="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="**************"
                                            name="password"
                                            required
                                        />
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please enter your password.</div>
                                    </div>

                                    <div class="col-xl-5 col-md-6 col-sm-12 mb-2">
                                        <label for="customFile1" class="form-label">File hình thẻ</label>
                                        <input class="form-control" name="file" type="file" id="file" required/>
                                    </div>
                                    <div class="col-xl-5 col-md-6 col-sm-12 mb-2">
                                        <label for="customFile1" class="form-label">File hình thẻ</label>
                                        <input class="form-control" name="file" type="file" id="file" required/>
                                    </div>
                                    <div>
                                        <label>Số buổi</label>
                                        <input >
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- /Bootstrap Validation -->
            </div>
        </section>
    </div>

    @push('javascript')
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>
        <!-- BEGIN: Page Vendor JS-->
        <script src="{{asset('js/picker.js')}}"></script>
        <script src="{{asset('js/picker.date.js')}}"></script>
        <script src="{{asset('js/picker.time.js')}}"></script>
        <script src="{{asset('js/legacy.js')}}"></script>
        <script src="{{asset('js/flatpickr.min.js')}}"></script>
        <!-- END: Page Vendor JS-->


        <!-- BEGIN: Page JS-->
        <script src="{{asset('js/form-pickers.min.js')}}"></script>
        <script src="{{asset('js/form-validation.js')}}"></script>

        <!-- END: Page JS-->

        </script>
    @endpush
@endsection
