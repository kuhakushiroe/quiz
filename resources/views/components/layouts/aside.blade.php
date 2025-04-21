@php
    $routeName = request()->route()->getName();
@endphp
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="/" class="brand-link">
            <!--begin::Brand Image-->
            <img src="../../../dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">E-QUESTION</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/" class="nav-link @if ($routeName == 'dashboard') active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                @hasAnyRole(['superadmin', 'dosen'])
                    @hasAnyRole('superadmin')
                        <li class="nav-header">Master Data</li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link @if ($routeName == 'users') active @endif">
                                <i class="nav-icon bi bi-person"></i>
                                <p>Users</p>
                            </a>
                        </li>
                    @endhasAnyRole
                    @hasAnyRole(['superadmin', 'dosen'])
                        <li class="nav-item">
                            <a href="/mahasiswa" class="nav-link @if ($routeName == 'mahasiswa') active @endif">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Mahasiswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/bank-soal" class="nav-link @if ($routeName == 'bank-soal') active @endif">
                                <i class="nav-icon bi bi-book"></i>
                                <p>Bank Soal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="ujian-dosen" class="nav-link @if ($routeName == 'ujian-dosen') active @endif">
                                <i class="nav-icon bi bi-pencil"></i>
                                <p>Open Class</p>
                            </a>
                        </li>
                    @endhasAnyRole
                @endhasAnyRole
                @hasAnyRole(['mahasiswa'])
                    <li class="nav-header">Ujian</li>
                    <li class="nav-item">
                        <a href="ujian-mahasiswa" class="nav-link @if ($routeName == 'ujian-mahasiswa') active @endif">
                            <i class="nav-icon bi bi-pencil"></i>
                            <p>Ujian</p>
                        </a>
                    </li>
                    <li class="nav-header">Histori</li>
                    <li class="nav-item">
                        <a href="hasil-ujian" class="nav-link @if ($routeName == 'hasil-ujian') active @endif">
                            <i class="nav-icon bi bi-flag"></i>
                            <p>Hasil Ujian</p>
                        </a>
                    </li>
                @endhasAnyRole
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
