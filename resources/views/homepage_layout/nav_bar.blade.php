<nav
    class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl"
    style="width: calc(100vw - (100vw - 100%) - calc(2rem * 2) - 25%); margin-right: 2em;">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">

            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="#">
                        <i class="ficon" data-feather="menu">

                        </i>
                    </a>
                </li>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ms-auto">
            <li class="nav-item d-none d-lg-block">
                <a class="nav-link nav-link-style">
                    <i class="ficon"
                       data-feather="moon">

                    </i>
                </a>
            </li>
            <li class="nav-item nav-search">
                <a class="nav-link nav-link-search">
                    <i class="ficon" data-feather="search">

                    </i>
                </a>
                <div class="search-input">
                    <div class="search-input-icon">
                        <i data-feather="search">

                        </i>
                    </div>
                    <input class="form-control input" type="text" placeholder="Tìm kiếm" tabindex="-1"
                           data-search="search">
                    <div class="search-input-close">
                        <i data-feather="x">

                        </i>
                    </div>
                    <ul class="search-list search-list-main">

                    </ul>
                </div>
            </li>
            <li class="nav-item dropdown dropdown-user">
                @auth('instructor')
                    <x-navbar :user="auth('instructor')->user()"/>
                @endauth
                @auth('driver')
                    <x-navbar :user="auth('driver')->user()"/>
                @endauth
                @guest('instructor')
                    @guest('driver')
                        <div class="card-content">
                            <a href="{{route('register')}}">
                            <span style="color: #606C80">
                                Đăng ký
                            </span>
                            </a>
                            /
                            <a href="{{route('login')}}">
                            <span style="color: #606C80">
                                Đăng nhập
                            </span>
                            </a>
                        </div>
                    @endguest
                @endguest
            </li>
        </ul>
    </div>
</nav>
