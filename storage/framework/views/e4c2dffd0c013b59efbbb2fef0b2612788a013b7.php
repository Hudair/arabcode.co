

<?php $__env->startSection('code', '403'); ?>

<?php $__env->startSection('message'); ?>
<h2><?php echo e(__('FORBIDDEN')); ?></h2>
<h3><?php echo e($exception->getMessage()); ?></h3>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\errors\403.blade.php ENDPATH**/ ?>