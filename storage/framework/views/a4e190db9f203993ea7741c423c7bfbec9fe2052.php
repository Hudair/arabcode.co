

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('additional_head_tags'); ?>

<link href="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('pages.update', $page->id)); ?>">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled pink large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Update')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('pages')); ?>">
			<i class="times icon"></i>
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

	<div class="one column grid" id="page">
		<div class="column">
			<div class="field">
				<label><?php echo e(__('Name')); ?></label>
				<input type="text" name="name" placeholder="..." value="<?php echo e(old('name', $page->name)); ?>" autofocus required>
			</div>
			<div class="field">
				<label><?php echo e(__('Short description')); ?></label>
				<textarea name="short_description" cols="30" rows="5"><?php echo e(old('short_description', $page->short_description)); ?></textarea>
			</div>
			<div class="field">
				<label><?php echo e(__('Content')); ?></label>
				<textarea name="content" required class="summernote" cols="30" rows="20"><?php echo e(old('content', $page->content)); ?></textarea>
			</div>
			<div class="field">
				<label><?php echo e(__('Tags')); ?></label>
				<input type="text" name="tags" value="<?php echo e(old('tags', $page->tags)); ?>">
			</div>
		</div>
	</div>
</form>

<script>
	'use strict';
	
  $('.summernote').summernote({
    placeholder: '...',
    tabsize: 2,
    height: 450,
    tooltip: false
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\pages\edit.blade.php ENDPATH**/ ?>