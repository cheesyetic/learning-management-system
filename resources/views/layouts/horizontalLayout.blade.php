@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();
@endphp

@extends('layouts/commonMaster')
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
                @include('layouts/sections/navbar/navbar')
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
                                <li class="menu-item ">
                                    <a href="http://127.0.0.1:8000/teacher/beranda" class="menu-link">
                                        <i class="menu-icon tf-icons ti ti-smart-home"></i>
                                        <div>Beranda</div>
                                    </a>


                                </li>
                                <li class="menu-item ">
                                    <a href="http://127.0.0.1:8000/teacher/penugasan" class="menu-link">
                                        <i class="menu-icon tf-icons ti ti-checkbox"></i>
                                        <div>Penugasan</div>
                                    </a>


                                </li>
                                <li class="menu-item ">
                                    <a href="http://127.0.0.1:8000/teacher/hasil-penugasan" class="menu-link">
                                        <i class="menu-icon tf-icons ti ti-clipboard"></i>
                                        <div>Hasil Penugasan</div>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="http://127.0.0.1:8000/teacher/materi" class="menu-link">
                                        <i class="menu-icon tf-icons ti ti-file"></i>
                                        <div>Materi</div>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="http://127.0.0.1:8000/teacher/chat" class="menu-link">
                                        <i class="menu-icon tf-icons ti ti-messages"></i>
                                        <div>Pesan</div>
                                    </a>
                                </li>
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
