@extends('layouts.app')

@section('content')
    <div class="container-fluid " >
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

<div class="row mt-3 ">

<div class="col-12 mx-auto">
<div class="grid">
  <div class="grid-sizer" style="border:5px solid red;">

    @foreach ( $allImages as $image )

    <div class="grid-item">
    <img src="{{'storage/uploads/'.$image->name}}" >
    </div>
    @endforeach

</div>
    </div>
            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {!! $allImages->links() !!}
            </div>
  </div>
</div>
</div>
@endsection
