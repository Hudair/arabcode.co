



<?php $__env->startSection('title', __('Transaction details')); ?>


<?php $__env->startSection('content'); ?>

<a class="ui icon labeled blue large circular button mb-1" href="<?php echo e(route('transactions')); ?>">
	<i class="left angle icon"></i>
	<?php echo e(__('Transactions')); ?>

</a>

<div class="ui three doubling stackable cards" id="transaction">
	<div class="fluid card">
		<div class="content header">
			<?php echo e(__('Transaction identifiers')); ?>

		</div>
		<div class="content body">
			<div class="item">
				<div class="name"><?php echo e(__('Transaction ID')); ?></div>
				<div class="value"><?php echo e($transaction->id ?? __('N-A')); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Reference ID')); ?></div>
				<div class="value"><?php echo e($transaction->reference_id ?? __('N-A')); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Order ID')); ?></div>
				<div class="value"><?php echo e($transaction->order_id ?? __('N-A')); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('CS Token')); ?> <sup>(Stripe)</sup></div>
				<div class="value"><?php echo e($transaction->cs_token ?? __('N-A')); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Processor')); ?></div>
				<div class="value"><?php echo e(__($transaction->processor === 'n-a' ? 'Guest' : ucfirst($transaction->processor))); ?></div>
			</div>
		</div>
	</div>

	<div class="fluid card">
		<div class="content header">
			<?php echo e(__('Transaction summary')); ?>

		</div>
		<div class="content body">
			<div class="item">
				<div class="name"><?php echo e(__('Created at')); ?></div>
				<div class="value"><?php echo e($transaction->created_at); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Status')); ?></div>
				<div class="value"><?php echo e(__(ucfirst($transaction->status))); ?></div>
			</div>
			<?php if($transaction->processor === 'offline'): ?>
			<div class="item">
				<div class="name"><?php echo e(__('Confirmed')); ?></div>
				<div class="value"><?php echo e($transaction->confirmed ? __('Yes') : __('No')); ?></div>
			</div>
			<?php endif; ?>
			<div class="item">
				<div class="name"><?php echo e(__('Refunded')); ?></div>
				<div class="value"><?php echo e($transaction->refunded ? __('Yes') : __('No')); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Currency')); ?></div>
				<div class="value"><?php echo e($transaction->details->currency); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Exchange rate')); ?></div>
				<div class="value"><?php echo e($transaction->details->exchange_rate); ?></div>
			</div>
			<?php $__currentLoopData = $transaction->details->items ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="item">
				<div class="name">
					<?php echo e(__($item->name)); ?>

					<?php if($item->license ?? null): ?>
					<sup>(<?php echo e(__($item->license)); ?>)</sup>
					<?php endif; ?>
				</div>
				<div class="value"><?php echo e($transaction->details->currency .' '. format_amount($item->value, false, $transaction->details->decimals ?? 2)); ?></div>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php if(!($transaction->details->items->discount ?? null)): ?>
			<div class="item">
				<div class="name"><?php echo e(__('Discount')); ?></div>
				<div class="value"><?php echo e($transaction->details->currency .' '. format_amount($transaction->details->discount ?? $transaction->discount, false, $transaction->details->decimals ?? 2)); ?></div>
			</div>
			<?php endif; ?>
			<?php if($transaction->details->custom_amount ?? null): ?>
			<div class="item">
				<div class="name"><?php echo e(__('Custom amount')); ?></div>
				<div class="value"><?php echo e($transaction->details->currency .' '. format_amount($transaction->details->custom_amount ?? $transaction->custom_amount, false, $transaction->details->decimals ?? 2)); ?></div>
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="fluid card">
		<div class="content header">
			<?php echo e(__('Buyer info')); ?>

		</div>
		<div class="content body">
			<?php if($buyer): ?>
			<div class="item">
				<div class="name"><?php echo e(__('First name')); ?></div>
				<div class="value"><?php echo e($buyer->firstname); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Last name')); ?></div>
				<div class="value"><?php echo e($buyer->lastname); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Email')); ?></div>
				<div class="value"><?php echo e($buyer->email); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Address')); ?></div>
				<div class="value"><?php echo e($buyer->address); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Country')); ?></div>
				<div class="value"><?php echo e($buyer->country); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('City')); ?></div>
				<div class="value"><?php echo e($buyer->city); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('ID number')); ?></div>
				<div class="value"><?php echo e($buyer->id_number); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Zip code')); ?></div>
				<div class="value"><?php echo e($buyer->zip_code); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('State')); ?></div>
				<div class="value"><?php echo e($buyer->state); ?></div>
			</div>
			<div class="item">
				<div class="name"><?php echo e(__('Verified')); ?></div>
				<div class="value"><?php echo e($buyer->verified ? __('Yes') : __('No')); ?></div>
			</div>
			<?php else: ?>
			<div class="item">
				<div class="name"><?php echo e(__('Type')); ?></div>
				<div class="value"><?php echo e(__('Guest')); ?></div>
			</div>
			<?php endif; ?>
			<?php if(isset($transaction->guest_token)): ?>
			<div class="item">
				<div class="name"><?php echo e(__('Guest token')); ?></div>
				<div class="value"><?php echo e($transaction->guest_token); ?></div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\transactions\show.blade.php ENDPATH**/ ?>