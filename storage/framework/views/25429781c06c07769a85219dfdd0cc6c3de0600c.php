<?php $__env->startSection('additional_head_tags'); ?>
<title><?php echo e(__('Register')); ?></title>
<?php echo $__env->make(view_path('partials.meta_data'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(captcha_is_enabled('register') && captcha_is('google')): ?>
<?php echo google_captcha_js(); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title', __('Create an account')); ?>

<?php $__env->startSection('content'); ?>
<div class="content">
  <form class="ui large form" method="post" action="<?php echo e(route('register')); ?>">
    <?php echo csrf_field(); ?> 

    <div class="two fields">
      <div class="field  <?php $__errorArgs = ['firstname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <label><?php echo e(__('First name')); ?></label>
        <input type="text" name="firstname" placeholder="..." value="<?php echo e(old('firstname')); ?>" required autofocus>
      </div>

      <div class="field <?php $__errorArgs = ['lastname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <label><?php echo e(__('Last name')); ?></label>
        <input type="text" name="lastname" placeholder="..." value="<?php echo e(old('lastname')); ?>" required >
      </div>
    </div>
    
    <div class="two fields">
      <div class="field <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <label><?php echo e(__('Username')); ?></label>
        <input type="text" name="name" placeholder="..." value="<?php echo e(old('name')); ?>" required>
        
        <?php $__errorArgs = ['name'];
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
      
      <div class="field <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
        <label><?php echo e(__('E-Mail Address')); ?></label>
        <input type="email" name="email" placeholder="..." value="<?php echo e(old('email')); ?>" required>

        <?php $__errorArgs = ['email'];
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
      <input type="password" name="password" placeholder="..." value="<?php echo e(old('password')); ?>" required>

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
    
    <div class="field">
      <label><?php echo e(__('Confirm password')); ?></label>
      <input type="password" name="password_confirmation" placeholder="..." value="<?php echo e(old('password_confirmation')); ?>" required>
    </div>

    <?php $__errorArgs = ['captcha'];
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

    <?php $__errorArgs = ['g-recaptcha-response'];
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

    <?php if(captcha_is_enabled('register')): ?>
    <div class="field d-flex justify-content-center">
      <?php echo render_captcha(); ?>


      <?php if(captcha_is('mewebstudio')): ?>
        <input type="text" name="captcha" value="<?php echo e(old('captcha')); ?>" class="ml-1">
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="field mb-0">
      <button class="ui yellow fluid large circular button" type="submit"><?php echo e(__('Create an account')); ?></button>
    </div>
  </form>
</div>

<div class="content center aligned">
  <p><?php echo e(__('Have an account')); ?> ?</p>
  <a href="<?php echo e(route('login')); ?>" class="ui blue fluid large circular button"><?php echo e(__('Login')); ?></a>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\auth\register.blade.php ENDPATH**/ ?>