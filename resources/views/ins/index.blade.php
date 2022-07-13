@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <div class="row">
            <div>
                <a href="{{route('instructors.salaries')}}">
                    <h3>Salary</h3>
                </a>
            </div>
            <div>
                <a href="">
                    <h3>Instructors</h3>
                </a>
            </div>
            <div>
                <a href="">
                    <h3>Drivers</h3>
                </a>
            </div>

        </div>

    </div>

    @push('javascript')

    @endpush
@endsection




