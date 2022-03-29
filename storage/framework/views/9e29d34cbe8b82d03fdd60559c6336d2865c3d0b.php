<?php $__env->startSection('additional_head_tags'); ?>
<title><?php echo e(__('Verify email address')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', __('Verify Your Email Address')); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
  <?php if(session('resent')): ?>
  <div class="ui positive message">
    <?php echo e(__('A fresh verification link has been sent to your email address.')); ?>

  </div>
  <?php endif; ?>

  <?php echo e(__('Before proceeding, please check your email for a verification link.')); ?>

  <?php echo e(__('If you did not receive the email')); ?>, <strong><a onclick="document.getElementById('resend-verification-link').submit()"><?php echo e(__('click here to request another')); ?></a><strong>
    <form id="resend-verification-link" method="POST" action="<?php echo e(route('verification.resend')); ?>" class="d-none"><?php echo csrf_field(); ?></form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\auth\verify.blade.php ENDPATH**/ ?>