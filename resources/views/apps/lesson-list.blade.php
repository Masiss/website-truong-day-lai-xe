<table class="table datatable-project">
    <thead>
    <tr>
        <th>Tên giáo viên</th>
        <th>Thời gian học</th>
        <th>Thời gian bắt đầu</th>
        <th>Đánh giá</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lessons as $lesson)
        <tr>
            <td>{{$lesson->driver->name}}</td>
            <td>{{$lesson->last}}</td>
            <td>{{$lesson->start_at ." ". $lesson->date}}</td>
            <td>{{$lesson->report}}</td>
            <td>{{$lesson->status}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
