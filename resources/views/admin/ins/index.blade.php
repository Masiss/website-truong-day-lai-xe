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
                        <div class="d-flex justify-content-between align-items-center m-1">
                            <div class=" m-1">
                                <button class="btn btn-primary row">
                                    <a class="text-white" href="{{route('admin.instructors.create')}}">
                                        <i data-feather="plus-circle"></i>
                                        <span>Thêm</span>
                                    </a>
                                </button>

                            </div>
                            <div class="col-sm-3 row">
                                <div class="search-bar">
                                    Tìm kiếm:
                                    <input id="search-bar" class="form-control" value="{{session()->get('input')}}" type="text">
                                </div>
                            </div>
                        </div>
                        <span class="alert alert-success">
                             {{session()->get('status')}}
                        </span>
                        @error('message')
                        <div class="col-md-6 m-2">
                            <span class="alert-danger">{{$message}}</span>
                        </div>
                        @enderror
                        <div id="table">

                        </div>
                        <x-pagination :paginate="$instructors"/>

                    </div>


                </div>
            </div>
        </div>
    </div>

    @push('javascript')
        <script type="text/javascript" src="{{asset('js/search.js')}}"></script>

    @endpush
@endsection




