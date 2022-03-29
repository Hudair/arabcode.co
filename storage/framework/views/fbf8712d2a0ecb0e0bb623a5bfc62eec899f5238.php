

<?php $__env->startSection('title', __('Chat settings')); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'chat')); ?>">

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
			<div class="ui fluid card">
				<div class="content">
					<h3 class="header">
						<a href="https://www.twak.to/" target="_blank"><img src="<?php echo e(asset_('assets/images/tawk-sitelogo.png')); ?>" alt="Twak.to" class="ui small avatar mr-1">Twak.to</a>
						<input type="hidden" name="twak[name]" value="twak">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="twak[enabled]"
						    	<?php if(!empty(old('twak.enabled'))): ?>
									<?php echo e(old('twak.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->twak->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">				
					<div class="field">
						<label><?php echo e(__('Property ID')); ?></label>
						<input type="text" name="twak[property_id]" value="<?php echo e(old('twak.property_id', $settings->twak->property_id ?? null)); ?>" placeholder="E.g. 64ca1d876503fa8a2a8e39a1s">
					</div>
				</div>
			</div>

			<div class="ui fluid card">
				<div class="content">
					<h3 class="header">
						<a href="https://www.twak.to/" target="_blank"><img src="<?php echo e(asset_('assets/images/gist.png')); ?>" alt="Gist" class="ui small avatar mr-1">Getgist.com</a>
						<input type="hidden" name="gist[name]" value="gist">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="gist[enabled]"
						    	<?php if(!empty(old('gist.enabled'))): ?>
									<?php echo e(old('gist.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->gist->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">				
					<div class="field">
						<label><?php echo e(__('Workspace ID')); ?></label>
						<input type="text" name="gist[workspace_id]" value="<?php echo e(old('gist.workspace_id', $settings->gist->workspace_id ?? null)); ?>" placeholder="E.g. ejt925x5">
					</div>
				</div>
			</div>

			<div class="ui fluid card">
				<div class="content">
					<h3 class="header">
						<a>Other service</a>
						<input type="hidden" name="other[name]" value="other">

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="other[enabled]"
						    	<?php if(!empty(old('other.enabled'))): ?>
									<?php echo e(old('other.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->other->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">				
					<div class="field">
						<textarea name="other[code]" placeholder="<?php echo e(__('Code')); ?>" cols="30" rows="5"><?php echo e(old('other.code', $settings->other->code ?? null)); ?></textarea>
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\chat.blade.php ENDPATH**/ ?>