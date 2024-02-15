@extends('frontend.layout.master')
@section('title','404 | Page Not found !')
@section('content')
@php
   require base_path().'/app/Http/Controllers/price.php'; 
@endphp

    <!-- 404 Start -->
    <section id="not-found-page" class="not-found-pge-main-block">
      <div class="container">
        <div class="not-found-page-block">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h1 class="not-found-title">404</h1>
              <p>We are sorry, the page you've requested is not available. </p>
              <a class="btn btn-primary" title="go to homepage" type="button" href="{{ url('/') }}"><i data-feather="home"></i> Go To Homepage</a>
            </div>
          </div>  
        </div>
      </div>
    </section>
    <!-- 404 End -->
@endsection