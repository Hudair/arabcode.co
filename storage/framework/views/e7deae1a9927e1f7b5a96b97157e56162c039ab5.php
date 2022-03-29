

<?php $__env->startSection('code', '404'); ?>

<?php $__env->startSection('message'); ?>
<h2><?php echo e(__('PAGE NOT FOUND')); ?></h2>
<h3><?php echo e(__("We can't seem to find the page you are looking for.")); ?></h3>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\errors\404.blade.php ENDPATH**/ ?>