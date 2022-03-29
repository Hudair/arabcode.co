<?php if($item->type_is('-')): ?>

<div class="ui card product <?php echo e($item->type); ?> type-- <?php echo e(out_of_stock($item, true)); ?> <?php echo e(has_promo_time($item, true)); ?> <?php echo e(has_promo_price($item, true)); ?>">
	
	<?php if(item_has_badge($item)): ?>
	<div class="ui left corner large label <?php echo e(item_has_badge($item)); ?>" title="<?php echo e(__(mb_ucfirst(item_has_badge($item)))); ?>"><i class="tag rotated icon"></i></div>
	<?php endif; ?>
	
	<?php if($item->has_preview('video')): ?>
	<div class="content cover preview">
		<?php echo preview($item); ?>

	</div>
	<?php else: ?>
	<a class="content cover" href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		<img src="<?php echo e(asset_("storage/covers/{$item->cover}")); ?>" alt="cover">
	</a>
	<?php endif; ?>
	
	<div class="content title <?php echo e($item->for_subscriptions ? 'padded' : ''); ?>">
		<div>
			<a href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		    <?php echo e($item->name); ?>

			</a>

			<?php if($category ?? null): ?>
			<span class="category">
	    <?php echo e(rand_subcategory($item->subcategories, $item->category_name)); ?>

    	</span>
    	<?php endif; ?>

    	<?php if(($rating ?? null)): ?>
    	<div class="image rating mt-1"><?php echo item_rating($item->rating); ?></div>
		<?php endif; ?>

		<?php if(!$item->for_subscriptions && ($sales ?? null)): ?>
		<div class="sales mt-1"><?php echo e(__(':count Sales', ['count' => $item->sales])); ?></div>
		<?php endif; ?>
		
		<?php if($item->promotional_time && $item->promotional_price && !$item->for_subscriptions): ?>
		<div data-json="<?php echo e($item->promotional_time); ?>" class="promo-count mt-1-hf"><?php echo e(__('Ends in')); ?> <span></span></div>
	    <?php endif; ?>
		</div>
	</div>

	<?php if(!$item->for_subscriptions): ?>
	<div class="content bottom p-1-hf">
		<?php if(!out_of_stock($item)): ?>
		<div class="price-wrapper <?php echo e($item->promotional_price ? 'has-promo' : ''); ?>">
			<div class="price mr-0 <?php echo e(!$item->price ? 'free' : ''); ?>">
				<?php echo e(price($item->price)); ?>

			</div>

			<?php if($item->promotional_price): ?>
			<div class="promo-price"><?php echo e(price($item->promotional_price)); ?></div>
			<?php endif; ?>
		</div>

		<div class="action" @click="addToCartAsync(<?php echo e(json_encode($item)); ?>, $event)">
			<img src="<?php echo e(asset_('assets/images/cart-1.png')); ?>" class="ui image">
		</div>

		<div class="action like" :class="{ active: itemInCollection(<?php echo e($item->id); ?>) }" @click="collectionToggleItem($event, <?php echo e($item->id); ?>)">
			<img src="<?php echo e(asset_('assets/images/heart-0.png')); ?>" class="ui heart outline image">
			<img src="<?php echo e(asset_('assets/images/heart-1.png')); ?>" class="ui heart image">
		</div>
		<?php else: ?>
		<div class="out-of-stock"><?php echo e(__('Out of stock')); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>

<?php elseif($item->type_is('audio')): ?>

