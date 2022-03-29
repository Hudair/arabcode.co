<div class="card">
	<div class="content p-0">
		<a href="<?php echo e(route('home.post', $post->slug)); ?>">
			<img src="<?php echo e(asset_("storage/posts/{$post->cover}")); ?>" alt="cover">
		</a>
		<time><?php echo e($post->updated_at->diffForHumans()); ?></time>
	</div>
	<div class="content title">
		<a href="<?php echo e(route('home.post', $post->slug)); ?>"><?php echo e($post->name); ?></a>
	</div>
	<div class="content description">
		<?php echo e(mb_substr($post->short_description, 0, 120).'...'); ?>

	</div>
	<div class="content tags">
		<?php $__currentLoopData = array_slice(explode(',', $post->tags), 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<a class="tag" href="<?php echo e(route('home.blog.tag', slug($tag))); ?>"><?php echo e(trim($tag)); ?></a><br>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div><?php /**PATH D:\laragon\www\valexa\resources\views\components\blog-card.blade.php ENDPATH**/ ?>