<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<meta charset="UTF-8">
		<meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon'))); ?>">
		
		<title><?php echo $__env->yieldContent('title'); ?></title>

		<style>
			<?php if(locale_direction() === 'ltr'): ?>
			@font-face {
		    font-family: 'Valexa';
		    src: url("/assets/fonts/Glegoo/Glegoo-Regular.ttf");
		    font-weight: 400;
		    font-style: normal;
			}

			@font-face {
		    font-family: 'Valexa';
		    src: url("/assets/fonts/Glegoo/Glegoo-Bold.ttf");
		    font-weight: 700;
		    font-style: normal;
			}
			<?php else: ?>
			@font-face {
		    font-family: 'Valexa';
		    src: url("/assets/fonts/Almarai/Almarai-Regular.ttf");
		    font-weight: 400;
		    font-style: normal;
			}

			@font-face {
		    font-family: 'Valexa';
		    src: url("/assets/fonts/Almarai/Almarai-Bold.ttf");
		    font-weight: 700;
		    font-style: normal;
			}
			<?php endif; ?>
		</style>

		<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

		<!-- jQuery -->  
		<script type="application/javascript" src="<?php echo e(asset_('assets/jquery/jquery-3.5.1.min.js')); ?>"></script>
		
    <!-- Semantic-UI -->
    <link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2-'.locale_direction().'.css')); ?>">
    <script type="application/javascript" src="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2.js')); ?>"></script>

    <!-- Spacing CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/css-spacing/spacing-'.locale_direction().'.css')); ?>">

		<!-- App CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/admin/app-'.locale_direction().'.css')); ?>">
		
		<!-- App Javascript -->
		<script type="application/javascript" src="<?php echo e(asset_('assets/admin/app.js')); ?>"></script>
		
		<script type="application/javascript">
			"use strict";

			window.translation = <?php echo json_encode(config('translation', JSON_UNESCAPED_UNICODE), 512) ?>;
		</script>

		<?php echo $__env->yieldContent('additional_head_tags'); ?>
	</head>
	

	<body dir="<?php echo e(locale_direction()); ?>" vhidden>

		<div class="ui main fluid container">
			<div class="ui celled grid m-0 shadowless">
				<div class="row" id="content">
					
					<div class="l-side-wrapper column">
						<div class="ui header p-0">
							<a href="<?php echo e(route('admin')); ?>">
								<img class="ui image mx-auto" src="<?php echo e(asset_("storage/images/".config('app.logo'))); ?>" alt="logo">
							</a>
						</div>

						<div class="ui vertical fluid menu togglable">

							<a class="item parent" href="<?php echo e(route('admin')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/dashboard.png')); ?>">
								<?php echo e(__('Dashboard')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('products')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/product.png')); ?>">
								<?php echo e(__('Products')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>
							
							<?php if(config('app.subscriptions.enabled')): ?>
							<a class="item parent" href="<?php echo e(route('subscriptions')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/product.png')); ?>">
								<?php echo e(__('Pricing table')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>
							<?php endif; ?>

							<a class="item parent" href="<?php echo e(route('categories')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/categories.png')); ?>">
								<?php echo e(__('Categories')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('licenses')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/licenses.png')); ?>">
								<?php echo e(__('Licenses')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('transactions')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/cart.png')); ?>">
								<?php echo e(__('Transactions')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('users_subscriptions')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/subscriptions.png')); ?>">
								<?php echo e(__('Users subscriptions')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('coupons')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/coupons.png')); ?>">
								<?php echo e(__('Coupons')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<?php if(config('app.blog.enabled')): ?>
							<a class="item parent" href="<?php echo e(route('posts')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/posts.png')); ?>">
								<?php echo e(__('Posts')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>
							<?php endif; ?>

							<a class="item parent" href="<?php echo e(route('pages')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/pages.png')); ?>">
								<?php echo e(__('Pages')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('keys')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/key.png')); ?>">
								<?php echo e(__('Keys')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('comments')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/comments.png')); ?>">
								<?php echo e(__('Comments')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('users')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/user.png')); ?>">
								<?php echo e(__('Users')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('reviews')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/reviews.png')); ?>">
								<?php echo e(__('Reviews')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('payment_links')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/dollar.png')); ?>">
								<?php echo e(__('Payment links')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('affiliate.balances')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/dollar.png')); ?>">
								<?php echo e(__('Affiliate Cashouts')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('subscribers')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/emails.png')); ?>">
								<?php echo e(__('Newsletter')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('faq')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/question-mark.png')); ?>">
								<?php echo e(__('FAQ')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>
							
							<a class="item parent logout" href="<?php echo e(route('support')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/help.png')); ?>">
								<?php echo e(__('Support messages')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" href="<?php echo e(route('searches')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/searches.png')); ?>">
								<?php echo e(__('Searches')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<div class="dropdown active">
								<div class="item parent">
									<img src="<?php echo e(asset_('assets/images/left_menu_icons/settings.png')); ?>">
									<?php echo e(__('Settings')); ?>

									<i class="circle outline icon mx-0"></i>
								</div>
								<div class="children settings">
									<a class="item" href="<?php echo e(url('admin/settings/general')); ?>"><span><?php echo e(__('General')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/mailer')); ?>"><span><?php echo e(__('Mailer')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/payments')); ?>"><span><?php echo e(__('Payments')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/files_host')); ?>"><span><?php echo e(__('Storage')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/affiliate')); ?>"><span><?php echo e(__('Affiliate')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/social_login')); ?>"><span><?php echo e(__('Social Login')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/search_engines')); ?>"><span><?php echo e(__('Search engines')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/adverts')); ?>"><span><?php echo e(__('Ads')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/chat')); ?>"><span><?php echo e(__('Chat')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/captcha')); ?>"><span><?php echo e(__('Captcha')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/translations')); ?>"><span><?php echo e(__('Translations')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/database')); ?>"><span><?php echo e(__('Database')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/cache')); ?>"><span><?php echo e(__('Cache')); ?></span></a>
									<a class="item" href="<?php echo e(url('admin/settings/bulk_upload')); ?>"><span><?php echo e(__('Bulk upload')); ?></span></a>
								</div>
							</div>
							
							<a class="item parent logout" href="<?php echo e(route('licenses_validation_form')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/certificate.png')); ?>">
								<?php echo e(__('Validate licenses')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent logout" href="<?php echo e(route('profile.edit')); ?>">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/user.png')); ?>">
								<?php echo e(__('Profile')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent" id="report-errors">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/report.png')); ?>">
								<?php echo e(__('Report errors')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<a class="item parent logout">
								<img src="<?php echo e(asset_('assets/images/left_menu_icons/logout.png')); ?>">
								<?php echo e(__('Logout')); ?>

								<i class="circle outline icon mx-0"></i>
							</a>

							<form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>

						</div>
					</div>

					<div id="vertical-divider"></div>

					<div class="r-side-wrapper column">
						<div class="ui unstackable secondary menu px-1" id="top-menu">
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
							</div>
						</div>

						<div class="ui text menu breadcrumb mb-0">
							<div class="item header">
								<?php echo $__env->yieldContent('title'); ?>
							</div>
						</div>

						<div class="ui hidden divider mt-0"></div>

						<?php echo $__env->yieldContent('content'); ?>

						<footer class="row">
							<div class="ui secondary unstackable menu m-0">
								<span class="item header"><?php echo e(config('app.name')); ?> © <?php echo e(date('Y')); ?> <?php echo e(__('All right reserved')); ?></span>
							</div>						

							<form action="<?php echo e(route('set_locale')); ?>" method="post" class="d-none" id="set-locale">
								<input type="hidden" name="redirect" value="<?php echo e(url()->full()); ?>">
								<input type="hidden" name="locale">
							</form>
						</footer>
					</div>
				</div>

			</div>
		</div>

		<div id="cover" class="d-none"></div>
	</body>
</html>
<?php /**PATH D:\laragon\www\valexa\resources\views\back\master.blade.php ENDPATH**/ ?>