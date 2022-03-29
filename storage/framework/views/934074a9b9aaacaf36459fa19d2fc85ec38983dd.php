

<?php $__env->startSection('title', __(':item_type - :name', ['item_type' => $license->item_type, 'name' => $license->name])); ?>

<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('licenses.update', ['id' => $license])); ?>">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled pink large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Save')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('licenses')); ?>">
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

	<div class="one column grid" id="license">
		<div class="column">
			<div class="field">
	      <div class="ui toggle checkbox">
	        <input type="checkbox" name="regular" <?php echo e($license->regular ? 'checked' : ''); ?> tabindex="0" class="hidden">
	        <label><?php echo e(__('Mark as regular license')); ?></label>
	      </div>
	    </div>

			<div class="field">
				<label><?php echo e(__('Name')); ?></label>
				<input type="text" name="name" placeholder="..." value="<?php echo e(old('name', $license->name)); ?>" autofocus required>
			</div>

			<div class="field">
				<label><?php echo e(__('Item type')); ?></label>
				<div class="ui selection floating search dropdown">
				  <input type="hidden" name="item_type" value="<?php echo e(old('item_type', $license->item_type)); ?>">
				  <div class="default text">-</div>
				  <div class="menu">
				  	<?php $__currentLoopData = config('app.item_types') ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item" data-value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  </div>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	$(function()
	{
		$('.ui.toggle.checkbox').checkbox()
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\licenses\edit.blade.php ENDPATH**/ ?>