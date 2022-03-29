

<?php $__env->startSection('title', __('Search engines settings')); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'search_engines')); ?>">

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
				<label><?php echo e(__('Site verification')); ?></label>

				<input type="text" name="google" placeholder="<?php echo e(__('Google code')); ?>..." value="<?php echo e(old('google', $settings->google ?? null)); ?>">

				<input class="mt-1" type="text" name="bing" placeholder="<?php echo e(__('Bing code')); ?>..." value="<?php echo e(old('bing', $settings->bing ?? null)); ?>">

				<input class="mt-1" type="text" name="yandex" placeholder="<?php echo e(__('Yandex code')); ?>..." value="<?php echo e(old('yandex', $settings->yandex ?? null)); ?>">
			</div>

			<div class="field">
				<label><?php echo e(__('Google analytics')); ?></label>
				<textarea name="google_analytics" cols="30" rows="5" placeholder="..."><?php echo e(old('google_analytics', $settings->google_analytics ?? null)); ?></textarea>
			</div>
		
			<div class="field">
				<label><?php echo e(__('Robots')); ?></label>
				<div class="ui dropdown floating selection">
					<input type="hidden" name="robots" value="<?php echo e(old('robots', $settings->robots ?? 'follow, index')); ?>">
					<div class="default text">...</div>
					<div class="menu">
						<div class="item" data-value="follow, index"><?php echo e(__('Follow and Index')); ?></div>
						<div class="item" data-value="follow, noindex"><?php echo e(__('Follow but do not Index')); ?></div>
						<div class="item" data-value="nofollow, index"><?php echo e(__('Do not Follow but Index')); ?></div>
						<div class="item" data-value="nofollow, noindex"><?php echo e(__('Do not Follow and do not Index')); ?></div>
					</div>
				</div>
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\search_engines.blade.php ENDPATH**/ ?>