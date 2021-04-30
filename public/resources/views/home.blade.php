@extends('layouts.app')

@section('content')
    <div class="container-fluid" >
      <div class="row header">
      <div class="col-8 mx-auto search-wrapper">
        <h4 class="text-white text-h text-center mb-4">SFI-IMAGE-LIBRARY: Search all media fiLes e.g photos for past programmes  </h4>
        <form class=""  action="">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <button class="btn btn-light search-icon" type="button"><i class="fa fa-search"></i></button>  
            </div>
            <input type="search" class="form-control" style="height:60px;" placeholder="Search images">
            <div class="input-group-append">
              <button type="button" class="btn btn-outline-secondary bg-white text-dark dropdown-toggle" data-toggle="dropdown">
                Select image Category
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Convention 2021</a>
                <a class="dropdown-item" href="#">YDF</a>
                <a class="dropdown-item" href="#">Jesus Wives</a>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
      <!-- the section fo the images after a search -->

<div class="row mt-3">

<div class="col-12 mx-auto">
<div class="grid">
  <div class="grid-sizer"></div>
  <div class="grid-item">
  <a href="{{ route('page') }}">  <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/orange-tree.jpg" /> </a>
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/submerged.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/look-out.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/one-world-trade.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/drizzle.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/cat-nose.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/contrail.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/golden-hour.jpg" />
  </div>
  <div class="grid-item">
    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/82/flight-formation.jpg" />
  </div>

    </div>
  </div>
</div>
</div>
@endsection
