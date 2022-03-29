

<?php $__env->startSection('title', __('Captcha settings')); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'captcha')); ?>">

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
				<label><?php echo e(__('Enable captcha on')); ?></label>
				<div class="ui selection multiple floating dropdown search">
					<input type="hidden" name="captcha[enable_on]" value="<?php echo e(old('captcha.enable_on', $settings->enable_on ?? null)); ?>">
					<div class="text"></div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<a class="item" data-value="register"><?php echo e(__('Registration form')); ?></a>
						<a class="item" data-value="login"><?php echo e(__('Login form')); ?></a>
						<a class="item" data-value="contact"><?php echo e(__('Contact form')); ?></a>
					</div>
				</div>
			</div>

			<div class="ui two doubling stackable cards mt-2">
				<div class="ui fluid card">
					<div class="content">
						<h3 class="header">
							<a href="https://www.google.com/recaptcha" target="_blank"><?php echo e(__('Google Recaptcha')); ?></a>
							<div class="checkbox-wrapper">
								<div class="ui fitted toggle checkbox">
							    <input 
							    	type="checkbox" 
							    	name="captcha[google][enabled]"
							    	<?php if(!empty(old('captcha.google.enabled'))): ?>
										<?php echo e(old('captcha.google.enabled') ? 'checked' : ''); ?>

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
							<label><?php echo e(__('Captcha secret')); ?></label>
							<input type="text" name="captcha[google][secret]" value="<?php echo e(old('captcha.google.secret', $settings->google->secret ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Captcha sitekey')); ?></label>
							<input type="text" name="captcha[google][sitekey]" value="<?php echo e(old('captcha.google.sitekey', $settings->google->sitekey ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Theme')); ?></label>
							<div class="ui selection floating dropdown">
								<input type="hidden" name="captcha[google][attributes][data-theme]" value="<?php echo e(old('captcha.google.attributes.data-theme', $settings->google->attributes->{'data-theme'} ?? 'light')); ?>">
								<div class="text"></div>
								<div class="menu">
									<a class="item" data-value="light"><?php echo e(__('Light')); ?></a>
									<a class="item" data-value="dark"><?php echo e(__('Dark')); ?></a>
								</div>
							</div>
						</div>

						<div class="field">
							<label><?php echo e(__('Theme')); ?></label>
							<div class="ui selection floating dropdown">
								<input type="hidden" name="captcha[google][attributes][data-size]" value="<?php echo e(old('captcha.google.attributes.data-size', $settings->google->attributes->{'data-size'} ?? 'compact')); ?>">
								<div class="text"></div>
								<div class="menu">
									<a class="item" data-value="compact"><?php echo e(__('Compact')); ?></a>
									<a class="item" data-value="normal"><?php echo e(__('Normal')); ?></a>
								</div>
							</div>
						</div>

						<input type="hidden" name="captcha[google][options][timeout]" value="<?php echo e(old('captcha.google.options.timeout', $settings->google->options->timeout ?? 30)); ?>">
					</div>
				</div>

				<div class="ui fluid card">
					<div class="content">
						<h3 class="header">
							<a href="https://github.com/mewebstudio/captcha" target="_blank"><?php echo e(__('Mewebstudio captcha')); ?></a>
							<div class="checkbox-wrapper">
								<div class="ui fitted toggle checkbox">
							    <input 
							    	type="checkbox" 
							    	name="captcha[mewebstudio][enabled]"
							    	<?php if(!empty(old('captcha.mewebstudio.enabled'))): ?>
										<?php echo e(old('captcha.mewebstudio.enabled') ? 'checked' : ''); ?>

										<?php else: ?>
										<?php echo e(($settings->mewebstudio->enabled ?? null) ? 'checked' : ''); ?>

							    	<?php endif; ?>
							    >
							    <label></label>
							  </div>
							</div>
						</h3>
					</div>

					<div class="content">				
						<div class="field">
							<label><?php echo e(__('Length')); ?></label>
							<input type="text" name="captcha[mewebstudio][length]" value="<?php echo e(old('captcha.mewebstudio.length', $settings->mewebstudio->length ?? '5')); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Enable math')); ?></label>
							<div class="ui selection floating dropdown">
								<input type="hidden" name="captcha[mewebstudio][math]" value="<?php echo e(old('captcha.mewebstudio.math', $settings->mewebstudio->math ?? 'true')); ?>">
								<div class="text"></div>
								<div class="menu">
									<a class="item" data-value="true"><?php echo e(__('Yes')); ?></a>
									<a class="item" data-value="false"><?php echo e(__('No')); ?></a>
								</div>
							</div>
						</div>

						<div class="field">
							<label><?php echo e(__('Width')); ?></label>
							<input type="text" name="captcha[mewebstudio][width]" value="<?php echo e(old('captcha.mewebstudio.width', $settings->mewebstudio->width ?? '120')); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Height')); ?></label>
							<input type="text" name="captcha[mewebstudio][height]" value="<?php echo e(old('captcha.mewebstudio.height', $settings->mewebstudio->height ?? '36')); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Quality')); ?></label>
							<input type="text" name="captcha[mewebstudio][quality]" value="<?php echo e(old('captcha.mewebstudio.quality', $settings->mewebstudio->quality ?? '90')); ?>">
						</div>
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\captcha.blade.php ENDPATH**/ ?>