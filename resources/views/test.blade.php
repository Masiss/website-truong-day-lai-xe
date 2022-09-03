@extends('layout.master')
@push('vendor')
    {{--    <link href='fullcalendar/main.css' rel='stylesheet'/>--}}
    <link rel="stylesheet" href="{{ asset('vendors/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/flatpickr.min.css') }}">
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('css/form-flat-pickr.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form-validation.css') }}">
@endpush
@section('content')
    <div class="content-body">
        <!-- Full calendar start -->
        <section>
            <div class="app-calendar overflow-hidden border">
                <div class="row g-0">
                    <!-- Calendar -->
                    <div class="col position-relative">
                        <div class="card shadow-none border-0 mb-0 rounded-0">
                            <div class="card-body pb-0">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar -->
                    <div class="body-content-overlay"></div>
                </div>
            </div>
            <!-- Calendar Add/Update/Delete event modal-->
            <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
                <div class="modal-dialog sidebar-lg">
                    <div class="modal-content p-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">Chi tiết buổi học</h5>
                        </div>
                        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                                <div class="mb-1">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Event Title" required/>
                                </div>
                                <div class="mb-1 position-relative">
                                    <label for="start-date" class="form-label">Start Date</label>
                                    <input type="text" class="form-control" id="start-date" name="start-date"
                                           placeholder="Start Date"/>
                                </div>
                                <div class="mb-1 position-relative">
                                    <label for="end-date" class="form-label">End Date</label>
                                    <input type="text" class="form-control" id="end-date" name="end-date"
                                           placeholder="End Date"/>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Calendar Add/Update/Delete event modal-->
        </section>
    </div>

    @push('javascript')
        // Page JS

        <script src="{{ asset('vendors/js/jquery.validate.min.js') }}"></script>

        <script src="{{ asset('vendors/js/fullcalendar.min.js') }}"></script>
        <script src="{{ asset('vendors/js/moment.min.js') }}"></script>
        <script src="{{ asset('vendors/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('vendors/js/flatpickr.min.js') }}"></script>
        <script src="{{ asset('js/app-menu.min.js') }}"></script>
        <script src="{{ asset('js/app.min.js') }}"></script>
        <script>
            var url = '{{route('testAPI')}}';
            var urlEvent = '{{asset('js/app-calendar-events.js')}}';
        </script>
{{--        <script  type="text/javascript" src="{{ asset('js/app-calendar-events.js') }}"></script>--}}
        <script  type="text/javascript" src="{{ asset('js/app-calendar.js') }}"></script>
    @endpush
@endsection
