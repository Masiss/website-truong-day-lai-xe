@php use App\Models\Instructor;
@endphp
    <!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{$pageName}} - Trang thông tin cho {{$title}} </title>
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.css"/>
    <link rel="apple-touch-icon" href="{{asset('apple-touch-icon.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors.min.css')}}">
    @stack('vendor')

    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-extended.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/colors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/components.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/dark-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bordered-layout.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/semi-dark-layout.min.css')}}">
    <!-- BEGIN: Page CSS-->
    @stack('css')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
      data-menu="vertical-menu-modern" data-col="">
{{--NAV-BAR--}}
@include('layout.nav-bar')
{{--SIDE-BAR--}}
{{--@if(auth('driver')->check())--}}
{{--    @include('layout.driver_sidebar')--}}
{{--@elseif(!Instructor::isAdmin())--}}
{{--    @include('layout.ins_sidebar')--}}
{{--@elseif(Instructor::isAdmin())--}}
{{--    @include('layout.sidebar')--}}
{{--@endif--}}
@include('layout.sidebar')
<!-- BEGIN: Content-->
<div class="app-content content @hasSidebar()
{{"email-application"}}
@endhasSidebar">
    <div class="content-overlay">

    </div>
    <div class="header-navbar-shadow">
    </div>
    @include('layout.header')
    <div
        class="@hasSidebar() content-area-wrapper @else content-wrapper @endhasSidebar
    container-xxl
     p-0">
        @yield('content')

    </div>
</div>
<!-- END: Content-->


<!-- Buynow Button-->
<div class="sidenav-overlay">

</div>
<div class="drag-target">

</div>

{{--Vendor JS--}}
<script src="{{asset('js/vendors.min.js')}}"></script>
@stack('vendors-js')
<!-- BEGIN: Theme JS-->
<script src="{{asset('js/app-menu.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/customizer.min.js')}}"></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}

<!-- END: Theme JS-->
@stack('javascript')

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })
    $(window).on('load', function () {
        let a = $(".main-menu-content ul li a");
        var path = window.location.pathname.split('/');
        path = path.length < 4 ? path :
            path.length > 4 ? path.slice(0, -2) :
                path.slice(0, -1);
        $(".main-menu-content ul li a").map(function (index, value) {
            var $this = $(this);
            if ($this.attr("href") === window.location.pathname) {
                $this.closest("li").addClass('active');
                return;
            } else {
                if ($this.attr("href") === path.join("/")) {
                    $this.closest("li").addClass('active');
                }
            }

        });
    })
</script>

</body>
<!-- END: Body-->
</html>
