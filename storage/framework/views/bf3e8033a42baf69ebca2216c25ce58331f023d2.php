

<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context":"http://schema.org",
	"@type": "BlogPosting",
	"image": "<?php echo e($meta_data->image); ?>",
	"url": "<?php echo e($meta_data->url); ?>",
	"description": "<?php echo e($meta_data->description); ?>",
	"headline": "<?php echo e($meta_data->title); ?>",
	"dateCreated": "<?php echo e((new \DateTime($post->created_at))->format('Y-m-d\\TH:i:s')); ?>",
	"datePublished": "<?php echo e((new \DateTime($post->created_at))->format('Y-m-d\\TH:i:s')); ?>",
	"dateModified": "<?php echo e((new \DateTime($post->updated_at))->format('Y-m-d\\TH:i:s')); ?>",
	"inLanguage": "en-US",
	"isFamilyFriendly": "true",
	"copyrightYear": "",
	"copyrightHolder": "",
	"contentLocation": {},
	"accountablePerson": {},
	"creator": {},
	"publisher": {},
	"sponsor": {},
	"mainEntityOfPage": "True",
	"keywords": "<?php echo e($post->keywords); ?>",
	"genre":["SEO","JSON-LD"],
	"articleSection": "<?php echo e($post->category); ?>",
	"articleBody": "<?php echo e(strip_tags($post->content)); ?>",
	"author": {
		"@type": "Organization",
		"name": "<?php echo e(config('app.name')); ?>",
		"url": "<?php echo e(config('app.url')); ?>"
	}
}
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
	
	<?php echo place_ad('ad_728x90'); ?>

	
	<div id="posts">

		<div class="ui two columns shadowless celled grid my-0 post">
			<div class="column left">
				<div class="post-cover">
					<img src="<?php echo e(asset_("storage/posts/{$post->cover}")); ?>" alt="<?php echo e($post->name); ?>">
				</div>

				<div class="post-title">
					<h1><?php echo e($post->name); ?></h1>
					<p><span><?php echo e($post->category); ?></span> / <span><?php echo e($post->updated_at->format('M d, Y')); ?></span></p>
				</div>
				
				<div class="post-content">
					<div class="post-body">
						<?php echo $post->content; ?>

					</div>
				</div>

				<div class="ui divider"></div>

				<div class="social-buttons">
					<span><?php echo e(__('Share on')); ?></span>
					<div class="buttons">
						<button class="ui circular icon twitter button" onclick="window.open('https://twitter.com/intent/tweet?text=<?php echo e($post->short_description); ?>&url=<?php echo e(url()->current()); ?>', 'Twitter', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
							<i class="twitter icon"></i>
						</button>

						<button class="ui circular icon vk button" onclick="window.open('https://vk.com/share.php?url=<?php echo e(url()->current()); ?>', 'VK', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
							<i class="vk icon"></i>
						</button>

						<button class="ui circular icon tumblr button" onclick="window.open('https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo e(url()->current()); ?>', 'tumblr', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
							<i class="tumblr icon"></i>
						</button>

						<button class="ui circular icon facebook button" onclick="window.open('https://facebook.com/sharer.php?u=<?php echo e(url()->current()); ?>', 'Facebook', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
							<i class="facebook icon"></i>
						</button>

						<button class="ui circular icon pinterest button" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php echo e(url()->current()); ?>&media=<?php echo e(asset("storage/posts/$post->cover")); ?>&description=<?php echo e($post->short_description); ?>', 'Pinterest', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
							<i class="pinterest icon"></i>
						</button>

						<button class="ui circular icon linkedin button" onclick="window.open('https://www.linkedin.com/cws/share?url=<?php echo e(url()->current()); ?>', 'Linkedin', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
							<i class="linkedin icon"></i>
						</button>
					</div>
				</div>
				
				<?php if($related_posts->count()): ?>
				<div class="ui divider"></div>

				<div class="related-posts">
					<div class="ui header"><?php echo e(__('Related posts')); ?></div>
					<div class="ui three doubling stackable cards">
						<?php $__currentLoopData = $related_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="ui fluid card">
							<a class="content p-0" href="<?php echo e(route('home.post', $post->slug)); ?>">
								<img src="<?php echo e(asset_("storage/posts/{$post->cover}")); ?>" alt="<?php echo e(__('cover')); ?>">
								<time><?php echo e($post->updated_at->format('M d, Y')); ?></time>
							</a>
							<div class="content title">
								<a href="<?php echo e(route('home.post', $post->slug)); ?>"><?php echo e($post->name); ?></a>
							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<?php endif; ?>
			</div>
		
			<div class="column right ">
				<div class="items-wrapper search">
					<form action="<?php echo e(route('home.blog.q')); ?>" method="get" id="posts-search" class="search-form">
						<div class="ui icon input fluid">
						  <input type="text" name="q" class="circular-corner" placeholder="<?php echo e(__('Find a post')); ?> ..." value="<?php echo e(request()->q); ?>">
						  <i class="search link icon"></i>
						</div>
					</form>
				</div>
				
				<div class="ui hidden divider"></div>

				<div class="items-wrapper categories">
					<div class="items-title">
						<h3><?php echo e(__('Categories')); ?></h3>
					</div>

					<div class="items-list">
						<?php $__currentLoopData = $posts_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $posts_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e(route('home.blog.category', $posts_category->slug)); ?>" class="item">
							<i class="caret right icon"></i><?php echo e($posts_category->name); ?>

						</a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				
				<div class="ui hidden divider"></div>

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

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\post.blade.php ENDPATH**/ ?>