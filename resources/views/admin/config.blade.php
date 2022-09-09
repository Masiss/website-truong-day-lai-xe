@php use App\Models\Config; @endphp
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
                        <div class="m-1">
                            <span id="success" class="alert alert-success">{{session()->get('status')}}</span>
                        </div>
                        <div class="m-1">
                            <span id="error" class="alert alert-danger"></span>
                        </div>
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
                                    <form action="./config/update" method="POST" enctype="multipart/form-data">

                                        @csrf
                                        @method('PUT')
                                        <td>{{$config->key}}</td>

                                        @if(in_array($config->key,$arr_banner))
                                            <td><img class="w-50 h-50" src="{{$config->value}}"></td>
                                            <td><input class="form-control" type="file" accept="image/*"
                                                       name="new_value">
                                            </td>
                                        @else
                                            <td>{{$config->value}}</td>
                                            <td><input class="form-control" name="new_value"></td>
                                        @endif
                                        <td>
                                            <button name="key" value="{{$config->key}}" data-key="{{$config->key}}" class="btn button1"
                                                    type="submit">Sửa
                                            </button>
                                        </td>
                                    </form>

                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>

    @push('javascript')

        <script src={{asset('js/jquery.validate.min.js')}}></script>
        {{--        <script src={{asset('js/form-select2.min.js')}}></script>--}}
        <script src={{asset('js/form-validation.js')}}></script>
        <script>
            {{--document.getElementsByName('button1').forEach(e => e.addEventListener('click', function () {--}}
            {{--    let a = $(this).parents("tr").find("input[name='new_value']").val();--}}
            {{--    let b = $(this).data('key');--}}
            {{--    var form_data = new FormData();--}}
            {{--    form_data.append('new_value', a);--}}
            {{--    form_data.append('key', b);--}}
            {{--    $.ajax({--}}
            {{--        headers: {--}}
            {{--            'X-CSRF-TOKEN': '{{ csrf_token() }}'--}}
            {{--        },--}}
            {{--        url: "{{route('admin.config.update')}}",--}}
            {{--        method: "PUT",--}}
            {{--        data: form_data,--}}
            {{--        cache: false,--}}
            {{--        contentType: false,--}}
            {{--        processData: false,--}}
            {{--        dataType: "JSON",--}}
            {{--        success: function (event) {--}}
            {{--            $('#success').html(event.status);--}}
            {{--        },--}}
            {{--        error: function (event) {--}}
            {{--            $('#error').html(event.status);--}}
            {{--        },--}}

            {{--    });--}}

            {{--}))--}}

        </script>
    @endpush
@endsection




