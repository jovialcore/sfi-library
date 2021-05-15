<?php $__env->startSection('page-css'); ?>

    <link href="<?php echo e(asset('css/page.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <div class="row ">
            <div class="col-12 col-md-9 image-wrapper">

                <img src="<?php echo e(asset('storage/uploads/' . $pic->name)); ?>" class="img-fluid img-page" alt="flower image">
            </div>
            <div class="col-12 col-md-3">
                <h4 class="mt-md-0 mt-4"> Image description</h4>
                <ul class="list-group">
                    <li class="list-group-item">Category: <?php echo e($pic->category->name ?? 'uncategorized'); ?> </li>
                    <li class="list-group-item"><b>Uploaded:</b> <i><?php echo e($pic->created_at->diffForHumans()); ?></i></li>
                    <li class="list-group-item">Uploaded by : <?php echo e($pic->User->name ?? 'Anonymous'); ?> </li>
                    <li class="list-group-item">Image Type: <?php echo e($pic->file_type); ?></li>
                    <li class="list-group-item">Image Size: <?php echo e($pic->size); ?> </li>
                </ul>
                <button class="btn btn-success rounded btn-block mt-4">
                    <a href="<?php echo e(route('downloadFile', $pic->id)); ?>" class="text-white"> <i
                            class="fa fa-download text-white"></i>
                        Download
                </button>
            </div>
        </div>
    </div>
    <!-- navbar and stuff ends here -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jovialp/Desktop/searchLibrary sfI/SFI-LIBRARY/resources/views/page.blade.php ENDPATH**/ ?>