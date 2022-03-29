

<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebSite",
	"image": "<?php echo e($meta_data->image); ?>",
	"name": "<?php echo e($meta_data->title); ?>",
  "url": "<?php echo e($meta_data->url); ?>"
	<?php if($category->description ?? null): ?>
  ,"description": "<?php echo e($meta_data->description); ?>"
  <?php elseif(request()->q): ?>
  ,"potentialAction": {
		"@type": "SearchAction",  
		"target": "<?php echo route('home.products.q').'?q={query}'; ?>",
		"query-input": "required name=query"
	}
  <?php endif; ?>
}
</script>

<script type="application/javascript"> 
	'use strict';

	window.props['products'] = <?php echo json_encode($products->reduce(function ($carry, $item) 
																	{
																	  $carry[$item->id] = $item;
																	  return $carry;
																	}, [])) ?>;
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<div class="ui shadowless celled grid my-0" id="items">

	<div class="row">
		<div class="column left">
			<div class="categories">
				<div class="title"><?php echo e(__('Categories')); ?></div>

				<?php if(config('categories.category_parents')): ?>
				<div class="ui vertical fluid menu shadowless borderless">
					<?php $__currentLoopData = config('categories.category_parents', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="category <?php if(request()->category_slug === $category->slug): ?> active <?php endif; ?>">
						<a href="<?php echo category_url($category->slug); ?>" class="parent header item">
							<span><?php echo e($category->name); ?></span>
						</a> 
						<?php if($subcategories = config("categories.category_children.{$category->id}", [])): ?>
						<div class="children">
							<?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<a href="<?php echo category_url($category->slug, $subcategory->slug); ?>" 
									 class="item <?php if(request()->subcategory_slug === $subcategory->slug): ?> active <?php endif; ?>">
									<span class="left floated"><i class="caret right icon"></i></span><?php echo e($subcategory->name); ?>

								</a>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<?php endif; ?>

			</div>

			<?php if($tags ?? []): ?>
			<div class="ui hidden divider"></div>

			<div class="filter tags">
				<div class="title"><?php echo e(__('Tags')); ?></div>

				<div class="ui vertical fluid menu shadowless borderless form">
					<?php $__currentLoopData = $tags ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(tag_url($tag)); ?>" class="item capitalize">
						<span class="ui checkbox radio <?php echo e(tag_is_selected($tag) ? 'checked' : ''); ?>">
						  <input type="checkbox">
						  <label><span><?php echo e($tag); ?></span></label>
						</span>
					</a>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<?php endif; ?>

			<?php if(config('app.products_by_country_city')): ?>
			<div class="ui hidden divider"></div>

			<div class="filter countries">
				<div class="title"><?php echo e(__('Country')); ?></div>

				<div class="ui floating search selection fluid dropdown countries">
					<input type="hidden" name="country" value="<?php echo e(country_url($country)); ?>">
					<div class="text">...</div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<?php $__currentLoopData = config('app.countries_cities', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $_country => $_cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e(country_url($_country)); ?>" class="item capitalize" data-value="<?php echo e(country_url($_country)); ?>"><?php echo e(__(mb_ucfirst($_country))); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>

			<?php if($country): ?>
			<div class="ui hidden divider"></div>

			<div class="filter cities">
				<div class="title"><?php echo e(__('Cities')); ?></div>

				<div class="ui floating multiple search selection fluid dropdown cities">
					<input type="hidden" name="cities" value="<?php echo e($cities); ?>">
					<div class="text">...</div>
					<i class="dropdown icon"></i>
					<div class="menu">
						<?php $__currentLoopData = _sort(config("app.countries_cities.{$country}", [])); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item capitalize" data-value="<?php echo e($city); ?>"><?php echo e(__($city)); ?></div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
			<?php endif; ?>

			<?php if(!request()->filter): ?>
			<div class="ui hidden divider"></div>

			<div class="price">
				<div class="title"><?php echo e(__('Price range')); ?></div>

				<div class="ui form">
					<div class="three fields">
						<div class="field w-100">
							<label><?php echo e(__('Min')); ?></label>
							<input type="number" step="0.1" name="min" value="<?php echo e(priceRange('min')); ?>" class="circular-corner">
						</div>
						<div class="field w-100">
							<label><?php echo e(__('Max')); ?></label>
							<input type="number" step="0.1" name="max" value="<?php echo e(priceRange('max')); ?>" class="circular-corner">
						</div>
						<div class="field">
							<label>&nbsp;</label>
							<a @click="applyPriceRange" class="ui pink circular icon button"><i class="right angle icon mx-0"></i></a>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>

		<div class="column right">

			<div class="ui results shadowless borderless menu">
				<div class="item header">
					<?php echo e(__(':total results found.', ['total' => $products->total()])); ?>

				</div>
				
				<?php if(array_intersect(array_keys(request()->query()), ['price_range', 'tags', 'sort'])): ?>
				<div class="right menu">
					<a href="<?php echo e(reset_filters()); ?>" class="item remove"><i class="close icon"></i><?php echo e(__('Filter')); ?></a>
				</div>
				<?php endif; ?>
			</div>

			<?php if(!request()->filter): ?>
			<div class="ui filter shadowless borderless menu">
				<a href="<?php echo e(filter_url('relevance_desc')); ?>" class="item <?php if(filter_is_selected('relevance_desc')): ?> selected <?php endif; ?>">
					<?php echo e(__('Best match')); ?>

				</a>
				
				<a href="<?php echo e(filter_url(filter_is_selected('rating_asc') ? 'rating_desc' : 'rating_asc')); ?>" class="item <?php echo e((filter_is_selected('rating_asc') || filter_is_selected('rating_desc')) ? 'selected' : ''); ?>"><?php echo e(__('Rating')); ?></a>

				<a href="<?php echo e(filter_url(filter_is_selected('price_asc') ? 'price_desc' : 'price_asc')); ?>" class="item <?php echo e((filter_is_selected('price_asc') || filter_is_selected('price_desc')) ? 'selected' : ''); ?>"><?php echo e(__('Price')); ?></a>

				<a href="<?php echo e(filter_url('trending_desc')); ?>" class="item <?php if(filter_is_selected('trending_desc')): ?> selected <?php endif; ?>">
					<?php echo e(__('Trending')); ?>

				</a>

				<a href="<?php echo e(filter_url(filter_is_selected('date_asc') ? 'date_desc' : 'date_asc')); ?>" class="item <?php echo e((filter_is_selected('date_asc') || filter_is_selected('date_desc')) ? 'selected' : ''); ?>"><?php echo e(__('Release date')); ?></a>

				<form class="ui right aligned search item search-form" method="get" action="<?php echo e(route('home.products.q')); ?>">
		      <div class="ui transparent icon input">
		        <input class="prompt" type="text" name="q" value="<?php echo e(request()->q); ?>" placeholder="<?php echo e(__('Search')); ?> ...">
		        <i class="search link icon"></i>
		      </div>
		    </form>

		    <a class="item icon left-column-toggler mobile-only ml-1"><i class="bars icon mx-0"></i></a>
			</div>
			<?php endif; ?>

			<div class="ui fluid divider"></div>

			<div class="ui three doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?>">
				@cards('item-card', $products, 'item', ['category' => 0, 'sales' => 1, 'rating' => 1, 'home' => 0])
			</div>
		
			<?php if($products->count()): ?>
			<div class="mt-2"></div>
			<?php echo e($products->appends(request()->query())->onEachSide(1)->links()); ?>

			<?php echo e($products->appends(request()->query())->links('vendor.pagination.simple-semantic-ui')); ?>

			<?php endif; ?>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\products.blade.php ENDPATH**/ ?>