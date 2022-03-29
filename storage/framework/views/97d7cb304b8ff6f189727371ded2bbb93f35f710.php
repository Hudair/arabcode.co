

<?php $__env->startSection('additional_head_tags'); ?>
<meta name="robots" value="noindex;nofollow">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	<div class="one column row w-100 failure" id="checkout-response">
		<div class="ui fluid card">
			<div class="content title">
				<?php echo e($message); ?>

			</div>
			
			<div class="content center aligned">
				<a href="/" class="ui yellow circular big button mx-0"><?php echo e(__('Back to Home page')); ?></a>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\checkout\failure.blade.php ENDPATH**/ ?>