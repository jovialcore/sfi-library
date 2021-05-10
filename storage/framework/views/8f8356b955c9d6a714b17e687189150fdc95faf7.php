<?php $__env->startSection('content'); ?>
 <div class="container mx-auto">
    <div class="row">
    <div class="gallery col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h1 class="gallery-title"><?php echo e($category->name); ?></h1>
    </div>
        <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6 filter hdpe">
            <img src="http://fakeimg.pl/365x365/" class="img-responsive">
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sfi-library\resources\views/category.blade.php ENDPATH**/ ?>