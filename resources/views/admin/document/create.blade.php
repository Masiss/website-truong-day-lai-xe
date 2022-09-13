@extends('layout.master')
@push('vendor')
@endpush
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
@endpush
@section('content')

    <div class="content-body">
        <section class="app-user-view-account">
            {{--            <div class="row">--}}
            <!-- User Content -->
            <div class="col-xl-13 ">
                <!-- Project table -->
                <div class="card">
                    <h4 class="card-header">Thêm tài liệu</h4>
                    <form class="mx-3 mb-1" method="POST" action="{{route('admin.document.store')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-75">
                            <label class="form-label" for="title">Tiêu đề</label>
                            <input name="title" class="form-control" type="text" required>
                        </div>
                        <div class="mb-75">
                            <label class="form-label" for="image">Ảnh đính kèm</label>
                            <input type="file" accept="image/*" name="image" class="form-control">
                        </div>
                        <div class="mb-75">
                            <label class="form-label" for="content">Nội dung</label>
                            <textarea name="content" class="form-control" required></textarea>
                        </div>
                        <div class="mb-75">
                            <label class="form-label" for="attachment">File đính kèm</label>
                            <input name="attachment" type="file" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <span>Gửi</span>
                        </button>
                    </form>
                </div>
                <!-- /Project table -->
            </div>
            <!--/ User Content -->
            {{--            </div>--}}
        </section>
    </div>

    @push('javascript')
        // Page JS


    @endpush
@endsection
