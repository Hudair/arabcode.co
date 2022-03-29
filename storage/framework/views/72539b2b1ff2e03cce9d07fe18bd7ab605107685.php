

<?php $__env->startSection('additional_head_tags'); ?>
	<meta name="robots" content="noindex,nofollow">

	<script type="application/javascript">
		window.props['subscriptionId'] = <?php echo e($subscription->id); ?>;
		window.props['subscriptionPrice'] = '<?php echo e($subscription->price); ?>';
	</script>

	<?php if(config('payments.stripe.enabled')): ?>
		<script src="https://js.stripe.com/v3/"></script>
		<script>
			'use strict';
			var stripe = Stripe('<?php echo e(config('payments.stripe.client_id')); ?>');
		</script>
	<?php endif; ?>

	<?php if(config('payments.payhere.enabled')): ?>
		<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
	<?php endif; ?>

	<?php if(config('payments.omise.enabled')): ?>
	<script type="text/javascript" src="https://cdn.omise.co/omise.js">
	</script>

	<script>
		'use strict';
		window.omisePublicKey = '<?php echo e(config('payments.omise.public_key')); ?>';
	</script>
	<?php endif; ?>

	<?php if(config('payments.spankpay.enabled')): ?>
	<script type="text/javascript" src="<?php echo e(asset_("assets/front/spankpay.js")); ?>"></script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('pre_js'); ?>
<?php if(config('payments.authorize_net.enabled')): ?>
<script type="text/javascript" src="https://js<?php echo e(config('payments.authorize_net.mode') == 'live' ? '' : 'test'); ?>.authorize.net/v3/AcceptUI.js" charset="utf-8" defer=""></script>

<script src="https://js<?php echo e(config('payments.authorize_net.mode') == 'live' ? '' : 'test'); ?>.authorize.net/v1/Accept.js"></script>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>

<div vhidden v-if="trasactionMsg === 'processing'">
	<div class="ui active dimmer">
    <div class="ui small text loader"><?php echo e(__('Processing')); ?></div>
  </div>
</div>

