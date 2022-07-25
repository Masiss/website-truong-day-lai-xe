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
                        <form action="{{route('admin.config.store')}}" method="POST">
                            <div class="row demo-inline-spacing m-1">
                                @csrf
                                <input class="form-control col-xl-2" name="key" placeholder="Tên khóa">
                                <input class="form-control col-xl-3" name="value" placeholder="Giá trị">
                                <button class="btn col-xl-2">
                                    <i data-feather="plus-circle"></i>
                                    <span>Thêm</span>
                                </button>
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
                                    <td>
                                        <form action="{{route('admin.config.destroy')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="key" value="{{$config->key}}">
                                            <button class="btn">Xóa</button>
                                        </form>
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
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript"
                src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript"
                src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/fh-3.2.3/datatables.min.js"></script>
        <script type="text/javascript">
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




