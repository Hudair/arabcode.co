

<?php $__env->startSection('code', '500'); ?>

<?php $__env->startSection('message'); ?>
<h2><?php echo e(__('INTERNAL SERVER ERROR')); ?></h2>
<h3><?php echo __('The server encountered an internal error or a misconfiguration <br> and was unable to complete your request.'); ?></h3>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\errors\500.blade.php ENDPATH**/ ?>