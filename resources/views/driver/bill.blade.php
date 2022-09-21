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
    <link rel="stylesheet" type="text/css" href="{{asset('css/app-invoice.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <section class="invoice-preview-wrapper">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-xl-12 col-md-8 col-12">
                    <div class="card invoice-preview-card">
                        <div class="card-body invoice-padding pb-0">
                            <!-- Header starts -->
                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                <div>
                                    <div class="logo-wrapper">
                                        <img src="">
                                        <h3 class="text-primary invoice-logo">Bao Đậu</h3>
                                    </div>
                                    <p class="card-text mb-25">{{$address}}</p>
                                </div>
                                <div class="mt-md-0 mt-2">
                                    <h4 class="invoice-title">
                                        Mã học viên
                                        <span class="invoice-number">{{auth('driver')->user()->id}}</span>
                                    </h4>
                                </div>
                            </div>
                            <!-- Header ends -->
                        </div>

                        <hr class="invoice-spacing"/>

                        <!-- Address and Contact starts -->
                        <div class="card-body invoice-padding pt-0">
                            <div class="row invoice-spacing">
                                <div class="col-xl-8 p-0">
                                    <h6 class="mb-2">Hoá đơn đến:</h6>
                                    <h6 class="mb-25">{{auth('driver')->user()->name}}</h6>
                                    <p class="card-text mb-25">{{auth('driver')->user()->phone_numbers}}</p>
                                    <p class="card-text mb-25">{{auth('driver')->user()->email}}</p>
                                </div>
                                <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                    <h6 class="mb-2">Hoá đơn chi tiết:</h6>
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="pe-1">Tổng:</td>
                                            <td><span class="fw-bold">{{$total}}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">Tên ngân hàng:</td>
                                            <td>BIDV</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-1">Số tài khoản:</td>
                                            <td>{{$bank_number}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Address and Contact ends -->
                        <!-- Invoice Description starts -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="py-1">Thông tin hoá đơn</th>
                                    <th class="py-1">Số buổi</th>
                                    <th class="py-1">Giá</th>
                                    <th class="py-1">Tình trạng</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bills as $bill)
                                <tr>
                                    <td class="py-1">
                                        <p class="card-text fw-bold mb-25">{{$bill->course->type}}</p>
{{--                                        <p class="card-text text-nowrap">--}}
{{--                                            Developed a full stack native app using React Native, Bootstrap & Python--}}
{{--                                        </p>--}}
                                    </td>

                                    <td class="py-1">
                                        <span class="fw-bold">30</span>

                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{number_format($bill->tuition)}}</span>

                                    </td>
                                    <td class="py-1">
                                        <span class="fw-bold">{{$bill->status}}</span>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body invoice-padding pb-0">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-13 d-flex justify-content-end order-md-2 order-1">
                                    <div class="invoice-total-wrapper">
                                        <hr class="my-50"/>
                                        <div class="invoice-total-item">
                                            <p class="invoice-total-title">Total:</p>
                                            <p class="invoice-total-amount">{{number_format($total)}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Description ends -->

                        <hr class="invoice-spacing"/>
                    </div>
                </div>
                <!-- /Invoice -->

                <!-- Invoice Actions -->
{{--                <div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">--}}
{{--                    <div class="card">--}}
{{--                        <div class="card-body">--}}
{{--                            <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#send-invoice-sidebar">--}}
{{--                                Send Invoice--}}
{{--                            </button>--}}
{{--                            <button class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</button>--}}
{{--                            <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/print')}}"--}}
{{--                               target="_blank"> Print </a>--}}
{{--                            <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/edit')}}">--}}
{{--                                Edit </a>--}}
{{--                            <button class="btn btn-success w-100" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#add-payment-sidebar">--}}
{{--                                Add Payment--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- /Invoice Actions -->
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



        <script src={{asset('js/select2.full.min.js')}}></script>
        <script src={{asset('js/jquery.validate.min.js')}}></script>
        <script src={{asset('js/form-select2.min.js')}}></script>
        <script src={{asset('js/form-validation.js')}}></script>
        <script src={{asset('js/app-invoice.min.js')}}></script>

    @endpush
@endsection
