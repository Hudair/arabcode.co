<?php $__env->startSection('additional_head_tags'); ?>
<style>
	<?php if(config('app.top_cover')): ?>
	#top-search {
		background-image: url('<?php echo e(asset_('storage/images/'.config('app.top_cover'))); ?>')
	}
	<?php endif; ?>
</style>

<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	  "name": "<?php echo e($meta_data->title); ?>",
	  "url": "<?php echo e($meta_data->url); ?>",
	  "image": "<?php echo e($meta_data->image); ?>",
	  "keywords": "<?php echo e(config('app.keywords')); ?>"
}
</script>

<script type="application/javascript">
	'use strict';
	window.props['products'] = <?php echo json_encode($products, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES, 512) ?>;
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('top-search'); ?>
	<div  class="ui bottom attached basic segment" id="top-search">
		<div class="ui middle aligned grid m-0">
			<div class="row">
				<div class="column center aligned">
					
					<?php if(config('app.search_header')): ?>
					<h1><?php echo e(config('app.search_header')); ?></h1>
					<br>
					<?php endif; ?>

					<?php if(config('app.search_subheader')): ?>
					<h3 class="marquee"><?php echo e(config('app.search_subheader')); ?></h3>
					<?php endif; ?>
					
					<form class="ui huge form fluid search-form" id="live-search" method="get" action="<?php echo e(route('home.products.q')); ?>">
						<div class="ui icon input fluid">
						  <input type="text" name="q" placeholder="<?php echo e(__('Search')); ?>...">
						  <i class="search link icon"></i>
						</div>
						<div class="products" vhidden>
							<a :href="'/item/'+ item.id + '/' + item.slug" v-for="item of liveSearchItems" class="item">
								{{ item.name }}
							</a>
						</div>
			    </form>
					
					<?php if(config('home_categories')): ?>
					<div class="categories mt-2 <?php if(count(config('home_categories')) > 20): ?> large <?php endif; ?>">
				    <div class="ui labels">
				    	<?php $__currentLoopData = config('home_categories'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $home_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a class="ui basic label" href="<?php echo e($home_category->url); ?>"><?php echo e($home_category->name); ?></a>
				    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				    </div>
			    </div>
			    <?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<?php if(config('app.users_notif')): ?>
	<div id="users-notif" class="mb-2" v-cloak v-if="usersNotifRead != '<?php echo e(config('app.users_notif')); ?>'">
		<?php echo e(config('app.users_notif')); ?>

		<i class="close circular icon mx-0" @click="markUsersNotifAsRead"></i>
	</div>
	<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	
	<div class="row home-items">
		
		<!--  FEATURED PRODUCTS -->
		<?php if($featured_products->count()): ?>
		<div class="wrapper featured">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu ml-1 pl-0">
					<a href="<?php echo e(route('home.products.filter', 'featured')); ?>" class="item my-1 featured">
						<?php echo __('Featured items'); ?>

					</a>
				</div>
			</div>
			
			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.default.featured.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?> px-1">
					@cards('item-card', $featured_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1, 'home' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>

		
		<!--  TRENDING PRODUCTS -->
		<?php if($trending_products->count()): ?>
		<div class="wrapper trending">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu ml-1 pl-0">
					<a href="<?php echo e(route('home.products.filter', 'trending')); ?>" class="item my-1 trending">
						<?php echo __('Trending items'); ?>

					</a>
				</div>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.default.trending.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?>  px-1">
					@cards('item-card', $trending_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1, 'home' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>
		

		<!--  NEWEST PRODUCTS -->
		<?php if($newest_products->count()): ?>
		<div class="wrapper newest">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu ml-1 pl-0">
					<a href="<?php echo e(route('home.products.filter', 'newest')); ?>" class="item my-1 newest">
						<?php echo __('Newest items'); ?>

					</a>
				</div>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.default.newest.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?>  px-1">
					@cards('item-card', $newest_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1, 'home' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		
		<!--  FREE PRODUCTS -->
		<?php if($free_products->count()): ?>
		<div class="wrapper free">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu ml-1 pl-0">
					<a href="<?php echo e(route('home.products.filter', 'free')); ?>" class="item my-1 free">
						<?php echo __('Free items'); ?>

					</a>
				</div>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.default.free.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?> px-1">
					@cards('item-card', $free_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1, 'home' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>


		<!-- POSTS -->
		<?php if($posts->count()): ?>
		<div class="wrapper posts">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu ml-1 pl-0">
					<a href="<?php echo e(route('home.blog')); ?>" class="item my-1 blog" href="<?php echo e(route('home.blog')); ?>">
						<?php echo __('Posts From Our Blog'); ?>

					</a>
				</div>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.default.posts.items_per_line', '5'))); ?> doubling cards px-1">
					<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\home.blade.php ENDPATH**/ ?>