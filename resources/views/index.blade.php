<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <title>Home</title>
</head>
<body>
<div class="content-body">
    <section class="m-3">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="row">
                        <div class="card-content">
                            <a href="{{route('register')}}">
                                <h3>
                                    Đăng ký
                                </h3>
                            </a>
                        </div>
                        <div class="card-content">
                            <a href="{{route('login')}}">
                                <h3>
                                    ĐĂng nhập
                                </h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

</body>
</html>
