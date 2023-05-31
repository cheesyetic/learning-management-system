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
    @yield('content')
    <!--/ Content -->
@endsection
