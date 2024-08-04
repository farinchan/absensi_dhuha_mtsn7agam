<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route("dashboard") }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img height="50px" src="{{ asset('assets\img\logo_mts7agam.png') }}" alt="">
            </span>
            <span class=" menu-text fw-bolder ms-2">MTS N 7 Agam</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if (request()->is('dashboard') || request()->is('dashboard/*')) active @endif ">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-item @if (request()->is('absensi') || request()->is('absensi/*')) active @endif ">
            <a href="{{ route('absensi.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-pin"></i>
                <div data-i18n="Analytics">Absensi Siswa</div>
            </a>
        </li>
        <li class="menu-item @if (request()->is('history') || request()->is('history/*')) active @endif ">
            <a href="{{ route('history.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-history"></i>
                <div data-i18n="Analytics">history Absensi</div>
            </a>
        </li>


        <!-- Data -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data</span></li>
        <!-- data guru -->
        <li class="menu-item @if (request()->is('guru') || request()->is('guru/*')) active @endif ">
            <a href="{{ route('guru.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Data Guru</div>
            </a>
        </li>

        <li class="menu-item @if (request()->is('kelas') || request()->is('kelas/*') || request()->is('siswa') || request()->is('siswa/*')) active @endif ">

            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Data Siswa">Data Siswa</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('kelas') || request()->is('kelas/*')) active @endif ">
                    <a href="{{ route('kelas.index') }}" class="menu-link">
                        <div data-i18n="Kelas">Kelas</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('siswa') || request()->is('siswa/*')) active @endif">
                    <a href="{{ route('siswa.index') }}" class="menu-link">
                        <div data-i18n="Siswa">Siswa</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Setting -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
        <li class="menu-item @if (request()->is('piket')) active @endif">
            <a href="{{ route("jadwal_piket.index") }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-calendar"></i>
                <div data-i18n="Support">Jadwal Piket</div>
            </a>
        </li>
        {{-- <li class="menu-item @if (request()->is('kehadiran')) active @endif">
            <a href="" class="menu-link">
                <i class="menu-icon tf-icons bx bx-info-circle"></i>
                <div data-i18n="Support">Kehadiran</div>
            </a>
        </li> --}}

        <!-- Misc -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Administrator</span></li>
        <li class="menu-item @if (request()->is('admin')) active @endif">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-support"></i>
                <div data-i18n="Support">Admin</div>
            </a>
        </li>
    </ul>
</aside>
<!-- / Menu -->
