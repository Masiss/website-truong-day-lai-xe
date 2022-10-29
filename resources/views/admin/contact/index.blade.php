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
    @include('admin.contact.sidebar')
    <div class="content-right">
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="body-content-overlay"></div>
                <!-- Email list Area -->
                <div class="email-app-list">
                    <!-- Email search starts -->
                    <!-- Email search ends -->

                    <!-- Email actions starts -->
                    <div class="app-action">
                        <div class="action-left">
                            <div class="form-check selectAll">
                                <input type="checkbox" class="form-check-input" id="selectAllCheck"/>
                                <label class="form-check-label fw-bolder ps-25" for="selectAllCheck">Chọn hết</label>
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
                    <div id="list" class="email-user-list">

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
            setTimeout(function () {
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

        function show(currElement) {
            // document.getElementsByName('show').forEach(e => e.addEventListener('click', function () {
            let id = currElement.getAttribute('data-id'),
                url = currElement.getAttribute('data-url');
            $.ajax({
                header: '{{csrf_token()}}',
                url: url,
                success: function (info) {
                    $('#list').empty();
                    $('#list').html(info);
                    feather.replace();
                }
            })
            // }))
        }

        function back() {
            $('#list').empty();
            callList();
        }


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

