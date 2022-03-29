<a class="item ui large button capitalize" href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a>

<div class="right menu">
  <div class="item ui dropdown admin-notifications">
    <div class="text bold">
      <i class="bell outline icon mx-0"></i>
      <span>(<?php echo e($admin_notifications->total()); ?>)</span>
    </div>

    <div class="left menu rounded-corner">
      <?php $__currentLoopData = $admin_notifications ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin_notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a class="item" data-id="<?php echo e($admin_notif->item_id); ?>" data-table="<?php echo e($admin_notif->table); ?>">
        <div class="header">
          <span><?php echo e($admin_notif->user); ?></span>
          <span><?php echo e($admin_notif->created_at->diffForHumans()); ?></span>
        </div>
        <div class="content">
          <?php echo e(__($admin_notif->content)); ?>

        </div>
      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <a href="<?php echo e(route('admin_notifs')); ?>" class="item all"><?php echo e(__('View all')); ?></a>
    </div>
  </div>

  <?php if(count(config('langs', [])) > 1): ?>
  <div class="item ui dropdown languages">
    <div class="text bold">
      <i class="globe icon mx-0"></i>
      <?php echo e(__(mb_ucfirst(session('locale', config('app.locale'))))); ?>

    </div>

    <div class="left menu rounded-corner">
      <?php $__currentLoopData = \LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale_code => $supported_locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="item" data-locale="<?php echo e($locale_code); ?>">
        <?php echo e($supported_locale['native'] ?? ''); ?>

      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="item ui dropdown user">
    <span class="default text capitalize"><?php echo e(auth()->user()->name); ?></span>
    <img src="<?php echo e(asset_("storage/avatars/".(auth()->user()->avatar ?? 'default.png'))."?v=".time()); ?>" class="ui image avatar ml-1">

    <div class="left menu rounded-corner">
      <a class="item" href="<?php echo e(route('profile.edit')); ?>">
        <i class="user outline icon"></i>
        <?php echo e(__('Profile')); ?>

      </a>
      <div class="item">
        <i class="cog icon"></i>
        <?php echo e(__('Settings')); ?>

        <div class="menu settings left rounded-corner">
            <a href="<?php echo e(route('settings', ['settings_name' => 'general'])); ?>" class="item"><?php echo e(__('General')); ?></a>
            <a href="<?php echo e(route('settings', ['settings_name' => 'search_engines'])); ?>" class="item"><?php echo e(__('Search engines')); ?></a>
            <a href="<?php echo e(route('settings', ['settings_name' => 'payments'])); ?>" class="item"><?php echo e(__('Payments')); ?></a>
            <a href="<?php echo e(route('settings', ['settings_name' => 'social_login'])); ?>" class="item"><?php echo e(__('Social Login')); ?></a>
            <a href="<?php echo e(route('settings', ['settings_name' => 'mailer'])); ?>" class="item"><?php echo e(__('Mailer')); ?></a>
            <a href="<?php echo e(route('settings', ['settings_name' => 'files_host'])); ?>" class="item"><?php echo e(__('Files host')); ?></a>
        </div>
      </div>
      <a class="item" href="<?php echo e(route('admin')); ?>">
        <i class="chart area icon"></i>
        <?php echo e(__('Dashboard')); ?>

      </a>
      <a class="item logout">
        <i class="sign out alternate icon"></i>
        <?php echo e(__('Logout')); ?>

      </a>
    </div>
  </div>

	<a class="header item mobile-only" id="mobile-menu-toggler">
		<i class="bars large icon mx-0"></i>
	</a>
</div><?php /**PATH D:\laragon\www\valexa\resources\views\back\includes\top_menu.blade.php ENDPATH**/ ?>