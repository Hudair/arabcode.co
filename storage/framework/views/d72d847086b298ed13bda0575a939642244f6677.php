<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<?php echo config('app.google_analytics'); ?>


		<meta charset="UTF-8">
		<meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon'))); ?>">
		
		<?php echo $__env->make(view_path('partials.meta_data'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

		<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		
		<!-- jQuery -->  
		<script type="application/javascript" src="<?php echo e(asset_('assets/jquery/jquery-3.5.1.min.js')); ?>"></script>

		<style>
			@font-face {
			  font-family: 'Valexa';
			  src: url('/assets/fonts/Poppins/Poppins-Regular.ttf');
			  font-weight: 400;
			  font-style: normal;
			}

			@font-face {
			  font-family: 'Valexa';
			  src: url('/assets/fonts/Poppins/Poppins-Medium.ttf');
			  font-weight: 500;
			  font-style: normal;
			}

			@font-face {
			  font-family: 'Valexa';
			  src: url('/assets/fonts/Poppins/Poppins-SemiBold.ttf');
			  font-weight: 600;
			  font-style: normal;
			}

			@font-face {
			  font-family: 'Valexa';
			  src: url('/assets/fonts/Poppins/Poppins-Bold.ttf');
			  font-weight: 700;
			  font-style: normal;
			}

			@font-face {
			  font-family: 'Valexa';
			  src: url('/assets/fonts/Poppins/Poppins-ExtraBold.ttf');
			  font-weight: 800;
			  font-style: normal;
			}

			@font-face {
			  font-family: 'Valexa';
			  src: url('/assets/fonts/Poppins/Poppins-Black.ttf');
			  font-weight: 900;
			  font-style: normal;
			}	
		</style>

    <!-- Semantic-UI -->
    <link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2-'.locale_direction().'.css')); ?>">
    <script type="application/javascript" src="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2.js')); ?>"></script>

    <!-- Spacing CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/css-spacing/spacing-'.locale_direction().'.css')); ?>">

		<!-- App CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/front/affiliate-'.locale_direction().'.css')); ?>">

		<!-- Search engines verification -->
		<meta name="google-site-verification" content="<?php echo e(config('app.google')); ?>">
		<meta name="msvalidate.01" content="<?php echo e(config('app.bing')); ?>">
		<meta name="yandex-verification" content="<?php echo e(config('app.yandex')); ?>">
    
	</head>

	<body dir="<?php echo e(locale_direction()); ?>">
		
		<div class="ui main fluid container <?php echo e(str_ireplace('.', '_', \Route::currentRouteName())); ?>">
			<div class="panel" style="-webkit-mask-image: url('<?php echo e(asset('storage/images/affiliate-program.svg')); ?>');">
				<div class="ui header">
					<a href="/" class="logo">
            <img class="ui image" src="<?php echo e(asset_("storage/images/".config('app.logo'))); ?>" alt="<?php echo e(config('app.name')); ?>">
					</a>

					<?php echo e(__('Affiliate Program')); ?>


					<div class="sub header mt-1">
						<?php echo e(__('Refer new customers to :app_name and receive :commission% of their purchases', ['app_name' => config('app.name'), 'commission' => config('affiliate.commission', 0)])); ?>

					</div>
				</div>	
			</div>

			<div class="section first">
				<div class="image">
					<img src="<?php echo e(asset('storage/images/affiliate-1.png')); ?>">
				</div>
				<div class="content ml-1">
					<div class="header"><?php echo e(__('Spread the word & start making money')); ?></div>
					<div class="description"><?php echo e(__('Refer new customers to :app_name using your affiliate link and you will receive :commission% of any purchase. Our affiliate tracking cookie lasts :expire days. You will receive commission from all customers that sign up within :expire days after clicking on your affiliate links.', ['app_name' => config('app.name'), 'commission' => config('affiliate.commission', 0), 'expire' => config('affiliate.expire', 0)])); ?></div>
				</div>
			</div>

			<div class="section second">
				<div class="wrapper">
					<div class="content mr-1">
						<div class="header"><?php echo e(__('Creating your affiliate links')); ?></div>
						<div class="description">
							<p><?php echo e(__('To be able to use our affiliate program. You will need to link to :app_name using your affiliate name from your profile page.', ['app_name' => config('app.name')])); ?></p>
							<p><?php echo e(__("Add ?r=AFFILIATE_NAME to any :app_name link, replace AFFILIATE_NAME with your affiliate name and that's it.", ['app_name' => config('app.name')])); ?></p>
							<div class="examples">
								<div class="title"><?php echo e(__('Examples')); ?></div>
								<div><span><?php echo e(__('Homepage')); ?></span> : <?php echo e(env('APP_URL')); ?><span>?r=AFFILIATE_NAME</span></div>
								<div><span><?php echo e(__('Item')); ?></span> : <?php echo e(env('APP_URL')); ?>/item/62/amaze-ball<span>?r=AFFILIATE_NAME</span></div>
								<div><span><?php echo e(__('Category')); ?></span> : <?php echo e(env('APP_URL')); ?>/items/category/graphics<span>?r=AFFILIATE_NAME</span></div>
							</div>
						</div>
					</div>
					<div class="image">
						<img src="<?php echo e(asset('storage/images/affiliate-2.png')); ?>">
					</div>
				</div>
			</div>

			<div class="section third">
				<div class="image">
					<img src="<?php echo e(asset('storage/images/affiliate-3.png')); ?>">
				</div>
				<div class="content ml-1">
					<div class="header"><?php echo e(__('Social Sharing')); ?></div>
					<div class="description"><?php echo e(__("On every item's page there are share buttons to share an item across several social networks including Facebook, Pinterest, Twitter and more. Just click on any share button and you will receive commission on every referred sale.")); ?></div>
				</div>
			</div>

			<div class="section fourth">
				<div class="wrapper">
					<div class="content mr-1">
						<div class="header"><?php echo e(__('Cash out your earnings')); ?></div>
						<div class="description">
							<?php echo config('affiliate.cashout_description'); ?>

						</div>
					</div>
					<div class="image">
						<img src="<?php echo e(asset('storage/images/affiliate-4.png')); ?>">
					</div>
				</div>
			</div>

			<footer id="footer" class="ui doubling stackable four columns grid mt-0 mx-auto px-0">
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
						        <a class="item" data-value="<?php echo e($locale_code); ?>">
						          <?php echo e($supported_locale['native'] ?? ''); ?>

						        </a>
						        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						      </div>
					      </div>
					    </div>
					    <?php endif; ?>

				      <?php $__currentLoopData = collect(config('pages', []))->where('deletable', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a href="<?php echo e(route('home.page', $page['slug'])); ?>" class="item"><?php echo e(__($page['name'])); ?></a>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							
							<?php if(config('app.blog.enabled')): ?>
							<a class="item" href="<?php echo e(route('home.blog')); ?>"><?php echo e(__('Blog')); ?></a>
							<?php endif; ?>
							
							<a class="item" href="<?php echo e(route('home.support')); ?>"><?php echo e(__('Help')); ?></a>
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
				</form>

				<script type="application/javascript">
					'use strict';
					
					$(function()
					{
						$('.ui.dropdown.languages').dropdown({
							action: function(text, value) 
							{
					      $('#set-locale input[name=locale]').val(value);
					      $('#set-locale').submit();
					    }
						})
					})
				</script>
			</footer>
		</div>

	</body>
</html><?php /**PATH D:\laragon\www\valexa\resources\views\front\affiliate.blade.php ENDPATH**/ ?>