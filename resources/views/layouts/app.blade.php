<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

       <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <link href="{{ asset('css/page.css') }}" rel="stylesheet">

   <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SFI-Library') }}</title>

        <!-- Scripts -->
 <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>


    <div id="app">
<!-- navbar starts here -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <!-- Brand -->
          <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'sfi-library') }}
                </a>
        <!-- Links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="#">Coventions</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">YDf</a>
          </li>
        </ul>

    <!-- search form version -->
    <!-- check if current is equal to page and display stuff -->
       @if (\Route::current()->getName() == 'page')

       <div class="mx-auto mb-n3" >
            <form class="form-inline align-self-center"  action="">
                <div class="input-group mb-3">
                <div class="input-group-prepend" style="">
                    <button class="btn btn-light search-icon" type="button"><i class="fa fa-search"></i></button>
                </div>
                <input type="search" class="form-control" style="height:auto; border: 0;" placeholder="Search images">
                <div class="input-group-append">
                    <button type="button" style="border-left: 0;" class="btn  bg-white text-dark dropdown-toggle" data-toggle="dropdown">
                    Select image Category
                    </button>
                    <div class="dropdown-menu"  style=" border: 0;">
                    <a class="dropdown-item" href="#">Convention 2021</a>
                    <a class="dropdown-item" href="#">YDF</a>
                    <a class="dropdown-item" href="#">Jesus Wives</a>
                    </div>
                </div>
                </div>
            </form>
            </div>
        @endif
    <!-- end ofserach form -->


                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse flex-grow-0 ml-auto" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else

                            <li >
                            <a href="{{route('upload')}}">
                                <button class="btn btn-success ">
                                    Upload Image
                                </button>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>



{{--
    <script src="{{asset('js/imagesloaded.js')}}"> </script>
      <script src="{{asset('js/mansory.min.js')}}"> </script> --}}

      <script>

// // init Masonry after all images have loaded
// const grid = document.querySelector('.grid');

// const msnry = new Masonry( grid, {
//   itemSelector: '.grid-item',
//   columnWidth: 80,
//   gutter: 20
// });

// imagesLoaded( grid ).on( 'progress', function() {
//   // layout Masonry after each image loads
//   msnry.layout();
// });


</script>
</body>
</html>
