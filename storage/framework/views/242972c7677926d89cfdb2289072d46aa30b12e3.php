<div class="ui secondary unstackable menu m-0">
	<span class="item header"><?php echo e(config('app.name')); ?> © <?php echo e(date('Y')); ?> <?php echo e(__('All right reserved')); ?></span>
</div>						

<form action="<?php echo e(route('set_locale')); ?>" method="post" class="d-none" id="set-locale">
	<input type="hidden" name="redirect" value="<?php echo e(url()->full()); ?>">
	<input type="hidden" name="locale">
</form><?php /**PATH D:\laragon\www\valexa\resources\views\back\includes\footer.blade.php ENDPATH**/ ?>