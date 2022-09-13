@extends('layout.master')
@push('vendor')
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
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
                                    <div class="user-info text-center">
                                        <h4></h4>
                                    </div>
                                </div>
                            </div>
                            <h4 class="fw-bolder border-bottom pb-50 mb-1">Chi tiết</h4>
                            <div class="info-container">
                                <ul class="list-unstyled">
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Tên:</span>
                                        <span>{{$contact->name}}</span>
                                    </li>

                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Email:</span>
                                        <span>{{$contact->email}}</span>
                                    </li>
                                    <li class="mb-75">
                                        <span class="fw-bolder me-25">Số điện thoại:</span>
                                        <span>{{$contact->phone_numbers}}</span>
                                    </li>
                                    @if($contact->message)
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Câu hỏi:</span>
                                            <span>{{$contact->message}}</span>
                                        </li>
                                    @elseif($contact->time_contacting)
                                        <li class="mb-75">
                                            <span class="fw-bolder me-25">Thời gian có thể nhận tư vấn:</span>
                                            <span>{{$contact->time_contacting}}</span>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <!--/ User Sidebar -->

                <!-- User Content -->
                <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                    <!-- Project table -->
                    <div class="card">
                        <h4 class="card-header">Phản hồi</h4>
                        <form class="mx-3 mb-1" method="POST" action="{{route('admin.contact.reply',$contact->id)}}">
                            @csrf
                            <div class="mb-75">
                                <label class="form-label" for="from">Từ</label>
                                <input name="from" class="form-control" value="Trường dạy lái xe cao cấp - Bao Đậu" readonly>
                            </div>
                            <div class="mb-75">
                                <label class="form-label" for="email">Email</label>
                                <input name="email" class="form-control" value="{{$from->get('email')->value}}" readonly>
                            </div>
                            <div class="mb-75">
                                <label class="form-label" for="email_receiver">Email người nhận</label>
                                <input name="email_receiver" class="form-control" value="{{$contact->email}}" readonly>
                            </div>
                            <div class="mb-75">
                                <label class="form-label" for="message">Nội dung gửi</label>
                                <textarea name="message" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <span>Gửi</span>
                            </button>
                        </form>
                    </div>
                    <!-- /Project table -->
                </div>
                <!--/ User Content -->
            </div>
        </section>
    </div>

    @push('javascript')
        // Page JS
        <script type="text/javascript">

        </script>

    @endpush
@endsection
