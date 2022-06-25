@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
            <div>
                <form action="" method="POST">

                    <div>
                        <h3>Tên</h3>
                        <input name="name">
                    </div>
                    <div>
                        <h3>Giới tính</h3>

                        <label for="1"> Nam</label>
                        <input type="radio" name="gender" value="1">

                        <label for="0"> Nữ</label>
                        <input type="radio" name="gender" value="0">
                    </div>
                    <div>
                        <h3>Thông tin khóa học</h3>
                        <div>
                            <h5>Thời gian</h5>
                            <input value="{{$driver->course->hours}}">
                        </div>
                        <div>
                            <h5>Giá</h5>
                            <input value="{{$driver->course->price}}">
                        </div>
                        <div>
                            <h5>Giá mỗi ngày</h5>
                            <input value="{{$driver->course->price_per_day}}">
                        </div>

                    </div>
                    <div>
                        <h3>CCCD</h3>
                        <input name="id_numbers">
                    </div>
                    <div>
                        <h3>Email</h3>
                        <input name="email">
                    </div>
                    <div>
                        <h3>SĐT</h3>
                        <input name="phone_numbers">
                    </div>
                    <div>
                        <h3>DOB</h3>
                        <input name="birthdate">
                    </div>

                </form>
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


        </script>
    @endpush
@endsection
