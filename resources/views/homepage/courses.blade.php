@extends('homepage_layout.master')
@section('content')
    <div class="d-flex" style="padding-top: 5rem; padding-left: 3rem;">
        <div class="card col-sm-13">
            <div class="card-header d-flex justify-content-center">
                <h4 class="card-title text-black">
                    <strong> THÔNG TIN KHOÁ HỌC</strong>
                </h4>
            </div>
            <div class="card-body px-5">
                <p class="">
                    <b>Bên chúng tôi hiện đang có đào tạo loại bằng lái với các mức giá:</b>
                </p>
                <ul class="list-group-flush">
                    <li>
                        <b>B1:</b> {{$configs->get('B1')->value}} vnđ
                    </li>
                    <li>
                        <b>B2:</b> {{$configs->get('B2')->value}} vnđ
                    </li>
                    <li>
                        <b>C:</b>{{$configs->get('C')->value}} vnđ
                    </li>
                </ul>
                <p>
                    <b>Thời gian học của các khoá là 20 buổi.</b> Nhanh hay chậm thì tuỳ vào cách bạn đăng ký và chúng
                    tôi luôn
                    sẵn sàng cho những nhu cầu của các bạn.
                </p>
                <p>
                    Các bạn sẽ có 5 buổi học lí thuyết và 15 buổi học thực hành lái và thi thử. Chúng tôi có <u> máy
                        tính
                        cấu hình mạnh </u> và <u>xe đời mới</u> để hỗ trợ cho các bạn trong việc thực hành và thi thử.
                </p>
                <div class="card-img">
                    <img class="card-img" style="width: 49%" src="{{asset('kia.jpg')}}">
                    <img class="card-img w-50" src="{{asset('vios.jpg')}}">
                </div>
                <p class="mt-3">
                    <b>Về học phí</b>, chúng tôi <u>chỉ thu học phí một lần trong một khoá học</u> và <u>cam kết không
                        phát sinh thêm.</u>
                </p>
                <p>
                    <b>Nếu bạn học xong mà cảm thấy tay lái chưa vững?</b> Thì đừng lo bạn ơi, bạn có thể đăng ký thêm
                    các buổi
                    học thêm để nâng cao tay lái với giá cả rất phải chăng.<u> Chỉ 200k cho 1 ca 2 tiếng.</u>
                </p>
                <p>
                    Thủ tục đăng ký học rất đơn giản, bạn có thể đến và đăng ký trực tiếp tại trung tâm hoặc nhấn nút
                    đăng ký ở góc phải website của chúng tôi.Hồ sơ bao gồm:
                <ul>
                    <li>
                        Giấy khám sức khoẻ
                    </li>
                    <li>
                        12 ảnh thẻ 3x4 (hoặc file scan ảnh thẻ cho ai đăng ký tại website)
                    </li>
                    <li>
                        2 bản sao CMND/CCCD không cần công chứng (đối với những ai đăng ký tại website thì có thể nộp
                        vào các buổi học trực tiếp)
                    </li>
                </ul>
                </p>
                <p>
                    Về yêu cầu để đăng ký, bạn phải đủ 18 tuổi trở lên và đủ sức khoẻ lái xe theo quy định của pháp luật
                    hiện hành.
                </p>
            </div>
        </div>
    </div>
    @push('js')


    @endpush
@endsection
