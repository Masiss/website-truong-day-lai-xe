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
                <form enctype="multipart/form-data" action="{{route('admin.instructors.update',$instructor->id)}}" method="POST" id="form-data-1" class="needs-validation"
                      name="form1" novalidate>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cập nhật thông tin giáo viên</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @csrf
                            @method('PUT')
                            <div class="card-content collapse show">

                                <div class="card-body">

                                    <div class="row">
                                        <input value="{{$instructor->id}}" name="id" hidden>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="name">Tên</label>

                                            <input
                                                value="{{$instructor->name}}"
                                                type="text"
                                                id="name"
                                                class="form-control"
                                                placeholder="Họ và tên"
                                                name="name"
                                                required
                                            />
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">Please enter your name.</div>
                                        </div>
                                        <div class="col-xl-3 col-md-6 col-sm-12 mb-1">
                                            <label class="form-label" class="d-block">Giới tính</label>
                                            <input
                                                value="{{$instructor->gender}}"

                                                type="text"
                                                id="gender"
                                                class="form-control"
                                                placeholder="Giới tính"
                                                name="gender"
                                                required
                                                disabled
                                            />
                                        </div>
                                        <div class="col-xl-4 col-md-6 mb-1">
                                            <label class="form-label" for="dob">
                                                Ngày tháng năm sinh
                                            </label>

                                            <input
                                                value="{{$instructor->birthdate}}"

                                                type="text"
                                                name="birthdate"
                                                id="fp-human-friendly"
                                                class="form-control picker flatpickr-human-friendly "
                                                placeholder=""
                                                required
                                                disabled
                                            />
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">Please enter your name.</div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="phone_numbers">Số điện thoại</label>

                                            <input
                                                value="{{$instructor->phone_numbers}}"

                                                type="number"
                                                id="phone_numbers"
                                                class="form-control"
                                                placeholder="Số điện thoại"
                                                name="phone_numbers"
                                                required
                                            />
                                            <div class="invalid-feedback">Please enter your name.</div>
                                        </div>


                                        {{--                                        col-xl-5 col-md-6 col-sm-12 mb-2--}}
                                        <div class=" text-center col-xl-6 ">
                                            <label for="customFile1" class="form-label">Avatar</label>
                                            <input value="" class="form-control" name="avatar"
                                                   type="file" id="Avatar"/>
                                            <img class="rounded d-block" src="{{$instructor->avatar}}"
                                                 style="max-height: 20em;">
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-primary " id="btn-submit">
                                                Cập nhật
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
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>
        // Page JS
        <script src={{asset('js/picker.js')}}></script>
        <script src={{asset('js/picker.date.js')}}></script>
        <script src={{asset('js/picker.time.js')}}></script>
        <script src={{asset('js/legacy.js')}}></script>
        <script src={{asset('js/flatpickr.min.js')}}></script>
        <script src={{asset('js/form-pickers.min.js')}}></script>
        <script src={{asset('js/select2.full.min.js')}}></script>
        <script src={{asset('js/jquery.validate.min.js')}}></script>
        <script src={{asset('js/form-select2.min.js')}}></script>

        <script src={{asset('js/form-validation.js')}}></script>

    @endpush
@endsection
