<div class="d-block menu-accordion w-25" data-scroll-to-active="true" style="">
    <div class="navbar-header m-3">
        <a class="navbar-brand" href="/index">
            <img src="{{asset('logo.svg')}}" width="" class="logo">
        </a>
    </div>
    <div class="main-menu-content me-1">
        <ul class="navigation navigation-main list-group" id="main-menu-navigation" data-menu="menu-navigation">
            <li>
                <a class="sidebar-list" href="{{route('index')}}">
                    <i data-feather="grid"></i>
                    <span>Trang chủ</span>
                </a>
            </li>
            <li>
                <a class="sidebar-list" href="{{route('contact')}}">
                    <i data-feather="message-square"></i>
                    <span>Liên hệ</span>
                </a>
            </li>
            <li>
                <a class="sidebar-list" href="{{route('courses')}}">
                    <i data-feather="calendar"></i>
                    <span>Các khóa học</span>
                </a>
            </li>
            <li>
                <a class="sidebar-list" href="{{route('document')}}">
                    <i data-feather="book"></i>
                    <span>Tài liệu</span>
                </a>
            </li>
        </ul>
        <form class="form-control p-0" method="POST" action="{{route('contact.create')}}">
            @csrf
            <div class="card m-0 p-1"
                 style="background: linear-gradient(180deg, rgba(58, 97, 238, 0.693) 0%, rgba(44, 45, 89, 0) 130.73%);">
                <div class="card-title d-flex justify-content-center align-text-bottom" style="color: #FFFFFF">Đăng ký
                    tư vấn
                </div>
                <div class="row d-flex justify-content-center">

                    <span class="alert alert-danger">{{session()->get('error')}}</span>
                    <div>
                        <input type="text" class="form-control mb-1" style="background: #DFDADAAB;" name="name"
                               placeholder="Họ và tên">
                    </div>
                    <div>
                        <input type="text" style=" background: #DFDADAAB;" class="form-control mb-1"
                               name="phone_numbers" placeholder="Số điện thoại">
                    </div>
                    <div>
                        <input type="text" style=" background: #DFDADAAB;" class="form-control mb-1" name="email"
                               placeholder="Email">
                    </div>
                    <div class="d-flex col justify-content-center align-items-center"
                         style="position: relative;left: 0;">
                        <label style="color: #FFFFFF">Thời gian có thể nhận tư vấn</label>
                        <select name="time_contacting" class="form-select m-1 w-auto" style="background:#DFDADAAB; ">
                            @for($i=6;$i<24;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary" style="color: #FFFFFF">Đăng ký</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

</div>
