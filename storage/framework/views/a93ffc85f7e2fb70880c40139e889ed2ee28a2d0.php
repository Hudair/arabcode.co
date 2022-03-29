

<?php $__env->startSection('title', $title); ?>

<?php $__env->startSection('content'); ?>

<form class="ui large form" id="subscription" method="post" action="<?php echo e(route('subscriptions.store')); ?>">
	<?php echo csrf_field(); ?>
	
	<div class="field">
		<button class="ui icon labeled purple large circular button" type="submit">
		  <i class="save outline icon"></i>
		  <?php echo e(__('Create')); ?>

		</button>
		<a class="ui icon labeled yellow large circular button" href="<?php echo e(route('subscriptions')); ?>">
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

	<div class="field">
		<label><?php echo e(__('Name')); ?></label>
		<input type="text" name="name" required autofocus value="<?php echo e(old('name')); ?>">
		<small><?php echo e(__('e.g. : Plan 1, Basic, Ultimate, ... etc')); ?>.</small>
	</div>

	<div class="field">
		<label><?php echo e(__('Duration title')); ?></label>
		<input type="text" name="title" value="<?php echo e(old('title')); ?>">
		<small><?php echo e(__('e.g. : Month, Day, 45 Days, Year, ... etc')); ?></small>
	</div>

	<div class="field">
		<label><?php echo e(__('Price')); ?></label>

		<div class="ui right action input">
		  <input type="number" step="0.01" name="price" value="<?php echo e(old('price')); ?>">
			<div class="ui teal icon button" onclick="this.nextElementSibling.click()"><?php echo e(__('Color')); ?></div>
		  <input type="color" class="d-none" name="color" value="<?php echo e(old('color')); ?>">
		</div>
	</div>
	
	<div class="field">
		<label><?php echo e(__('Days')); ?> </label>
		<input type="number" name="days" value="<?php echo e(old('days')); ?>">
		<small><?php echo e(__('Number of days for the subscription')); ?>.</small>
		<div class="ui hidden my-0"></div>
	</div>

	<div class="field">
		<label><?php echo e(__('Limit total downloads')); ?></label>
		<input type="number" name="limit_downloads" value="<?php echo e(old('limit_downloads')); ?>">
		<small><?php echo e(__('Limit of downloads per X days')); ?>.</small>
	</div>

	<div class="field">
		<label><?php echo e(__('Limit downloads per day')); ?></label>
		<input type="number" name="limit_downloads_per_day" value="<?php echo e(old('limit_downloads_per_day')); ?>">
	</div>

	<div class="field">
		<label><?php echo e(__('Limit downloads of the same item during the subscription')); ?></label>
    <input type="number" name="limit_downloads_same_item" value="<?php echo e(old('limit_downloads_same_item')); ?>">
	</div>

	<div class="field">
		<label><?php echo e(__('Description')); ?></label>
		<textarea name="description" cols="30" rows="5" placeholder="<?php echo e(__('Line')); ?> 1&#10;<?php echo e(__('Line')); ?> 2&#10;<?php echo e(__('Line')); ?> 3"><?php echo e(old('description')); ?></textarea>
		<small><?php echo e(__('HTML code allowed')); ?>.</small>
	</div>

	<div class="field">
		<label><?php echo e(__('Products')); ?></label>
		<div class="ui search multiple floating selection dropdown">
			<input type="hidden" name="products" value="<?php echo e(old('products')); ?>">
			<div class="text">...</div>
			<div class="menu">
				<?php $__currentLoopData = \App\Models\Product::where('active', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a class="item capitalize" data-value="<?php echo e($product->id); ?>"><?php echo e($product->name); ?></a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		<small><?php echo e(__('Products applicable for this plan. (Default: all)')); ?></small>
	</div>

	<div class="field">
		<label><?php echo e(__('Position')); ?></label>
		<input type="number" name="position" value="<?php echo e(old('position')); ?>">
		<small><?php echo e(__('Whether to show first, 2nd ... last.')); ?>.</small>
	</div>

</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\pricing\create.blade.php ENDPATH**/ ?>