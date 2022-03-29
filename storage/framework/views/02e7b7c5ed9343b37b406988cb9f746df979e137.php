

<?php $__env->startSection('title', __('Mailer settings')); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'mailer')); ?>">

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
		<div class="ui fluid card">
			<div class="content">
				<h3 class="header">
					<i class="circular blue envelope outline icon mr-1" title="Sender"></i>SMTP
				</h3>
			</div>
			
			<div class="content">
				<div class="field">
					<label><?php echo e(__('User')); ?></label>
					<input type="text" name="mailer[mail][username]" placeholder="..." value="<?php echo e(old('mailer.mail.username', $settings->mail->username ?? null)); ?>">
				</div>
			
				<div class="field">
					<label><?php echo e(__('Password')); ?></label>
					<input type="text" name="mailer[mail][password]" placeholder="..." value="<?php echo e(old('mailer.mail.password', $settings->mail->password ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Host')); ?></label>
					<input type="text" name="mailer[mail][host]" placeholder="..." value="<?php echo e(old('mailer.mail.host', $settings->mail->host ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Port')); ?></label>
					<input type="text" name="mailer[mail][port]" placeholder="..." value="<?php echo e(old('mailer.mail.port', $settings->mail->port ?? null)); ?>">
				</div>
				
				<div class="field">
					<label><?php echo e(__('Encryption')); ?></label>
					<input type="text" name="mailer[mail][encryption]" placeholder="..." value="<?php echo e(old('mailer.mail.encryption', $settings->mail->encryption ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Reply to')); ?></label>
					<input type="email" name="mailer[mail][reply_to]" placeholder="example@gmail" value="<?php echo e(old('mailer.mail.reply_to', $settings->mail->reply_to ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Forward to')); ?></label>
					<input type="text" name="mailer[mail][forward_to]" placeholder="email1,email2,..." value="<?php echo e(old('mailer.mail.forward_to', $settings->mail->forward_to ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Queue emails messages')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="mailer[mail][use_queue]" value="<?php echo e(old('mailer.mail.use_queue', $settings->mail->use_queue ?? '0')); ?>">
						<div class="text"></div>
						<div class="menu rounded-corner">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<button class="ui large circular blue button" type="button" id="check-connection"><?php echo e(__('Check connection')); ?></button>
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

		$('#check-connection').on('click', function()
		{
			var formData = $('form.main').serialize();

			$.post('<?php echo e(route('settings.check_mailer_connection')); ?>', formData, 'json')
			.done(function(data)
			{
				alert(data.message)
			})
		})
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\mailer.blade.php ENDPATH**/ ?>