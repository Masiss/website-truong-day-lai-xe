<a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#"
   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="user-nav d-sm-flex d-none">
        <span class="user-name fw-bolder">{{$user->name}}</span>
        <span class="user-status">{{"DRIVER"}}</span>
    </div>
    <span class="avatar">
                                <img class="round" src="{{$user->file}}"
                                     alt="avatar" height="40" width="40">
                                <span
                                    class="avatar-status-online"></span></span>

</a>

<div class="dropdown-menu dropdown-menu-end font-small-3" aria-labelledby="dropdown-user">
    <a class="dropdown-item "
       href="{{route('index')}}">
        <i class="me-50" data-feather="home"> </i>
        Về trang chủ
    </a>
    <a class="dropdown-item "
       href="{{route('drivers.index')}}">
        <i class="me-50" data-feather="user"> </i>
        Về trang người dùng
    </a>

    <a class="dropdown-item" href="{{route('logout')}}">
        <i class="me-50" data-feather="power"> </i>
        Đăng xuất
    </a>
</div>

