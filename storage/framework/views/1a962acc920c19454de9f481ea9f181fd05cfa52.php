

<?php $__env->startSection('code', '419'); ?>

<?php $__env->startSection('message'); ?>
<h2><?php echo e(__('PAGE EXPIRED')); ?></h2>
<h3><?php echo e(__("Sorry, your session has expired. Please refresh and try again.")); ?></h3>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\errors\419.blade.php ENDPATH**/ ?>