<div class="ui card product <?php echo e($item->type); ?> type-audio <?php echo e(out_of_stock($item, true)); ?> <?php echo e(has_promo_time($item, true)); ?> <?php echo e(has_promo_price($item, true)); ?>">
	
	<?php if(item_has_badge($item)): ?>
	<div class="ui left corner large label <?php echo e(item_has_badge($item)); ?>" title="<?php echo e(__(mb_ucfirst(item_has_badge($item)))); ?>"><i class="tag rotated icon"></i></div>
	<?php endif; ?>
	
	<div class="content top">
		<a class="cover" href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
			<img src="<?php echo e(asset_("storage/covers/{$item->cover}")); ?>" alt="cover">
		</a>

		<?php if(item_has_info($item, ['bpm', 'label', 'authors'])): ?>
		<div class="info">
			<?php if($item->authors): ?>
			<span class="author"><?php echo e(trim(explode(',', $item->authors)[0])); ?></span>
			<?php endif; ?>

			<?php if($item->bpm): ?>
			<span><i class="circle outline icon"></i><?php echo e(__(':count BPM', ['count' => $item->bpm])); ?></span>
			<?php endif; ?>
			
			<?php if($item->bpm): ?>
			<span><i class="circle outline icon"></i><?php echo e(__('Bit rate :count', ['count' => $item->bit_rate])); ?></span>
			<?php endif; ?>

			<?php if($item->label): ?>
			<span><i class="circle outline icon"></i><?php echo e($item->label); ?></span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>

	<div class="content p-0 mb-1">
		<?php echo preview($item); ?>

	</div>
	
	<div class="content title <?php echo e($item->for_subscriptions ? 'padded' : ''); ?>">
		<div>
			<a href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		    <?php echo e($item->name); ?>

			</a>

			<?php if($category ?? null): ?>
			<span class="category">
	    <?php echo e(rand_subcategory($item->subcategories, $item->category_name)); ?>

    	</span>
    	<?php endif; ?>

    	<?php if(($rating ?? null)): ?>
    	<div class="image rating mt-1"><?php echo item_rating($item->rating); ?></div>
			<?php endif; ?>

			<?php if(!$item->for_subscriptions && ($sales ?? null)): ?>
			<div class="sales mt-1"><?php echo e(__(':count Sales', ['count' => $item->sales])); ?></div>
			<?php endif; ?>
		</div>
		
		<?php if($item->promotional_time && $item->promotional_price  && !$item->for_subscriptions): ?>
		<div data-json="<?php echo e($item->promotional_time); ?>" class="promo-count mt-1-hf"><?php echo e(__('Ends in')); ?> <span></span></div>
	    <?php endif; ?>
	</div>

	<?php if(!$item->for_subscriptions): ?>
	<div class="content bottom p-1-hf">
		<?php if(!out_of_stock($item)): ?>
		<div class="price-wrapper <?php echo e($item->promotional_price ? 'has-promo' : ''); ?>">
			<div class="price mr-0 <?php echo e(!$item->price ? 'free' : ''); ?>">
				<?php echo e(price($item->price)); ?>

			</div>

			<?php if($item->promotional_price): ?>
			<div class="promo-price"><?php echo e(price($item->promotional_price)); ?></div>
			<?php endif; ?>
		</div>

		<div class="action" @click="addToCartAsync(<?php echo e(json_encode($item)); ?>, $event)">
			<img src="<?php echo e(asset_('assets/images/cart-1.png')); ?>" class="ui image">
		</div>

		<div class="action like" :class="{ active: itemInCollection(<?php echo e($item->id); ?>) }" @click="collectionToggleItem($event, <?php echo e($item->id); ?>)">
			<img src="<?php echo e(asset_('assets/images/heart-0.png')); ?>" class="ui heart outline image">
			<img src="<?php echo e(asset_('assets/images/heart-1.png')); ?>" class="ui heart image">
		</div>
		<?php else: ?>
		<div class="out-of-stock"><?php echo e(__('Out of stock')); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>

<?php elseif($item->type_is('ebook')): ?>

