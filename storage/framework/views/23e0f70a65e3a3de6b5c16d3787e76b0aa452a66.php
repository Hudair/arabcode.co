

<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebPage",
	"image": "<?php echo e($meta_data->image); ?>",
	"name": "<?php echo e($meta_data->title); ?>",
  "url": "<?php echo e($meta_data->url); ?>",
  "description": "Frequently asked questions and support."
}
</script>

<?php if(captcha_is_enabled('contact') && captcha_is('google')): ?>
<?php echo google_captcha_js(); ?>

<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>

	<div class="ui one column shadowless celled grid my-0" id="support">
		<div class="column">

			<div class="title-wrapper">
				<h1><?php echo e(__('Support')); ?></h1>
				<div class="ui big breadcrumb">
					<a href="/" class="section"><?php echo e(__('Home')); ?></a>
					<i class="right chevron icon divider"></i>
					<span class="active section">Support</span>
				</div>
			</div>

			<div class="faq p-2">
				<div class="title"><?php echo e(__('Frequently asked questions')); ?></div>
				<div class="content">
					<div class="ui borderless segments">
					<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <div class="ui borderless segment">
				    <p><i class="minus icon"></i><?php echo e($faq->question); ?></p>
				    <div>
				    	<?php echo $faq->answer; ?>

				    </div>
				  </div>
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>	
				</div>
			</div>

			<div class="contact p-2">
				<div class="border top"></div>

				<div class="title"><?php echo e(__('Contact us')); ?></div>

				<?php if($errors->any()): ?>
			    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="ui negative fluid small circular bold message">
						<i class="close icon"></i>
						<?php echo e($error); ?>

					</div>
			    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>

				<?php if(session('support_response')): ?>
				<div class="ui fluid small bold positive message">
					<?php echo e(session('support_response')); ?>

				</div>
				<?php endif; ?>

				<form action="<?php echo e(route('home.support')); ?>" method="post" class="ui large form">
					<?php echo csrf_field(); ?>

					<div class="field">
						<label><?php echo e(__('Email')); ?></label>
						<input type="email" value="<?php echo e(old('email', request()->user()->email ?? '')); ?>" name="email" placeholder="Your email..." required>
					</div>

					<div class="field">
						<label><?php echo e(__('Subjet')); ?></label>
						<input type="text" name="subject" value="<?php echo e(old('subject')); ?>" placeholder="..." required>
					</div>

					<div class="field">
						<label><?php echo e(__('Question')); ?></label>
						<textarea name="message" cols="30" rows="10" placeholder="..." required><?php echo e(old('message')); ?></textarea>
					</div>

					<?php $__errorArgs = ['captcha'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
			      <div class="ui negative message">
			        <strong><?php echo e($message); ?></strong>
			      </div>
			    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

			    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
			      <div class="ui negative message">
			        <strong><?php echo e($message); ?></strong>
			      </div>
			    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

			    <?php if(captcha_is_enabled('contact')): ?>
			    <div class="field d-flex justify-content-center">
			      <?php echo render_captcha(); ?>


			      <?php if(captcha_is('mewebstudio')): ?>
			      <input type="text" name="captcha" value="<?php echo e(old('captcha')); ?>" class="ml-1">
			      <?php endif; ?>
			    </div>
			    <?php endif; ?>

					<div class="field">
						<button class="ui circular big yellow button" type="submit"><?php echo e(__('Submit')); ?></button>
					</div>
				</form>
			</div>
		</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\support.blade.php ENDPATH**/ ?>