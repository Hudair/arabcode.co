<?php $__env->startSection('code', '503'); ?>

<?php $__env->startSection('message'); ?>
<h2><?php echo e(__('SERVICE UNAVAILABLE')); ?></h2>
<h3><?php echo e(__($exception->getMessage() ?? 'The server is temporarily busy, please try again later.')); ?></h3>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\errors\503.blade.php ENDPATH**/ ?>