<div class="ui card product <?php echo e($item->type); ?> type-ebook <?php echo e(out_of_stock($item, true)); ?> <?php echo e(has_promo_time($item, true)); ?> <?php echo e(has_promo_price($item, true)); ?>">
    
    <?php if(item_has_badge($item)): ?>
	<div class="ui left corner large label <?php echo e(item_has_badge($item)); ?>" title="<?php echo e(__(mb_ucfirst(item_has_badge($item)))); ?>"><i class="tag rotated icon"></i></div>
	<?php endif; ?>
	
	<div class="content top">
		<a class="cover" href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
			<img src="<?php echo e(asset_("storage/covers/{$item->cover}")); ?>" alt="cover">
		</a>

		<?php if(item_has_info($item, ['authors', 'pages', 'words', 'language'])): ?>
		<div class="info">
			<?php if($item->authors): ?>
			<span class="author"><?php echo e(trim(explode(',', $item->authors)[0])); ?></span>
			<?php endif; ?>

			<?php if($item->pages): ?>
			<span><i class="circle outline icon"></i><?php echo e(__(':count pages', ['count' => $item->pages])); ?></span>
			<?php endif; ?>

			<?php if($item->words): ?>
			<span><i class="circle outline icon"></i><?php echo e(__(':count words', ['count' => $item->words])); ?></span>
			<?php endif; ?>

			<?php if($item->language): ?>
			<span><i class="circle outline icon"></i><?php echo e(__(mb_ucfirst($item->language))); ?></span>
			<?php endif; ?>
		</div>
		<?php endif; ?>
	</div>

	<div class="content title <?php echo e($item->for_subscriptions ? 'padded' : ''); ?>">
		<div>
			<a href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		    <?php echo e($item->name); ?>

			</a>

			<?php if($category ?? null): ?>
			<span class="category">
	    <?php echo e(rand_subcategory($item->subcategories, $item->category_name)); ?>

    	</span>
    	<?php endif; ?>

    	<?php if(($rating ?? null)): ?>
    	<div class="image rating mt-1"><?php echo item_rating($item->rating); ?></div>
			<?php endif; ?>

			<?php if(!$item->for_subscriptions && ($sales ?? null)): ?>
			<div class="sales mt-1"><?php echo e(__(':count Sales', ['count' => $item->sales])); ?></div>
			<?php endif; ?>
		</div>
		
		<?php if($item->promotional_time && $item->promotional_price && !$item->for_subscriptions): ?>
		<div data-json="<?php echo e($item->promotional_time); ?>" class="promo-count mt-1-hf"><?php echo e(__('Ends in')); ?> <span></span></div>
	    <?php endif; ?>
	</div>

	<?php if(!$item->for_subscriptions): ?>
	<div class="content bottom p-1-hf">
		<?php if(!out_of_stock($item)): ?>
		<div class="price-wrapper <?php echo e($item->promotional_price ? 'has-promo' : ''); ?>">
			<div class="price mr-0 <?php echo e(!$item->price ? 'free' : ''); ?>">
				<?php echo e(price($item->price)); ?>

			</div>

			<?php if($item->promotional_price): ?>
			<div class="promo-price"><?php echo e(price($item->promotional_price)); ?></div>
			<?php endif; ?>
		</div>

		<div class="action" @click="addToCartAsync(<?php echo e(json_encode($item)); ?>, $event)">
			<img src="<?php echo e(asset_('assets/images/cart-1.png')); ?>" class="ui image">
		</div>

		<div class="action like" :class="{ active: itemInCollection(<?php echo e($item->id); ?>) }" @click="collectionToggleItem($event, <?php echo e($item->id); ?>)">
			<img src="<?php echo e(asset_('assets/images/heart-0.png')); ?>" class="ui heart outline image">
			<img src="<?php echo e(asset_('assets/images/heart-1.png')); ?>" class="ui heart image">
		</div>
		<?php else: ?>
		<div class="out-of-stock"><?php echo e(__('Out of stock')); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>

<?php elseif($item->type_is('graphic')): ?>

<div class="ui card product <?php echo e($item->type); ?> type-graphic <?php echo e(out_of_stock($item, true)); ?> <?php echo e(has_promo_time($item, true)); ?> <?php echo e(has_promo_price($item, true)); ?>">
	
	<?php if(item_has_badge($item)): ?>
	<div class="ui left corner large label <?php echo e(item_has_badge($item)); ?>" title="<?php echo e(__(mb_ucfirst(item_has_badge($item)))); ?>"><i class="tag rotated icon"></i></div>
	<?php endif; ?>
	
	<?php if($item->has_preview('video')): ?>
	<div class="content cover preview">
		<?php echo preview($item); ?>

	</div>
	<?php else: ?>
	<a class="content cover" href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		<img src="<?php echo e(asset_("storage/covers/{$item->cover}")); ?>" alt="cover">
	</a>
	<?php endif; ?>
	
	<div class="content title <?php echo e($item->for_subscriptions ? 'padded' : ''); ?>">
		<div>
			<a href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		    <?php echo e($item->name); ?>

			</a>

			<?php if($category ?? null): ?>
			<span class="category">
	    <?php echo e(rand_subcategory($item->subcategories, $item->category_name)); ?>

    	</span>
    	<?php endif; ?>

    	<?php if(($rating ?? null)): ?>
    	<div class="image rating mt-1"><?php echo item_rating($item->rating); ?></div>
			<?php endif; ?>

			<?php if(!$item->for_subscriptions && ($sales ?? null)): ?>
			<div class="sales mt-1"><?php echo e(__(':count Sales', ['count' => $item->sales])); ?></div>
			<?php endif; ?>
		</div>
		
		<?php if($item->promotional_time && $item->promotional_price && !$item->for_subscriptions): ?>
		<div data-json="<?php echo e($item->promotional_time); ?>" class="promo-count mt-1-hf"><?php echo e(__('Ends in')); ?> <span></span></div>
	    <?php endif; ?>
	</div>

	<?php if(!$item->for_subscriptions): ?>
	<div class="content bottom p-1-hf">
		<?php if(!out_of_stock($item)): ?>
		<div class="price-wrapper <?php echo e($item->promotional_price ? 'has-promo' : ''); ?>">
			<div class="price mr-0 <?php echo e(!$item->price ? 'free' : ''); ?>">
				<?php echo e(price($item->price)); ?>

			</div>

			<?php if($item->promotional_price): ?>
			<div class="promo-price"><?php echo e(price($item->promotional_price)); ?></div>
			<?php endif; ?>
		</div>

		<div class="action" @click="addToCartAsync(<?php echo e(json_encode($item)); ?>, $event)">
			<img src="<?php echo e(asset_('assets/images/cart-1.png')); ?>" class="ui image">
		</div>

		<div class="action like" :class="{ active: itemInCollection(<?php echo e($item->id); ?>) }" @click="collectionToggleItem($event, <?php echo e($item->id); ?>)">
			<img src="<?php echo e(asset_('assets/images/heart-0.png')); ?>" class="ui heart outline image">
			<img src="<?php echo e(asset_('assets/images/heart-1.png')); ?>" class="ui heart image">
		</div>
		<?php else: ?>
		<div class="out-of-stock"><?php echo e(__('Out of stock')); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>

