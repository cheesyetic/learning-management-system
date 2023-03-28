@extends('layouts/layoutMaster')

@section('title', 'Analytics')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/swiper/swiper.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/cards-advance.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/swiper/swiper.js')}}">
</script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<!-- Content -->
<div class="row row-cols-1 g-4 mb-5 mx-auto" style="width: 40%">
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/2.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Judul Karya</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia maxime assumenda suscipit nam culpa laboriosam tempora delectus in aliquid obcaecati, dolorum, atque perspiciatis soluta rerum distinctio illum autem! Possimus, laudantium..</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Diunggah 3 menit yang lalu</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/10.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Judul Karya</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia maxime assumenda suscipit nam culpa laboriosam tempora delectus in aliquid obcaecati, dolorum, atque perspiciatis soluta rerum distinctio illum autem! Possimus, laudantium..</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Diunggah 3 menit yang lalu</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/4.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Judul Karya</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Diunggah 3 menit yang lalu</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/13.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Judul Karya</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia maxime assumenda suscipit nam culpa laboriosam tempora delectus in aliquid obcaecati, dolorum, atque perspiciatis soluta rerum distinctio illum autem! Possimus, laudantium..</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Diunggah 3 menit yang lalu</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/14.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Judul Karya</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia maxime assumenda suscipit nam culpa laboriosam tempora delectus in aliquid obcaecati, dolorum, atque perspiciatis soluta rerum distinctio illum autem! Possimus, laudantium..</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Diunggah 3 menit yang lalu</small>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card h-100">
      <img class="card-img-top" src="{{asset('assets/img/elements/15.jpg')}}" alt="Card image cap" />
      <div class="card-body">
        <h5 class="card-title">Judul Karya</h5>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia maxime assumenda suscipit nam culpa laboriosam tempora delectus in aliquid obcaecati, dolorum, atque perspiciatis soluta rerum distinctio illum autem! Possimus, laudantium..</p>
      </div>
      <div class="card-footer">
        <small class="text-muted">Diunggah 3 menit yang lalu</small>
      </div>
    </div>
  </div>
</div>
<!-- End of Content -->
@endsection
