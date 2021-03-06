@extends('layouts.app')

@section('content')
 <div class="container mx-auto">

     <div class="row ">
        <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="gallery-title">{{$category->name}}</h1>
        </div>

        @foreach ($category->files as $cat )
            <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe ">
                <a href="{{route('showPicture', ['id'=> $cat])}}" class="no-underline text-white"><img src="{{ url('/uploads/uploads/'.$cat->name)}}" alt="Image" class="img-responsive img-fluid"> </a>
            </div>

            @endforeach

    </div>
</div>


@endsection
