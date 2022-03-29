

<?php $__env->startSection('title', __('Edit coupon')); ?>


<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('coupons.update', $coupon->id)); ?>" id="coupon" spellcheck="false">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled large pink circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Update')); ?>

		</button>
		<a class="ui icon labeled large yellow circular button" href="<?php echo e(route('coupons')); ?>">
			<i class="times icon"></i>
			<?php echo e(__('Cancel')); ?>

		</a>
	</div>
	
	<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="ui negative fluid small message">
			<i class="times icon close"></i>
			<?php echo e($error); ?>

		</div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<div class="ui fluid divider"></div>

	<div class="one column grid">
		<div class="column">

			<div class="field" id="coupon-code">
				<label><?php echo e(__('Code')); ?></label>
				<div class="ui right action input">
				  <input type="text" name="code" placeholder="..." value="<?php echo e(old('code', $coupon->code)); ?>" autofocus required>
				  <button class="ui teal button" type="button"><?php echo e(__('Generate')); ?></button>
				</div>
			</div>

			<div class="field">
				<label><?php echo e(__('Value')); ?></label>
				<input type="number" step="0.01" name="value" placeholder="..." value="<?php echo e(old('value', $coupon->value)); ?>" required>
			</div>

			<div class="field">
				<label><?php echo e(__('Is percentage')); ?></label>
				<div class="ui fluid selection dropdown floating">
					<input type="hidden" name="is_percentage" value="<?php echo e(old('is_percentage', $coupon->is_percentage ? '1' : '0')); ?>">
					<div class="text">...</div>
					<div class="menu">
						<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
						<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
					</div>
				</div>
			</div>

			<div class="field">
				<label><?php echo e(__('For')); ?></label>
				<div class="ui fluid dropdown selection floating">
					<input type="hidden" name="for" value="<?php echo e(old('for', $coupon->for ?? 'products')); ?>">
					<div class="text"></div>
					<div class="menu">
						<a class="item" data-value="products"><?php echo e(__('Products')); ?></a>
						<a class="item" data-value="subscriptions"><?php echo e(__('Subscriptions')); ?></a>
					</div>
				</div>
			</div>

			<div class="ui segment rounded-corner items products">
				<div class="field">
					<label><?php echo e(__('Products')); ?></label>
					<div class="ui multiple search selection dropdown floating">
						<input type="hidden" name="products_ids" value="<?php echo e(old('products_ids', str_replace("'", '', $coupon->products_ids))); ?>">
						<i class="dropdown icon"></i>
						<div class="text"></div>
						<div class="menu">
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item" data-value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Valid for regular licenses only')); ?></label>
					<div class="ui selection dropdown floating">
						<input type="hidden" name="regular_license_only" value="<?php echo e(old('regular_license_only', $coupon->regular_license_only ?? '0')); ?>">
						<div class="text"></div>
						<i class="dropdown icon"></i>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="ui segment rounded-corner items subscriptions d-none">
				<div class="field">
					<label><?php echo e(__('Subscriptions')); ?></label>
					<div class="ui multiple search selection dropdown floating">
						<input type="hidden" name="subscriptions_ids" value="<?php echo e(old('subscriptions_ids', $coupon->subscriptions_ids)); ?>">
						<i class="dropdown icon"></i>
						<div class="text"></div>
						<div class="menu">
						<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item" data-value="<?php echo e($subscription->id); ?>"><?php echo e($subscription->name); ?></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</div>

			<div class="field">
				<label><?php echo e(__('Users ids')); ?></label>
				<select class="ui fluid  dropdown users" name="users_ids" multiple>
					<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($user->id); ?>"><?php echo e($user->email); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>


			<div class="field">
				<label><?php echo e(__('Allow one time use per user')); ?></label>
				<div class="ui selection dropdown floating">
					<input type="hidden" name="once" value="<?php echo e(old('once', $coupon->once)); ?>">
					<div class="text"></div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
						<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
					</div>
				</div>
			</div>


			<div class="field">
				<label><?php echo e(__('Starts at')); ?></label>
				<input type="datetime-local" name="starts_at" required value="<?php echo e(old('starts_at', $coupon->starts_at)); ?>">
			</div>
			

			<div class="field">
				<label><?php echo e(__('Expires at')); ?></label>
				<input type="datetime-local" name="expires_at" required value="<?php echo e(old('expires_at', $coupon->expires_at)); ?>">
			</div>

		</div>
	</div>
</form>

<script>
	$(function()
	{
		'use strict';

		$('#coupon').on('submit', function(e)
		{
			if($('#coupon input[name="value"]').val() <= 0)
			{
				$('#coupon input[name="value"]').focus();
				e.preventDefault();
				return false;
			}
		})

		$('#coupon input[name="value"]').on('change', function()
		{
			$(this).toggleClass('error', !($(this).val() > 0));
		})

		$('#coupon-code button').on('click', function()
		{
			$.post('<?php echo e(route('coupons.generate')); ?>', null, null, 'json')
			.done(function(coupon)
			{
				$('#coupon-code input').val(coupon.code);
			})
		})

		$('.ui.dropdown.users').dropdown('set selected', <?php echo e(old('users_ids', str_replace("'", '', $coupon->users_ids))); ?>)
		
		$('input[name="for"]').on('change', function()
		{
			$('.items.' + $(this).val()).toggleClass('d-none', false)
																				.siblings('.items').toggleClass('d-none', true).find('.selection').dropdown('clear');
		})

		if($('input[name="for"]').val().length)
		{
			$('.items.' + $('input[name="for"]').val()).toggleClass('d-none', false).siblings('.items').toggleClass('d-none', true);
		}
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\coupons\edit.blade.php ENDPATH**/ ?>