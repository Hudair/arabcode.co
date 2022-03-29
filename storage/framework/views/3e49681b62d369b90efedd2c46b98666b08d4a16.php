

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<script type="application/javascript">
	'use strict';
	var parents_categories = {"0": <?php echo json_encode((object)$parents_posts); ?>, "1": <?php echo json_encode((object)$parents_products); ?>};
</script>

<form class="ui large form" id="category" method="post" 
			action="<?php echo e(route('categories.update', [$category->id, request()->for])); ?>">
	<?php echo csrf_field(); ?>
	
	<div class="field">
		<button class="ui icon labeled pink large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Update')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('categories')); ?>">
			<i class="times icon"></i>
			<?php echo e(__('Cancel')); ?>

		</a>
	</div>

	<?php if($errors->any()): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="ui negative bold circular-corner fluid message">
         	<i class="times icon close"></i>
         	<?php echo e($error); ?>

         </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<div class="ui fluid divider"></div>

	<div class="field">
		<label><?php echo e(__('Name')); ?></label>
		<input type="text" name="name" value="<?php echo e($category->name); ?>" required>
	</div>
	
	<div class="field">
		<label><?php echo e(__('For')); ?></label>
		<div class="ui selection floating dropdown">
			<input type="hidden" name="for" value="<?php echo e(old('for', $category->for ?? null)); ?>">
			<div class="text"></div>
			<div class="menu">
				<?php $__currentLoopData = ['posts', 'products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $for): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a class="item" data-value="<?php echo e($key); ?>"><?php echo e(__(ucfirst($for))); ?></a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
	</div>

	<div class="field">
		<label><?php echo e(__('Parent')); ?></label>
		<div class="ui selection floating dropdown parent-category">
			<input type="hidden" name="parent" value="<?php echo e(old('parent', $category->parent ?? null)); ?>">
			<div class="text"></div>
			<div class="menu"></div>
		</div>
	</div>

	<div class="field">
		<label><?php echo e(__('Position')); ?></label>
		<input type="number" name="range" value="<?php echo e($category->range); ?>">
	</div>

	<div class="field">
		<label><?php echo e(__('Description')); ?></label>
		<textarea name="description" cols="30" rows="5"><?php echo e(nl2br($category->description)); ?></textarea>
	</div>

</form>

<script>
	$(function()
	{
		'use strict';

		$('#category input[name="range"]').on('change', function()
		{
			if($(this).val() < 0)
				$(this).val('0');
		})

		$('input[name="for"]').on('change', function()
		{
			var parents = parents_categories[$(this).val()] || [];
			var options = '';

			$('.dropdown.parent-category').dropdown({values: parents});
		})


	  if($('input[name="for"]').val().length)
	  {
	  	var parentCategory = $('input[name="parent"]').val();

	  	$('input[name="for"]').change()

	  	if(parentCategory.length)
	  	{
	  		$('.dropdown.parent-category').dropdown('set selected', parentCategory)
	  	}
	  }
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\categories\edit.blade.php ENDPATH**/ ?>