<div class="ui shadowless celled grid hasItems my-0" id="checkout-page" vhidden>
	<!-- CART ITEMS -->
	<div class="column left">
		<div class="ui fluid card">
			<div class="content cart-title">
				<div class="header"><?php echo e(__('Subscription')); ?></div>
	      <div class="sub header mt-1">
	        <p><?php echo e(__(':name Plan', ['name' => $subscription->name])); ?></p>
	      </div>
			</div>

			<div class="content cart-items">
				<div class="cart-item subscription">
					<div class="header">
						<div class="name">
							<?php echo e($subscription->name); ?>

						</div>
						<div class="price">
							<span>{{ price(totalAmount, true, true) }} <sup><?php echo e(currency()); ?></sup></span>
						</div>
					</div>
					<div class="description">
						<?php $__currentLoopData = explode("\n", $subscription->description); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div><i class="check blue icon mr-1-hf"></i><?php echo e(__($note)); ?></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- PAYMENT METHODS -->
	<div class="column right">
		<div class="payment-methods w-100">
			<div class="total-fee">
				<div class="fee">
					<?php echo e(__('Purchase Fee : ')); ?>

					<span v-if="!isNaN(getPaymentFee())">
						{{ price(getPaymentFee()) }}
					</span>
				</div>

				<div class="total">
					<?php echo e(__('Total : ')); ?>

					<span v-if="!isNaN(getTotalAmount())">
						{{ price(getTotalAmount(), true, true) }}
					</span>
				</div>
			</div>

			<?php if(config('pay_what_you_want.enabled') && config('pay_what_you_want.for.subscriptions')): ?>
			<div class="ui large form custom-amount">
				<div class="field">
					<label><?php echo e(__('Pay what you want')); ?></label>
					<input id="custom-amount" :disabled="paymentProcessor.length > 0 && minimumPayments[paymentProcessor] == null" step="0.01" type="number" v-model="customAmount" :placeholder="__('Minimum :amount', {amount: priceConverted(minimumPayments[paymentProcessor] || 0)})">
				</div>
			</div>
			<?php endif; ?>

		  <div class="ui unstackable items" v-if="getTotalAmount() > 0 || customAmount > 0">
				<?php if(config('payments.stripe.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'stripe')}" @click="setPaymentProcessor('stripe')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Stripe')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'stripe')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.flutterwave.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'flutterwave')}" @click="setPaymentProcessor('flutterwave')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Flutterwave')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'flutterwave')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.skrill.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'skrill')}" @click="setPaymentProcessor('skrill')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Skrill')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'skrill')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>
				
				<?php if(config('payments.sslcommerz.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'sslcommerz')}" @click="setPaymentProcessor('sslcommerz')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Sslcommerz')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'sslcommerz')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.paypal.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'paypal')}" @click="setPaymentProcessor('paypal')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Paypal')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/paypal-curved-64px.png')); ?>" alt="Paypal">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'paypal')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.authorize_net.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'authorize_net')}" @click="setPaymentProcessor('authorize_net')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Authorize.Net')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/paypal-curved-64px.png')); ?>" alt="Paypal">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'authorize_net')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.razorpay.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'razorpay')}" @click="setPaymentProcessor('razorpay')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Razorpay')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'razorpay')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.coingate.enabled')): ?>
				<div class="item crypto" :class="{'active': (paymentProcessor == 'coingate')}" @click="setPaymentProcessor('coingate')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Coingate')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/bch.png')); ?>" alt="bch">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/btc.png')); ?>" alt="btc">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/eth.png')); ?>" alt="eth">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/usdt.png')); ?>" alt="usdt">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/xrp.png')); ?>" alt="xrp">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/ltc.png')); ?>" alt="ltc">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'coingate')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.spankpay.enabled')): ?>
				<div class="item crypto" :class="{'active': (paymentProcessor == 'spankpay')}" @click="setPaymentProcessor('spankpay')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Spankpay')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/bch.png')); ?>" alt="bch">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/btc.png')); ?>" alt="btc">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/eth.png')); ?>" alt="eth">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/usdt.png')); ?>" alt="usdt">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/xrp.png')); ?>" alt="xrp">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/ltc.png')); ?>" alt="ltc">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'spankpay')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>


				<?php if(config('payments.coinpayments.enabled')): ?>
				<div class="item crypto" :class="{'active': (paymentProcessor == 'coinpayments')}" @click="setPaymentProcessor('coinpayments')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Coinpayments')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/bch.png')); ?>" alt="bch">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/btc.png')); ?>" alt="btc">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/eth.png')); ?>" alt="eth">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/xrp.png')); ?>" alt="xrp">
							<img src="<?php echo e(asset_('assets/images/crypto-currency-icons/ltc.png')); ?>" alt="ltc">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'coinpayments')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.midtrans.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'midtrans')}" @click="setPaymentProcessor('midtrans')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Midtrans')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'midtrans')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.iyzico.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'iyzico')}" @click="setPaymentProcessor('iyzico')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Iyzico')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'iyzico')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.payhere.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'payhere')}" @click="setPaymentProcessor('payhere')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Payhere')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'payhere')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.omise.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'omise')}" @click="setPaymentProcessor('omise')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Omise')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/kbank.png')); ?>" title="Kasikorn Bank">
							<img src="<?php echo e(asset_('assets/images/ktc_card.jpg')); ?>" title="Krungthai Card">
							<img src="<?php echo e(asset_('assets/images/krungsri_first_choice.png')); ?>" title="krungsri first choice">
							<img src="<?php echo e(asset_('assets/images/scb.png')); ?>" title="Siam Commercial Bank">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'omise')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.paystack.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'paystack')}" @click="setPaymentProcessor('paystack')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Paystack')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'paystack')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.adyen.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'adyen')}" @click="setPaymentProcessor('adyen')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Adyen')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>	

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'adyen')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.instamojo.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'instamojo')}" @click="setPaymentProcessor('instamojo')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Instamojo')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/visa-curved-64px.png')); ?>" alt="Visa">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'instamojo')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.paymentwall.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'paymentwall')}" @click="setPaymentProcessor('paymentwall')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Paymentwall')); ?></div>
						</div>

						<div class="icons">
							<img src="<?php echo e(asset_('assets/images/mastercard-curved-64px.png')); ?>" alt="Mastercard">
							<img src="<?php echo e(asset_('assets/images/paypal-curved-64px.png')); ?>" alt="Paypal">
							<img src="<?php echo e(asset_('assets/images/american-express-curved-64px.png')); ?>" alt="American-express">
							<img src="<?php echo e(asset_('assets/images/discover-curved-64px.png')); ?>" alt="Discover">
						</div>

						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'paymentwall')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(config('payments.offline.enabled')): ?>
				<div class="item" :class="{'active': (paymentProcessor == 'offline')}" @click="setPaymentProcessor('offline')">
					<div class="wrapper">
						<div class="ui small header">
							<div class="sub header"><?php echo e(__('Offline payment')); ?></div>
						</div>
						<div class="content">
							<i class="circle outline large icon mx-0" :class="{'dot blue': (paymentProcessor == 'offline')}"></i>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>

			<div class="cart-payment cart-checkout">
				<form action="<?php echo e(route('home.checkout.payment')); ?>" method="post" id="form-checkout" class="ui big form" :class="{'d-none': !/^iyzico|paystack|payhere|coinpayments|flutterwave$/.test(paymentProcessor) || (<?php echo e(var_export(\Auth::check())); ?> && paymentProcessor == 'paystack')}">
					<?php echo csrf_field(); ?>
					<input type="hidden" name="subscription_id" :value="<?php echo e($subscription->id); ?>">
					<input type="hidden" name="cart" :value="JSON.stringify(cart)">
					<input type="hidden" name="processor" :value="paymentProcessor">
					<input type="hidden" name="coupon" :value="couponRes.status ? couponRes.coupon.code : ''">
					<input type="hidden" name="locale" value="<?php echo e(get_locale()); ?>">

					<?php if(config('payments.authorize_net.enabled')): ?>
					<input type="hidden" name="dataValue" id="dataValue" />
    			<input type="hidden" name="dataDescriptor" id="dataDescriptor" />
    			<?php endif; ?>

					<?php if(config('payments.omise.enabled')): ?>
					<input type="hidden" name="omiseToken">
  				<input type="hidden" name="omiseSource">
					<?php endif; ?>

					<?php if(collect(config('payments'))->except('pay_what_you_want')->where('enabled', 'on')->count() && 
					config('payments.pay_what_you_want')): ?>
					<input type="hidden" name="custom_amount" step="0.01" v-model="customAmount">
					<?php endif; ?>

					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="ui negative fluid small message">
          	<i class="close icon mr-0"></i>
            <?php echo e($message); ?>

          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<div v-if="/iyzico|payhere|sslcommerz|flutterwave/i.test(paymentProcessor)">
						<div class="two fields">
							<div class="field">
			          <label><?php echo e(__('First name')); ?></label>
			          <input type="text" placeholder="..." name="buyer[firstname]" value="<?php echo e(old('buyer.firstname', request()->user()->firstname ?? null)); ?>" required autocomplete="firstname">
			        </div>

			        <div class="field">
			          <label><?php echo e(__('Last name')); ?></label>
			          <input type="text" placeholder="..." name="buyer[lastname]" value="<?php echo e(old('buyer.lastname', request()->user()->lastname ?? null)); ?>" required autocomplete="lastname">
			        </div>
						</div>

		        <div class="two fields">
		          <div class="field" v-if="paymentProcessor === 'iyzico'">
		            <label><?php echo e(__('ID number')); ?></label>
		            <input type="text" placeholder="..." name="buyer[id_number]" value="<?php echo e(old('buyer.id_number', request()->user()->id_number ?? null)); ?>" required autocomplete="id_number">
		            <?php $__errorArgs = ['buyer.id_number'];
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

		          <div class="field" v-if="/payhere|sslcommerz|flutterwave/i.test(paymentProcessor)">
		            <label><?php echo e(__('Phone')); ?></label>
		            <input type="text" placeholder="..." name="buyer[phone]" value="<?php echo e(old('buyer.phone', request()->user()->phone ?? null)); ?>" required autocomplete="phone">
		            <?php $__errorArgs = ['buyer.phone'];
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
		            <label><?php echo e(__('Email')); ?></label>
		            <input type="email" placeholder="..." name="buyer[email]" value="<?php echo e(old('buyer.email', request()->user()->email ?? null)); ?>" required autocomplete="email">
		            <input type="hidden" class="d-none" value="<?php echo e(request()->ip()); ?>" name="ip_address">
		          </div>
		        </div>

		        <div class="two fields" v-if="paymentProcessor != 'flutterwave'">
		          <div class="field">
		            <label><?php echo e(__('City')); ?></label>
		            <input type="text" placeholder="..." name="buyer[city]" value="<?php echo e(old('buyer.city', request()->user()->city ?? null)); ?>" required autocomplete="city">
		          </div>

		          <div class="field">
		            <label><?php echo e(__('Country')); ?></label>
		            <input type="text" placeholder="..." name="buyer[country]" value="<?php echo e(old('buyer.country', request()->user()->country ?? null)); ?>" required autocomplete="country">
		          </div>
		        </div>

		        <div class="field" v-if="paymentProcessor != 'flutterwave'">
		          <label><?php echo e(__('Address')); ?></label>
		          <input type="text" placeholder="..." name="buyer[address]" value="<?php echo e(old('buyer.address', request()->user()->address ?? null)); ?>" required autocomplete="address">
		        </div>

		        <div class="two fields" v-if="paymentProcessor == 'sslcommerz'">
		        	<div class="field">
			          <label><?php echo e(__('Zip code')); ?></label>
			          <input type="text" placeholder="..." name="buyer[zip_code]" value="<?php echo e(old('buyer.zip_code', request()->user()->zip_code ?? null)); ?>" required autocomplete="address">
			        </div>

			        <div class="field">
			          <label><?php echo e(__('State')); ?></label>
			          <input type="text" placeholder="..." name="buyer[state]" value="<?php echo e(old('buyer.state', request()->user()->state ?? null)); ?>" required autocomplete="state">
			        </div>
		        </div>
					</div>
				</form>

				<?php if(config('payments.offline.enabled')): ?>
				<div v-if="paymentProcessor == 'offline'">
					<div class="offline-payment">
						<?php echo config('payments.offline.instructions'); ?>

					</div>
				</div>
				<?php endif; ?>

				<form id="coupon-form" class="ui big form">
					<div class="message" :class="{negative: !couponRes.status, positive: couponRes.status}" v-if="couponRes.msg !== undefined">
						{{ couponRes.msg }}
					</div>

					<div class="ui action fluid input" v-if="couponFormVisible">
					  <input type="text" name="coupon-code" placeholder="<?php echo e(__('Enter your coupon code...')); ?>" spellcheck="false" :disabled="couponRes.status">
					  <a class="ui button" v-if="!couponRes.status" @click="applyCoupon($event)"><?php echo __('Apply'); ?></a>
						<a class="ui button" v-else class="reset" @click="removeCoupon()"><?php echo e(__('Reset')); ?></a>
					</div>
				</form>

				<div class="bottom" :class="{'mt-1': couponFormVisible}">
					<?php if(auth()->guard()->check()): ?>
					<button type="button" class="ui yellow circular big button mx-0" @click="checkout($event)"><?php echo e(__('Checkout')); ?></button>

					<div class="coupon-text" @click="toggleCouponForm"><?php echo e(__('Do you have a coupon code ?')); ?></div>
					<?php else: ?>
					<div class="buttons w-100 p-0">
						<a type="button" class="ui fluid circular yellow big button mx-0" href="<?php echo e(route('login', ['redirect' => url()->full()])); ?>"><?php echo e(__('Login to checkout')); ?></a>

						<div class="coupon-text right aligned mt-2" @click="toggleCouponForm"><?php echo e(__('Do you have a coupon code ?')); ?></div>
					</div>
					<?php endif; ?>

					<button type="button"
						id="AcceptUIBtn"
		        class="AcceptUI d-none"
		        data-billingAddressOptions='{"show":true, "required":false}' 
		        data-apiLoginID="<?php echo e(config('payments.authorize_net.api_login_id')); ?>" 
		        data-clientKey="<?php echo e(config('payments.authorize_net.client_key')); ?>"
		        data-acceptUIFormBtnTxt="Submit" 
		        data-acceptUIFormHeaderTxt="Card Information"
		        data-paymentOptions='{"showCreditCard": true, "showBankAccount": true}' 
		        data-responseHandler="authorizeNetResponseHandler">Pay
		    </button>
				</div>
		  </div>
	  </div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\checkout\subscription.blade.php ENDPATH**/ ?>