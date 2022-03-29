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

</div><?php /**PATH D:\laragon\www\valexa\resources\views\back\includes\left_sidebar.blade.php ENDPATH**/ ?>