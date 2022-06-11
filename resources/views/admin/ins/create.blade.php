@extends('layout.master')
@push('css')
@endpush
@section('content')
    <section>
        <div class="row">
            <div class="col"></div>
        </div>
    </section>
    <form>
        @csrf
        <div class="mb-3 row-cols-3">
            <label class="col-form-label-lg ">Tên</label>
            <input class="input-group" type="text" name="name">
        </div>
        <div class="mb-3 row-cols-3">
            <label class="col-form-label-lg ">Email</label>
            <input class="input-group" type="email" name="email">
        </div>
        <div class="mb-3 row-cols-3">
            <label class="col-form-label-lg ">Số điện thoại</label>
            <input class="input-group" type="number" name="phone_numbers">
        </div>
        <div class="mb-3 row-cols-3">
            <label class="col-form-label-lg ">Giới tính</label>
            <input class="input-group" type="radio" name="gender">
            <input class="input-group" type="radio" name="gender">
        </div>
        <div class="mb-3 row-cols-3">
            <label class="col-form-label-lg ">Lương</label>
            <input class="input-group" type="number" name="salary" value="5000000">
        </div>
        <div>
            <button type="button">
                <a href="{{route('ins.store.ins')}}">Thêm</a>
            </button>
        </div>
        <div>
            <button type="reset">
                Nhập lại
            </button>
        </div>


    </form>
    @push('javascript')
    @endpush
@endsection
