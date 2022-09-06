@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="d-flex col justify-content-between align-items-center">
                            <button type="button" class="btn btn-primary h-25 ">
                                <a class="text-white" href="{{route('admin.drivers.create')}}">
                                    <i data-feather="plus-circle"></i>
                                    <span>Thêm</span>
                                </a>
                            </button>
                            <div class="col-sm-3 row">
                                <div class="search-bar">
                                    Tìm kiếm:
                                    <input id="search-bar" class="form-control" value="{{session()->get('input')}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="alert alert-success">
                             {{session()->get('status')}}
                        </span>
                    <div id="table" class="card-body p-0">

                    </div>

                    <!-- Bootstrap Pagination with icon starts -->
                    <x-pagination :paginate="$drivers"/>
                    <!-- Bootstrap Pagination with icon ends -->
                </div>

            </div>

        </div>

    </div>

    @push('javascript')
        <script type="text/javascript" src="{{asset('js/search.js')}}"></script>

    @endpush
@endsection
