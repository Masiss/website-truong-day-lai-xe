@extends('layout.master')

@section('title', 'Email Application')

@push('vendors')
    <!-- vendor css files -->
    <link rel="stylesheet" href="{{ asset('vendors/css/katex.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/monokai-sublime.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Inconsolata&family=Roboto+Slab&family=Slabo+27px&family=Sofia&family=Ubuntu+Mono&display=swap"
        rel="stylesheet">
@endpush

@push('css')
    <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset('css/form-quill-editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-email.min.css') }}">
@endpush



@section('content')
    <!-- Email list Area -->
    <div class="email-app-list">
        <!-- Email search starts -->
        <div class="app-fixed-search d-flex align-items-center">
            <div class="sidebar-toggle d-block d-lg-none ms-1">
                <i data-feather="menu" class="font-medium-5"></i>
            </div>
            <div class="d-flex align-content-center justify-content-between w-100">
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i data-feather="search" class="text-muted"></i></span>
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
        <!-- Email list starts -->
        <div class="email-user-list">
            <ul class="email-media-list">
                <li class="d-flex user-mail mail-read">
                    <div class="mail-left pe-50">
                        <div class="avatar">
                            img
                        </div>

                    </div>
                    <div class="mail-body">
                        <div class="mail-details">
                            <div class="mail-items">
                                <h5 class="mb-25">Tonny Deep</h5>
                                <span class="text-truncate">🎯 Focused impactful open system </span>
                            </div>
                            <div class="mail-meta-item">
                                <span class="mail-date">4:14 AM</span>
                            </div>
                        </div>
                        <div class="mail-message">
                            <p class="text-truncate mb-0">
                                Hey John, bah kivu decrete epanorthotic unnotched Argyroneta nonius veratrine
                                preimaginary saunders
                                demidolmen Chaldaic allusiveness lorriker unworshipping ribaldish tableman hendiadys
                                outwrest unendeavored
                                fulfillment scientifical Pianokoto CheloniaFreudian sperate unchary hyperneurotic
                                phlogiston duodecahedron
                                unflown Paguridea catena disrelishable Stygian paleopsychology cantoris phosphoritic
                                disconcord fruited
                                inblow somewhatly ilioperoneal forrard palfrey Satyrinae outfreeman melebiose
                            </p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Email list ends -->
    </div>
    <!--/ Email list Area -->
    <!-- Detailed Email View -->
    <!--/ Detailed Email View -->
        @endsection

        @push('vendors-js')
            <!-- vendor js files -->
            <script src="{{ asset('vendors/js/katex.min.js') }}"></script>
            <script src="{{ asset('vendors/js/highlight.min.js') }}"></script>
            <script src="{{ asset('vendors/js/quill.min.js') }}"></script>
            <script src="{{ asset('vendors/js/toastr.min.js') }}"></script>
            <script src="{{ asset('vendors/js/select2.full.min.js') }}"></script>
        @endpush
        @push('js')
            <!-- Page js files -->
            <script src="{{ asset('js/app-email.min.js') }}"></script>
    @endpush
