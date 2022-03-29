

<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebPage",
	"image": "<?php echo e($meta_data->image); ?>",
	"name": "<?php echo e($meta_data->title); ?>",
  "url": "<?php echo e($meta_data->url); ?>",
  "description": "<?php echo e($meta_data->description); ?>"
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

	<div class="ui one column shadowless celled grid my-0 px-1" id="pricing">	

		<?php echo place_ad('ad_728x90'); ?>


		<?php if($subscriptions->count()): ?>
		<div class="row">
			<div class="column title">
				<h1><?php echo e(__('Our Pricing Plans')); ?></h1>
				<h3><?php echo e(__('Explore our pricing plans, from :first to :last, choose the one that meets your needs.', ['first' => $subscriptions->first()->name, 'last' => $subscriptions->last()->name])); ?></h3>
			</div>

			<div class="column mx-auto px-0">
				<div class="ui three doubling cards">
					<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card">
						<div class="content name">
							<span style="background: <?php echo e($subscription->color ?? '#667694'); ?>"><?php echo e(__($subscription->name)); ?></span>
						</div>

						<div class="content price">
							<div style="color: <?php echo e($subscription->color ?? '#000'); ?>">
								<?php echo e(price($subscription->price, false, true)); ?>

								<?php if($subscription->title): ?><span>/ <?php echo e(__($subscription->title)); ?></span><?php endif; ?>
							</div>
						</div>

						<div class="content description">
							<?php $__currentLoopData = explode("\n", $subscription->description); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div><i class="check blue icon"></i><?php echo e($note); ?></div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>

						<div class="content buy">
							<a href="<?php echo e(pricing_plan_url($subscription)); ?>" class="ui large circular button mx-0" style="background: <?php echo e($subscription->color ?? '#667694'); ?>">
								<?php echo e(__('Get started')); ?>

							</a>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\pricing.blade.php ENDPATH**/ ?>