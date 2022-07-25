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
                <form enctype="multipart/form-data"
                      id="form-data-1" class="needs-validation"
                      name="form1" novalidate>
                    <div class="col-md-12 ">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thông tin các buổi dạy</h4>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <td>Tên học viên</td>
                                            <td>Thời gian buổi học</td>
                                            <td>Ngày</td>
                                            <td>Báo cáo học viên</td>
                                            <td>Đánh giá của học viên</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($lessons as $lesson)
                                            <tr>
                                                <td>{{$lesson->driver->name}}</td>
                                                <td>{{$lesson->last}} tiếng</td>
                                                <td>{{$lesson->date}}</td>
                                                <td>{{$lesson->report}}</td>
                                                <td>{{$lesson->rating}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <form>
                                <div class="row ms-2">
                                    <div class="col-xl-3 col-md-6 col-sm-12 mb-2">
                                        <label for="base">Lương ban đầu</label>
                                        <input class="form-control" name="base" type="number"
                                               value="{{$detail_salary->base}}" disabled>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-sm-12 mb-2">

                                        <label for="minus">Lương bị trừ</label>
                                        <input class="form-control" name="minus" type="number"
                                               value="{{$detail_salary->minus}}" disabled>
                                    </div>
                                    <div class="col-xl-3 col-md-6 col-sm-12 mb-2">

                                        <label for="total">Lương tổng</label>
                                        <input class="form-control" name="total" type="number"
                                               value="{{$detail_salary->total}}" disabled>
                                    </div>

                                </div>
                            </form>
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
