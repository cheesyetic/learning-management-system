@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset
@php
    $configData = Helper::appClasses();
    
    /* Display elements */
    $customizerHidden = $customizerHidden ?? '';
    
@endphp

@extends('content/auth/layouts/commonMaster')

@section('layoutContent')
    <!-- Content -->
    <div>
        <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
            <i class="ti ti-settings"></i>
        </a>
    </div>
    @yield('content')
    <!--/ Content -->
@endsection
