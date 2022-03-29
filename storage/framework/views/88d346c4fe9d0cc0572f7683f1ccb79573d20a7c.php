<?php $__env->startSection('additional_head_tags'); ?>
<style>
	<?php if(config('app.top_cover_color')): ?>
	#top-search:before {
		background: <?php echo e(config('app.top_cover_color')); ?>	
	}
	<?php endif; ?>
	
	<?php if(config('app.top_cover')): ?>
	#top-search {
		background-image: url('<?php echo e(asset_('storage/images/'.config('app.top_cover'))); ?>')
	}
	<?php endif; ?>

	<?php if(config('app.tendra_top_cover_mask')): ?>
	#top-search {
		-webkit-mask-image: url('<?php echo e(asset_('storage/images/'.config('app.tendra_top_cover_mask'))); ?>');
    -webkit-mask-position: bottom center;
    -webkit-mask-size: cover;
    padding-bottom: 6rem;
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
	<div class="ui bottom attached basic segment" id="top-search">
		<div class="ui middle aligned grid m-0">
			<div class="row">
				<div class="column center aligned">
					
					<?php if(config('app.search_header')): ?>
					<h1><?php echo e(__(config('app.search_header'))); ?></h1>
					<br>
					<?php endif; ?>

					<?php if(config('app.search_subheader')): ?>
					<h3 class="marquee"><?php echo e(__(config('app.search_subheader'))); ?></h3>
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

				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	
	<div class="row home-items">
		
		<!--  NEWEST PRODUCTS -->
		<?php if($newest_products->count()): ?>
		<div class="newest wrapper">
			<div class="ui header">
				<?php echo e(__('Our Newest Items')); ?>

				<div class="sub header">
					<?php echo e(__('Explore our newest Digital Products, from :first_category to :last_category, we always have something interesting for you.',
					['first_category' => collect(config('categories.category_parents'))->first()->name ?? null, 
					 'last_category' => collect(config('categories.category_parents'))->last()->name ?? null])); ?>

				</div>
			</div>

			<div class="ui <?php echo e(number_to_word(config('app.homepage_items.tendra.newest.items_per_line', '8'))); ?> items <?php echo e(is_single_prdcts_type()); ?>">
				<?php $__currentLoopData = $newest_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newest_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a href="<?php echo e(item_url($newest_product)); ?>" class="item" style="background-image: url(<?php echo e(asset_("storage/covers/{$newest_product->cover}")); ?>)" data-detail="<?php echo e(json_encode($newest_product)); ?>">
				</a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>

		<div class="ui popup newest-item">
			<div class="ui fluid card">
				<div class="image">
					<img src="">
					<div class="price"></div>
					<div class="play">
						<a><img src="<?php echo e(asset_('assets/images/play.png')); ?>"></a>
					</div>
				</div>
				<div class="content">
					<div class="name"></div>
				</div>
			</div>
		</div>
		<?php endif; ?>


		<!--  FEATURED PRODUCTS -->
		<?php if($featured_products): ?>
		<div class="featured wrapper" id="featured-items">
			<div class="ui header">
				<?php echo e(__('Featured Items Of The Week')); ?>

				<div class="sub header">
					<?php echo e(__('Explore our best items of the week. :categories and more.',
					['categories' => implode(', ', array_map(function($category)
					{
						return __($category->name ?? null);
					}, config('categories.category_parents') ?? []))])); ?>

				</div>
			</div>
			
			<div class="ui secondary menu">
    			<?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_slug => $items_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        			<?php $__currentLoopData = config('categories.category_parents') ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            			<?php if($category_slug == $category->slug): ?>
        				<a class="item tab <?php echo e($loop->parent->first ? 'active' : ''); ?>" data-category="<?php echo e($category->slug); ?>"><?php echo e($category->name); ?></a>
        				<?php endif; ?>
    				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>

			<?php $__currentLoopData = $featured_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_slug => $items_list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="ui <?php echo e(number_to_word(config('app.homepage_items.tendra.featured.items_per_line', '3'))); ?> doubling cards mt-0 <?php echo e($category_slug); ?> <?php echo e($loop->first ? 'active' : ''); ?>">
				<?php cards('item-card', $items_list, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1, 'home' => 1]); ?>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<div class="ui segment borderless shadowless center aligned mt-2">
				<a href="/items/category/<?php echo e(array_keys($featured_products)[0] ?? null); ?>" class="ui teal big circular button mx-0 more-items"><?php echo e(__('More items')); ?></a>
			</div>
		</div>
		<?php endif; ?>
	

		<!-- FREE ITEMS -->
		<?php if($free_products->count()): ?>
		<div class="free wrapper mt-4">
			<div class="ui header">
				<?php echo e(__('Our Free Items')); ?>

				<div class="sub header">
					<?php echo e(__('Explore our free items of the week')); ?>

				</div>
			</div>

			<div class="ui <?php echo e(number_to_word(config('app.homepage_items.tendra.free.items_per_line', '6'))); ?> doubling cards">
				<?php $__currentLoopData = $free_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $free_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a class="fluid card" href="<?php echo e(item_url($free_product)); ?>">
					<div class="image">
						<div class="thumbnail" style="background-image: url('<?php echo e(asset_("storage/covers/{$free_product->cover}")); ?>')"></div>
					</div>
					<div class="title"><?php echo e($free_product->name); ?></div>
				</a>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		<?php endif; ?>

		<!-- SUBSCRIPTION PLANS -->
		<?php if(config('app.subscriptions.enabled') && $subscriptions->count()): ?>
		<div class="pricing container">
			<div class="pricing wrapper">
				<div class="ui header">
					<?php echo e(__('Our Pricing Plans')); ?>

					<div class="sub header">
						<?php echo e(__('Explore our pricing plans, from :first to :last, choose the one that meets your needs.', ['first' => $subscriptions->first()->name, 'last' => $subscriptions->last()->name])); ?>

					</div>
				</div>
				
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.tendra.pricing_plans.items_per_line', '3'))); ?> doubling cards mt-2">
					<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card">
						<div class="contents">
							<div class="content price">
								<div style="color: <?php echo e($subscription->color ?? '#000'); ?>">
									<?php echo e(price($subscription->price)); ?>

									<?php if($subscription->title): ?><span>/ <?php echo e(__($subscription->title)); ?></span><?php endif; ?>
								</div>
							</div>

							<div class="content description">
								<?php $__currentLoopData = explode("\n", $subscription->description); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div><i class="check blue icon"></i><?php echo e($note); ?></div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>

							<div class="content buy">
								<a href="<?php echo e(pricing_plan_url($subscription)); ?>" class="ui large circular button mx-0" style="background: <?php echo e($subscription->color ?? '#667694'); ?>">
									<?php echo e(__('Get started')); ?>

								</a>
							</div>

							<div class="name" style="background: <?php echo e($subscription->color ?? '#667694'); ?>">
								<span><?php echo e(__($subscription->name)); ?></span>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>


		<!-- POSTS -->
		<?php if(config('app.blog.enabled')): ?>
		<?php if($posts->count()): ?>
			<div class="posts wrapper">
				<div class="ui header">
					<?php echo e(__('Our Latest News')); ?>

					<div class="sub header">
						<?php echo e(__('Explore our latest articles for more ideas and inspiration, technology, design, tutorials, business and much more.')); ?>

					</div>
				</div>

				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.tendra.posts.items_per_line', '3'))); ?> doubling cards mt-2">
					<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card">
						<a class="image" href="<?php echo e(route('home.post', $post->slug)); ?>">
							<img src="<?php echo e(asset_("storage/posts/{$post->cover}")); ?>" alt="<?php echo e($post->name); ?>">
						</a>

						<div class="content metadata">
							<div class="left">
								<div><?php echo e($post->updated_at->format('d')); ?></div>
								<div><?php echo e($post->updated_at->format('M, Y')); ?></div>
							</div>
							<div class="right">
								<a href="<?php echo e(route('home.post', $post->slug)); ?>" title="<?php echo e($post->name); ?>"><?php echo e(shorten_str($post->name, 60)); ?></a>
							</div>
						</div>

						<div class="content description">
							<?php echo e(shorten_str($post->short_description, 100)); ?>

						</div>

						<div class="content action">
							<a href="<?php echo e(route('home.post', $post->slug)); ?>"><?php echo e(__('Read more')); ?><i class="plus icon ml-1-hf"></i></a>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		<?php endif; ?>
		<?php endif; ?>
		
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views/front/tendra/home.blade.php ENDPATH**/ ?>