@extends('homepage_layout.master')
@section('content')
    <div class="d-flex" style="padding-top: 5rem; padding-left: 3rem;">
        <div class="card col-sm-13">
            <div class="card-header d-flex justify-content-center">
                <h4 class="card-title text-black">
                    <strong> THÔNG TIN LIÊN HỆ</strong>
                </h4>
            </div>
            <div class="card-body px-5">
                <p class="">
                    Bạn có thắc mắc về chúng tôi? Chúng tôi sẵn sàng giải đáp mọi thắc mắc của bạn. Hãy liên hệ ngay
                    với chúng tôi bằng ...
                </p>
                <ul class="list-group navigation">
                    <li>
                        <i data-feather="phone"></i>
                        Số điện thoại:
                    </li>
                    <li>
                        <i data-feather="mail"></i>
                        Email liên hệ:
                    </li>
                    <li>
                        <i data-feather="map-pin"></i>
                        Địa chỉ:
                    </li>
                </ul>
                <div>
                    <p>
                        Bạn có thể đặt câu hỏi cho chúng tôi bằng cách điền vào biểu mẫu dưới đây, chúng tôi sẽ liên hệ
                        lại cho bạn trong vòng 12 tiếng sau khi gửi.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endsection
