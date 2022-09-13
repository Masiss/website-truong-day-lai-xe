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
                    với chúng tôi thông qua ...
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
                    <form action="{{route('contact.create')}}" method="POST">
                        @csrf
                        <div class="form">
                            <label class="form-label" for="name">Tên*</label>
                            <input class="form-control" type="text" name="name" required>
                            @error('name')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="email">Email*</label>
                            <input class="form-control" type="email" name="email" required>
                            @error('email')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="form-label" for="phone_numbers">Số điện thoại*</label>
                            <input class="form-control" type="number" name="phone_numbers" required>
                            @error('phone_numbers')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label">Câu hỏi cần giải đáp*</label>
                            <textarea class="form-control" name="message" required></textarea>
                            @error('message')
                            <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary m-1" type="submit">Gửi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')


    @endpush
@endsection
