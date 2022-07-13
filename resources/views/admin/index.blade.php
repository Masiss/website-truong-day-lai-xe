@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
            <div>
                <a href="{{route('admin.salaries.index')}}">
                    <h3>Salary</h3>
                </a>
            </div>
            <div>
                <a href="{{route('admin.instructors.index')}}">
                    <h3>Instructors</h3>
                </a>
            </div>
            <div>
                <a href="{{route('admin.drivers.index')}}">
                    <h3>Drivers</h3>
                </a>
            </div>

        </div>

    </div>

    @push('javascript')
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>
        <script type="text/javascript">

            $(function () {
                $('#table-data').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('admin.instructors.api') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {
                            data: 'avatar',
                            name: 'avatar',
                            render: function (data) {
                                return `<img src=${data} style="width:100px;height:100px">`;
                            },
                        },
                        {data: 'email', name: 'email'},
                        {data: 'phone_numbers', name: 'phone_numbers'},
                        {data: 'gender', name: 'gender'},
                        {data: 'salary', name: 'salary'},

                    ]
                });
            })


        </script>
    @endpush
@endsection




