@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div id="drivers" class="card offcanvas-end-example"
                     data-bs-toggle="offcanvas"
                     data-bs-target="#offcanvasEnd"
                     aria-controls="offcanvasEnd">
                    <div class="card-header flex-column align-items-start pb-1">
                        <div class="avatar bg-light-primary p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="users" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder mt-1">{{$driver}}</h2>
                        <p class="card-text">Lượng học viên đăng ký tháng này</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-header flex-column align-items-start pb-1">
                        <div class="avatar bg-light-warning p-50 m-0">
                            <div class="avatar-content">
                                <i data-feather="help-circle" class="font-medium-5"></i>
                            </div>
                        </div>
                        <h2 class="fw-bolder mt-1">{{$contact}}</h2>
                        <p class="card-text">Lượng câu hỏi chưa phàn hồi</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Offcanvas End</h5>
            <button
                type="button"
                class="btn-close text-reset"
                data-bs-dismiss="offcanvas"
                aria-label="Close"
            ></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">
            <ul id="list">

            </ul>
        </div>
    </div>

    @push('javascript')
        <script>
            document.getElementById('drivers').addEventListener('click', function () {
                $.ajax({
                    header: {
                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                    },
                    url: '{{route('admin.drivers.api')}}',
                    dataType: 'JSON',
                    success: function (response) {
                        for(i=0;i<response.length;i++){
                            document.getElementById('list').innerHTML += `<li>${response[i]}</li>`;
                        }
                    }
                })
            })
        </script>
    @endpush
@endsection




