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
           href="/drivers/">
            <i class="me-50" data-feather="user"> </i> Thông tin cá nhân</a>
        {{--                    <a class="dropdown-item" href="app-email.html">--}}
        {{--                        <i class="me-50" data-feather="mail"> </i>--}}
        {{--                        Inbox--}}
        {{--                    </a>--}}
        {{--                    <a class="dropdown-item" href="app-todo.html">--}}
        {{--                        <i class="me-50" data-feather="check-square"> </i>--}}
        {{--                        Task--}}
        {{--                    </a>--}}
        {{--                    <a class="dropdown-item" href="app-chat.html">--}}
        {{--                        <i class="me-50" data-feather="message-square"> </i>--}}
        {{--                        Chats--}}
        {{--                    </a>--}}
        <div class="dropdown-divider">

        </div>
        {{--                    <a class="dropdown-item" href="page-account-settings-account.html">--}}
        {{--                        <i class="me-50" data-feather="settings"> </i>--}}
        {{--                        Settings--}}
        {{--                    </a>--}}
        {{--                    <a class="dropdown-item" href="page-pricing.html">--}}
        {{--                        <i class="me-50" data-feather="credit-card"> </i>--}}
        {{--                        Pricing--}}
        {{--                    </a>--}}
        {{--                    <a class="dropdown-item" href="page-faq.html">--}}
        {{--                        <i class="me-50" data-feather="help-circle"> </i>--}}
        {{--                        FAQ--}}
        {{--                    </a>--}}
        <a class="dropdown-item" href="{{route('logout')}}">
            <i class="me-50" data-feather="power"> </i>
            Logout
        </a>
    </div>

