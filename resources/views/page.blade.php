@extends('layouts.app')

@section('content')

<div class="container mt-5">
  <div class="row ">
    <div class="col-12 col-md-9 image-wrapper">

      <img src="{{ 'storage/uploads/' . $pic->name }}" class="img-fluid img-page" alt="flower image">
      </div>
      <div class="col-12 col-md-3">
       <h4 class="mt-md-0 mt-4"> Image description</h4>
       <ul class="list-group">
        <li class="list-group-item">Category:</li>
        <li class="list-group-item">Date: </li>
        <li class="list-group-item">Uploaded by :</li>
        <li class="list-group-item">Details: </li>
      </ul>
      <button class="btn btn-success rounded btn-block mt-4">
        <i class="fa fa-download text-white"></i>
        Download
      </button>
      </div>
  </div>
</div>
<!-- navbar and stuff ends here -->

@endsection
