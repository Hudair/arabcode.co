

<?php $__env->startSection('title', __('Social login settings')); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'social_login')); ?>">

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
	
	<div class="ui fluid divider mb-0"></div>
	
	<div class="one column grid" id="settings">

		<div class="ui three stackable cards mt-1">
			<div class="ui card mt-0">
				<div class="content">
					<h3 class="header">
						<i class="circular google icon mr-1"></i>Google

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="google[enabled]"
						    	<?php if(!empty(old('google.enabled'))): ?>
									<?php echo e(old('google.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->google->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="google[client_id]" placeholder="..." value="<?php echo e(old('google.client_id', $settings->google->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="google[secret_id]" placeholder="..." value="<?php echo e(old('google.secret_id', $settings->google->secret_id ?? null)); ?>">
					</div>
				</div>
			</div>

			<div class="ui card mt-0">
				<div class="content">
					<h3 class="header">
						<i class="circular twitter icon mr-1"></i>Twitter

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="twitter[enabled]"
						    	<?php if(!empty(old('twitter.enabled'))): ?>
									<?php echo e(old('twitter.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->twitter->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="twitter[client_id]" placeholder="..." value="<?php echo e(old('twitter.client_id', $settings->twitter->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="twitter[secret_id]" placeholder="..." value="<?php echo e(old('twitter.secret_id', $settings->twitter->secret_id ?? null)); ?>">
					</div>
				</div>
			</div>

			<div class="ui card mt-0">
				<div class="content">
					<h3 class="header">
						<i class="circular facebook icon mr-1"></i>Facebook

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="facebook[enabled]"
						    	<?php if(!empty(old('facebook.enabled'))): ?>
									<?php echo e(old('facebook.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->facebook->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="facebook[client_id]" placeholder="..." value="<?php echo e(old('facebook.client_id', $settings->facebook->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="facebook[secret_id]" placeholder="..." value="<?php echo e(old('facebook.secret_id', $settings->facebook->secret_id ?? null)); ?>">
					</div>
				</div>
			</div>

			<div class="ui card mt-0">
				<div class="content">
					<h3 class="header">
						<i class="circular github icon mr-1"></i>Github

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="github[enabled]"
						    	<?php if(!empty(old('github.enabled'))): ?>
									<?php echo e(old('github.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->github->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="github[client_id]" placeholder="..." value="<?php echo e(old('github.client_id', $settings->github->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="github[secret_id]" placeholder="..." value="<?php echo e(old('github.secret_id', $settings->github->secret_id ?? null)); ?>">
					</div>
				</div>
			</div>

			<div class="ui card mt-0">
				<div class="content">
					<h3 class="header">
						<i class="circular linkedin icon mr-1"></i>Linkedin

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="linkedin[enabled]"
						    	<?php if(!empty(old('linkedin.enabled'))): ?>
									<?php echo e(old('linkedin.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->linkedin->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="linkedin[client_id]" placeholder="..." value="<?php echo e(old('linkedin.client_id', $settings->linkedin->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="linkedin[secret_id]" placeholder="..." value="<?php echo e(old('linkedin.secret_id', $settings->linkedin->secret_id ?? null)); ?>">
					</div>
				</div>
			</div>

			<div class="ui card mt-0">
				<div class="content">
					<h3 class="header">
						<i class="circular vk icon mr-1"></i>VKontakte (VK)

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="vkontakte[enabled]"
						    	<?php if(!empty(old('vkontakte.enabled'))): ?>
									<?php echo e(old('vkontakte.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->vkontakte->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="field">
						<label><?php echo e(__('App Key')); ?></label>
						<input type="text" name="vkontakte[client_id]" placeholder="..." value="<?php echo e(old('vkontakte.client_id', $settings->vkontakte->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="vkontakte[secret_id]" placeholder="..." value="<?php echo e(old('vkontakte.secret_id', $settings->vkontakte->secret_id ?? null)); ?>">
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\social_login.blade.php ENDPATH**/ ?>