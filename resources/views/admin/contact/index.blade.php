@extends('layout.master')
@push('vendor')
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
    <link rel="stylesheet" href="{{ asset('css/vertical-menu.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-quill-editor.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ext-component-toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-email.min.css') }}">
@endpush

<!-- Sidebar Area -->


@section('content')
    <div class="email-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar">
                        <div class="email-app-menu">
                            <div class="sidebar-menu-list">
                                <!-- <hr /> -->
                                <h6 class="section-label mt-3 mb-1 px-2">Loại liên hệ</h6>
                                <div class="list-group list-group-labels">
                                    @foreach($type as $type)
                                        <button name="btn-type" data-type="{{$type->value}}"
                                                class="list-group-item list-group-item-action">
                                            <span class="bullet bullet-sm bullet-success me-1"></span>
                                            {{$type->name}}
                                        </button>
                                    @endforeach
                                    <button name="btn-type" data-type="all"
                                            class="list-group-item list-group-item-action">
                                        <span class="bullet bullet-sm bullet-success me-1"></span>
                                        ALL
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <span class="position-absolute alert" style="top:25%;left:25%" id="alert"></span>
            <div id="list" class="email-user-list w-100">

            </div>
            <!-- Email list ends -->

        </div>
    </div>

@endsection
@push('vendors-js')
    <!-- vendor js files -->
    <script src="{{ asset('vendors/js/katex.min.js') }}"></script>
    <script src="{{ asset('vendors/js/highlight.min.js') }}"></script>
    <script src="{{ asset('vendors/js/quill.min.js') }}"></script>
    <script src="{{ asset('vendors/js/toastr.min.js') }}"></script>
    <script src="{{ asset('vendors/js/select2.full.min.js') }}"></script>
@endpush
@push('javascript')
    <!-- Page js files -->
    @if(!empty(session()->get('status')))
        <script>
            let alert = document.getElementById('alert');
            alert.innerHTML = '{{session()->get('status')}}';
            setTimeout(function(){
                alert.remove();
            }, 3000);
        </script>
    @endif
    <script src="{{ asset('js/app-email.min.js') }}"></script>
    <script>
        window.onload = callList('');
        document.getElementsByName('btn-type').forEach(e => e.addEventListener('click', function () {
            let value = this.getAttribute('data-type');
            callList(value);
        }))

        function callList(value) {
            $.ajax({
                header: '{{csrf_token()}}',
                url: '{{route('admin.contact.api')}}',
                data: {
                    type: value,
                },
                success: function (list) {
                    $('#list').html(list);
                }

            })
        }
    </script>
@endpush

