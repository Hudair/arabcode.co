

<?php $__env->startSection('title', __('Affiliate settings')); ?>

<?php $__env->startSection('additional_head_tags'); ?>

<link href="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'affiliate')); ?>">

	<div class="field">
		<button type="submit" class="ui pink large circular labeled icon button mx-0">
		  <i class="save outline icon mx-0"></i>
		  <?php echo e(__('Update')); ?>

		</button>
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
		<div class="column">
			<div class="field" id="affiliate">
				<label><?php echo e(__('Enable')); ?></label>
				<div class="ui dropdown floating selection">
					<input type="hidden" name="affiliate[enabled]" value="<?php echo e(old('enabled', $settings->enabled ?? '0')); ?>">
					<div class="default text">...</div>
					<div class="menu">
						<div class="item" data-value="1"><?php echo e(__('Yes')); ?></div>
						<div class="item" data-value="0"><?php echo e(__('No')); ?></div>
					</div>
				</div>
			</div>
			
			<div class="field" id="affiliate-commission">
				<label><?php echo e(__('Commission in %')); ?></label>
				<input type="number" step="0.001" name="affiliate[commission]" value="<?php echo e(old('commission', $settings->commission ?? '0')); ?>">
			</div>

			<div class="field" id="affiliate-cookie">
				<label><?php echo e(__('Cookie expiration time')); ?> <sup>(<?php echo e(__('In days')); ?>)</sup></label>
				<input type="number" name="affiliate[expire]" value="<?php echo e(old('expire', $settings->expire ?? '30')); ?>">
			</div>

			<div class="field" id="affiliate">
				<label><?php echo e(__('Cashout methods')); ?></label>
				<div class="ui dropdown multiple search floating selection">
					<input type="hidden" name="affiliate[cashout_methods]" value="<?php echo e(old('cashout_methods', $settings->cashout_methods ?? 'paypal_account')); ?>">
					<div class="default text">...</div>
					<div class="menu">
						<div class="item" data-value="paypal_account"><?php echo e(__('PayPal account')); ?></div>
						<div class="item" data-value="bank_account"><?php echo e(__('Bank transfer')); ?></div>
					</div>
				</div>
			</div>

			<div class="field" id="minimum-cashout-paypal">
				<label><?php echo e(__('Minimum PayPal Cashout')); ?> <sup>(<?php echo e(__(config('payments.currency_code'))); ?>)</sup></label>
				<input type="number" name="affiliate[minimum_cashout][paypal]" value="<?php echo e(old('minimum_cashout.paypal', $settings->minimum_cashout->paypal ?? null)); ?>">
			</div>
			
			<div class="field" id="minimum-cashout-bank-transfer">
				<label><?php echo e(__('Minimum Bank Transfer Cashout')); ?> <sup>(<?php echo e(__(config('payments.currency_code'))); ?>)</sup></label>
				<input type="number" name="affiliate[minimum_cashout][bank_transfer]" value="<?php echo e(old('minimum_cashout.bank_transfer', $settings->minimum_cashout->bank_transfer ?? null)); ?>">
			</div>
			
			<div class="field" id="affiliate-cashout">
				<label><?php echo e(__('How cashout works')); ?></label>
				<textarea name="affiliate[cashout_description]" class="summernote" rows="4" placeholder="..."><?php echo e(old('cashout_description', $settings->cashout_description ?? null)); ?></textarea>
			</div>
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
	    height: 250,
	    tooltip: false
	  });

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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\affiliate.blade.php ENDPATH**/ ?>