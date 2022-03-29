<?php $__env->startSection('additional_head_tags'); ?>
<title><?php echo e(__('Confirm password')); ?></title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', __('Confirm password')); ?>;

<?php $__env->startSection('content'); ?>

<div class="content">
  <p><?php echo e(__('Please confirm your password before continuing.')); ?></p>
</div>

<div class="content">
  <form class="ui large form" method="post" action="<?php echo e(route('password.confirm')); ?>">
    <?php echo csrf_field(); ?>
    
    <div class="field">
      <label><?php echo e(__('Password')); ?></label>
      <input type="password" name="password" required autocomplete="current-password">

      <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
      <div class="ui negative message">
        <?php echo e($message); ?>

      </div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="field mb-0">
      <button class="ui yellow fluid large circular button" type="submit"><?php echo e(__('Confirm password')); ?></button>
    </div>
  </form>
</div>

<div class="content center aligned">
  <p><?php echo e(__('Back to login form')); ?> ?</p>
  <a href="<?php echo e(route('login')); ?>" class="ui blue fluid large circular button"><?php echo e(__('Login')); ?></a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\auth\passwords\confirm.blade.php ENDPATH**/ ?>