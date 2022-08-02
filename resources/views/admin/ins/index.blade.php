@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="card">
                        <div class="d-flex">
                            <div class="col-md-1 m-1">
                                <a href="{{route('admin.instructors.create')}}">
                                    <i data-feather="plus-circle"></i>
                                    <span>Thêm</span>
                                </a>
                            </div>
                            @error('message')
                            <div class="col-md-6 m-2">
                                <span class="alert-danger">{{$message}}</span>
                            </div>
                            @enderror
                        </div>

                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Lương</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($instructors as $instructor)
                                <tr>
                                    <td>{{$instructor->id}}</td>
                                    <td>{{$instructor->name}}</td>
                                    <td>{{$instructor->email}}</td>
                                    <td>{{$instructor->phone_numbers}}</td>
                                    <td>{{$instructor->salary}}</td>
                                    <td>
                                        <a href="instructors/{{$instructor->id}}/">Chi tiết</a>
                                    </td>
                                    <td>
                                        <form action="instructors/{{$instructor->id}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-bitbucket" type="submit">Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <x-pagination :paginate="$instructors"/>


                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script type="text/javascript">


        </script>
    @endpush
@endsection




