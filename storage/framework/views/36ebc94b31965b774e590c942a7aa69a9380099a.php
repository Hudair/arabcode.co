

<?php $__env->startSection('title', __('Payments settings')); ?>

<?php $__env->startSection('additional_head_tags'); ?>

<link href="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'payments')); ?>">

	<div class="field">
		<button type="submit" class="ui pink large circular labeled icon button mx-0">
		  <i class="save outline icon mx-0"></i>
		  <?php echo e(__('Update')); ?>

		</button>

		<button type="button" class="ui grey large circular button mr-0 ml-1-hf" id="disable-all-services"><?php echo e(__('Disable all services')); ?></button>
	</div>

	<?php if($errors->any()): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="ui negative fluid small message">
         	<i class="times icon close"></i>
         	<?php echo e($error); ?>

         </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<?php if(session('settings_message')): ?>
	<div class="ui positive fluid message">
		<i class="times icon close"></i>
		<?php echo e(session('settings_message')); ?>

	</div>
	<?php endif; ?>
	
	<div class="ui fluid divider"></div>
	
	<div class="one column grid" id="settings">

		<div class="ui three doubling stackable cards">

			<!-- FLUTTERWAVE -->
			<div class="fluid card" id="flutterwave">
				<div class="content">
					<h3 class="header">
						<a href="https://www.flutterwave.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/flutterwave_icon.png')); ?>" alt="flutterwave" class="ui small avatar mr-1"><?php echo e(__('Flutterwave')); ?></a>
						<input type="hidden" name="flutterwave[name]" value="flutterwave">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="flutterwave[enabled]"
						    	<?php if(!empty(old('flutterwave.enabled'))): ?>
									<?php echo e(old('flutterwave.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->flutterwave->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="flutterwave[mode]" value="<?php echo e(old('flutterwave.mode', $settings->flutterwave->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Public key')); ?></label>
						<input type="text" name="flutterwave[public_key]" placeholder="..." value="<?php echo e(old('flutterwave.public_key', $settings->flutterwave->public_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="flutterwave[secret_key]" placeholder="..." value="<?php echo e(old('flutterwave.secret_key', $settings->flutterwave->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Payment methods')); ?></label>
						<div  class="ui selection multiple search floating dropdown">
							<input type="hidden" name="flutterwave[methods]" placeholder="..." value="<?php echo e(old('flutterwave.methods', $settings->flutterwave->methods ?? null)); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="account"><?php echo e(__('Account')); ?></div>
								<div class="item" data-value="card"><?php echo e(__('Card')); ?></div>
								<div class="item" data-value="banktransfer"><?php echo e(__('Bankt ransfer')); ?></div>
								<div class="item" data-value="mpesa"><?php echo e(__('Mpesa')); ?></div>
								<div class="item" data-value="mobilemoneyrwanda"><?php echo e(__('Mobile money rwanda')); ?></div>
								<div class="item" data-value="mobilemoneyzambia"><?php echo e(__('Mobile money zambia')); ?></div>
								<div class="item" data-value="qr"><?php echo e(__('Qr')); ?></div>
								<div class="item" data-value="mobilemoneyuganda"><?php echo e(__('Mobile money uganda')); ?></div>
								<div class="item" data-value="ussd"><?php echo e(__('Ussd')); ?></div>
								<div class="item" data-value="credit"><?php echo e(__('Credit')); ?></div>
								<div class="item" data-value="barter"><?php echo e(__('Barter')); ?></div>
								<div class="item" data-value="mobilemoneyghana"><?php echo e(__('Mobile money ghana')); ?></div>
								<div class="item" data-value="payattitude"><?php echo e(__('Payattitude')); ?></div>
								<div class="item" data-value="mobilemoneyfranco"><?php echo e(__('Mobile money franco')); ?></div>
								<div class="item" data-value="paga"><?php echo e(__('Paga')); ?></div>
								<div class="item" data-value="1voucher"><?php echo e(__('1voucher')); ?></div>
								<div class="item" data-value="mobilemoneytanzania"><?php echo e(__('Mobile money tanzania')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Verif hash')); ?></label>
						<input type="text" name="flutterwave[verif_hash]" placeholder="..." value="<?php echo e(old('flutterwave.verif_hash', $settings->flutterwave->verif_hash ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="flutterwave[fee]" placeholder="..." value="<?php echo e(old('flutterwave.fee', $settings->flutterwave->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="flutterwave[minimum]" placeholder="..." value="<?php echo e(old('flutterwave.minimum', $settings->flutterwave->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?></label>
						<input type="text" name="flutterwave[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('flutterwave.auto_exchange_to', $settings->flutterwave->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>




			<!-- PAYPAL -->
			<div class="fluid card" id="paypal">
				<div class="content">
					<h3 class="header">
						<a href="https://www.paypal.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/paypal_icon.png')); ?>" alt="PayPal" class="ui small avatar mr-1"><?php echo e(__('PayPal')); ?></a>
						<input type="hidden" name="paypal[name]" value="paypal">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="paypal[enabled]"
						    	<?php if(!empty(old('paypal.enabled'))): ?>
									<?php echo e(old('paypal.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->paypal->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="paypal[mode]" value="<?php echo e(old('paypal.mode', $settings->paypal->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="paypal[client_id]" placeholder="..." value="<?php echo e(old('paypal.client_id', $settings->paypal->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="paypal[secret_id]" placeholder="..." value="<?php echo e(old('paypal.secret_id', $settings->paypal->secret_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="paypal[fee]" placeholder="..." value="<?php echo e(old('paypal.fee', $settings->paypal->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="paypal[minimum]" placeholder="..." value="<?php echo e(old('paypal.minimum', $settings->paypal->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="paypal[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('paypal.auto_exchange_to', $settings->paypal->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- STRIPE -->
			<div class="fluid card" id="stripe">
				<div class="content">
					<h3 class="header">
						<a href="https://stripe.com/" target="_blank"><i class="circular blue inverted stripe s icon mr-1"></i><?php echo e(__('Stripe')); ?></a>
						<input type="hidden" name="stripe[name]" value="stripe">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="stripe[enabled]"
						    	<?php if(!empty(old('stripe.enabled'))): ?>
									<?php echo e(old('stripe.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->stripe->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="stripe[mode]" value="<?php echo e(old('stripe.mode', $settings->stripe->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="stripe[client_id]" placeholder="..." value="<?php echo e(old('stripe.client_id', $settings->stripe->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="stripe[secret_id]" placeholder="..." value="<?php echo e(old('stripe.secret_id', $settings->stripe->secret_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="stripe[fee]" placeholder="..." value="<?php echo e(old('stripe.fee', $settings->stripe->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Allowed method types')); ?></label>
						<div  class="ui selection multiple search floating dropdown">
							<input type="hidden" name="stripe[method_types]" value="<?php echo e(old('stripe.method_types', $settings->stripe->method_types ?? null)); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="card"><?php echo e(__('Card')); ?></div>
								<div class="item" data-value="bancontact"><?php echo e(__('Bancontact')); ?></div>
								<div class="item" data-value="alipay"><?php echo e(__('Alipay')); ?></div>
								<div class="item" data-value="eps"><?php echo e(__('EPS')); ?></div>
								<div class="item" data-value="fpx"><?php echo e(__('FPX')); ?></div>
								<div class="item" data-value="giropay"><?php echo e(__('Giropay')); ?></div>
								<div class="item" data-value="ideal"><?php echo e(__('Ideal')); ?></div>
								<div class="item" data-value="p24"><?php echo e(__('P24')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="stripe[minimum]" placeholder="..." value="<?php echo e(old('stripe.minimum', $settings->stripe->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="stripe[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('stripe.auto_exchange_to', $settings->stripe->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- CoinGate -->
			<div class="fluid card" id="coingate">
				<div class="content">
					<h3 class="header">
						<a href="https://coingate.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/coingate.png')); ?>" alt="CoinGate" class="ui small avatar mr-1"><?php echo e(__('CoinGate')); ?></a>
						<input type="hidden" name="coingate[name]" value="coingate">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="coingate[enabled]"
						    	<?php if(!empty(old('coingate.enabled'))): ?>
									<?php echo e(old('coingate.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->coingate->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="coingate[mode]" value="<?php echo e(old('coingate.mode', $settings->coingate->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Auth Token')); ?></label>
						<input type="text" name="coingate[auth_token]" placeholder="..." value="<?php echo e(old('coingate.auth_token', $settings->coingate->auth_token ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Receive currency')); ?></label>
						<input type="text" name="coingate[receive_currency]" placeholder="USD" value="<?php echo e(old('coingate.receive_currency', $settings->coingate->receive_currency ?? 'USD')); ?>">
						<small><?php echo e(__('Exchange the received currency to your preferable currency. Default: USD')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></small>
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="coingate[fee]" placeholder="..." value="<?php echo e(old('coingate.fee', $settings->coingate->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="coingate[minimum]" placeholder="..." value="<?php echo e(old('coingate.minimum', $settings->coingate->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="coingate[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('coingate.auto_exchange_to', $settings->coingate->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>
			

			<!-- Midtrans -->
			<div class="fluid card" id="midtrans">
				<div class="content">
					<h3 class="header">
						<a href="https://midtrans.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/midtrans.png')); ?>" alt="midtrans" class="ui small avatar mr-1"><?php echo e(__('Midtrans')); ?></a>
						<input type="hidden" name="midtrans[name]" value="midtrans">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="midtrans[enabled]"
						    	<?php if(!empty(old('midtrans.enabled'))): ?>
									<?php echo e(old('midtrans.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->midtrans->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="midtrans[mode]" value="<?php echo e(old('midtrans.mode', $settings->midtrans->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Client Key')); ?></label>
						<input type="text" name="midtrans[client_key]" placeholder="..." value="<?php echo e(old('midtrans.client_key', $settings->midtrans->client_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Server Key')); ?></label>
						<input type="text" name="midtrans[server_key]" placeholder="..." value="<?php echo e(old('midtrans.server_key', $settings->midtrans->server_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Merchant ID')); ?></label>
						<input type="text" name="midtrans[merchant_id]" placeholder="..." value="<?php echo e(old('midtrans.merchant_id', $settings->midtrans->merchant_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="midtrans[fee]" placeholder="..." value="<?php echo e(old('midtrans.fee', $settings->midtrans->fee ?? null)); ?>">
					</div>
					
					<div class="field">
						<label><?php echo e(__('Allowed methods')); ?></label>
						<div  class="ui selection multiple search floating dropdown">
							<input type="hidden" name="midtrans[methods]" placeholder="..." value="<?php echo e(old('midtrans.methods', $settings->midtrans->methods ?? null)); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="credit_card"><?php echo e(__('Credit card')); ?></div>
								<div class="item" data-value="danamon_online"><?php echo e(__('Danamon online')); ?></div>
								<div class="item" data-value="cimb_clicks"><?php echo e(__('CIMB clicks')); ?></div>
								<div class="item" data-value="bca_klikpay"><?php echo e(__('BCA klikpay')); ?></div>
								<div class="item" data-value="mandiri_clickpay"><?php echo e(__('Mandiri clickpay')); ?></div>
								<div class="item" data-value="bri_epay"><?php echo e(__('BRI epay')); ?></div>
								<div class="item" data-value="bca_klikbca"><?php echo e(__('BCA klikbca')); ?></div>
								<div class="item" data-value="echannel"><?php echo e(__('Echannel')); ?></div>
								<div class="item" data-value="mandiri_ecash"><?php echo e(__('Mandiri ecash')); ?></div>
								<div class="item" data-value="permata_va"><?php echo e(__('Permata va')); ?></div>
								<div class="item" data-value="bca_va"><?php echo e(__('Bca va')); ?></div>
								<div class="item" data-value="bni_va"><?php echo e(__('Bni va')); ?></div>
								<div class="item" data-value="other_va"><?php echo e(__('Other va')); ?></div>
								<div class="item" data-value="indomaret"><?php echo e(__('Indomaret')); ?></div>
								<div class="item" data-value="alfamart"><?php echo e(__('Alfamart')); ?></div>
								<div class="item" data-value="akulaku"><?php echo e(__('Akulaku')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="midtrans[minimum]" placeholder="..." value="<?php echo e(old('midtrans.minimum', $settings->midtrans->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="midtrans[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('midtrans.auto_exchange_to', $settings->midtrans->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- Sslcommerz -->
			<div class="fluid card" id="sslcommerz">
				<div class="content">
					<h3 class="header">
						<a href="https://sslcommerz.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/sslcommerz-icon.png')); ?>" alt="Sslcommerz" class="ui small avatar mr-1"><?php echo e(__('sslcommerz')); ?></a>
						<input type="hidden" name="sslcommerz[name]" value="sslcommerz">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="sslcommerz[enabled]"
						    	<?php if(!empty(old('sslcommerz.enabled'))): ?>
									<?php echo e(old('sslcommerz.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->sslcommerz->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="sslcommerz[mode]" value="<?php echo e(old('sslcommerz.mode', $settings->sslcommerz->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Store ID')); ?></label>
						<input type="text" name="sslcommerz[store_id]" placeholder="..." value="<?php echo e(old('sslcommerz.store_id', $settings->sslcommerz->store_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Store password')); ?></label>
						<input type="text" name="sslcommerz[store_passwd]" placeholder="..." value="<?php echo e(old('sslcommerz.store_passwd', $settings->sslcommerz->store_passwd ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Use IPN')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="sslcommerz[use_ipn]" value="<?php echo e(old('sslcommerz.use_ipn', $settings->sslcommerz->use_ipn ?? '1')); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="1" default><?php echo e(__('Yes')); ?></div>
								<div class="item" data-value="0"><?php echo e(__('No')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="sslcommerz[fee]" placeholder="..." value="<?php echo e(old('sslcommerz.fee', $settings->sslcommerz->fee ?? null)); ?>">
					</div>
					
					<div class="field">
						<label><?php echo e(__('Allowed methods')); ?></label>
						<div  class="ui selection multiple search floating dropdown">
							<input type="hidden" name="sslcommerz[methods]" placeholder="..." value="<?php echo e(old('sslcommerz.methods', $settings->sslcommerz->methods ?? null)); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item center aligned header disabled"><?php echo e(__('Specific methods')); ?></div>
								<div class="item" title="BRAC VISA" data-value="brac_visa"><?php echo e(__('Brac_ isa')); ?></div>
								<div class="item" title="Dutch Bangla VISA" data-value="dbbl_visa"><?php echo e(__('Dbbl visa')); ?></div>
								<div class="item" title="City Bank Visa" data-value="city_visa"><?php echo e(__('City visa')); ?></div>
								<div class="item" title="EBL Visa" data-value="ebl_visa"><?php echo e(__('Ebl visa')); ?></div>
								<div class="item" title="Southeast Bank Visa" data-value="sbl_visa"><?php echo e(__('Sbl visa')); ?></div>
								<div class="item" title="BRAC MASTER" data-value="brac_master"><?php echo e(__('Brac master')); ?></div>
								<div class="item" title="MASTER Dutch-Bangla" data-value="dbbl_master"><?php echo e(__('Dbbl master')); ?></div>
								<div class="item" title="City Master Card" data-value="city_master"><?php echo e(__('City master')); ?></div>
								<div class="item" title="EBL Master Card" data-value="ebl_master"><?php echo e(__('Ebl master')); ?></div>
								<div class="item" title="Southeast Bank Master Card" data-value="sbl_master"><?php echo e(__('Sbl master')); ?></div>
								<div class="item" title="City Bank AMEX" data-value="city_amex"><?php echo e(__('City_amex')); ?></div>
								<div class="item" title="QCash" data-value="qcash"><?php echo e(__('Qcash')); ?></div>
								<div class="item" title="DBBL Nexus" data-value="dbbl_nexus"><?php echo e(__('Dbbl nexus')); ?></div>
								<div class="item" title="Bank Asia IB" data-value="bankasia"><?php echo e(__('Bankasia')); ?></div>
								<div class="item" title="AB Bank IB" data-value="abbank"><?php echo e(__('Abbank')); ?></div>
								<div class="item" title="IBBL IB and Mobile Banking" data-value="ibbl"><?php echo e(__('Ibbl')); ?></div>
								<div class="item" title="Mutual Trust Bank IB" data-value="mtbl"><?php echo e(__('Mtbl')); ?></div>
								<div class="item" title="Bkash Mobile Banking" data-value="bkash"><?php echo e(__('Bkash')); ?></div>
								<div class="item" title="DBBL Mobile Banking" data-value="dbblmobilebanking"><?php echo e(__('Dbblmobilebanking')); ?></div>
								<div class="item" title="City Touch IB" data-value="city"><?php echo e(__('City')); ?></div>
								<div class="item" title="Upay" data-value="upay"><?php echo e(__('Upay')); ?></div>
								<div class="item" title="Tap N Pay Gateway" data-value="tapnpay"><?php echo e(__('Tapnpay')); ?></div>
								<div class="item center aligned header disabled"><?php echo e(__('Global methods')); ?></div>
								<div class="item" title="For all internet banking" data-value="internetbank"><?php echo e(__('Internetbank')); ?></div>
								<div class="item" title="For all mobile banking" data-value="mobilebank"><?php echo e(__('Mobilebank')); ?></div>
								<div class="item" title="For all cards except visa,master and amex" data-value="othercard"><?php echo e(__('Othercard')); ?></div>
								<div class="item" title="For all visa" data-value="visacard"><?php echo e(__('Visacard')); ?></div>
								<div class="item" title="For All Master card" data-value="mastercard"><?php echo e(__('Mastercard')); ?></div>
								<div class="item" title="For Amex Card" data-value="amexcard"><?php echo e(__('Amexcard')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="sslcommerz[minimum]" placeholder="..." value="<?php echo e(old('sslcommerz.minimum', $settings->sslcommerz->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="sslcommerz[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('sslcommerz.auto_exchange_to', $settings->sslcommerz->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- RAZOPAY -->
			<div class="fluid card" id="razorpay">
				<div class="content">
					<h3 class="header">
						<a href="https://razorpay.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/razorpay_icon.png')); ?>" alt="razorpay" class="ui small avatar mr-1"><?php echo e(__('Razorpay')); ?></a>
						<input type="hidden" name="razorpay[name]" value="razorpay">
						
						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="razorpay[enabled]"
						    	<?php if(!empty(old('razorpay.enabled'))): ?>
									<?php echo e(old('razorpay.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->razorpay->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Key ID')); ?></label>
						<input type="text" name="razorpay[client_id]" placeholder="..." value="<?php echo e(old('razorpay.client_id', $settings->razorpay->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Key Secret')); ?></label>
						<input type="text" name="razorpay[secret_id]" placeholder="..." value="<?php echo e(old('razorpay.secret_id', $settings->razorpay->secret_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Webhook Secret')); ?></label>
						<input type="text" name="razorpay[webhook_secret]" placeholder="..." value="<?php echo e(old('razorpay.webhook_secret', $settings->razorpay->webhook_secret ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="razorpay[fee]" placeholder="..." value="<?php echo e(old('razorpay.fee', $settings->razorpay->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="razorpay[minimum]" placeholder="..." value="<?php echo e(old('razorpay.minimum', $settings->razorpay->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="razorpay[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('razorpay.auto_exchange_to', $settings->razorpay->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- IYZICO -->
			<div class="fluid card" id="iyzico">
				<div class="content">
					<h3 class="header">
						<a href="https://www.iyzico.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/iyzico_icon.png')); ?>" alt="iyzico" class="ui small avatar mr-1"><?php echo e(__('Iyzico')); ?></a>
						<input type="hidden" name="iyzico[name]" value="iyzico">
						
						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="iyzico[enabled]"
						    	<?php if(!empty(old('iyzico.enabled'))): ?>
									<?php echo e(old('iyzico.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->iyzico->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="iyzico[mode]" value="<?php echo e(old('iyzico.mode', $settings->iyzico->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Key ID')); ?></label>
						<input type="text" name="iyzico[client_id]" placeholder="..." value="<?php echo e(old('iyzico.client_id', $settings->iyzico->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Key Secret')); ?></label>
						<input type="text" name="iyzico[secret_id]" placeholder="..." value="<?php echo e(old('iyzico.secret_id', $settings->iyzico->secret_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="iyzico[fee]" placeholder="..." value="<?php echo e(old('iyzico.fee', $settings->iyzico->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="iyzico[minimum]" placeholder="..." value="<?php echo e(old('iyzico.minimum', $settings->iyzico->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="iyzico[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('iyzico.auto_exchange_to', $settings->iyzico->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- SKRILL -->
			<div class="fluid card" id="skrill">
				<div class="content">
					<h3 class="header">
						<a href="https://www.skrill.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/skrill_icon.png')); ?>" alt="Skrill" class="ui small avatar mr-1"><?php echo e(__('Skrill')); ?></a>
						<input type="hidden" name="skrill[name]" value="skrill">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="skrill[enabled]"
						    	<?php if(!empty(old('skrill.enabled'))): ?>
									<?php echo e(old('skrill.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->skrill->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Merchant account')); ?></label>
						<input type="text" name="skrill[merchant_account]" placeholder="..." value="<?php echo e(old('skrill.merchant_account', $settings->skrill->merchant_account ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('MQI/API secret word')); ?></label>
						<input type="text" name="skrill[mqiapi_secret_word]" placeholder="..." value="<?php echo e(old('skrill.mqiapi_secret_word', $settings->skrill->mqiapi_secret_word ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('MQI/API password')); ?></label>
						<input type="text" name="skrill[mqiapi_password]" placeholder="..." value="<?php echo e(old('skrill.mqiapi_password', $settings->skrill->mqiapi_password ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Allowed payment methods')); ?></label>
						<div  class="ui selection scrolling search multiple floating dropdown">
							<input type="hidden" name="skrill[methods]" placeholder="..." value="<?php echo e(old('skrill.methods', $settings->skrill->methods ?? null)); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="WLT"><?php echo e(__('Skrill Digital Wallet')); ?></div>
								<div class="item" data-value="NTL"><?php echo e(__('Neteller')); ?></div>
								<div class="item" data-value="PSC"><?php echo e(__('Paysafecard')); ?></div>
								<div class="item" data-value="PCH"><?php echo e(__('Paysafecash')); ?></div>
								<div class="item" data-value="ACC"><?php echo e(__('All card types available in the customer’s country')); ?></div>
								<div class="item" data-value="VSA"><?php echo e(__('Visa')); ?></div>
								<div class="item" data-value="MSC"><?php echo e(__('Mastercard')); ?></div>
								<div class="item" data-value="VSE"><?php echo e(__('Visa Electron')); ?></div>
								<div class="item" data-value="MAE"><?php echo e(__('Maestro')); ?></div>
								<div class="item" data-value="GCB"><?php echo e(__('Carte Bleue')); ?></div>
								<div class="item" data-value="DNK"><?php echo e(__('Dankort')); ?></div>
								<div class="item" data-value="PSP"><?php echo e(__('PostePay')); ?></div>
								<div class="item" data-value="CSI"><?php echo e(__('CartaSi')); ?></div>
								<div class="item" data-value="ACH"><?php echo e(__('iACH')); ?></div>
								<div class="item" data-value="GCI"><?php echo e(__('iDEAL GCI')); ?></div>
								<div class="item" data-value="IDL"><?php echo e(__('iDEAL IDL')); ?></div>
								<div class="item" data-value="PWY"><?php echo e(__('Przelewy24')); ?></div>
								<div class="item" data-value="GLU"><?php echo e(__('Trustly')); ?></div>
								<div class="item" data-value="ALI"><?php echo e(__('Alipay')); ?></div>
								<div class="item" data-value="ADB"><?php echo e(__('Astropay - Online bank transfer (Direct Bank Transfer)')); ?></div>
								<div class="item" data-value="AOB"><?php echo e(__('Astropay - Offline bank transfer')); ?></div>
								<div class="item" data-value="ACI"><?php echo e(__('Astropay - Cash (Invoice)')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="skrill[fee]" placeholder="..." value="<?php echo e(old('skrill.fee', $settings->skrill->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="skrill[minimum]" placeholder="..." value="<?php echo e(old('skrill.minimum', $settings->skrill->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="skrill[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('skrill.auto_exchange_to', $settings->skrill->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>
			

			<!-- PAYSTACK -->
			<div class="fluid card" id="paystack">
				<div class="content">
					<h3 class="header">
						<a href="https://paystack.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/paystack.png')); ?>" alt="Paystack" class="ui small avatar mr-1"><?php echo e(__('Paystack')); ?></a>
						<input type="hidden" name="paystack[name]" value="paystack">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="paystack[enabled]"
						    	<?php if(!empty(old('paystack.enabled'))): ?>
									<?php echo e(old('paystack.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->paystack->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">

					<div class="field">
						<label><?php echo e(__('Public Key')); ?></label>
						<input type="text" name="paystack[public_key]" placeholder="..." value="<?php echo e(old('paystack.public_key', $settings->paystack->public_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="paystack[secret_key]" placeholder="..." value="<?php echo e(old('paystack.secret_key', $settings->paystack->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="paystack[fee]" placeholder="..." value="<?php echo e(old('paystack.fee', $settings->paystack->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Allowed channels')); ?></label>
						<div  class="ui selection multiple floating dropdown">
							<input type="hidden" name="paystack[channels]" placeholder="..." value="<?php echo e(old('paystack.channels', $settings->paystack->channels ?? null)); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="card"><?php echo e(__('Card')); ?></div>
								<div class="item" data-value="bank"><?php echo e(__('Bank')); ?></div>
								<div class="item" data-value="ussd"><?php echo e(__('USSD')); ?></div>
								<div class="item" data-value="qr"><?php echo e(__('QR')); ?></div>
								<div class="item" data-value="mobile_money"><?php echo e(__('MOBILE MONEY')); ?></div>
								<div class="item" data-value="bank_transfer"><?php echo e(__('BANK TRANSFER')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="paystack[minimum]" placeholder="..." value="<?php echo e(old('paystack.minimum', $settings->paystack->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="paystack[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('paystack.auto_exchange_to', $settings->paystack->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- ADYEN -->
			<div class="fluid card" id="adyen">
				<div class="content">
					<h3 class="header">
						<a href="https://www.adyen.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/adyen.jpg')); ?>" alt="Adyen" class="ui small avatar mr-1"><?php echo e(__('Adyen')); ?></a>
						<input type="hidden" name="adyen[name]" value="adyen">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="adyen[enabled]"
						    	<?php if(!empty(old('adyen.enabled'))): ?>
									<?php echo e(old('adyen.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->adyen->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="adyen[mode]" value="<?php echo e(old('adyen.mode', $settings->adyen->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('API key')); ?></label>
						<input type="text" name="adyen[api_key]" placeholder="..." value="<?php echo e(old('adyen.api_key', $settings->adyen->api_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Client key')); ?></label>
						<input type="text" name="adyen[client_key]" placeholder="..." value="<?php echo e(old('adyen.client_key', $settings->adyen->client_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Merchant account')); ?></label>
						<input type="text" name="adyen[merchant_account]" placeholder="..." value="<?php echo e(old('adyen.merchant_account', $settings->adyen->merchant_account ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('HMAC key')); ?></label>
						<input type="text" name="adyen[hmac_key]" placeholder="..." value="<?php echo e(old('adyen.hmac_key', $settings->adyen->hmac_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="adyen[fee]" placeholder="..." value="<?php echo e(old('adyen.fee', $settings->adyen->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="adyen[minimum]" placeholder="..." value="<?php echo e(old('adyen.minimum', $settings->adyen->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="adyen[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('adyen.auto_exchange_to', $settings->adyen->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- INSTAMOJO -->
			<div class="fluid card" id="instamojo">
				<div class="content">
					<h3 class="header">
						<a href="https://www.instamojo.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/instamojo.png')); ?>" alt="Instamojo" class="ui small avatar mr-1"><?php echo e(__('Instamojo')); ?></a>
						<input type="hidden" name="instamojo[name]" value="instamojo">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input
						    	type="checkbox" 
						    	name="instamojo[enabled]"
						    	<?php if(!empty(old('instamojo.enabled'))): ?>
									<?php echo e(old('instamojo.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->instamojo->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="instamojo[mode]" value="<?php echo e(old('instamojo.mode', $settings->instamojo->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Private API Key')); ?></label>
						<input type="text" name="instamojo[private_api_key]" placeholder="..." value="<?php echo e(old('instamojo.private_api_key', $settings->instamojo->private_api_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Private Auth Token')); ?></label>
						<input type="text" name="instamojo[private_auth_token]" placeholder="..." value="<?php echo e(old('instamojo.private_auth_token', $settings->instamojo->private_auth_token ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Private Salt')); ?></label>
						<input type="text" name="instamojo[private_salt]" placeholder="..." value="<?php echo e(old('instamojo.private_salt', $settings->instamojo->private_salt ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="instamojo[fee]" placeholder="..." value="<?php echo e(old('instamojo.fee', $settings->instamojo->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="instamojo[minimum]" placeholder="..." value="<?php echo e(old('instamojo.minimum', $settings->instamojo->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="instamojo[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('instamojo.auto_exchange_to', $settings->instamojo->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- PAYHERE -->
			<div class="fluid card" id="payhere">
				<div class="content">
					<h3 class="header">
						<a href="https://www.payhere.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/payhere.png')); ?>" class="ui small avatar mr-1"><?php echo e(__('Payhere')); ?></a>
						<input type="hidden" name="payhere[name]" value="payhere">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="payhere[enabled]"
						    	<?php if(!empty(old('payhere.enabled'))): ?>
									<?php echo e(old('payhere.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->payhere->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="payhere[mode]" value="<?php echo e(old('payhere.mode', $settings->payhere->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Merchant secret')); ?></label>
						<input type="text" name="payhere[merchant_secret]" placeholder="..." value="<?php echo e(old('payhere.merchant_secret', $settings->payhere->merchant_secret ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Merchant ID')); ?></label>
						<input type="text" name="payhere[merchant_id]" placeholder="..." value="<?php echo e(old('payhere.merchant_id', $settings->payhere->merchant_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="payhere[fee]" placeholder="..." value="<?php echo e(old('payhere.fee', $settings->payhere->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="payhere[minimum]" placeholder="..." value="<?php echo e(old('payhere.minimum', $settings->payhere->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="payhere[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('payhere.auto_exchange_to', $settings->payhere->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- SPANKPAY -->
			<div class="fluid card" id="spankpay">
				<div class="content">
					<h3 class="header">
						<a href="https://spankpay.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/spankpay_icon.png')); ?>" alt="Spankpay" class="ui small avatar mr-1"><?php echo e(__('Spankpay')); ?></a>
						<input type="hidden" name="spankpay[name]" value="spankpay">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="spankpay[enabled]"
						    	<?php if(!empty(old('spankpay.enabled'))): ?>
									<?php echo e(old('spankpay.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->spankpay->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Client key')); ?></label>
						<input type="text" name="spankpay[public_key]" placeholder="..." value="<?php echo e(old('spankpay.public_key', $settings->spankpay->public_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="spankpay[secret_key]" placeholder="..." value="<?php echo e(old('spankpay.secret_key', $settings->spankpay->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="spankpay[fee]" placeholder="..." value="<?php echo e(old('spankpay.fee', $settings->spankpay->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="spankpay[minimum]" placeholder="..." value="<?php echo e(old('spankpay.minimum', $settings->spankpay->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="spankpay[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('spankpay.auto_exchange_to', $settings->spankpay->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- OMISE -->
			<div class="fluid card" id="omise">
				<div class="content">
					<h3 class="header">
						<a href="https://omise.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/omise_icon.png')); ?>" alt="omise" class="ui small avatar mr-1"><?php echo e(__('omise')); ?></a>
						<input type="hidden" name="omise[name]" value="omise">
						
						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="omise[enabled]"
						    	<?php if(!empty(old('omise.enabled'))): ?>
									<?php echo e(old('omise.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->omise->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Public key')); ?></label>
						<input type="text" name="omise[public_key]" placeholder="..." value="<?php echo e(old('omise.public_key', $settings->omise->public_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="omise[secret_key]" placeholder="..." value="<?php echo e(old('omise.secret_key', $settings->omise->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="omise[fee]" placeholder="..." value="<?php echo e(old('omise.fee', $settings->omise->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="omise[minimum]" placeholder="..." value="<?php echo e(old('omise.minimum', $settings->omise->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="omise[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('omise.auto_exchange_to', $settings->omise->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>


			
			<!-- PAYMENTWALL -->
			<div class="fluid card" id="paymentwall">
				<div class="content">
					<h3 class="header">
						<a href="https://paymentwall.com/" target="_blank"><img src="<?php echo e(asset_('assets/images/paymentwall_icon.png')); ?>" alt="paymentwall" class="ui small avatar mr-1"><?php echo e(__('Paymentwall')); ?></a>
						<input type="hidden" name="paymentwall[name]" value="paymentwall">
						
						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="paymentwall[enabled]"
						    	<?php if(!empty(old('paymentwall.enabled'))): ?>
									<?php echo e(old('paymentwall.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->paymentwall->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
				<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="paymentwall[mode]" value="<?php echo e(old('paymentwall.mode', $settings->paymentwall->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Project key')); ?></label>
						<input type="text" name="paymentwall[project_key]" placeholder="..." value="<?php echo e(old('paymentwall.project_key', $settings->paymentwall->project_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="paymentwall[secret_key]" placeholder="..." value="<?php echo e(old('paymentwall.secret_key', $settings->paymentwall->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="paymentwall[fee]" placeholder="..." value="<?php echo e(old('paymentwall.fee', $settings->paymentwall->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="paymentwall[minimum]" placeholder="..." value="<?php echo e(old('paymentwall.minimum', $settings->paymentwall->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="paymentwall[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('paymentwall.auto_exchange_to', $settings->paymentwall->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>



			<!-- AUTHORIZE.NET -->
			<div class="fluid card" id="authorize-net">
				<div class="content">
					<h3 class="header">
						<a href="https://authorize.net/" target="_blank"><img src="<?php echo e(asset_('assets/images/authorize_net_icon.png')); ?>" alt="authorize_net" class="ui small avatar mr-1"><?php echo e(__('Authorize.Net')); ?></a>
						<input type="hidden" name="authorize_net[name]" value="authorize_net">
						
						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="authorize_net[enabled]"
						    	<?php if(!empty(old('authorize_net.enabled'))): ?>
									<?php echo e(old('authorize_net.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->authorize_net->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
				<div class="field">
						<label><?php echo e(__('Mode')); ?></label>
						<div  class="ui selection floating dropdown">
							<input type="hidden" name="authorize_net[mode]" value="<?php echo e(old('authorize_net.mode', $settings->authorize_net->mode ?? 'sandbox')); ?>">
							<div class="default text"><?php echo e(__('Select Mode')); ?></div>
							<div class="menu">
								<div class="item" data-value="sandbox" default><?php echo e(__('Sandbox')); ?></div>
								<div class="item" data-value="live"><?php echo e(__('Live')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('API login ID')); ?></label>
						<input type="text" name="authorize_net[api_login_id]" placeholder="..." value="<?php echo e(old('authorize_net.api_login_id', $settings->authorize_net->api_login_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Client key')); ?></label>
						<input type="text" name="authorize_net[client_key]" placeholder="..." value="<?php echo e(old('authorize_net.client_key', $settings->authorize_net->client_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction key')); ?></label>
						<input type="text" name="authorize_net[transaction_key]" placeholder="..." value="<?php echo e(old('authorize_net.transaction_key', $settings->authorize_net->transaction_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Signature key')); ?></label>
						<input type="text" name="authorize_net[signature_key]" placeholder="..." value="<?php echo e(old('authorize_net.signature_key', $settings->authorize_net->signature_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Transaction Fee')); ?></label>
						<input type="number" step="0.01" name="authorize_net[fee]" placeholder="..." value="<?php echo e(old('authorize_net.fee', $settings->authorize_net->fee ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
						<input type="number" step="0.01" name="authorize_net[minimum]" placeholder="..." value="<?php echo e(old('authorize_net.minimum', $settings->authorize_net->minimum ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto exchange currency to')); ?> <sup>(5)</sup></label>
						<input type="text" name="paymentwall[auto_exchange_to]" placeholder="<?php echo e(__('Currency code')); ?>" value="<?php echo e(old('authorize_net.auto_exchange_to', $settings->authorize_net->auto_exchange_to ?? null)); ?>">
					</div>
				</div>
			</div>
		</div>

		<!-- OFFLINE PAYMENT -->
		<div class="ui fluid card" id="offline">
			<div class="content" id="offline">
				<h3 class="header">
					<span><?php echo e(__('Offline payment')); ?></span>
					<input type="hidden" name="offline[name]" value="offline">
					
					<div class="checkbox-wrapper">
						<div class="ui fitted toggle checkbox">
					    <input 
					    	type="checkbox" 
					    	name="offline[enabled]"
					    	<?php if(!empty(old('offline.enabled'))): ?>
								<?php echo e(old('offline.enabled') ? 'checked' : ''); ?>

								<?php else: ?>
								<?php echo e(($settings->offline->enabled ?? null) ? 'checked' : ''); ?>

					    	<?php endif; ?>
					    >
					    <label></label>
					  </div>
					</div>

				</h3>
			</div>
			
			<div class="content" id="offline-payment-instruction">
				<div class="field">
					<label><?php echo e(__('Instructions')); ?></label>
					<textarea name="offline[instructions]" class="summernote" cols="30" rows="10"><?php echo e(old('offline.instructions', $settings->offline->instructions ?? null)); ?></textarea>
				</div>

				<div class="field">
					<label><?php echo e(__('Transaction Fee')); ?></label>
					<input type="number" step="0.01" name="offline[fee]" placeholder="..." value="<?php echo e(old('offline.fee', $settings->offline->fee ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Mimimun amount')); ?> <sup><i class="exclamation circle blue icon m-0" title="<?php echo e(__('For Pay what you want')); ?>"></i></sup></label>
					<input type="number" step="0.01" name="offline[minimum]" placeholder="..." value="<?php echo e(old('offline.minimum', $settings->offline->minimum ?? null)); ?>">
				</div>
			</div>
		</div>

		<!-- YOOMONEY -->
		


		<!-- COINPAYMENTS -->
		

		<div class="ui fluid blue segment rounded-corner">
			<div class="five fields mt-1">
				<div class="field" id="vat">
					<label><?php echo e(__('VAT')); ?> (%)</label>
					<input type="number" step="0.01" name="vat" value="<?php echo e(old('vat', $settings->vat ?? null)); ?>">
				</div>

				<div class="field" id="currency-code">
					<label><?php echo e(__('Main currency code')); ?></label>
					<input type="text" name="currency_code" value="<?php echo e(old('currency_code', $settings->currency_code ?? null)); ?>">
				</div>

				<div class="field" id="main-currency-symbol">
					<label><?php echo e(__('Main currency symbol')); ?></label>
					<input type="text" name="currency_symbol" value="<?php echo e(old('currency_symbol', $settings->currency_symbol ?? null)); ?>">
				</div>

				<div class="field" id="currency_position">
					<label><?php echo e(__('Currency position')); ?> <sup>(1)</sup></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="currency_position" value="<?php echo e(old('currency_position', $settings->currency_position ?? 'left')); ?>">
						<div class="text">...</div>
						<div class="menu">
							<a class="item" data-text="<?php echo e(__('Left')); ?>" data-value="left"><?php echo e(__('Left')); ?></a>
							<a class="item" data-text="<?php echo e(__('Right')); ?>" data-value="right"><?php echo e(__('Right')); ?></a>
						</div>
					</div>
				</div>

				<div class="field" id="allow-foreign-currencies">
					<label><?php echo e(__('Allow foreign currencies')); ?> <sup>(1)</sup></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="allow_foreign_currencies" value="<?php echo e(old('allow_foreign_currencies', $settings->allow_foreign_currencies ?? null)); ?>">
						<div class="text">...</div>
						<div class="menu">
							<a class="item" data-text="<?php echo e(__('Yes')); ?>" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-text="<?php echo e(__('No')); ?>" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="field">
				<small>(1) : <?php echo e(__('Allow receiving payments in defferent currencies than the main currency.')); ?></small>
			</div>

			<div class="field" id="currencies">
				<label><?php echo e(__('Currencies')); ?></label>
				<div class="ui fluid multiple search selection floating dropdown">
					<input type="hidden" name="currencies" value="<?php echo e(strtolower(old('currencies', $settings->currencies ?? null))); ?>">
					<div class="text">...</div>
					<div class="menu">
						<?php $__currentLoopData = $currencies ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="item" data-text="<?php echo e($code); ?>"><?php echo e($code); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>

			<div class="field" id="currency-exchange">
				<label><?php echo e(__('Currency exchange API')); ?></label>
				<div class="ui selection floating dropdown">
					<input type="hidden" name="currency_exchange_api" value="<?php echo e(old('currency_exchange_api', $settings->currency_exchange_api ?? null)); ?>">
					<div class="text"></div>
					<div class="menu">
						<a class="item"></a>
						<a class="item" data-value="api.exchangeratesapi.io">api.exchangeratesapi.io</a>
						<a class="item" data-value="api.currencyscoop.com">api.currencyscoop.com</a>
						<a class="item" data-value="api.exchangerate.host" data-text="api.exchangerate.host">api.exchangerate.host <sup><?php echo e(__('Supports cryptocurrency')); ?></sup></a>
						<a class="item" data-value="api.coingate.com" data-text="api.coingate.com">api.coingate.com <sup><?php echo e(__('Supports cryptocurrency')); ?></sup></a>
					</div>
				</div>
				<small>
					<a href="https://exchangeratesapi.io" target="_blank">api.exchangeratesapi.io</a>
					<a class="ml-1" href="https://currencyscoop.com" target="_blank">api.currencyscoop.com</a>
					<a class="ml-1" href="https://exchangerate.host" target="_blank">api.exchangerate.host</a>
					<a class="ml-1" href="https://coingate.com" target="_blank">api.coingate.com</a>
				</small>
			</div>
            
            <div class="field" id="currency-exchanger-api-key">
				<label><?php echo e(__(':name API key', ['name' => 'Api.exchangeratesapi.io'])); ?></label>
				<input type="text" name="exchangeratesapi_io_key" value="<?php echo e(old('exchangeratesapi_io_key', $settings->exchangeratesapi_io_key ?? null)); ?>">
				<small><?php echo e(__('Required if api.exchangeratesapi.io is selected.')); ?></small>
			</div>
			
			<div class="field" id="currency-exchanger-api-key">
				<label><?php echo e(__(':name API key', ['name' => 'Api.currencyscoop.com'])); ?></label>
				<input type="text" name="currencyscoop_api_key" value="<?php echo e(old('currencyscoop_api_key', $settings->currencyscoop_api_key ?? null)); ?>">
				<small><?php echo e(__('Required if api.currencyscoop.com is selected.')); ?></small>
			</div>
			
			<div class="field" id="allow-guest-checkout">
				<label><?php echo e(__('Allow guest checkout')); ?> <sup>(3)</sup></label>
				<div class="ui fluid selection floating dropdown">
					<input type="hidden" name="guest_checkout" value="<?php echo e(old('guest_checkout', $settings->guest_checkout ?? null)); ?>">
					<div class="text">...</div>
					<div class="menu">
						<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
						<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
					</div>
				</div>
				<small>(3) <?php echo e(__('Allow users to make purchases without being logged in.')); ?></small>
			</div>


			<div class="two fields" id="pay-what-you-want">
				<div class="field">
					<label><?php echo e(__('Enable « Pay What You Want »')); ?> <sup>(4)</sup></label>
				  <div class="ui selection floating dropdown left-circular-corner">
						<input type="hidden" name="pay_what_you_want[enabled]" value="<?php echo e(old('pay_what_you_want.enabled', $settings->pay_what_you_want->enabled ?? '0')); ?>">
						<div class="text">...</div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>
				<div class="field">
					<label><?php echo e(__('For')); ?></label>
					<div class="ui selection multiple floating dropdown right-circular-corner">
						<input type="hidden" name="pay_what_you_want[for]" value="<?php echo e(old('pay_what_you_want.for', $settings->pay_what_you_want->for ?? null)); ?>">
						<div class="text">...</div>
						<div class="menu">
							<a class="item" data-value="products"><?php echo e(__('Products')); ?></a>
							<a class="item" data-value="subscriptions"><?php echo e(__('Subscriptions')); ?></a>
						</div>
					</div>
				</div>
			</div>
			<small>(4) <?php echo e(__('Allow users to pay what they want for products with an optional minimum amount.')); ?></small>

			<div class="field mt-1">
				<label><?php echo e(__('Change user currency based on his country')); ?></label>
			  <div class="ui selection floating dropdown left-circular-corner">
					<input type="hidden" name="currency_by_country" value="<?php echo e(old('currency_by_country', $settings->currency_by_country ?? '0')); ?>">
					<div class="text">...</div>
					<div class="menu">
						<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
						<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
					</div>
				</div>
			</div>

			<small>(5) : <?php echo e(__('Change the currency to this currency when a user proceed to the checkout, regardless his selected currrency.')); ?></small>
		</div>

	</div>
</form>

<script>
	'use strict';

	$(function()
  {
		$('.summernote').summernote({
	    placeholder: '...',
	    tabsize: 2,
	    height: 150,
	    tooltip: false
	  });

	  $('#disable-all-services').on('click', function()
	  {
	  	$('#settings input[type="checkbox"]').prop('checked', false);
	  })

	  $('#settings input, #settings textarea').on('keydown', function(e) 
		{
		    if((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
		    {		        
		        $('form.main').submit();

		  			e.preventDefault();

		        return false;
		    }
		    else
		    {
		        return true;
		    }
		})
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\payments.blade.php ENDPATH**/ ?>