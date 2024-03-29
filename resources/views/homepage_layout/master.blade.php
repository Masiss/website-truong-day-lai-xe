<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Bao Đậu - Trường dạy lái ô tô cao cấp</title>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.css"/>
    {{--    <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">--}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors.min.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/pickadate.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/flatpickr.min.css')}}">--}}
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
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/form-validation.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/form-flat-pickr.min.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('css/form-pickadate.min.css')}}">--}}
    @stack('css')
    <title>Home</title>
</head>
<style>
    body {
        list-style-type: none;
        font-size: 15px;
    }

    h3, h4 {
        color: #FFFFFF;
        font-size: medium;
    }

    a {
        color: black
    }

    .main-menu {
        height: fit-content;
    }

    .sidebar-container {
        margin: 0;
        position: relative;
        width: 20%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }

    .logo-wrapper {
        margin: 5vw;

    }

    .logo {
        height: 100px;
        width: 100px;
    }

    .sidebar-list {
        font-size: medium;
        padding: 10px 50px;
        margin: 1em 0 1em 3em;
        font-weight: 500;

    }

    .main-menu {
        width: 30%;
        margin-right: 0;
    }

    .row .w-25 {
        color: #7367F0;
        height: auto;
        margin: 2em 3em;
        z-index: 99;
        position: relative;

    }

    .row .w-25 h3 {
        color: #7367F0;
        font-weight: 900;

    }

    /*.btn {*/
    /*    background: linear-gradient(90deg, #C72E2E 50%, rgba(242, 28, 28, 0.79) 100%);*/

    /*}*/


    .form-control::placeholder {
        color: #FFFFFF;
    }


</style>
<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">
<!-- BEGIN: Header-->
@include('homepage_layout.nav_bar')
<!-- END: Header-->
<!-- BEGIN: Main Menu-->
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="w-100 p-3 " style="">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0 d-flex">
        @include('homepage_layout.sidebar')
        @yield('content')
    </div>
</div>
{{--modal--}}
<div class="d-inline-block">
    <div
        class="modal fade text-start modal-success"
        id="success"
        tabindex="-1"
        aria-labelledby="myModalLabel110"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel110">Thông báo thành công</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Chúng tôi đã nhận được câu hỏi của bạn. Chúng tôi sẽ phản hồi cho bạn trong thời gian sớm nhất
                    thông qua các liên hệ bạn đã để lại.
                    Xin cảm ơn.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END: Content-->
</body>

<!-- BEGIN: Footer-->
@include('homepage_layout.footer')
<!-- END: Footer-->

<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN: Theme JS-->
<script src="{{asset('js/app-menu.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/customizer.min.js')}}"></script>
@stack('js')
<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })

</script>
@if(!empty(session()->get('success')))
    <script>
        var myModal = new bootstrap.Modal(document.getElementById('success'), {
            keyboard: false
        })
        myModal.show();
    </script>
@endif
</html>
