@extends('homepage_layout.master')
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">

        </div>
    </div>
    <div class="content-body w-75 mt-5">
        <section>
            <div class="d-flex row">
                <div class="col-6 ">
                    <div class="card ">
                        @php
                            @endphp
                        <img class="card-img" src="{{$configs->get('banner_1')->value}}">
                    </div>

                </div>
                <div class="col-6">
                    <div class="card ">
                        <img class="card-img" src="{{$configs->get('banner_2')->value}}">
                    </div>
                </div>
            </div>
            <div class="d-flex row card  " style="justify-content: space-between">
                <div class="col-xl-12">
                    <div class="row">
                        <img style="z-index: 0;position: relative;" class="card-img"
                             src="{{asset('homepage3.png')}}">
                        <div class="w-25">
                            <h3>
                                HỌC LÁI XE HẠNG B1
                            </h3>
                            <b> 14.000.000 </b>
                            <p>
                                Đào tạo trong 15 buổi
                                (vào thứ 7, Chủ Nhật trong tuần)
                                Không phát sinh thêm chi phí
                            </p>
                            <a class="btn btn-outline-flickr" style="color: #FFFFFF">Xem thêm</a>
                        </div>
                        <div class="w-25">
                            <h3>
                                HỌC LÁI XE HẠNG B2
                            </h3>
                            <b> 14.000.000 </b>
                            <p>
                                Đào tạo trong 15 buổi
                                (vào thứ 7, Chủ Nhật trong tuần)
                                Không phát sinh thêm chi phí
                            </p>
                            <a class="btn btn-outline-flickr" style="color: #FFFFFF">Xem thêm</a>

                        </div>

                        <div class="w-25">
                            <h3>
                                HỌC LÁI XE HẠNG C
                            </h3>
                            <b> 16.000.000 </b>
                            <p>
                                Đào tạo trong 15 buổi
                                (vào thứ 7, Chủ Nhật trong tuần)
                                Không phát sinh thêm chi phí
                            </p>
                            <a class="btn btn-outline-flickr" style="color: #FFFFFF">Xem thêm</a>

                        </div>
                    </div>
                </div>


            </div>
        </section>
    </div>
@endsection
