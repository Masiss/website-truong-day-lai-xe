@php use App\Enums\GenderNameEnum; @endphp
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
                <form enctype="multipart/form-data" action="{{route('drivers.update')}}" method="POST" id="form-data-1"
                      class="needs-validation"
                      name="form1" novalidate>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cập nhật thông tin học viên</h4>
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
                                        <input value="{{$driver->id}}" name="id" hidden>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="name">Tên</label>

                                            <input
                                                value="{{$driver->name}}"
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
                                            <div class="demo-inline-spacing">
                                                <div class="form-check my-50">
                                                    <input
                                                        type="radio"
                                                        value="0"
                                                        name="gender"
                                                        class="form-check-input"
                                                        required
                                                    @if(!GenderNameEnum::TrueFalse($driver->gender))
                                                        {{"checked"}}
                                                        @endif
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
                                                    @if(GenderNameEnum::TrueFalse($driver->gender))
                                                        {{"checked"}}
                                                        @endif
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
                                                value="{{$driver->birthdateForEditing()}}"
                                                type="text"
                                                name="birthdate"
                                                id="fp-human-friendly"
                                                class="form-control picker flatpickr-human-friendly "
                                                placeholder=""
                                                required
                                            />
                                            <div class="valid-feedback"></div>
                                            <div class="invalid-feedback">Please enter your name.</div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="phone_numbers">Số điện thoại</label>

                                            <input
                                                value="{{$driver->phone_numbers}}"

                                                type="number"
                                                id="phone_numbers"
                                                class="form-control"
                                                placeholder="Số điện thoại"
                                                name="phone_numbers"
                                                required
                                            />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="id_numbers">CCCD/CMND</label>

                                            <input
                                                value="{{$driver->id_numbers}}"

                                                type="number"
                                                id="id_numbers"
                                                class="form-control"
                                                placeholder="Căn cước công dân"
                                                name="id_numbers"
                                                required
                                            />
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="email">Email</label>
                                            <input
                                                value="{{$driver->email}}"

                                                type="email"
                                                id="email"
                                                class="form-control"
                                                placeholder="email"
                                                name="email"
                                                required
                                            />
                                        </div>
                                        {{--                                        col-xl-5 col-md-6 col-sm-12 mb-2--}}
                                        <div class=" text-center col-xl-6 ">
                                            <label for="customFile1" class="form-label">File hình thẻ</label>
                                            <input value="{{$driver->file}}" class="form-control" name="file"
                                                   type="file" id="file"/>
                                            <img class="rounded d-block" src="{{$driver->file}}"
                                                 style="max-height: 20em;">
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin khóa học</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline">
                                        <li>
                                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-1">
                                            <label class="form-label" class="d-block">Trọn gói</label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check my-50">
                                                    @if($driver->is_full)
                                                        <label class="form-check-label"
                                                               for="validationRadio3">Có</label>
                                                    @else
                                                        <label class="form-check-label"
                                                               for="validationRadio4">Không</label>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="">Ngày học</label>
                                            <input
                                                value="{{$driver->days_of_week}}"
                                                type="text"
                                                class="form-control"
                                                required
                                                disabled
                                            />
                                        </div>
                                        <!-- Basic Select -->
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="last">Thời gian mỗi buổi</label>
                                            <select name="last" class="form-select" id="last" disabled>
                                                <option value="2">2 tiếng</option>
                                                <option value="4">4 tiếng</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="disabledInput">Số buổi</label>
                                                <input
                                                    name="lesson" type="number" value="20" class="form-control"
                                                    id="lesson"
                                                    disabled/>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
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
        <script type="text/javascript">
            {{--$(document).ready(function () {--}}
            {{--    $("#btn-submit").click(function (event) {--}}
            {{--        //validate--}}
            {{--        var form = document.getElementById('form-data-1');--}}
            {{--        form.dispatchEvent(new Event('submit'));--}}
            {{--        // for (var key of form.entries()) {--}}
            {{--        //     console.log(key[0] + ', ' + key[1])--}}
            {{--        // }--}}
            {{--        // Form data--}}
            {{--        var form1 = new FormData(document.getElementById('form-data-1'));--}}

            {{--        event.preventDefault();--}}
            {{--        //ajax--}}
            {{--        $.ajax({--}}
            {{--            headers: {--}}
            {{--                'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
            {{--            },--}}
            {{--            url: '{{route('admin.drivers.update',$driver->id)}}',--}}
            {{--            type: 'PUT',--}}
            {{--            dataType: "JSON",--}}
            {{--            data: form1,--}}

            {{--            contentType: false,--}}
            {{--            processData: false,--}}
            {{--            success: function (event) {--}}
            {{--                if (event == "1") {--}}
            {{--                    window.location = "{{route('admin.drivers.store')}}";--}}
            {{--                } else {--}}
            {{--                    console.log(0);--}}
            {{--                }--}}
            {{--            },--}}
            {{--            error: function () {--}}
            {{--                console.log(0);--}}

            {{--            },--}}

            {{--        });--}}
            {{--    })--}}
            {{--});--}}
        </script>
        <script src={{asset('js/form-validation.js')}}></script>

    @endpush
@endsection
