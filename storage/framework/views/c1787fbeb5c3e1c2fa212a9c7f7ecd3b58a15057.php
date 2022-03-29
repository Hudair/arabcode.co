

<?php $__env->startSection('title', __('Advertisement')); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'adverts')); ?>">

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

			<div class="field">
				<label><?php echo e(__('Responsive ad')); ?></label>
				<textarea name="responsive_ad" cols="30" rows="3"><?php echo e(old('responsive_ad', $settings->responsive_ad ?? null)); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Auto ad')); ?></label>
				<textarea name="auto_ad" cols="30" rows="3"><?php echo e(old('auto_ad', $settings->auto_ad ?? null)); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Ad 728x90')); ?></label>
				<textarea name="ad_728x90" cols="30" rows="3"><?php echo e(old('ad_728x90', $settings->ad_728x90 ?? null)); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Ad 468x60')); ?></label>
				<textarea name="ad_468x60" cols="30" rows="3"><?php echo e(old('ad_468x60', $settings->ad_468x60 ?? null)); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Ad 300x250')); ?></label>
				<textarea name="ad_300x250" cols="30" rows="3"><?php echo e(old('ad_300x250', $settings->ad_300x250 ?? null)); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Ad 320x100')); ?></label>
				<textarea name="ad_320x100" cols="30" rows="3"><?php echo e(old('ad_320x100', $settings->ad_320x100 ?? null)); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Popup Ad')); ?></label>
				<textarea name="popup_ad" cols="30" rows="3"><?php echo e(old('popup_ad', $settings->popup_ad ?? null)); ?></textarea>
			</div>

		</div>
	</div>
</form>

<script>
	'use strict';

	$(function()
	{
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\adverts.blade.php ENDPATH**/ ?>