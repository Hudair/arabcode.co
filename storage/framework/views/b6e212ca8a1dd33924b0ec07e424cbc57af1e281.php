



<?php $__env->startSection('additional_head_tags'); ?>
<?php if(session('guest_token')): ?>
<script type="application/javascript" src="<?php echo e(asset_("assets/FileSaver.2.0.4.min.js")); ?>"></script>
<?php endif; ?>

<meta name="robots" value="noindex;nofollow">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	<div class="column row w-100 success" id="checkout-response">
		<div class="ui fluid card">
			<div class="content title">
				<?php echo e(__('Order completed')); ?>

			</div>
			
			<div class="content">
				<div class="header icon"><i class="check icon mx-0"></i></div>
				<div class="ui header text">
					<?php echo e(__('Thank you for your order!')); ?>

					<?php if(session('processor') !== 'offline'): ?>
					<div class="sub header mt-1">
						<?php if(!session('guest_token')): ?>
						<?php echo e(__('You will receive an email once your payment is confirmed.')); ?>

						<?php else: ?>
						<?php echo e(__('Your purchase will take effect once your payment is confirmed.')); ?>

						<?php endif; ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
			
			<?php if(session('guest_token')): ?>
			<script type="application/javascript">
				'use strict';

				var tokenDownloaded = false;
				var content  = "<?php echo e(session('guest_token')); ?>";
				var filename = "<?php echo e(session('transaction_id')); ?>-access-token.txt";
				var blob 		 = new Blob([content], {type: "text/plain;charset=utf-8"});

				function redirectHomePage()
				{
					if(!tokenDownloaded)
					{
						saveAs(blob, filename);
					}
					
					location.href = "/";
				}

				function downloadAccessToken()
				{
					saveAs(blob, filename);

					tokenDownloaded = true;
				}
			</script>

			<div class="content guest-token">
				<div class="header"><?php echo e(__('Access token')); ?> <i class="exclamation circle icon mr-0 ml-1" title="<?php echo e(__('Make sure to keep this token in a safe place, you will need it to download the items you purchased as guest.')); ?>"></i></div>
				<div class="token">
					<?php echo e(session('guest_token')); ?>

					<a class="download" onclick="downloadAccessToken()"><?php echo e(__('Download')); ?></a>
				</div>
			</div>
			<?php endif; ?>

			<div class="content center aligned">
				<?php if(session('guest_token')): ?>
				<a onclick="redirectHomePage()" class="ui yellow circular big button mx-0"><?php echo e(__('Back to Home page')); ?></a>
				<?php else: ?>
				<a href="/" class="ui yellow circular big button mx-0"><?php echo e(__('Back to Home page')); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\checkout\success.blade.php ENDPATH**/ ?>