@extends('layout.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/vertical-menu.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/form-validation.css')}}">
@endpush
@section('content')
    <div class="content-body">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="card">
                        <form class="needs-validation" action="{{route('admin.config.store')}}" method="POST"
                              novalidate>
                            <div class="row demo-inline-spacing m-1">
                                <div class="d-flex  row">
                                    @csrf
                                    <div class="col-xl-3 mb-2">
                                        <label for="key">Tên khóa</label>
                                        <input class="form-control " name="key" placeholder="Tên khóa" required>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Vui lòng không để trống.</div>
                                    </div>
                                    <div class="col-xl-3 mb-2">
                                        <label for="key">Giá trị</label>
                                        <input class="form-control " name="value" placeholder="Giá trị"
                                               required>
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Vui lòng không để trống.</div>

                                    </div>
                                    <div class="col-xl-2 d-flex  align-items-center justify-content-center">
                                        <button class="btn p-2">
                                            <i data-feather="plus-circle"></i>
                                            <span>Thêm</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                        <table class="table" id="table-data">
                            <thead>
                            <tr>
                                <th>Tên khóa</th>
                                <th>Giá trị</th>
                                <th>Giá trị mới</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($configs as $config)
                                <tr>
                                    <td>{{$config->key}}</td>
                                    <td>{{$config->value}}</td>
                                    <td><input class="form-control" name="new_value"></td>
                                    <td>
                                        <button data-key="{{$config->key}}" class="btn button1" name="button1"
                                                type="button">Sửa
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <x-pagination :paginate="$configs"/>

                </div>
            </div>

        </div>

    </div>

    @push('javascript')

        <script src={{asset('js/jquery.validate.min.js')}}></script>
        <script src={{asset('js/form-select2.min.js')}}></script>
        <script src={{asset('js/form-validation.js')}}></script>
        <script>
            document.getElementsByName('button1').forEach(e => e.addEventListener('click', function () {
                let a = $(this).parents("tr").find("input[name='new_value']").val();
                let b = $(this).data('key');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: "{{route('admin.config.update')}}",
                    method: "PUT",
                    data: {
                        'new_value': a,
                        'key': b,
                    },
                    success: function (event) {
                        if (event == 1) {
                            $(this).parents("tr").find("input[name='new_value']").innerHTML = a;
                        }

                    }
                });

            }))

        </script>
    @endpush
@endsection




