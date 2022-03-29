

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
	
	<?php echo place_ad('ad_728x90'); ?>

	
	<div class="ui two columns shadowless celled grid my-0" id="posts">
		<div class="column left">
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

			
			<?php if($posts->count()): ?>
			<div class="ui three doubling stackable cards px-0">
				<?php echo $__env->renderEach('components.blog-card', $posts, 'post'); ?>
			</div>
			
			
			<div class="ui hidden divider"></div>

			<?php echo e($posts->appends(request()->q ? ['q' => request()->q] : [])->onEachSide(1)->links()); ?>

			<?php echo e($posts->appends(request()->q ? ['q' => request()->q] : [])->links('vendor.pagination.simple-semantic-ui')); ?>

			<?php endif; ?>
		</div>
	
		<div class="column right ">
			<div class="items-wrapper latest-posts">
				<div class="items-title">
					<h3><?php echo e(__('Latest posts')); ?></h3>
				</div>

				<div class="items-list">
					<?php $__currentLoopData = $latest_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest_post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="item">
						<a href="<?php echo e(route('home.post', $latest_post->slug)); ?>" style="background-image: url(<?php echo e(asset_("storage/posts/{$latest_post->cover}")); ?>)"></a>
						<div class="content">
							<a href="<?php echo e(route('home.post', $latest_post->slug)); ?>"><?php echo e($latest_post->name); ?></a>
							<p class="m-0">
								<a href="<?php echo e(route('home.blog.category', $latest_post->category_slug)); ?>"><?php echo e($latest_post->category_name); ?></a>
								<span>/</span>
								<span><?php echo e($latest_post->updated_at->format('M d, Y')); ?></span>
							</p>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>

			<div class="ui hidden divider"></div>

			<div class="items-wrapper tags">
				<div class="items-title">
					<h3><?php echo e(__('Tags')); ?></h3>
				</div>

				<div class="items-list">
					<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(route('home.blog.tag', $tag)); ?>" class="tag"><?php echo e($tag); ?></a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\blog.blade.php ENDPATH**/ ?>