

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('additional_head_tags'); ?>
<link href="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('faq.update', $faq->id)); ?>">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button type="submit" class="ui purple circular large labeled icon button mx-0">
		  <i class="save outline icon mx-0"></i>
		  <?php echo e(__('Update')); ?>

		</button>
		<a href="<?php echo e(route('faq')); ?>" class="ui yellow circular large right labeled icon button mx-0">
		  <i class="times icon mx-0"></i>
		  <?php echo e(__('Cancel')); ?>

		</a>
	</div>
	
	<?php if($errors->any()): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="ui negative fluid small message">
			<i class="times icon close"></i>
			<?php echo e($error); ?>

		</div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<div class="ui fluid divider"></div>

	<div class="one column grid">
		<div class="column">

			<div class="field">
				<label><?php echo e(__('Question')); ?></label>
				<input type="text" name="question" placeholder="..." value="<?php echo e(old('question', $faq->question)); ?>" required>
			</div>

			<div class="field">
				<label><?php echo e(__('Answer')); ?></label>
				<textarea name="answer" required class="summernote" cols="30" rows="20"><?php echo e(old('answer', $faq->answer)); ?></textarea>
			</div>
			
		</div>
	</div>
</form>

<script>
	$(function()
	{
		'use strict';
		
		$('.summernote').summernote({
	    placeholder: '...',
	    tabsize: 2,
	    height: 300,
	    tooltip: false
	  })
		
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\faq\edit.blade.php ENDPATH**/ ?>