<?php elseif($item->type_is('video')): ?>

<div class="ui card product <?php echo e($item->type); ?> type-video <?php echo e(out_of_stock($item, true)); ?> <?php echo e(has_promo_time($item, true)); ?> <?php echo e(has_promo_price($item, true)); ?>">
	
	<?php if(item_has_badge($item)): ?>
	<div class="ui left corner large label <?php echo e(item_has_badge($item)); ?>" title="<?php echo e(__(mb_ucfirst(item_has_badge($item)))); ?>"><i class="tag rotated icon"></i></div>
	<?php endif; ?>
	
	<?php if($item->has_preview('video')): ?>
	<div class="content cover preview">
		<?php echo preview($item); ?>

	</div>
	<?php else: ?>
	<a class="content cover" href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		<img src="<?php echo e(asset_("storage/covers/{$item->cover}")); ?>" alt="cover">
	</a>
	<?php endif; ?>
	
	<div class="content title <?php echo e($item->for_subscriptions ? 'padded' : ''); ?>">
		<div>
			<a href="<?php echo e(item_url($item)); ?>" title="<?php echo e($item->name); ?>">
		    <?php echo e($item->name); ?>

			</a>

			<?php if($category ?? null): ?>
			<span class="category">
	    <?php echo e(rand_subcategory($item->subcategories, $item->category_name)); ?>

    	</span>
    	<?php endif; ?>

    	<?php if(($rating ?? null)): ?>
    	<div class="image rating mt-1"><?php echo item_rating($item->rating); ?></div>
			<?php endif; ?>

			<?php if(!$item->for_subscriptions && ($sales ?? null)): ?>
			<div class="sales mt-1"><?php echo e(__(':count Sales', ['count' => $item->sales])); ?></div>
			<?php endif; ?>
		</div>
		
		<?php if($item->promotional_time && $item->promotional_price && !$item->for_subscriptions): ?>
		<div data-json="<?php echo e($item->promotional_time); ?>" class="promo-count mt-1-hf"><?php echo e(__('Ends in')); ?> <span></span></div>
	    <?php endif; ?>
	</div>

	<?php if(!$item->for_subscriptions): ?>
	<div class="content bottom p-1-hf">
		<?php if(!out_of_stock($item)): ?>
		<div class="price-wrapper <?php echo e($item->promotional_price ? 'has-promo' : ''); ?>">
			<div class="price mr-0 <?php echo e(!$item->price ? 'free' : ''); ?>">
				<?php echo e(price($item->price)); ?>

			</div>

			<?php if($item->promotional_price): ?>
			<div class="promo-price"><?php echo e(price($item->promotional_price)); ?></div>
			<?php endif; ?>
		</div>

		<div class="action" @click="addToCartAsync(<?php echo e(json_encode($item)); ?>, $event)">
			<img src="<?php echo e(asset_('assets/images/cart-1.png')); ?>" class="ui image">
		</div>

		<div class="action like" :class="{ active: itemInCollection(<?php echo e($item->id); ?>) }" @click="collectionToggleItem($event, <?php echo e($item->id); ?>)">
			<img src="<?php echo e(asset_('assets/images/heart-0.png')); ?>" class="ui heart outline image">
			<img src="<?php echo e(asset_('assets/images/heart-1.png')); ?>" class="ui heart image">
		</div>
		<?php else: ?>
		<div class="out-of-stock"><?php echo e(__('Out of stock')); ?></div>
		<?php endif; ?>
	</div>
	<?php endif; ?>
</div>

<?php endif; ?><?php /**PATH D:\laragon\www\valexa\resources\views\components\item-card.blade.php ENDPATH**/ ?>