



<?php $__env->startSection('body'); ?>

<div class="ui one column shadowless celled grid my-0" id="folder">

	<div class="column">
		<div class="ui header title"><?php echo e($title); ?></div>
		
		<div class="ui four doubling cards">
			<?php $__currentLoopData = $files_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="card fluid center aligned">
				<div class="content name" title="<?php echo e($file->name); ?>">
					<?php echo e(mb_ucfirst(mb_strtolower($file->name))); ?>

				</div>
				<div class="content icon">
					<i class="file huge outline icon mx-0"></i>
				</div>
				<a class="content link" @click="downloadFile('<?php echo e($file->id); ?>', '<?php echo e($file->name); ?>', '#download-file-form')">
					<?php echo e(__('Download')); ?>

				</a>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	

	<form action="<?php echo e(route('home.product_folder_sync_download', ['id' => $product->id, 'slug' => $product->slug])); ?>" target="_blank" id="download-file-form" class="d-none" method="post">
		<?php echo csrf_field(); ?>
		<input type="hidden" name="slug" value="<?php echo e($product->slug); ?>">
		<input type="hidden" name="id" value="<?php echo e($product->id); ?>">
		<input type="hidden" name="file_name" v-model="folderFileName">
		<input type="hidden" name="file_client_name" v-model="folderClientFileName">
	</form>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\folder.blade.php ENDPATH**/ ?>