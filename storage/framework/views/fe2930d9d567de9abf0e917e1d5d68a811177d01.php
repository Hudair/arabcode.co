

<?php $__env->startSection('title', __('Create key, account, license ...')); ?>

<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('keys.store')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled pink large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Create')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('keys')); ?>">
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

	<div class="one column grid" id="key">
		<div class="column">
			<div class="field">
				<label><?php echo e(__('Code')); ?></label>
				<div class="ui left action input">
				  <button class="ui button left-circular-corner" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Create keys in bluk.')); ?></button>
				  <input class="d-none" type="file" name="codes" accept=".txt">
				  <div class="ui basic floating dropdown button mw-20">
				  	<input type="hidden" name="separator" value="<?php echo e(old('separator')); ?>">
				    <div class="text"><?php echo e(__('Separator')); ?></div>
				    <i class="dropdown icon"></i>
				    <div class="menu">
				      <div class="item" data-value="\r\n|\r|\n"><?php echo e(__('Newline')); ?></div>
				      <div class="item" data-value="\r\n\r\n|\r\r|\n\n"><?php echo e(__('Double newline')); ?></div>
				      <div class="item" data-value=","><?php echo e(__('Comma')); ?> <sup>( , )</sup></div>
				      <div class="item" data-value=";"><?php echo e(__('Semicolon')); ?> <sup>( ; )</sup></div>
				      <div class="item" data-value="|"><?php echo e(__('Pipe')); ?> <sup>( | )</sup></div>
				    </div>
				  </div>
				</div>

				<textarea class="mt-1" name="code" placeholder="..."  cols="30" rows="3" autofocus><?php echo e(old('code')); ?></textarea>
			</div>

			<div class="field">
				<label><?php echo e(__('Product')); ?></label>
				<div class="ui fluid floating search selection dropdown">
					<input type="hidden" name="product_id" value="<?php echo e(old('product_id')); ?>" required>
					<div class="default text"></div>
					<div class="menu">
						<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a class="item capitalize" data-value="<?php echo e($product->id); ?>"><?php echo $product->name; ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\keys\create.blade.php ENDPATH**/ ?>