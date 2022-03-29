

<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "Blog",
	  "name": "<?php echo e($meta_data->title); ?>",
	  "url": "<?php echo e($meta_data->url); ?>",
	  "image": "<?php echo e($meta_data->image); ?>",
	  "description": "<?php echo e($meta_data->description); ?>"
	  <?php if(request()->q): ?>
	  ,"potentialAction": {
			"@type": "SearchAction",  
			"target": "<?php echo route('home.blog.q').'?q={query}'; ?>",
			"query-input": "required name=query"
		}
	  <?php endif; ?>
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	<div id="blog">
		
		<div class="ui secondary menu">
			<div class="item header">
				<?php if(request()->category || request()->tag || request()->query('q')): ?>
				<?php echo __(':total Posts found for :name',
						['total' => $posts->total(), 'name' => '<span><a href="'.route('home.blog').'"><i class="close icon"></i></a>'.$filter->value.'</span>']); ?>	
				<?php else: ?>
				<?php echo e(__(':total Posts found.', ['total' => $posts->total()])); ?>	
				<?php endif; ?>
			</div>

			<div class="right menu">
				<div class="ui search item">
					<form class="ui icon input" action="<?php echo e(route('home.blog.q')); ?>" method="get">
						<input type="text" name="q" value="<?php echo e(request()->query('q')); ?>" placeholder="<?php echo e(__('Find a post')); ?>" class="prompt"> 
						<i class="search link icon"></i>
					</form>
				</div>

				<div class="item ui dropdown">
					<i class="bars icon mx-0"></i>
					<div class="menu">
						<?php $__currentLoopData = $posts_categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posts_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e(blog_category_url($posts_category->slug)); ?>" class="item"><?php echo e($posts_category->name); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>

		<div class="ui one column shadowless celled grid posts my-0">
			<div class="column">
				<?php if($posts->count()): ?>
				<div class="ui three doubling cards px-0">
					<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="ui fluid card">
						<a class="content p-0" href="<?php echo e(route('home.post', $post->slug)); ?>">
							<img src="<?php echo e(asset_("storage/posts/{$post->cover}")); ?>" alt="<?php echo e(__('cover')); ?>">
							<time><?php echo e($post->updated_at->format('M d, Y')); ?></time>
						</a>
						<div class="content title">
							<a href="<?php echo e(route('home.post', $post->slug)); ?>"><?php echo e($post->name); ?></a>
						</div>
						<div class="content description">
							<?php echo e(shorten_str($post->short_description, 120)); ?>

						</div>
						<div class="content tags">
							<?php $__currentLoopData = array_slice(explode(',', $post->tags), 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a class="tag" href="<?php echo e(route('home.blog.tag', slug($tag))); ?>"><?php echo e(trim($tag)); ?></a><br>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				
				<?php echo e($posts->appends(request()->q ? ['q' => request()->q] : [])->onEachSide(1)->links()); ?>

				<?php echo e($posts->appends(request()->q ? ['q' => request()->q] : [])->links('vendor.pagination.simple-semantic-ui')); ?>

				<?php endif; ?>
			</div>
		</div>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\blog.blade.php ENDPATH**/ ?>