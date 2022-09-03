@php use App\Enums\LevelEnum; @endphp
    <!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand"
                   href="#">
                <span
                    class="brand-logo"></span>
                    <img viewbox="0 0 139 95" src="{{asset('logo.png')}}" height="24">

                    <h2 class="brand-text">Bao Đậu</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x">

                    </i>
                    <i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc">

                    </i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom">

    </div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            {{-- Foreach menu item starts --}}
            @php
                if(auth('driver')->check()){
                        $menus=$menuData[2];
                    }elseif(LevelEnum::isAdmin()){
                        $menus=$menuData[0];
                    }else{
                        $menus=$menuData[1];
                    }
            @endphp
            @if (isset($menus))
                @foreach ($menus->menu as $menu)
                    {{-- Add Custom Class with nav-item --}}
                    <li
                        class="nav-item  {{ Route::currentRouteName() === $menu->slug ? 'active' : '' }}">
                        <a href="{{ isset($menu->url) ? url($menu->url) : 'javascript:void(0)' }}"
                           class="d-flex align-items-center"
                           target="{{ isset($menu->newTab) ? '_blank' : '_self' }}">
                            <i data-feather="{{ $menu->icon }}"></i>
                            <span class="menu-title text-truncate">{{ $menu->name }}</span>
                        </a>
                        @if (isset($menu->submenu))
                            @include('layout.submenu', ['menu' => $menu->submenu])
                        @endif
                    </li>
                @endforeach
            @endif
            {{-- Foreach menu item ends --}}
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
