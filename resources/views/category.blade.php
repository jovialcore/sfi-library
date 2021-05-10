@extends('layouts.app')


@section('content')
 <div class="container mx-auto">

     <div class="row">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">{{$category->name}}</h1>
        </div>
        @foreach ($cats as $cat )
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
                <img src="http://fakeimg.pl/365x365/" class="img-responsive img-fluid">
            </div>
            @endforeach
        </div>
</div>

@endsection
