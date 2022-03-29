<?php $__env->startSection('code', '401'); ?>

<?php $__env->startSection('message'); ?>
<h2><?php echo e(__('AUTHORIZATION REQUIRED')); ?></h2>
<h3><?php echo e(__('Sorry, your request could not be processed.')); ?></h3>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\errors\401.blade.php ENDPATH**/ ?>