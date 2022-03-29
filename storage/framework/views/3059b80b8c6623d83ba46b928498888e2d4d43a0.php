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
<div class="row" id="top-search">
	<div  class="ui bottom attached basic segment borderless shadowless">
		<div class="ui middle aligned grid m-0">
			<div class="row">
				<div class="column center aligned">
					
					<?php if(config('app.search_header')): ?>
					<h1><?php echo e(config('app.search_header')); ?></h1>
					<br>
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

	<div class="border bottom"></div>
</div>

<?php if(config('app.users_notif')): ?>
<div id="users-notif" class= mb-2" v-if="usersNotifRead != '<?php echo e(config('app.users_notif')); ?>'" v-cloak>
	<div class="notif"><span class="<?php if(mb_strlen(config('app.users_notif')) > 100): ?> marquee <?php endif; ?>"><?php echo e(config('app.users_notif')); ?></span></div>
	<i class="close circular icon mx-0" @click="markUsersNotifAsRead"></i>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	
	<?php echo place_ad('ad_728x90'); ?>

	
	<div class="row home-items">
		
		<!--  FEATURED PRODUCTS -->
		<?php if($featured_products->count()): ?>
		<div class="wrapper featured">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu featured">
					<div class="item">
						<?php echo e(__('Featured items')); ?>

					</div>

					<div class="right menu">
						<a href="<?php echo e(route('home.products.filter', 'featured')); ?>" class="item"><?php echo e(__('Browse all')); ?></a>
					</div>
				</div>
			</div>
			
			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.valexa.featured.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?> px-1">					
					@cards('item-card', $featured_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>

		
		<!--  NEWEST PRODUCTS -->
		<?php if($newest_products->count()): ?>
		<div class="wrapper newest">
			<div class="border top"></div>

			<div class="sixteen wide column mx-auto selection-title">
				<a class="header" href="<?php echo e(route('home.products.filter', 'newest')); ?>"><?php echo e(__('Our newest items')); ?></a>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.valexa.newest.items_per_line', '10'))); ?> items">
					<?php $__currentLoopData = $newest_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newest_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(item_url($newest_product)); ?>" class="item" style="background-image: url(<?php echo e(asset_("storage/covers/{$newest_product->cover}")); ?>)" data-detail="<?php echo e(json_encode($newest_product)); ?>">
					</a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>

			<div class="border bottom"></div>
		</div>
		<?php endif; ?>

		<!--  TRENDING PRODUCTS -->
		<?php if($trending_products->count()): ?>
		<div class="wrapper trending">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu trending">
					<div class="item">
						<?php echo e(__('Trending items')); ?>

					</div>

					<div class="right menu">
						<a href="<?php echo e(route('home.products.filter', 'trending')); ?>" class="item"><?php echo e(__('Browse all')); ?></a>
					</div>
				</div>
			</div>
			
			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.valexa.trending.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?> px-1">
					@cards('item-card', $trending_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>
		
		
		<!--  FLASH PRODUCTS -->
		<?php if($flash_products->count()): ?>
		<div class="wrapper flash">
			<div class="border top"></div>

			<div class="sixteen wide column mx-auto selection-title">
				<a class="header" href="<?php echo e(route('home.products.filter', 'flash')); ?>"><?php echo e(__('Flash items')); ?></a>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui unstackable items">
					<?php $__currentLoopData = $flash_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash_product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="item <?php echo e(out_of_stock($flash_product, true)); ?>">

						<a class="image" href="<?php echo e(item_url($flash_product)); ?>">
							<div style="background-image: url(<?php echo e(asset_("storage/covers/{$flash_product->cover}")); ?>)"></div>
						</a>
						<div class="content">
							<?php if(out_of_stock($flash_product)): ?>
							<div class="out-of-stock"><?php echo e(__('Out of stock')); ?></div>
							<?php endif; ?>

							<div class="name" title="<?php echo $flash_product->name; ?>"><?php echo shorten_str($flash_product->name, 35); ?></div>
							<div class="price">
								<div class="price"><?php echo e(price($flash_product->price)); ?></div>
								<div class="promo"><?php echo e(price($flash_product->promotional_price)); ?></div>
							</div>
							<div class="actions">
								<?php if(!out_of_stock($flash_product)): ?>
								<div class="action" @click="addToCartAsync(<?php echo e(json_encode($flash_product)); ?>, $event)"><i class="cart icon mx-0"></i></div>
								<div class="action like" @click="collectionToggleItem($event, <?php echo e($flash_product->id); ?>)">
									<i class="heart icon link mx-0" :class="{active: itemInCollection(<?php echo e($flash_product->id); ?>)}"></i>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>

			<div class="border bottom"></div>
		</div>
		<?php endif; ?>


		<!--  FREE PRODUCTS -->
		<?php if($free_products->count()): ?>
		<div class="wrapper free">
			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu free">
					<div class="item">
						<?php echo e(__('Free items')); ?>

					</div>

					<div class="right menu">
						<a href="<?php echo e(route('home.products.filter', 'free')); ?>" class="item"><?php echo e(__('Browse all')); ?></a>
					</div>
				</div>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.valexa.free.items_per_line', '4'))); ?> doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?> px-1">
					@cards('item-card', $free_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1])
				</div>
			</div>
		</div>
		<?php endif; ?>


		<?php if(config('app.blog.enabled')): ?>
		<!-- POSTS -->
		<?php if($posts->count()): ?>
		<div class="wrapper posts">
			<div class="border top"></div>

			<div class="sixteen wide column mx-auto selection-title">
				<div class="ui menu posts">
					<a href="<?php echo e(route('home.blog')); ?>" class="item" href="<?php echo e(route('home.blog')); ?>">
						<?php echo e(__('Posts From Our Blog')); ?>

					</a>
				</div>
			</div>

			<div class="sixteen wide column mx-auto">
				<div class="ui <?php echo e(number_to_word(config('app.homepage_items.valexa.posts.items_per_line', '4'))); ?> doubling cards px-1">	
					<?php echo $__env->renderEach('components.blog-card', $posts, 'post'); ?>
				</div>
			</div>
		</div>
		<?php endif; ?>
		<?php endif; ?>

	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\home.blade.php ENDPATH**/ ?>