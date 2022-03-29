

<?php $__env->startSection('additional_head_tags'); ?>
<title><?php echo e($meta_data->name); ?></title>

<link rel="canonical" href="<?php echo e(preg_replace('/https?\:/i', '', $meta_data->url)); ?>">

<meta name="description" content="<?php echo e($meta_data->description); ?>">

<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
<meta property="og:title" content="<?php echo e($meta_data->title); ?>">
<meta property="og:type" content="Website">
<meta property="og:url" content="<?php echo e($meta_data->url); ?>">
<meta property="og:description" content="<?php echo e($meta_data->description); ?>">
<meta property="og:image" content="<?php echo e($meta_data->image); ?>">

<meta name="twitter:title" content="<?php echo e($meta_data->name); ?>">
<meta name="twitter:url" content="<?php echo e($meta_data->url); ?>">
<meta name="twitter:description" content="<?php echo e($meta_data->description); ?>">
<meta name="twitter:site" content="<?php echo e($meta_data->url); ?>">
<meta name="twitter:image" content="<?php echo e($meta_data->image); ?>">

<meta itemprop="title" content="<?php echo e($meta_data->name); ?>">
<meta itemprop="name" content="<?php echo e(config('app.name')); ?>">
<meta itemprop="url" content="<?php echo e($meta_data->url); ?>">
<meta itemprop="description" content="<?php echo e($meta_data->description); ?>">
<meta itemprop="image" content="<?php echo e($meta_data->image); ?>">

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

	<div class="ui two stackable columns shadowless celled grid my-0" id="posts">
		<div class="column left">
			<?php if($filter): ?>
			<div class="ui segment shadowless filter p-1-hf">
				<div class="ui labels">
				   <div class="ui basic label mb-0">
				   		<i class="filter icon"></i><?php echo e($filter->name); ?>

				   </div>
				   <div class="ui yellow label mb-0">
				      <?php echo e($filter->value); ?><i class="times icon link mr-0 ml-1-hf" onclick="location.href = '<?php echo e(route('home.blog')); ?>'"></i>
				   </div>
				</div>
			</div>
			<?php endif; ?>
			
			<?php if($posts->count()): ?>
			<div class="ui three doubling cards px-0">
				<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="card">
					<div class="content p-0">
						<a href="<?php echo e(route('home.post', $post->slug)); ?>">
							<img src="<?php echo e(asset_("storage/posts/{$post->cover}")); ?>" alt="<?php echo e(__('cover')); ?>">
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
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
			
			
			<div class="ui fluid divider"></div>

			<?php echo e($posts->appends(request()->q ? ['q' => request()->q] : [])->onEachSide(1)->links()); ?>

			<?php echo e($posts->appends(request()->q ? ['q' => request()->q] : [])->links('vendor.pagination.simple-semantic-ui')); ?>

			<?php endif; ?>
		</div>
	
		<div class="column right desktop-only">
			<div class="items-wrapper">
				<form action="<?php echo e(route('home.blog.q')); ?>" method="get" id="posts-search" class="search-form">
					<div class="ui icon input fluid">
					  <input type="text" name="q" placeholder="<?php echo e(__('Find a post')); ?> ..." value="<?php echo e(request()->q); ?>">
					  <i class="search link icon"></i>
					</div>
				</form>
			</div>

			<div class="ui hidden divider"></div>

			<div class="items-wrapper">
				<div class="items-title">
					<h3><?php echo e(__('Categories')); ?></h3>
				</div>

				<div class="items-list">
					<?php $__currentLoopData = $posts_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posts_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(route('home.blog.category', $posts_category->slug)); ?>" class="tag">
						<?php echo e($posts_category->name); ?>

					</a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\blog.blade.php ENDPATH**/ ?>