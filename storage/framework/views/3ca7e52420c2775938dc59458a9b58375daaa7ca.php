<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/gallery.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('page-css'); ?>

    <script src="<?php echo e(asset('js/imagesloaded.js')); ?>"> </script>
    <script src="<?php echo e(asset('js/mansory.min.js')); ?>"> </script>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'SFI-Library')); ?></title>


</head>

<body>

    <div id="app">
    <!-- navbar starts here -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <?php echo e(config('app.name', 'sfi-library')); ?>

            </a>
            <!-- Links -->
            <ul class="navbar-nav">
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('showCategory', ['id'=> $cat ])); ?>"><?php echo e($cat->name); ?></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>

            <!-- search form version -->
            <!-- check if current is equal to page and display stuff -->
            <?php if(\Route::current()->getName() == 'home'): ?>

                <div class="mx-auto mb-n3">
                    <form class="form-inline align-self-center" action="">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend" style="">
                                <button class="btn btn-light search-icon" type="button"><i
                                        class="fa fa-search"></i></button>
                            </div>
                            <input type="search" class="form-control" style="height:auto; border: 0;"
                                placeholder="Search images">
                            <div class="input-group-append">
                                <button type="button" style="border-left: 0;"
                                    class="btn  bg-white text-dark dropdown-toggle" data-toggle="dropdown">
                                    Select image Category
                                </button>
                                <div class="dropdown-menu" style=" border: 0;">

                                    <a class="dropdown-item" href="#"></a>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
            <!-- end ofserach form -->


            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="<?php echo e(__('Toggle navigation')); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse flex-grow-0 ml-auto" id="navbarSupportedContent">

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <?php if(Route::has('login')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(Route::has('register')): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>

                        <li>
                            <a href="<?php echo e(route('upload')); ?>">
                                <button class="btn btn-success ">
                                    Upload Image
                                </button>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php echo e(Auth::user()->name); ?>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <main class="">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>



    <script src="<?php echo e(asset('js/app.js')); ?>"></script>
    <script>
        // init Masonry after all images have loaded
        // const grid = document.querySelector('.grid');

        // imagesLoaded(grid).on('progress', function() {
        //     // layout Masonry after each image loads
        //     msnry.layout();
        // });


        var grid = document.querySelector('.grid');
        var msnry;

        imagesLoaded(grid, function() {
            // init Isotope after all images have loaded
            msnry = new Masonry(grid, {
                itemSelector: '.grid-item',
                columnWidth: '.grid-sizer',
                percentPosition: true
            });
        });


        // const msnry = new Masonry(grid, {
        //   itemSelector: '.grid-item',
        //   columnWidth: 80,
        //   gutter: 20
        // });

    </script>
</body>

</html>
<?php /**PATH /home/jovialp/Desktop/searchLibrary sfI/SFI-LIBRARY/resources/views/layouts/app.blade.php ENDPATH**/ ?>