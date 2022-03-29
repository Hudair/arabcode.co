

<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content'); ?>
<form class="ui large form" method="post" action="<?php echo e(route('profile.update')); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?>

	<div class="field">
		<button class="ui icon labeled purple large circular button" type="submit">
		  <i class="save outline icon"></i>
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

	<div class="ui fluid divider"></div>

	<div class="one column grid" id="page">
		<div class="column">
			<div class="field">
				<img class="ui tiny image circular cursor-pointer" src="<?php echo e(asset_('storage/avatars/'.($user->avatar ?? 'default.jpg'))); ?>?v=<?php echo e(time()); ?>" onclick="this.nextElementSibling.click()">
				<input type="file" class="d-none" name="avatar" accept="image/*">
			</div>

			<div class="field">
				<label><?php echo e(__('Firstname')); ?></label>
				<input type="text" name="firstname" placeholder="..." value="<?php echo e(old('firstname', $user->firstname)); ?>">
			</div>
			<div class="field">
				<label><?php echo e(__('Lastname')); ?></label>
				<input type="text" name="lastname" placeholder="..." value="<?php echo e(old('lastname', $user->lastname)); ?>">
			</div>
			<div class="field">
				<label><?php echo e(__('Username')); ?></label>
				<input type="text" name="name" placeholder="..." value="<?php echo e(old('name', $user->name)); ?>">
			</div>
			<div class="field">
				<label><?php echo e(__('Email')); ?></label>
				<input type="text" name="email" placeholder="..." value="<?php echo e(old('email', $user->email)); ?>" required>
			</div>
			<div class="field">
				<label><?php echo e(__('Password')); ?></label>
				<input type="text" name="password" placeholder="..." value="<?php echo e(old('password')); ?>">
			</div>

		</div>
	</div>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\profile.blade.php ENDPATH**/ ?>