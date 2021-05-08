<?php $__env->startSection('content'); ?>

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
                    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="dropdown-item" href="#"><?php echo e($cat->name); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
        <!-- end of section fo the images after a search -->
        <div class="grid">
            <div class="grid-sizer"></div>
            <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="grid-item">
                   <a href=""> <img src="<?php echo e('storage/uploads/' . $image->name); ?>"> </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="d-flex justify-content-center mt-2">
            <?php echo $allImages->links(); ?>

        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jovialp/Desktop/searchLibrary sfI/SFI-LIBRARY/resources/views/home.blade.php ENDPATH**/ ?>