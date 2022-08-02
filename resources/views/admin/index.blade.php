@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
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

    @endpush
@endsection




