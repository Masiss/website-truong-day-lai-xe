<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.css"/>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pickadate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bordered-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/semi-dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-flat-pickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-pickadate.min.css')}}">

    <title></title>


</head>
<body>
<div class="content-body">
    <section class="bs-validation m-3">
        <div class="col d-flex justify-content-center ">
            <form enctype="multipart/form-data" id="form-data-1"
                  method="POST"
                  action="{{route('login_processing')}}"
                  class="needs-validation"
                  name="form1" novalidate>
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="d-flex justify-content-between card-header ">
                            <div class="heading-elements ">
                                <ul class="list-inline mb-0 ms-0">
                                    <li>
                                        <a href="{{route('index')}}"><i data-feather="chevron-left"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <h1 class="">Đăng nhập</h1>
                            <div class="heading-elements ">
                                <ul class="list-inline mb-0 ms-0">
                                    <li>
                                        <a data-action="collapse"><i data-feather="chevron-down"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @csrf

                        <div class="card-content collapse show">

                            <div class="card-body m-3">

                                <div class="row">


                                    @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                    <div class="col-xl-12 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input
                                            value="{{old('email')}}"
                                            type="email"
                                            id="email"
                                            class="form-control"
                                            placeholder="email"
                                            name="email"
                                            required
                                        />
                                        <div class="invalid-feedback">Vui lòng nhập email.</div>
                                    </div>

                                    <div class="col-xl-12 col-md-6 col-sm-12 mb-2">
                                        <label class="form-label" for="password">Mật khẩu</label>

                                        <input
                                            value="{{old('password')}}"
                                            max="20"
                                            min="8"
                                            type="password"
                                            id="password"
                                            class="form-control"
                                            placeholder="Mật khẩu"
                                            name="password"
                                            required
                                        />
                                    </div>
                                    <div class="col-xl-12 col-md-6 col-sm-12 mb-2">

                                        <input
                                            value="1"
                                            width="20px"
                                            height="20px"
                                            type="checkbox"
                                            class="form-check-input"
                                            name="save_login"
                                        />
                                        <label for="save_login">Ghi nhớ đăng nhập</label>
                                    </div>
                                    <div class="d-flex justify-content-lg-center center-layout">
                                        <button type="submit" class="btn btn-primary " id="btn-submit">
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
</body>
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN: Theme JS-->
<script src="{{asset('js/app-menu.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/customizer.min.js')}}"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript"
        src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>

<script src={{asset('js/jquery.validate.min.js')}}></script>
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })

</script>
<script src={{asset('js/form-validation.js')}}></script>

</html>
