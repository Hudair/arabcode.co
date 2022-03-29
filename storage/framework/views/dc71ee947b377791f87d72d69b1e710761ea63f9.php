

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

	<div class="ui two stackable columns shadowless celled grid my-0" id="posts">
		<div class="column left post">
			<div class="post-title">
				<h1><?php echo e($post->name); ?></h1>
				<p><i class="time icon"></i> <?php echo e((new DateTime($post->updated_at))->format('F d, Y')); ?></p>
			</div>

			<div class="social-buttons">
				<div class="ui spaced tiny buttons p-1-hf">
					<button class="ui basic button" onclick="window.open('https://twitter.com/intent/tweet?text=<?php echo e($post->short_description); ?>&url=<?php echo e(url()->current()); ?>', 'Twitter', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						<i class="twitter icon"></i>
						<span>Twitter</span>
					</button>

					<button class="ui basic button" onclick="window.open('https://vk.com/share.php?url=<?php echo e(url()->current()); ?>', 'VK', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						<i class="vk icon"></i>
						<span>VK</span>
					</button>

					<button class="ui basic button" onclick="window.open('https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo e(url()->current()); ?>', 'tumblr', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						<i class="tumblr icon"></i>
						<span>Tumblr</span>
					</button>

					<button class="ui basic button" onclick="window.open('https://facebook.com/sharer.php?u=<?php echo e(url()->current()); ?>', 'Facebook', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						<i class="facebook icon"></i>
						<span>facebook</span>
					</button>

					<button class="ui basic button" onclick="window.open('https://www.pinterest.com/pin/create/button/?url=<?php echo e(url()->current()); ?>&media=<?php echo e(asset("storage/posts/$post->cover")); ?>&description=<?php echo e($post->short_description); ?>', 'Pinterest', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						<i class="pinterest icon"></i>
						<span>Pinterest</span>
					</button>

					<button class="ui basic button" onclick="window.open('https://www.linkedin.com/cws/share?url=<?php echo e(url()->current()); ?>', 'Linkedin', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						<i class="linkedin icon"></i>
						<span>Linkedin</span>
					</button>
				</div>
			</div>
			
			<div class="post-content">
				<div class="post-body">
					<?php echo $post->content; ?>

				</div>
			</div>
		</div>
	
		<div class="column right desktop-only">
			<div class="items-wrapper">
				<form action="<?php echo e(route('home.blog.q')); ?>" method="get" id="posts-search" class="search-form ui large form">
					<div class="ui icon input fluid">
					  <input type="text" name="keywords" placeholder="<?php echo e(__('Find a post')); ?> ..." value="<?php echo e(request()->q); ?>">
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
<?php echo $__env->make('front.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\post.blade.php ENDPATH**/ ?>