@php use App\Enums\GenderNameEnum; @endphp
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
                <form enctype="multipart/form-data" action="{{route('instructors.updatePassword')}}" method="POST"
                      id="form-data-1" class="needs-validation"
                      name="form1" novalidate>
                    <div class="col-md-12 ">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Thay đổi mật khẩu</h4>
                                <span class="alert alert-danger">{{$errors->status->first()}}</span>
                                @if (session('status'))
                                    <span class="alert alert-success">{{session()->get('status')}}</span>
                                @endif
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li>
                                            <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            @csrf
                            @method('PUT')
                            <div class="card-content collapse show">

                                <div class="card-body">

                                    <div class="row d-flex align-items-center">
                                        <div class="text-center col-xl-3">
                                            <label for="password" class="form-label">Mật khẩu cũ</label>
                                            <input value="" class="form-control" name="password"
                                                   type="password"/>
                                        </div>
                                        <div class="text-center col-xl-3">
                                            <label for="new_password" class="form-label">Mật khẩu mới</label>
                                            <input value="" class="form-control" name="new_password"
                                                   type="password"/>
                                        </div>
                                        <div class="text-center col-xl-3">
                                            <label for="new_password1" class="form-label">Nhập lại khẩu mới</label>
                                            <input value="" class="form-control" name="new_password1"
                                                   type="password"/>
                                        </div>
                                        <div class="text-center col-xl-3">
                                            <button type="submit" class="btn btn-primary">Đổi mật khẩu</button>
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
            // Page JS

        <script src={{asset('js/select2.full.min.js')}}></script>
        <script src={{asset('js/jquery.validate.min.js')}}></script>
        <script src={{asset('js/form-select2.min.js')}}></script>
        <script src={{asset('js/form-validation.js')}}></script>

    @endpush
@endsection
