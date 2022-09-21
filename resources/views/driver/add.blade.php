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
                <form enctype="multipart/form-data" action="{{route('drivers.lessons.store')}}"
                      method="POST" id="form-data-1" class="needs-validation"
                      name="form1" novalidate>

                    <div class="col-md-12 ">

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
                            <div class="card-content collapsed">
                                <div class="card-body">
                                    <div class="row">
                                        @csrf
                                        @method('POST')
                                        <div class="col-xl-3 col-md-6 col-sm-12 mb-1">
                                            <label class="form-label" class="d-block">Trọn gói</label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check my-50">
                                                    <input
                                                        value="1"
                                                        type="radio"
                                                        name="is_full"
                                                        class="form-check-input"
                                                        required
                                                    />
                                                    <label class="form-check-label" for="validationRadio3">Có</label>
                                                </div>
                                                <div class="form-check my-50">
                                                    <input
                                                        value="0"
                                                        type="radio"
                                                        name="is_full"
                                                        class="form-check-input"
                                                        required
                                                    />
                                                    <label class="form-check-label" for="validationRadio4">Không</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3">
                                            <label class="form-label">Loại bằng</label>
                                            <select class="form-control" name="type">
                                                <option value="0">B1</option>
                                                <option value="1">B2</option>
                                                <option value="2">C</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-1">
                                            <label class="form-label" for="select2-limited">Chọn thứ</label>
                                            <select name="days_of_week[]"
                                                    class="max-length form-select form-control select2"
                                                    id="select2-limited" multiple required>
                                                <optgroup label="Thứ">
                                                    <option value="Mon">Thứ 2</option>
                                                    <option value="Tue">Thứ 3</option>
                                                    <option value="Wed">Thứ 4</option>
                                                    <option value="Thu">Thứ 5</option>
                                                    <option value="Fri">Thứ 6</option>
                                                    <option value="Sat">Thứ 7</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <!-- Basic Select -->
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="last">Thời gian mỗi buổi</label>
                                            <select name="last" class="form-select" id="last">
                                                <option value="2">2 tiếng</option>
                                                <option value="4">4 tiếng</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-sm-12 mb-2">
                                            <label class="form-label" for="shift">Ca</label>
                                            <select name="shift" class="form-select" id="shift">
                                                <option value="AM">Sáng</option>
                                                <option value="PM">Chiều</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-4 col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label">Số buổi</label>
                                                <div>
                                                    <span><b>Trọn gói:</b> 40 buổi/2 tiếng hoặc 20 buổi/4 tiếng</span>
                                                    <span><b>Không trọn gói:</b> số buổi được đăng ký bằng số thứ đã chọn</span>
                                                </div>
                                            </div>
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


        </script>
        <script src={{asset('js/form-validation.js')}}></script>

    @endpush
@endsection
