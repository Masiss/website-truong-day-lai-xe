<!DOCTYPE html>
<!--
Template Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://1.envato.market/vuexy_admin
Renew Support: https://1.envato.market/vuexy_admin
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
          content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
          content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Email Application - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendors.min.css')}}">
    <link rel="stylesheet" href="{{ asset('vendors/css/katex.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/monokai-sublime.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css2?family=Inconsolata&amp;family=Roboto+Slab&amp;family=Slabo+27px&amp;family=Sofia&amp;family=Ubuntu+Mono&amp;display=swap">
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
    <link rel="stylesheet" href="{{ asset('css/vertical-menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-quill-editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-email.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static  "
      data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

<!-- BEGIN: Header-->
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content email-application">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-area-wrapper container-xxl p-0">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="sidebar-content email-app-sidebar">
                    <div class="email-app-menu">

                        <div class="sidebar-menu-list">
                            <!-- <hr /> -->
                            <h6 class="section-label mt-3 mb-1 px-2">Labels</h6>
                            <div class="list-group list-group-labels">
                                <a href="#" class="list-group-item list-group-item-action"
                                ><span class="bullet bullet-sm bullet-success me-1"></span>Personal</a
                                >
                                <a href="#" class="list-group-item list-group-item-action"
                                ><span class="bullet bullet-sm bullet-primary me-1"></span>Company</a
                                >
                                <a href="#" class="list-group-item list-group-item-action"
                                ><span class="bullet bullet-sm bullet-warning me-1"></span>Important</a
                                >
                                <a href="#" class="list-group-item list-group-item-action"
                                ><span class="bullet bullet-sm bullet-danger me-1"></span>Private</a
                                >
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="content-right">
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="body-content-overlay"></div>
                    <!-- Email list Area -->
                    <div class="email-app-list">
                        <!-- Email search starts -->
                        <div class="app-fixed-search d-flex align-items-center">
                            <div class="sidebar-toggle d-block d-lg-none ms-1">
                                <i data-feather="menu" class="font-medium-5"></i>
                            </div>
                            <div class="d-flex align-content-center justify-content-between w-100">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i data-feather="search"
                                                                      class="text-muted"></i></span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="email-search"
                                        placeholder="Search email"
                                        aria-label="Search..."
                                        aria-describedby="email-search"
                                    />
                                </div>
                            </div>
                        </div>
                        <!-- Email search ends -->

                        <!-- Email actions starts -->
                        <div class="app-action">
                            <div class="action-left">
                                <div class="form-check selectAll">
                                    <input type="checkbox" class="form-check-input" id="selectAllCheck"/>
                                    <label class="form-check-label fw-bolder ps-25" for="selectAllCheck">Select
                                        All</label>
                                </div>
                            </div>
                            <div class="action-right">
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item mail-delete">
                                        <span class="action-icon"><i data-feather="trash-2"
                                                                     class="font-medium-2"></i></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- Email actions ends -->

                        <!-- Email list starts -->
                        <div class="email-user-list">
                            <ul class="email-media-list">
                                <li class="d-flex user-mail mail-read">
                                    <div class="mail-left pe-50">
                                        <div class="user-action">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck12"/>
                                                <label class="form-check-label" for="customCheck12"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mail-body">
                                        <div class="mail-details">
                                            <div class="mail-items">
                                                <h5 class="mb-25">Heather Howell</h5>
                                                <span class="text-truncate mb-0">Thanks, Let's do it.</span>
                                            </div>
                                            <div class="mail-meta-item">
                                                <span class="mx-50 bullet bullet-warning bullet-sm"></span>
                                                <span class="mail-date">21 Mar</span>
                                            </div>
                                        </div>
                                        <div class="mail-message">
                                            <p class="mb-0 text-truncate">
                                                Hi John,Biscuit lemon drops marshmallow. Marzipan carrot cake soufflé.
                                                Toffee tiramisu pudding cotton
                                                candy powder jujubes pie. Topping danish sweet croissant liquorice lemon
                                                drops cake oat cake brownie.
                                                Cupcake liquorice tart tootsie roll sugar plum chocolate bar oat cake
                                                sweet roll.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div class="no-results">
                                <h5>No Items Found</h5>
                            </div>
                        </div>
                        <!-- Email list ends -->
                    </div>
                    <!--/ Email list Area -->
                    <!-- Detailed Email View -->

                    <!-- Detailed Email Header ends -->

                    <!-- Detailed Email Content starts -->
                    <!-- Detailed Email Content ends -->
                </div>
                <!--/ Detailed Email View -->

                <!-- compose email -->
                <!--/ compose email -->

            </div>
        </div>
    </div>
</div>
</div>
<!-- END: Content-->


<!-- BEGIN: Customizer-->

<!-- End: Customizer-->

<!-- Buynow Button-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
    <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT  &copy; 2021<a
                class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span
                class="d-none d-sm-inline-block">, All rights Reserved</span></span><span
            class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('vendors/js/katex.min.js') }}"></script>
<script src="{{ asset('vendors/js/highlight.min.js') }}"></script>
<script src="{{ asset('vendors/js/quill.min.js') }}"></script>
<script src="{{ asset('vendors/js/toastr.min.js') }}"></script>
<script src="{{ asset('vendors/js/select2.full.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('js/app-menu.min.js')}}"></script>
<script src="{{asset('js/app.min.js')}}"></script>
<script src="{{asset('js/customizer.min.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('js/app-email.min.js') }}"></script>
<!-- END: Page JS-->

<script>
    $(window).on('load', function () {
        if (feather) {
            feather.replace({width: 14, height: 14});
        }
    })
</script>
</body>
<!-- END: Body-->
</html>
