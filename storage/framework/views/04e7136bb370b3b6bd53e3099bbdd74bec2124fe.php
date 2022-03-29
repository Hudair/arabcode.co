<?php $__env->startSection('additional_head_tags'); ?>
<title><?php echo e(__('Login')); ?></title>
<?php echo $__env->make(view_path('partials.meta_data'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(captcha_is_enabled() && captcha_is('google')): ?>
<?php echo google_captcha_js(); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title', __('Login to your account')); ?>


<?php $__env->startSection('content'); ?>
<div class="content">
  <?php if(array_filter(array_column(config('services'), 'enabled'))): ?>
  <div class="ui floating dropdown right labeled icon fluid large basic button">
    <div class="text"><?php echo e(__('With your social account')); ?></div>
    <i class="dropdown icon"></i>
    <div class="menu">
      <?php if(config('services.facebook.enabled')): ?>
      <a href="<?php echo e(secure_url('login/facebook')); ?>" class="item">
        <i class="facebook icon"></i>
        Facebook
      </a>
      <?php endif; ?>

      <?php if(config('services.google.enabled')): ?>
      <a href="<?php echo e(secure_url('login/google')); ?>" class="item">
        <i class="google icon"></i>
        Google
      </a>
      <?php endif; ?>
      
      <?php if(config('services.github.enabled')): ?>
      <a href="<?php echo e(secure_url('login/github')); ?>" class="item">
        <i class="github icon"></i>
        Github
      </a>
      <?php endif; ?>

      <?php if(config('services.twitter.enabled')): ?>
      <a href="<?php echo e(secure_url('login/twitter')); ?>" class="item">
        <i class="twitter icon"></i>
        Twitter
      </a>
      <?php endif; ?>

      <?php if(config('services.linkedin.enabled')): ?>
      <a href="<?php echo e(secure_url('login/linkedin')); ?>" class="item">
        <i class="linkedin icon"></i>
        Linkedin
      </a>
      <?php endif; ?>

      <?php if(config('services.vkontakte.enabled')): ?>
      <a href="<?php echo e(secure_url('login/vkontakte')); ?>" class="item">
        <i class="vk icon"></i>
        Vkontakte (VK)
      </a>
      <?php endif; ?>
    </div>
  </div>

  <div class="ui horizontal divider"><?php echo e(__('Or')); ?></div>
  <?php endif; ?>
  
  <form class="ui large form" action="<?php echo e(route('login', ['redirect' => request()->redirect ?? '/'])); ?>" method="post">
    <?php echo csrf_field(); ?> 

    <div class="field">
      <label>Email</label>
      <input type="email" placeholder="..." name="email" value="<?php echo e(old('email', session('email'))); ?>" required autocomplete="email" autofocus>

      <?php $__errorArgs = ['email'];
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
      <label><?php echo e(__('Password')); ?></label>
      <input type="password" placeholder="..." name="password" required autocomplete="current-password">

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
      <div class="ui checkbox">
        <input type="checkbox" name="remember" id="remember">
        <label class="checkbox" for="remember"><?php echo e(__('Remember me')); ?></label>
      </div>
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

    <?php if(captcha_is_enabled('login')): ?>
    <div class="field d-flex justify-content-center">
      <?php echo render_captcha(); ?>


      <?php if(captcha_is('mewebstudio')): ?>
        <input type="text" name="captcha" value="<?php echo e(old('captcha')); ?>" class="ml-1">
      <?php endif; ?>
    </div>
    <?php endif; ?>

    <div class="field mb-0">
      <button class="ui yellow large fluid circular button" type="submit"><?php echo e(__('Login')); ?></button>
    </div>

    <div class="field">
      <div class="ui text menu my-0">
        <a class="item right aligned" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('Forgot password')); ?></a>
      </div>
    </div>
  </form>
</div>

<div class="content center aligned">
  <p><?php echo e(__('Don\'t have an account')); ?> ?</p>
  <a href="<?php echo e(route('register')); ?>" class="ui fluid large blue circular button"><?php echo e(__('Create an account')); ?></a>
</div>

<script>
    'use strict';
    
    $(function()
    {
        $('.ui.dropdown').dropdown();
    })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('auth.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views/auth/login.blade.php ENDPATH**/ ?>