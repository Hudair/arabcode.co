

<?php $__env->startSection('additional_head_tags'); ?>
<meta name="robots" content="nofollow, noindex">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	<div class="column row w-100 confirm" id="checkout-response">
		<div class="ui fluid card">
			<div class="content title">
				<?php echo e(__('Payment created')); ?>

			</div>

			<div class="content summary">
				<div class="details">

					<?php $__currentLoopData = $transaction_details->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="item <?php echo e($k); ?>">
						<div class="name capitalize"><?php echo e(mb_ucfirst($item->name)); ?></div>
						<div class="price"><?php echo e($item->value); ?></div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<div class="total item">
						<div class="name"><?php echo e(__('Total')); ?></div>
						<div class="price"><?php echo e($transaction_details->currency.' '.$transaction_details->total_amount); ?></div>
					</div>
				</div>
			</div>

			<div class="content center aligned">
				<form method="post" action="<?php echo e(route('home.checkout.offline_confirm', ['reference' => $transaction->reference_id])); ?>">
					<?php echo csrf_field(); ?>
					<button class="ui red circular large button" value="false" name="cancel"><?php echo e(__('Cancel')); ?></button>
					<button class="ui yellow circular large button" value="true" name="confirm"><?php echo e(__('Confirm')); ?></button>
				</form>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\checkout\offline.blade.php ENDPATH**/ ?>