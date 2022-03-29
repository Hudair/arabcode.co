

<?php $__env->startSection('title', __('Create payment link')); ?>

<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('payment_links.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled pink large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Create')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('payment_links')); ?>">
			<i class="times icon"></i>
			<?php echo e(__('Cancel')); ?>

		</a>
	</div>
	
	<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="ui negative fluid small message">
			<i class="close icon"></i>
			<?php echo e($error); ?>

		</div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<?php if(session('user_message')): ?>
	<div class="ui fluid small message">
		<i class="close icon"></i>
		<?php echo e(session('user_message')); ?>

	</div>
	<?php endif; ?>

	<div class="ui fluid divider"></div>

	<div class="one column grid" id="payment-link">
		<div class="column">
			<div class="field">
				<label><?php echo e(__('Name')); ?></label>
			  <input type="text" name="name" value="<?php echo e(old('name')); ?>">
			</div>

			<div class="field">
				<label><?php echo e(__('User')); ?></label>
				<div class="ui fluid dropdown search selection floating">
					<input type="hidden" name="user_id" value="<?php echo e(old('user_id')); ?>">
					<i class="dropdown icon"></i>
					<div class="text capitalize">...</div>
					<div class="menu">
						<?php $__currentLoopData = \App\User::useIndex('blocked')->select('id', 'email')->where('blocked', '0')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="item" data-value="<?php echo e($user->id); ?>"><?php echo e($user->email); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>

			<div class="field">
				<label><?php echo e(__('Is subscription')); ?></label>
				<div class="ui fluid dropdown selection floating">
					<input type="hidden" name="is_subscription" value="<?php echo e(old('is_subscription', '0')); ?>">
					<i class="dropdown icon"></i>
					<div class="text">...</div>
					<div class="menu">
						<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
					</div>
				</div>
			</div>

			<div class="field items" id="products">
				<label><?php echo e(__('Products')); ?></label>
				<div class="table wrapper">
					<table class="ui fluid unstackable basic table">
						<thead>
							<tr>
								<th><?php echo e(__('Name')); ?></th>
								<th><?php echo e(__('License')); ?></th>
								<th><?php echo e(__('Price')); ?> <sup class="currency"><?php echo e(currency()); ?></sup></th>
								<th>-</th>
							</tr>
						</thead>
						<tbody>
							<tr class="d-none main">
								<td class="name">
									<div class="ui floating circular scrolling fluid dropdown large basic search names button mx-0">
										<input type="hidden" name="products[id][]">
										<span class="default text">...</span>
										<i class="dropdown icon"></i>
										<div class="menu"></div>
									</div>
								</td>
								<td class="license four column wide">
									<div class="ui floating circular scrolling fluid dropdown large basic search licenses button mx-0">
										<input type="hidden" name="products[license][]">
										<span class="default text">...</span>
										<i class="dropdown icon"></i>
										<div class="menu"></div>
									</div>
								</td>
								<td class="price three column wide">
									<input type="number" name="products[price][]" class="price" step="0.0000000001">
								</td>
								<td class="one column wide">
									<div class="d-flex">
										<i class="minus circular link yellow inverted icon mr-1-hf"></i>
									  <i class="plus circular link purple inverted icon mx-0"></i>
									</div>
								</td>
							</tr>

							<tr>
								<td class="name">
									<div class="ui floating circular scrolling fluid dropdown large basic search names button mx-0">
										<input type="hidden" name="products[id][]">
										<span class="default text">...</span>
										<i class="dropdown icon"></i>
										<div class="menu"></div>
									</div>
								</td>
								<td class="license four column wide">
									<div class="ui floating circular scrolling fluid dropdown large basic search licenses button mx-0">
										<input type="hidden" name="products[license][]">
										<span class="default text">...</span>
										<i class="dropdown icon"></i>
										<div class="menu"></div>
									</div>
								</td>
								<td class="price three column wide">
									<input type="number" name="products[price][]" class="price" step="0.0000000001">
								</td>
								<td class="one column wide">
									<div class="d-flex">
										<i class="minus circular link yellow inverted icon mr-1-hf"></i>
									  <i class="plus circular link purple inverted icon mx-0"></i>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="field items d-none" id="subscriptions">
				<label><?php echo e(__('Subscriptions')); ?></label>
				<div class="table wrapper">
					<table class="ui fluid unstackable basic table">
						<thead>
							<tr>
								<th><?php echo e(__('Name')); ?></th>
								<th><?php echo e(__('Price')); ?> <sup class="currency"><?php echo e(currency()); ?></sup></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="name">
									<div class="ui floating circular scrolling fluid dropdown large basic search button mx-0">
										<input type="hidden" name="subscription[id]" value="<?php echo e(old('subscription.id')); ?>">
										<span class="default text">...</span>
										<i class="dropdown icon"></i>
										<div class="menu">
											<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<div class="item" data-price="<?php echo e($subscription->price); ?>" data-value="<?php echo e($subscription->id); ?>"><?php echo e($subscription->name); ?></div>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
								</td>
								<td class="price three column wide">
									<input type="number" name="subscription[price]" class="price" step="0.0000000001" value="<?php echo e(old('subscription.price')); ?>">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>


			<div class="three doubling fields">
				<div class="field disabled">
					<label><?php echo e(__('Amount')); ?></label>
				  <input type="text" step="0.001" name="amount">
				</div>
				<div class="field">
					<label><?php echo e(__('Discount')); ?></label>
				  <input type="text" step="0.001" name="discount" value="<?php echo e(old('discount', '0')); ?>">
				</div>
				<div class="field">
					<label><?php echo e(__('Custom amount')); ?></label>
				  <input type="text" step="0.001" name="custom_amount" value="<?php echo e(old('custom_amount')); ?>">
				</div>
			</div>

			<div class="three doubling fields">
				<div class="field">
					<label><?php echo e(__('Payment service')); ?></label>
					<div class="ui floating circular scrolling fluid dropdown large basic search button payment-services mx-0">
						<input type="hidden" name="payment_service" value="<?php echo e(old('payment_service')); ?>">
						<div class="text"></div>
						<i class="dropdown icon"></i>
						<div class="menu">
							<?php $__currentLoopData = $payment_services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $fee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item capitalize" data-value="<?php echo e($name); ?>" data-fee="<?php echo e($fee ?? '0'); ?>"><?php echo e($name); ?> <sup>(<?php echo e($fee); ?>)</sup></div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
				<div class="field">
					<label><?php echo e(__('Currency')); ?></label>
					<div class="ui floating circular scrolling fluid dropdown large basic search button mx-0">
						<input type="hidden" name="currency" value="<?php echo e(old('currency')); ?>">
						<div class="text"></div>
						<i class="dropdown icon"></i>
						<div class="menu">
							<?php $__currentLoopData = config('payments.currencies'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item" data-value="<?php echo e($code); ?>"><?php echo e($code); ?></div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
				<div class="field">
					<label><?php echo e(__('Exchange rate')); ?></label>
					<input type="number" step="0.001" name="exchange_rate" value="<?php echo e(old('exchange_rate')); ?>">
				</div>
			</div>
		</div>
	</div>
</form>

<script type="application/javascript">
	'use strict';

	$(function()
	{
		$(document).on('click', '#products i.plus', function()
		{
			var row = $('#products tbody tr.main').clone().removeClass('d-none main');

			$(row).appendTo($('#products tbody'));

			$('#products .ui.dropdown').dropdown();

			getLicenses();
		})


		$(document).on('click', '#products i.minus', function()
		{
			if($('#products tbody tr:not(.main)').length > 1)
			{
				$(this).closest('tr').remove();
			}
		})


		$(document).on('keyup', '#products .ui.dropdown.search.names input.search', debounce(function(e)
		{
			var _this = $(e.target);

			var val = _this.val().trim();

			if(!val.length)
				return;

			$.post('<?php echo e(route('products.api')); ?>', {'keywords': val}, null, 'json')
			.done(function(res)
			{
				var items = res.products.reduce(function(carry, item)
										{
											carry.push('<div class="item" data-value="'+item.id+'" data-license-name="'+item.license_name+'" data-license-id="'+item.license_id+'" data-price="'+item.price+'">'+item.name+'</div>');
											return carry;
										}, []);

				_this.siblings('.ui.dropdown.search.names .menu').html(items.join(''));

				getLicenses();
			})
			.fail(function()
			{
				alert('<?php echo e(__('Request failed')); ?>')
			})
		}, 200));


		$('#subscriptions .ui.dropdown').dropdown({
			onChange: function(val, text, $choice)
			{
				$('#subscriptions input.price').val($choice.data('price'))
			}
		})


		$('input[name="is_subscription"]').on('change', function()
		{
			var itemsSlctrId = $(this).val() == '1' ? 'subscriptions' : 'products';

			$('#'+itemsSlctrId+'.field.items').toggleClass('d-none', false).siblings('.items').toggleClass('d-none', true);
		})


		function getLicenses()
		{
			$('#products .ui.dropdown.names').dropdown(
			{
				onChange: function(itemId, text, $choice)
				{
					$.post('<?php echo e(route('payment_links.item_licenses')); ?>', {item_id: itemId})
					.done(function(data)
					{
						var items = data.licenses_prices.reduce(function(carry, item)
												{
													carry.push('<div class="item" data-value="'+item.license_id+'" data-price="'+item.price+'">'+item.license_name+'</div>');
													return carry;
												}, []);

						$choice.closest('tr').find('.ui.dropdown.search.licenses .menu').html(items.join(''));
					})
				}
			})

			$('#products .ui.dropdown.licenses').dropdown({
				onChange: function(val, text, $choice)
				{
					var price = $choice.data('price');

					$choice.closest('tr').find('input.price').val(price)
				}
			})
		}


		setInterval(function()
		{
			var amount    = 0;
			var elementId = $('input[name="is_subscription"]').val() == '1' ? 'subscriptions' : 'products';
			var discount  = parseFloat($('input[name="discount"]').val());

			$('#'+elementId+' input.price').each(function()
			{
				var price = $(this).val().trim();

				if(!isNaN(price) && price.length)
				{
					amount += parseFloat(price);
				}
			})

			amount += parseFloat($('.ui.dropdown.payment-services .menu .item.selected').data('fee')) || 0;

			$('input[name="amount"]').val(Number(amount >= discount ? (amount - discount) : amount).toFixed('<?php echo e(config("payments.currencies.".config('payments.currency_code').".decimals")); ?>'));
		}, 1000)
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\payment_links\create.blade.php ENDPATH**/ ?>