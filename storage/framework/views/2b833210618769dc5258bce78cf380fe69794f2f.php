

<!DOCTYPE html>
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

		<!-- Countdown -->
		<script type="application/javascript" src="<?php echo e(asset_('assets/jquery.countdown.min.js')); ?>"></script>

		<!-- Marquee -->
		<script type="application/javascript" src="<?php echo e(asset_('assets/jquery.marquee.min.js')); ?>"></script>
		
		<!-- Js-Cookie -->
		<script type="application/javascript" src="<?php echo e(asset_('assets/js.cookie.min.js')); ?>"></script>

		<style>
			<?php echo load_font(); ?>

		</style>

    <!-- Semantic-UI -->
    <link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2-'.locale_direction().'.css')); ?>">
    <script type="application/javascript" src="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2.js')); ?>"></script>

    <!-- Spacing CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/css-spacing/spacing-'.locale_direction().'.css')); ?>">

    
		<!-- App CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/front/default-'.locale_direction().'.css')); ?>">

		  
		<script src="<?php echo e(asset_('assets/wavesurfer.min.js')); ?>"></script>

		<!-- Search engines verification -->
		<meta name="google-site-verification" content="<?php echo e(config('app.google')); ?>">
		<meta name="msvalidate.01" content="<?php echo e(config('app.bing')); ?>">
		<meta name="yandex-verification" content="<?php echo e(config('app.yandex')); ?>">
        
		<script>
			'use strict';
			
			window.props = {
				appName: '<?php echo e(config('app.name')); ?>',
				itemId: null,
	      product: {},
	      products: {},
	      direction: '<?php echo e(locale_direction()); ?>',
	      routes: {
	      	checkout: '<?php echo e(route('home.checkout')); ?>',
	      	products: '<?php echo e(route('home.products.category', '')); ?>',
	      	pages: '<?php echo e(route('home.page', '')); ?>',
	      	payment: '<?php echo e(route('home.checkout.payment')); ?>',
	      	savePayment: '<?php echo e(route('home.checkout.save')); ?>',
	      	coupon: '<?php echo e(route('home.checkout.validate_coupon')); ?>',
	      	productFolder: '<?php echo e(route('home.product_folder_async')); ?>',
	      	notifRead: '<?php echo e(route('home.notifications.read')); ?>',
	      	addToCartAsyncRoute: '<?php echo e(route('home.add_to_cart_async')); ?>',
	      	subscriptionPayment: '<?php echo e(config('app.subscriptions.enabled') ? route('home.subscription.payment') : ''); ?>',
	      },
	      currentRouteName: '<?php echo e(Route::currentRouteName()); ?>',
	      location: window.location,
	      trasactionMsg: '<?php echo e(session('transaction_response')); ?>',
	      paymentProcessors: {
	      	paypal: <?php echo e(var_export(config('payments.paypal.enabled') ? true : false)); ?>,
	      	stripe: <?php echo e(var_export(config('payments.stripe.enabled') ? true : false)); ?>,
					skrill: <?php echo e(var_export(config('payments.skrill.enabled') ? true : false)); ?>,
					razorpay: <?php echo e(var_export(config('payments.razorpay.enabled') ? true : false)); ?>,
					iyzico: <?php echo e(var_export(config('payments.iyzico.enabled') ? true : false)); ?>,
					coingate: <?php echo e(var_export(config('payments.coingate.enabled') ? true : false)); ?>,
					midtrans: <?php echo e(var_export(config('payments.midtrans.enabled') ? true : false)); ?>,
					paystack: <?php echo e(var_export(config('payments.paystack.enabled') ? true : false)); ?>,
					adyen: <?php echo e(var_export(config('payments.adyen.enabled') ? true : false)); ?>,
					instamojo: <?php echo e(var_export(config('payments.instamojo.enabled') ? true : false)); ?>,
					coinpayments: <?php echo e(var_export(config('payments.coinpayments.enabled') ? true : false)); ?>,
					offline: <?php echo e(var_export(config('payments.offline.enabled') ? true : false)); ?>,
					payhere: <?php echo e(var_export(config('payments.payhere.enabled') ? true : false)); ?>,
					spankpay: <?php echo e(var_export(config('payments.spankpay.enabled') ? true : false)); ?>,
					omise: <?php echo e(var_export(config('payments.omise.enabled') ? true : false)); ?>,
					paymentwall: <?php echo e(var_export(config('payments.paymentwall.enabled') ? true : false)); ?>,
					authorize_net: <?php echo e(var_export(config('payments.authorize_net.enabled') ? true : false)); ?>,
					sslcommerz: <?php echo e(var_export(config('payments.sslcommerz.enabled') ? true : false)); ?>,
					flutterwave: <?php echo e(var_export(config('payments.flutterwave.enabled') ? true : false)); ?>,
	      },
	      paymentProcessor: '<?php echo e($payment_processor ?? null); ?>',
	      paymentFees: <?php echo json_encode(config('fees'), 15, 512) ?>,
	      minimumPayments: <?php echo json_encode(config('mimimum_payments'), 15, 512) ?>,
	      translation: <?php echo json_encode(config('translation'), 15, 512) ?>,
	      currency: {
	      	code: '<?php echo e(config('payments.currency_code')); ?>', 
	      	symbol: '<?php echo e(config('payments.currency_symbol')); ?>', 
	      	position: '<?php echo e(config('payments.currency_position', 'left')); ?>'
	      },
	      activeScreenshot: null,
	      subcategories: <?php echo collect(config('categories.category_children', []))->toJson(); ?>,
	      categories: <?php echo collect(config('categories.category_parents', []))->toJson(); ?>,
	      pages: <?php echo collect(config('pages', []))->where('deletable', 1)->toJson(); ?>,
	      workingWithFolders: <?php if(isFolderProcess()): ?> true <?php else: ?> false <?php endif; ?>,
	      removeItemConfirmMsg: '<?php echo e(__('Are you sure you want to remove this item ?')); ?>',
	      exchangeRate: <?php echo e(config('payments.exchange_rate', 1)); ?>,
	      userCurrency: '<?php echo e(currency('code')); ?>',
	      currencies: <?php echo json_encode(config('payments.currencies') ?? [], JSON_UNESCAPED_UNICODE, 512) ?>,
	      currencyDecimals: <?php echo e(config('payments.currencies.'.currency('code').'.decimals') ?? 2); ?>,
	      usersNotif: '<?php echo e(config('app.users_notif', '')); ?>',
	      userNotifs: <?php echo json_encode(config('notifications') ?? [], 15, 512) ?>,
	    }

	    window.isMasonry = '<?php echo e(config('app.masonry_layout') ? '1' : '0'); ?>' === '1';

			<?php if(cache('peaks', [])): ?>
			window.peaks = <?php echo json_encode(cache('peaks', []), 512) ?>;
			<?php endif; ?>
		</script>

		<style>
			<?php if(config('app.cookie.background')): ?>
			#cookies {
				background: <?php echo e(config('app.cookie.background')); ?> !important;
			}
			<?php endif; ?>

			<?php if(config('app.cookie.color')): ?>
			#cookies * {
				color: <?php echo e(config('app.cookie.color')); ?> !important;
			}
			<?php endif; ?>

			<?php if(config('app.cookie.button_bg')): ?>
			#cookies button {
				background: <?php echo e(config('app.cookie.button_bg')); ?> !important;
			}
			<?php endif; ?>
		</style>

		<?php echo $__env->yieldContent('additional_head_tags'); ?>
	</head>
	<body dir="<?php echo e(locale_direction()); ?>" vhidden>
		
		<div class="ui main fluid container <?php echo e(str_ireplace('.', '_', \Route::currentRouteName())); ?>" id="app">
			<div class="ui celled grid m-0 shadowless">

				<div class="row">
					<?php echo $__env->make('front.default.partials.top_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>

				<div class="row">
					<?php echo $__env->yieldContent('top-search'); ?>
				</div>
				
				<div class="row my-1" id="body">
					<?php echo $__env->yieldContent('body'); ?>
				</div>
				
				<div id="blur" @click="toggleMobileMenu" v-if="!menu.mobile.hidden"></div>

				<?php if(config('app.recently_viewed_items')): ?>
				<div id="recently-viewed-items" v-if="Object.keys(recentlyViewedItems).length > 0">
					<div class="title">
						<?php echo e(__('Recently viewed items')); ?>

					</div>
					<div class="items">
						<div :title="viewedItem.name" class="item" v-for="viewedItem, k in recentlyViewedItems">
							<span class="remove" @click="removeRecentViewedItem(k)"><i class="close icon mx-0"></i></span>
							<a :href="'/item/'+viewedItem.id+'/'+viewedItem.slug" class="image" :style="'background-image: url('+ viewedItem.cover +')'"></a>
						</div>
					</div>
				</div>
				<?php endif; ?>
				
				<footer id="footer" class="ui doubling stackable four columns grid mt-0 mx-auto px-0">
					<?php echo $__env->make('front.default.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</footer>

				<?php if(config('app.cookie.text')): ?>
				<div v-cloak>
					<div id="cookies" class="ui segment fluid" v-if="!cookiesAccepted">
						<div class="content"><?php echo config('app.cookie.text'); ?></div>
						<div class="button"><button class="ui rounded button" @click="acceptCookies" type="button"><?php echo e(__('I agree')); ?></button></div>
					</div>
				</div>
				<?php endif; ?>
			</div>

			<div class="ui tiny modal" id="user-message">
			  <div class="content bold">
			    <p>{{ userMessage }}</p>
			  </div>
			</div>
		</div>

		<div class="ui dimmer" id="main-dimmer">
			<div class="ui text loader"><?php echo e(__('Processing')); ?></div>
		</div>

		<!-- App JS -->
	  <script type="application/javascript" src="<?php echo e(asset_('assets/front/default.js')); ?>"></script>
		
		<?php if(session('user_message')): ?>
		<script>
			'use strict';

			$(function()
			{
				app.userMessage = "<?php echo session('user_message'); ?>";

				Vue.nextTick(function()
  			{
  				$('#user-message').modal('show')
  			});
			})
		</script>
	  <?php endif; ?>

	  <?php if(config('chat.twak.enabled')): ?>
	  	<!-- start twak.to JS code-->
			<script type="text/javascript">
			var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/<?php echo e(config('chat.twak.property_id')); ?>/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
			})();
			</script>
			<!-- start twak.to JS code-->
	  <?php elseif(config('chat.gist.enabled')): ?>
		  <!-- start Gist JS code-->
			<script>
			    (function(d,h,w){var gist=w.gist=w.gist||[];gist.methods=['trackPageView','identify','track','setAppId'];gist.factory=function(t){return function(){var e=Array.prototype.slice.call(arguments);e.unshift(t);gist.push(e);return gist;}};for(var i=0;i<gist.methods.length;i++){var c=gist.methods[i];gist[c]=gist.factory(c)}s=d.createElement('script'),s.src="https://widget.getgist.com",s.async=!0,e=d.getElementsByTagName(h)[0],e.appendChild(s),s.addEventListener('load',function(e){},!1),gist.setAppId("<?php echo e(config('chat.gist.workspace_id')); ?>"),gist.trackPageView()})(document,'head',window);
			</script>
			<!-- end Gist JS code-->
		<?php elseif(config('chat.other.enabled')): ?>
			<?php echo config('chat.other.code'); ?>

	  <?php endif; ?>

	  <?php echo $__env->yieldContent('post_js'); ?>
	</body>
</html><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\master.blade.php ENDPATH**/ ?>