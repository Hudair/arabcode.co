<div class="row first">
	<div class="column">
		<img class="ui image mx-auto" src="<?php echo e(asset_("storage/images/".config('app.logo'))); ?>" alt="<?php echo e(config('app.name')); ?>">
		<p class="mt-1">
			<?php echo e(config('app.description')); ?>

		</p>
	</div>

	<div class="column">
		<h4><?php echo e(__('Featured Categories')); ?></h4>
		<ul class="p-0">
			<?php $__currentLoopData = config('popular_categories', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><a href="<?php echo e(route('home.products.category', $p_category->slug)); ?>"><?php echo e($p_category->name); ?></a></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>

	<div class="column">
		<h4><?php echo e(__('Additional Resources')); ?></h4>
		<ul class="p-0">
			<li><a href="<?php echo e(route('home.support')); ?>"><?php echo e(__('Contact')); ?></a></li>
			<li><a href="<?php echo e(route('home.support')); ?>"><?php echo e(__('FAQ')); ?></a></li>
			<?php $__currentLoopData = collect(config('pages', []))->where('deletable', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><a href="<?php echo e(route('home.page', $page['slug'])); ?>"><?php echo e($page['name']); ?></a></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</ul>
	</div>
	<div class="column">
		<h4><?php echo e(__('Newsletter')); ?></h4>
		<form class="ui big  form newsletter" action="<?php echo e(route('home.newsletter', ['redirect' => url()->current()])); ?>" method="post">
			<?php echo csrf_field(); ?>
			<p><?php echo e(__('Subscribe to our newsletter to receive news, updates, free stuff and new releases')); ?>.</p>

			<?php if(session('newsletter_subscription_msg')): ?>
			<div class="ui fluid small message inverted p-1-hf">
				<?php echo e(session('newsletter_subscription_msg')); ?>

			</div>
			<?php endif; ?>

			<div class="ui icon input fluid">
				<input type="text" name="email" placeholder="email...">
				<i class="paper plane outline link icon"></i>
			</div>
		</form>
		<div class="social-icons mx-auto justify-content-center mt-1">
			<?php if(config('app.facebook')): ?>
			<a class="ui big circular teal small icon button" href="<?php echo e(config('app.facebook')); ?>">
				<i class="facebook icon"></i>
			</a>
			<?php endif; ?>

			<?php if(config('app.twitter')): ?>
			<a class="ui big circular teal small icon button" href="<?php echo e(config('app.twitter')); ?>">
				<i class="twitter icon"></i>
			</a>
			<?php endif; ?>

			<?php if(config('app.pinterest')): ?>
			<a class="ui big circular teal small icon button" href="<?php echo e(config('app.pinterest')); ?>">
				<i class="pinterest icon"></i>
			</a>
			<?php endif; ?>

			<?php if(config('app.youtube')): ?>
			<a class="ui big circular teal small icon button" href="<?php echo e(config('app.youtube')); ?>">
				<i class="youtube icon"></i>
			</a>
			<?php endif; ?>

			<?php if(config('app.tumblr')): ?>
			<a class="ui big circular teal small icon button mr-0" href="<?php echo e(config('app.tumblr')); ?>">
				<i class="tumblr icon"></i>
			</a>
			<?php endif; ?>
		</div>
	</div>
</div>

<div class="row last">
	<div class="sixteen wide column">
		<div class="ui secondary stackable menu mb-0">
			<?php if(count(config('langs') ?? []) > 1): ?>
	    <div class="item ui top dropdown languages">
	      <div class="text capitalize"><?php echo e(__(config('laravellocalization.supportedLocales.'.session('locale', 'en').'.name'))); ?></div>
	    
	      <div class="left menu rounded-corner">
	      	<div class="header"><?php echo e(__('Languages')); ?></div>
	      	<div class="wrapper">
		        <?php $__currentLoopData = \LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale_code => $supported_locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        <a class="item" @click="setLocale('<?php echo e($locale_code); ?>')">
		          <?php echo e($supported_locale['native'] ?? ''); ?>

		        </a>
		        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		      </div>
	      </div>
	    </div>
	    <?php endif; ?>

	    <?php if(config('affiliate.enabled')): ?>
			<a href="<?php echo e(route('home.affiliate')); ?>" class="item"><?php echo e(__('Affiliate Program')); ?></a>
			<?php endif; ?>

      <?php $__currentLoopData = collect(config('pages', []))->where('deletable', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<a href="<?php echo e(route('home.page', $page['slug'])); ?>" class="item"><?php echo e(__($page['name'])); ?></a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<?php if(count(config('payments.currencies') ?? []) > 1): ?>
			<span class="item ui top dropdown currencies">
				<span class="text uppercase"><?php echo e(session('currency', config('payments.currency_code'))); ?></span>

				<span class="menu rounded-corner">
					<div class="header"><?php echo e(__('Currency')); ?></div>
					<div class="wrapper">
						<?php $__currentLoopData = config('payments.currencies'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e(route('set_currency', ['code' => $code, 'redirect' => url()->full()])); ?>" class="item"><?php echo e($code); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</span>
			</span>
			<?php endif; ?>
			
			<?php if(config('app.blog.enabled')): ?>
			<a class="item" href="<?php echo e(route('home.blog')); ?>"><?php echo e(__('Blog')); ?></a>
			<?php endif; ?>
			
			<a class="item" href="<?php echo e(route('home.support')); ?>"><?php echo e(__('Help')); ?></a>
			
			<?php if(config('payments.guest_checkout') && !\Auth::check()): ?>
			<a class="item" href="<?php echo e(route('home.guest')); ?>"><?php echo e(__('Guest section')); ?></a>
			<?php endif; ?>

			
			<?php if(auth_is_admin()): ?>
			<span class="item ui top dropdown templates">
				<span class="text uppercase"><?php echo e(__('Template')); ?></span>

				<span class="menu">
					<?php $__currentLoopData = ['valexa', 'tendra', 'default']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(route('set_template', ['template' => $template, 'redirect' => url()->full()])); ?>" class="item"><?php echo e(ucfirst($template)); ?></a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</span>
			</span>
			<?php endif; ?>

		</div>

		<div class="ui secondary stackable menu mt-0">
			<span class="item"><?php echo e(config('app.name')); ?> © <?php echo e(date('Y')); ?> <?php echo e(__('All right reserved')); ?></span>
		</div>
	</div>
</div>

<?php if(auth()->guard()->check()): ?>
	<form id="logout-form" action="<?php echo e(route('logout', ['redirect' => url()->full()])); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
<?php endif; ?>

<form action="<?php echo e(route('set_locale')); ?>" method="post" class="d-none" id="set-locale">
	<input type="hidden" name="redirect" value="<?php echo e(url()->full()); ?>">
	<input type="hidden" name="locale" v-model="locale">
</form><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\partials\footer.blade.php ENDPATH**/ ?>