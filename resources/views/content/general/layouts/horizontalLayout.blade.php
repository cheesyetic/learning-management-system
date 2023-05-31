@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();
@endphp

@extends('content/general/layouts/commonMaster')
@php
    
    $menuHorizontal = true;
    $navbarFull = true;
    
    /* Display elements */
    $isNavbar = $isNavbar ?? true;
    $isMenu = $isMenu ?? true;
    $isFlex = $isFlex ?? false;
    $isFooter = $isFooter ?? true;
    $customizerHidden = $customizerHidden ?? '';
    $pricingModal = $pricingModal ?? false;
    
    /* HTML Classes */
    $menuFixed = isset($configData['menuFixed']) ? $configData['menuFixed'] : '';
    $navbarFixed = isset($configData['navbarFixed']) ? $configData['navbarFixed'] : '';
    $footerFixed = isset($configData['footerFixed']) ? $configData['footerFixed'] : '';
    $menuCollapsed = isset($configData['menuCollapsed']) ? $configData['menuCollapsed'] : '';
    
    /* Content classes */
    $container = $container ?? 'container-xxl';
    $containerNav = $containerNav ?? 'container-xxl';
    
@endphp

@section('layoutContent')
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">

            <!-- BEGIN: Navbar-->
            @if ($isNavbar)
                @include('content/general/layouts/navbar')
            @endif
            <!-- END: Navbar-->


            <!-- Layout page -->
            <div class="layout-page">

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Horizontal Menu -->
                    <aside id="layout-menu"
                        class="layout-menu-horizontal menu-horizontal  menu bg-menu-theme flex-grow-0 align-items-center">
                        <div class="container-xxl d-flex h-100">
                            <ul class="menu-inner justify-content-center">
                                @if (Auth::user()->role == 'teacher')
                                    <li class="menu-item {{ request()->is('teacher/beranda*') ? 'active' : '' }}">
                                        <a href="{{ route('teacher.dashboard') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                            <div>Beranda</div>
                                        </a>


                                    </li>
                                    <li class="menu-item {{ request()->is('teacher/penugasan*') ? 'active' : '' }}">
                                        <a href="{{ route('teacher.task.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-checkbox"></i>
                                            <div>Penugasan</div>
                                        </a>


                                    </li>
                                    <li class="menu-item {{ request()->is('teacher/hasil-penugasan*') ? 'active' : '' }}">
                                        <a href="{{ route('teacher.assignment.task.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-clipboard"></i>
                                            <div>Hasil Penugasan</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('teacher/materi*') ? 'active' : '' }}">
                                        <a href="{{ route('teacher.material.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-file"></i>
                                            <div>Materi</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('teacher/chat*') ? 'active' : '' }}">
                                        <a href="{{ route('teacher.chat.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-messages"></i>
                                            <div>Pesan</div>
                                        </a>
                                    </li>
                                @else
                                    <li class="menu-item {{ request()->is('student/beranda*') ? 'active' : '' }}">
                                        <a href="{{ route('student.dashboard') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                            <div>Beranda</div>
                                        </a>


                                    </li>
                                    <li class="menu-item {{ request()->is('student/penugasan*') ? 'active' : '' }}">
                                        <a href="{{ route('student.task.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-checkbox"></i>
                                            <div>Penugasan</div>
                                        </a>


                                    </li>
                                    <li class="menu-item {{ request()->is('student/materi*') ? 'active' : '' }}">
                                        <a href="{{ route('student.material.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-file"></i>
                                            <div>Materi</div>
                                        </a>
                                    </li>
                                    <li class="menu-item {{ request()->is('student/chat*') ? 'active' : '' }}">
                                        <a href="{{ route('student.chat.index') }}" class="menu-link">
                                            <i class="menu-icon tf-icons ti ti-messages"></i>
                                            <div>Pesan</div>
                                        </a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </aside>
                    <!--/ Horizontal Menu -->

                    <!-- Content -->
                    @if ($isFlex)
                        <div class="{{ $container }} d-flex align-items-stretch flex-grow-1 p-0">
                        @else
                            <div class="{{ $container }} flex-grow-1 container-p-y">
                    @endif

                    @yield('content')

                    <!-- pricingModal -->
                    @if ($pricingModal)
                        @include('_partials/_modals/modal-pricing')
                    @endif
                    <!--/ pricingModal -->
                </div>
                <!-- / Content -->

                <div class="content-backdrop fade"></div>
            </div>
            <!--/ Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>
    <!-- / Layout Container -->

    @if ($isMenu)
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->
@endsection
