@extends('layouts.app')

@section('page-css')

    <link href="{{ asset('css/page.css') }}" rel="stylesheet">

@endsection

@section('content')
    <div class="container mt-5">
        <div class="row ">
            <div class="col-12 col-md-9 image-wrapper">

                <img src="{{ asset('storage/uploads/' . $pic->name) }}" class="img-fluid img-page" alt="flower image">
            </div>
            <div class="col-12 col-md-3">
                <h4 class="mt-md-0 mt-4"> Image description</h4>
                <ul class="list-group">
                    <li class="list-group-item">Category: {{ $pic->category->name ?? 'uncategorized' }} </li>
                    <li class="list-group-item"><b>Uploaded:</b> <i>{{ $pic->created_at->diffForHumans() }}</i></li>
                    <li class="list-group-item">Uploaded by : {{ $pic->User->name ?? 'Anonymous' }} </li>
                    <li class="list-group-item">Image Type: {{ $pic->file_type }}</li>
                    <li class="list-group-item">Image Size: {{ $pic->size }} </li>
                </ul>
                <button class="btn btn-success rounded btn-block mt-4">
                    <a href="{{ route('downloadFile', $pic->id) }}" class="text-white"> <i
                            class="fa fa-download text-white"></i>
                        Download
                </button>
            </div>
        </div>
    </div>
    <!-- navbar and stuff ends here -->

@endsection
