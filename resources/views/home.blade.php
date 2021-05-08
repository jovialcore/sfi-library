@extends('layouts.app')

@section('content')

    <!-- the section fo the images after a search -->
    <div class="container-fluid ">
        <div class="row header mb-4">
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
                    @foreach ($cats as $cat)
                    <a class="dropdown-item" href="#">{{ $cat->name }}</a>
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
        <!-- end of section fo the images after a search -->
        <div class="grid">
            <div class="grid-sizer"></div>
            @foreach ($allImages as $image)

                <div class="grid-item">
                   <a href="{{route('showPicture', ['id'=> $image])}}"> <img src="{{ 'storage/uploads/' . $image->name }}"> </a>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-2">
            {!! $allImages->links() !!}
        </div>
    </div>
    @endsection
