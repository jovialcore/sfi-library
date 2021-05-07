<?php $__env->startSection('content'); ?>
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
        </div>
      </form>
    </div>
  </div>
    <!-- the section fo the images after a search -->
      <!-- the section fo the images after a search -->

<div class="row mt-3 ">

<div class="col-12 mx-auto">
<div class="grid">
  <div class="grid-sizer" style="border:5px solid red;">

            <?php $__currentLoopData = $allImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <div class="grid-item">
    <img src="<?php echo e('storage/uploads/'.$image->name); ?>" >
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
    </div>
            
            <div class="d-flex justify-content-center">
                <?php echo $allImages->links(); ?>

            </div>
          </div>
</div>

</div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jovialp/Desktop/searchLibrary sfI/SFI-LIBRARY/resources/views/home.blade.php ENDPATH**/ ?>