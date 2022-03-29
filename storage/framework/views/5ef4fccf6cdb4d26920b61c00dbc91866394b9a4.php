

<?php $__env->startSection('title', __('Edit offline transaction - :transaction_id', ['transaction_id' => $transaction->transaction_id])); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('user_not_found')): ?>
<div class="ui fluid small negative bold message">
	<i class="close icon"></i>
	<?php echo e(session('user_not_found')); ?>

</div>
<?php endif; ?>

<form class="ui large form" method="post" action="<?php echo e(route('transactions.update', ['id' => $transaction->id])); ?>" spellcheck="false">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled teal large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Update')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('transactions')); ?>">
			<i class="times icon"></i>
			<?php echo e(__('Cancel')); ?>

		</a>
	</div>
	
	<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="ui negative fluid circular-corner bold small message">
			<i class="times icon close"></i>
			<?php echo e($error); ?>

		</div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<div class="ui fluid divider"></div>

	<div class="one column grid">
		<div class="column">
			<input type="hidden" name="is_subscription" value="<?php echo e(var_export($transaction->is_subscription === 1)); ?>">

			<div class="field">
				<label><?php echo e(__('User email')); ?></label>
				<input type="email" name="email" placeholder="..." value="<?php echo e(old('email', $transaction->email)); ?>" autofocus required>
			</div>
		
			<?php if(!$transaction->is_subscription): ?>

			<div class="field">
				<label><?php echo e(__('Products')); ?></label>
				<div class="ui search floating selection multiple dropdown">
					<input type="hidden" name="products_ids" required value="<?php echo e(old('products_ids', str_ireplace('\'', '', $transaction->products_ids))); ?>">
					<i class="dropdown icon"></i>
					<div class="default text"><?php echo e(__('Products')); ?></div>
					<div class="menu">
					<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item" data-value="<?php echo e($product->id); ?>">
							<?php echo e($product->name); ?> 
							<span class="right floated"><?php echo e(price($product->price)); ?></span>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>

			<?php else: ?>

			<div class="field">
				<label><?php echo e(__('Subscription')); ?></label>
				<div class="ui selection floating dropdown subscriptions">
					<input type="hidden" name="products_ids" required value="<?php echo e(old('products_ids', str_ireplace('\'', '', $transaction->products_ids))); ?>">
					<i class="dropdown icon"></i>
					<div class="default text"><?php echo e(__('Subscription')); ?></div>
					<div class="menu">
					<?php $__currentLoopData = App\Models\Subscription::orderBy('id', 'desc')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item capitalize" data-value="<?php echo e($subscription->id); ?>" data-price="<?php echo e($subscription->price); ?>">
							<?php echo e($subscription->name); ?> 
							<span class="right floated"><?php echo e(price($subscription->price)); ?></span>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>

			<?php endif; ?>

			<div class="field">
				<label><?php echo e(__('Amount')); ?></label>
				<input type="number" name="amount" required step="0.01" value="<?php echo e(old('amount', $transaction->amount)); ?>">
			</div>

			<div class="field">
				<label><?php echo e(__('Discount')); ?></label>
				<input type="number" name="discount" step="0.01" value="<?php echo e(old('discount', $transaction->discount ?? '0')); ?>">
			</div>

			<div class="field">
				<label><?php echo e(__('Refunded')); ?></label>
				<div class="ui selection floating dropdown">
					<input type="hidden" name="refunded" value="<?php echo e(old('refunded', $transaction->refunded)); ?>">
					<i class="dropdown icon"></i>
					<div class="default text"><?php echo e(__('Refunded status')); ?></div>
					<div class="menu">
						<div class="item" data-value="1"><?php echo e(__('Yes')); ?> </div>
						<div class="item" data-value="0"><?php echo e(__('No')); ?> </div>
					</div>
				</div>
			</div>

		</div>
	</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\transactions\edit.blade.php ENDPATH**/ ?>