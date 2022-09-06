<table class="table table-striped " id="table-data" data-table="driver">
    <thead>
    <tr>
        <th>@sortablelink('id')</th>
        <th scope="col">Tên</th>
        <th scope="col">Giới tính</th>
        <th scope="col">Loại bằng</th>
        <th scope="col">SĐT</th>
        <th scope="col">Hình thẻ</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach($drivers as $driver)
        <tr>
            <td>{{$driver->id}}</td>
            <td>{{$driver->name}}</td>
            <td>{{$driver->gender}}</td>
            <td>{{$driver->course->type}}</td>
            <td>{{$driver->phone_numbers}}</td>
            <td>
                <img src="{{$driver->file}}" width="100px" height="100px">
            </td>
            <td>
                <a class="form-control" href="drivers/{{$driver->id}}">Chi tiết</a>
            </td>
            <td>
                <form action="drivers/{{$driver->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="form-control" class="btn btn-outline-bitbucket"
                            type="submit">Xóa
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
