<table class="table" id="table-data" data-table="instructor">
    <thead>
    <tr>
        <th>#</th>
        <th>Tên</th>
        <th>Email</th>
        <th>Số điện thoại</th>
        <th>Lương</th>
        <th></th>
        <th></th>
    </tr>
    </thead>
    <tbody id="tbody">
    @foreach($instructors as $instructor)
        <tr>
            <td>{{$instructor->id}}</td>
            <td>{{$instructor->name}}</td>
            <td>{{$instructor->email}}</td>
            <td>{{$instructor->phone_numbers}}</td>
            <td>{{$instructor->salary}}</td>
            <td>
                <a href="instructors/{{$instructor->id}}/">Chi tiết</a>
            </td>
            <td>
                <form action="instructors/{{$instructor->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-bitbucket" type="submit">Xóa</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
