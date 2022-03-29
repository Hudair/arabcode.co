<?php $__env->startSection('additional_head_tags'); ?>
<title><?php echo e(__('Reset Password')); ?></title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title', __('Reset Password')); ?>;


<?php $__env->startSection('content'); ?>

<div class="content">
  <form class="ui large form" method="POST" action="<?php echo e(route('password.update')); ?>">
    <?php echo csrf_field(); ?>

    <input type="hidden" name="token" value="<?php echo e($token); ?>">
    
    <div class="field <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <label><?php echo e(__('E-Mail Address')); ?></label>

      <input id="email" type="email" name="email" value="<?php echo e($email ?? old('email')); ?>" required autocomplete="email" autofocus>

      <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="ui small negative message">
          <strong><?php echo e($message); ?></strong>
        </div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    <div class="field <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
      <label><?php echo e(__('Password')); ?></label>

      <input id="password" type="password" name="password" value="<?php echo e($password ?? old('password')); ?>" required autocomplete="new-password" autofocus>

      <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <div class="ui negative message">
          <strong><?php echo e($message); ?></strong>
        </div>
      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    
    <div class="field">
      <label><?php echo e(__('Confirm password')); ?></label>
      <input type="password" name="password_confirmation" required autocomplete="new-password">
    </div>

    <div class="field">
      <button class="ui yellow circular large button fluid"><?php echo e(__('Reset Password')); ?></button>
    </div>
  </form>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\auth\passwords\reset.blade.php ENDPATH**/ ?>