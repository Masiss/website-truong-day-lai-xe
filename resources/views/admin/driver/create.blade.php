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
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Thêm học viên</h4>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form enctype="multipart/form-data" id="form-data-1" class="needs-validation"
                                      name="form1" novalidate>
                                    <div class="row">
                                        @csrf
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
                                                name="birthdate"
                                                id="fp-human-friendly"
                                                class="form-control flatpickr-human-friendly"
                                                placeholder="October 14, 2020"
                                            />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email</div>

                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="phone_numbers">Số điện thoại</label>

                                            <input
                                                type="number"
                                                id="phone_numbers"
                                                class="form-control"
                                                placeholder="Số điện thoại"
                                                name="phone_numbers"
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
                                                name="email"
                                                required
                                            />
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email</div>
                                        </div>

                                        <div class="col-xl-5 col-md-6 col-sm-12 mb-2">
                                            <label for="customFile1" class="form-label">File hình thẻ</label>
                                            <input class="form-control" name="file" type="file" id="file" required/>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Đăng ký buổi học</h4>
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
                                <form enctype="multipart/form-data" id="form-data-2" class="needs-validation"
                                      novalidate>
                                    <div class="row">
                                        @csrf
                                        <div class="col-xl-3 col-md-6 col-sm-12 mb-1">
                                            <label class="form-label" class="d-block">Trọn gói</label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check my-50">
                                                    <input
                                                        value="true"
                                                        type="radio"
                                                        name="is_full"
                                                        class="form-check-input"
                                                        required
                                                    />
                                                    <label class="form-check-label" for="validationRadio3">Có</label>
                                                </div>
                                                <div class="form-check my-50">
                                                    <input
                                                        value="false"
                                                        type="radio"
                                                        name="is_full"
                                                        class="form-check-input"
                                                        required
                                                    />
                                                    <label class="form-check-label" for="validationRadio4">Không</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-1">
                                            <label class="form-label" for="select2-limited">Chọn thứ</label>
                                            <select name="days_of_week" class="max-length form-select"
                                                    id="select2-limited" multiple>
                                                <optgroup label="Thứ">
                                                    <option value="t2">Thứ 2</option>
                                                    <option value="t3">Thứ 3</option>
                                                    <option value="t4">Thứ 4</option>
                                                    <option value="t5">Thứ 5</option>
                                                    <option value="t6">Thứ 6</option>
                                                    <option value="t7">Thứ 7</option>
                                                    <option value="cn">Chủ nhật</option>
                                                </optgroup>

                                            </select>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email</div>
                                        </div>
                                        <!-- Basic Select -->
                                        <div class="col-xl-5 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="basicSelect">Thời gian mỗi buổi</label>
                                            <select name="time" class="form-select" id="basicSelect">
                                                <option value="2">2 tiếng</option>
                                                <option value="4">4 tiếng</option>
                                            </select>
                                            <div class="valid-feedback">Looks good!</div>
                                            <div class="invalid-feedback">Please enter a valid email</div>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="disabledInput">Số buổi</label>
                                                <input name="days" type="number" value="20" class="form-control"
                                                       id="disabledInput"
                                                       disabled/>
                                                <div class="valid-feedback">Looks good!</div>
                                                <div class="invalid-feedback">Please enter a valid email</div>
                                            </div>
                                        </div>
                                        <div class="col-xl-1 center-layout">
                                            <button class="btn btn-primary " id="btn-submit">Submit
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
        // Page JS
        <script src={{asset('js/picker.js')}}></script>
        <script src={{asset('js/picker.date.js')}}></script>
        <script src={{asset('js/picker.time.js')}}></script>
        <script src={{asset('js/legacy.js')}}></script>
        <script src={{asset('js/flatpickr.min.js')}}></script>
        <script src={{asset('js/form-pickers.min.js')}}></script>
        <script src={{asset('js/select2.full.min.js')}}></script>
        <script src={{asset('js/form-select2.min.js')}}></script>
        <script type="text/javascript">
            // dateValidate = function (form) {
            //     let pick = Date.parse($('#fp-human-friendly').val()),
            //         today = new Date(),
            //         dateDiff = Math.floor(today - pick) / 1000 / 60 / 60 / 24 / 365;
            //     $('#fp-human-friendly').closest(".invalid-feedback").show("fast");
            //     if (dateDiff < 18) {
            //         form.classList.add('invalid');
            //     }
            //     form.classList.add('was-validated');
            // }
            $(document).ready(function () {
                $("#btn-submit").click(function (event) {
                    var form = document.getElementById('form-data-1');
                    // dateValidate(form);
                    form.dispatchEvent(new Event('submit'));
                    // event.preventDefault();
                    var data = document.getElementsByName('_token').values();
                    var data1 = "{{@csrf_token()}}";
                    var form1 = new FormData(document.getElementById('form-data-1'));
                    var form2 = new FormData(document.getElementById('form-data-2'));
                    for (value of form2) {
                        form1.append(value[0], value[1]);
                    }
                    var day = $('input[name="days"]').val();
                    var time = $('select[name="time"]').val();
                    form1.append('hours', day * time);


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        url: '{{route('admin.drivers.store')}}',
                        type: 'POST',
                        dataType: "JSON",
                        data: form1,
                        // "'X-CSRF-TOKEN'": data1,

                        contentType: false,
                        processData: false,

                    })
                        .done(function () {
                            location.href = "{{route('admin.drivers.store')}}";
                        })
                        .fail(function () {
                        });
                })
            });
        </script>
        <script src={{asset('js/form-validation.js')}}></script>

    @endpush
@endsection
