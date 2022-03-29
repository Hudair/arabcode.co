



<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "Product",
	"url": "<?php echo e(url()->current()); ?>",
  "name": "<?php echo e($product->name); ?>",
  "image": "<?php echo e($meta_data->image); ?>",
  "description": "<?php echo $product->short_description; ?>",
  <?php if($product->reviews_count): ?>
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "<?php echo e($product->rating); ?>",
    "reviewCount": "<?php echo e($product->reviews_count); ?>",
    "bestRating": "5",
    "worstRating": "0"
  },
  "review": [
		<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		{
			"@type": "Review",
			"author": "<?php echo e($review->name ?? $review->alias_name); ?>",
			"datePublished" : "<?php echo e((new DateTime($review->created_at))->format('Y-m-d')); ?>",
			"description": "<?php echo e($review->content); ?>",
			"name": "-",
			"reviewRating": {
        "@type": "Rating",
        "bestRating": "5",
        "ratingValue": "<?php echo e($review->rating); ?>",
        "worstRating": "0"
      }
		}<?php if(next($reviews)): ?>,<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ],
  <?php endif; ?>
  "category": "<?php echo $product->category; ?>",
  "offers": {
    "@type": "AggregateOffer",
    "lowPrice": "<?php echo e(number_format($product_prices[$product->license_id]['price'] ?? 0, 2)); ?>",
    "highPrice": "<?php echo e(number_format($product_prices[$product->license_id]['price'] ?? 0, 2)); ?>",
    "priceCurrency": "<?php echo e(config('payments.currency_code')); ?>",
    "offerCount": "1"
  },
  "brand": "-",
  "sku": "-",
  "mpn": "<?php echo e($product->id); ?>"
}
</script>

<script>
	'use strict';

  window.props['product'] = {
  	screenshots: <?php echo json_encode($product->screenshots); ?>,
		id: <?php echo e($product->id); ?>,
		name: '<?php echo e($product->name); ?>',
		cover: '<?php echo e(asset("storage/covers/{$product->cover}")); ?>',
		quantity: 1,
		license_id: '<?php echo e($product->license_id); ?>',
		license_name: '<?php echo e($product->license_name); ?>',
		url: '<?php echo e(item_url($product)); ?>',
		price: <?php echo e($product_prices[$product->license_id]['price'] ?? '0'); ?>,
		slug: '<?php echo e($product->slug); ?>'
  }

  window.props['licenseId'] = <?php echo e($product->license_id); ?>;
  window.props['itemPrices'] = <?php echo json_encode($product_prices, 15, 512) ?>;

  window.props['products'] = <?php echo json_encode($similar_products->reduce(function ($carry, $item) 
																	{
																	  $carry[$item->id] = $item;
																	  return $carry;
																	}, [])) ?>;
</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	
<?php echo place_ad('ad_728x90'); ?>


<div class="ui two columns shadowless celled grid my-0 px-1 type-<?php echo e($product->type); ?>" id="item" vhidden>	

	<div class="row">
		<div class="column mx-auto l-side">
			<div class="row menu">
				<div class="ui top secondary menu p-1">
				  <a class="active item ml-0" data-tab="details"><?php echo e(__('Details')); ?></a>
				  <?php if($product->hidden_content && ($valid_subscription || $product->purchased || $product->free)): ?>
				  <a class="item" data-tab="hidden-content"><?php echo e(__('Hidden content')); ?></a>
				  <?php endif; ?>

				  <?php if($product->table_of_contents): ?>
				  <a class="item mr-0" data-tab="table_of_contents"><?php echo e(__('Table of contents')); ?></a>
				  <?php endif; ?>

				  <a class="item" data-tab="support"><?php echo e(__('Support')); ?></a>
				  <a class="item" data-tab="reviews"><?php echo e(__('Reviews')); ?></a>
				  <a class="item mr-0" data-tab="faq"><?php echo e(__('FAQ')); ?></a>
				  <?php if(isFolderProcess() && $product->file_name): ?>
				  <a class="item mr-0" data-tab="files" @click="getFolderContent"><?php echo e(__('Files')); ?></a>
				  <?php endif; ?>
				</div>
			</div>

			<div class="row item">
				<div class="sixteen wide column details">
					<div class="row center aligned cover">
						<?php if($product->type_is('ebook')): ?>
						<div class="cover-wrapper ebook">
							<div class="left">
								<div class="ui image">
									<img src="<?php echo e(asset_("storage/covers/{$product->cover}")); ?>">
								</div>

								<?php if(!out_of_stock($product) && !$product->for_subscriptions): ?>
									<div class="price-holder" :class="{reduced: itemHasPromo}">
										<?php if($product->free): ?>
						    		<div class="price free"><?php echo e(__('Free')); ?></div>
						    		<?php else: ?>
						    		<div class="price promo" v-if="itemHasPromo">{{ price(itemPrices[licenseId]['promo_price']) }}</div>
						    		<div class="price" v-if="!itemIsFree()">{{ price(itemPrices[licenseId]['price']) }}</div>
						    		<div class="price free" v-else>{{ __('Free') }}</div>
						    		<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>

							<div class="right">
								<div class="title">
									<?php echo $product->name; ?>

								</div>
								
								<?php if($product->authors): ?>
								<div class="authors">
									<span><?php echo e(__('Authors')); ?></span>
									<span><?php echo $product->authors; ?></span>
								</div>
								<?php endif; ?>

								<?php if($product->language): ?>
								<div class="language">
									<span><?php echo e(__('Language')); ?></span>
									<span><?php echo $product->language; ?></span>
								</div>
								<?php endif; ?>

								<?php if($product->words): ?>
								<div class="words">
									<span><?php echo e(__('Words')); ?></span>
									<span><?php echo $product->words; ?></span>
								</div>
								<?php endif; ?>

								<?php if($product->pages): ?>
								<div class="pages">
									<span><?php echo e(__('pages')); ?></span>
									<span><?php echo $product->pages; ?></span>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<?php elseif($product->type_is('audio')): ?>

						<div class="cover-wrapper audio">
							<div class="left">
								<div class="ui image" style="background-image: url(<?php echo e(asset_("storage/covers/{$product->cover}")); ?>)"></div>
								<?php if(!out_of_stock($product) && !$product->for_subscriptions): ?>
									<div class="price-holder" :class="{reduced: itemHasPromo}">
										<?php if($product->free): ?>
						    		<div class="price free"><?php echo e(__('Free')); ?></div>
						    		<?php else: ?>
						    		<div class="price promo" v-if="itemHasPromo">{{ price(itemPrices[licenseId]['promo_price']) }}</div>
						    		<div class="price" v-if="!itemIsFree()">{{ price(itemPrices[licenseId]['price']) }}</div>
						    		<div class="price free" v-else>{{ __('Free') }}</div>
						    		<?php endif; ?>
								</div>
								<?php endif; ?>
							</div>
							<div class="right">
								<div class="title">
									<?php echo $product->name; ?>

								</div>
								
								<?php if($product->authors): ?>
								<div class="authors">
									<span><?php echo e(__('Authors')); ?></span>
									<span><?php echo $product->authors; ?></span>
								</div>
								<?php endif; ?>

								<?php if($product->label): ?>
								<div class="label">
									<span><?php echo e(__('Label')); ?></span>
									<span><?php echo $product->label; ?></span>
								</div>
								<?php endif; ?>

								<?php if($product->bpm): ?>
								<div class="bpm">
									<span><?php echo e(__('BPM')); ?></span>
									<span><?php echo $product->bpm; ?></span>
								</div>
								<?php endif; ?>

								<?php if($product->bit_rate): ?>
								<div class="bit_rate">
									<span><?php echo e(__('Bit rate')); ?></span>
									<span><?php echo $product->bit_rate; ?></span>
								</div>
								<?php endif; ?>
							</div>
						</div>

						<div class="audio-container" data-src="<?php echo e(preview_link($product)); ?>" data-id="<?php echo e($product->id); ?>">
							<div class="player">
								<div class="timeline"><div class="wave"></div></div>

								<div class="actions">
									<button class="ui link circular basic white play button visible">
										<?php echo e(__('Play')); ?>

									</button>
									<button class="ui link circular basic white pause button">
										<?php echo e(__('Pause')); ?>

									</button>
									<button class="ui link circular basic white stop button">
										<?php echo e(__('Stop')); ?>

									</button>
								</div>

								<div class="duration">00:00</div>
							</div>
						</div>

						<?php else: ?>
						<div class="cover-wrapper">
							<?php if(!out_of_stock($product) && !$product->for_subscriptions): ?>
								<div class="price-holder" :class="{reduced: itemHasPromo}">
									<?php if($product->free): ?>
					    		<div class="price free"><?php echo e(__('Free')); ?></div>
					    		<?php else: ?>
					    		<div class="price promo" v-if="itemHasPromo">{{ price(itemPrices[licenseId]['promo_price']) }}</div>
					    		<div class="price" v-if="!itemIsFree()">{{ price(itemPrices[licenseId]['price']) }}</div>
					    		<div class="price free" v-else>{{ __('Free') }}</div>
					    		<?php endif; ?>
								</div>
							<?php endif; ?>

							<?php if($product->has_preview('video')): ?>
					  		<div class="video">
								<?php echo preview($product); ?>

							</div>
							<?php else: ?>
							<div class="ui image">
								<img src="<?php echo e(asset_("storage/covers/{$product->cover}")); ?>">
    					    </div>
    					    <?php endif; ?>

					    <h1><?php echo $product->name; ?></h1>
						</div>
						<?php endif; ?>

						<?php if(out_of_stock($product)): ?>
						<div class="ui fluid red shadowless borderless message d-table mx-auto circular-corner bold"><?php echo e(__('This item is out of stock.')); ?></div>
						<?php endif; ?>

						<?php if($product->for_subscriptions): ?>
						<div class="ui fluid blue shadowless borderless message circular-corner d-table mx-auto bold"><?php echo e(__('This item is available via subscriptions only.')); ?></div>
						<?php endif; ?>

						<?php if(!is_null($product->minimum_price) && config('pay_what_you_want.enabled') && config('pay_what_you_want.for.products')): ?>
				    <div class="content minimum-item-price ui large form mb-1 mx-auto w-50">
				    	<div class="field">
				    		<input class="rounded-corner" type="number" step="0.0001" v-model="customItemPrice" placeholder="<?php echo e(__('Custom price (minimum :price)', ['price' => price($product->minimum_price, false)])); ?>">
				    	</div>
				    </div>
				    <?php endif; ?>
				    
						<div class="actions">
							<?php if($product->file_name && ($valid_subscription || $product->purchased)): ?>
								<?php if(!$product->is_dir): ?>
								<button class="ui button rounded large download" @click="downloadItem(<?php echo e($product->id); ?>, '#download')"><?php echo e(__('Download')); ?> 
									<?php if($product->remaining_downloads): ?>
									<sup>(<?php echo e($product->remaining_downloads); ?>)</sup>
									<?php endif; ?>
								</button>
								<form action="<?php echo e(route('home.download')); ?>" class="d-none" id="download" method="post">
									<?php echo csrf_field(); ?>
									<input type="hidden" name="itemId" v-model="itemId">
								</form>
								<?php else: ?>
								<a class="ui open-dir large fluid rounded button" target="_blank" href="<?php echo e(route('home.product_folder_sync', $product->slug)); ?>"><?php echo e(__('Open folder')); ?></a>
								<?php endif; ?>
								<div class="ui hidden divider"></div>
							<?php endif; ?>

							<?php if(!$product->for_subscriptions && !out_of_stock($product)): ?>
								<div>
									<?php if(!$product->free): ?>
							  	<button class="ui purple large rounded button" v-if="!itemIsFree()" @click="buyNow(product, $event)"><?php echo e(__('Buy Now')); ?></button>
							  	<?php endif; ?>

							  	<button class="ui blue large rounded button" @click="addToCartAsync(product, $event)"><?php echo e(__('Add To Cart')); ?></button>

							  	<?php if($product->preview_url): ?>
									<a class="ui pink large rounded button" target="_blank" href="<?php echo e($product->preview_url); ?>"><?php echo e(__('Preview')); ?></a>
									<?php endif; ?>
								</div>

								<div class="ui fluid large floating circular button dropdown selection licenses <?php echo e(count($product_prices) <= 1 ? 'd-none disabled' : ''); ?>">
									<input type="hidden" name="license_id" @change="setPrice">
									<?php if(count($product_prices) > 1): ?>
									<i class="dropdown icon"></i>
									<?php endif; ?>
									<div class="text"><?php echo e(__(mb_ucfirst($product->license_name))); ?></div>
									<div class="menu">
										<?php $__currentLoopData = $product_prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product_price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<div class="item" data-value="<?php echo e($product_price['license_id']); ?>"><?php echo e($product_price['license_name']); ?></div>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
								</div>

								<?php if($product->free && $product->free_time && !out_of_stock($product)): ?>
						    <div class="card promo mt-0">
									<div class="promo-count" data-json="<?php echo e($product->free_time); ?>"><?php echo e(__('Ends in')); ?> <span></span></div>
								</div>
						    <?php else: ?>
						    <div class="card promo mt-0" v-if="itemHasPromo">
									<div class="promo-count" data-json="<?php echo e(collect($product_prices)->where('promotional_time', '!=', null)->first()['promotional_time'] ?? null); ?>"><?php echo e(__('Ends in')); ?> <span></span></div>
								</div>
								<?php endif; ?>
					  	<?php endif; ?>
					  </div>
					</div>

					<div class="ui hidden divider"></div>
					
					<?php if($product->screenshots): ?>
					<div class="ui fluid card">
						<div class="content images body">
							<div class="ui items">
								<?php $__currentLoopData = $product->screenshots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screenshot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<a class="item screenshot" data-src="<?php echo e($screenshot); ?>" style="background-image: url('<?php echo e($screenshot); ?>')"></a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if($product->overview): ?>
					<div class="ui fluid card">
						<div class="content overview body">
							<?php echo $product->overview; ?>

						</div>
					</div>
					<?php endif; ?>
				</div>

				<?php if($product->hidden_content && ($valid_subscription || $product->purchased || $product->free)): ?>
				<!-- Hidden content -->
				<div class="sixteen wide column hidden-content">
					<?php echo $product->hidden_content; ?>

				</div>
				<?php endif; ?>
				
				
				<?php if($product->table_of_contents): ?>
				<div class="sixteen wide column table_of_contents">
					<div class="ui segments shadowless">
						<?php $__currentLoopData = $product->table_of_contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if($title->text_type === 'header'): ?>
								<div class="ui secondary segment">
							    <p><?php echo e($title->text); ?></p>
							  </div>
							<?php else: ?>
								<div class="ui segment">
									<p>
										<?php if($title->text_type === 'subheader'): ?>
										<i class="right blue angle icon"></i>
										<?php else: ?>
										<span class="ml-2"></span>
										<?php endif; ?>

										<?php echo e($title->text); ?>

									</p>
							  </div>
							<?php endif; ?>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<?php endif; ?>

				<!-- Support -->
				<div class="sixteen wide column support">

					<?php if(session('comment_response')): ?>

					<div class="ui fluid shadowless borderless green message circular-corner">
						<?php echo e(request()->session()->pull('comment_response')); ?>

					</div>

					<?php elseif(!$comments->count()): ?>

					<div class="ui fluid shadowless large rounded-corner message">
						<?php echo e(__('No comments found')); ?>.
					</div>

					<?php endif; ?>

					<div class="ui divided unstackable items mt-1">
						<div class="mb-1">
							<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="comments-wrapper">
								<div class="item parent main-item">
									<div class="main">
										<div class="ui tiny circular image">
											<img src="<?php echo e(asset_("storage/avatars/{$comment->avatar}")); ?>">
										</div>

										<div class="content description body">
											<h3>
												<?php echo e($comment->name ?? $comment->alias_name ?? $comment->fullname); ?> 
												<span class="floated right"><?php echo e($comment->created_at->diffForHumans()); ?></span>
											</h3>

											<?php echo nl2br($comment->body); ?>

											
											<div class="ui hidden divider mt-0"></div>

											<div class="ui form">
												<?php if(auth()->guard()->check()): ?>
												<div class="ui icon bottom right white pointing dropdown button like">
													<img src="<?php echo e(asset_('assets/images/like.png')); ?>" class="ui image m-0">
												  <div class="menu">
												    <div class="item reactions" data-item_id="<?php echo e($comment->id); ?>" data-item_type="comment">
												    	<a class="action" data-reaction="like" style="background-image: url('<?php echo e(asset_('assets/images/reactions/like.gif')); ?>')"></a>
												    	<a class="action" data-reaction="love" style="background-image: url('<?php echo e(asset_('assets/images/reactions/love.gif')); ?>')"></a>
												    	<a class="action" data-reaction="funny" style="background-image: url('<?php echo e(asset_('assets/images/reactions/funny.gif')); ?>')"></a>
												    	<a class="action" data-reaction="wow" style="background-image: url('<?php echo e(asset_('assets/images/reactions/wow.gif')); ?>')"></a>
												    	<a class="action" data-reaction="sad" style="background-image: url('<?php echo e(asset_('assets/images/reactions/sad.gif')); ?>')"></a>
												    	<a class="action" data-reaction="angry" style="background-image: url('<?php echo e(asset_('assets/images/reactions/angry.gif')); ?>')"></a>
												    </div>
												  </div>
												</div>

												<?php endif; ?>

												<button class="ui blue circular button mr-0 uppercase circular"
																@click="setReplyTo('<?php echo e($comment->name ?? $comment->alias_name ?? $comment->fullname); ?>', <?php echo e($comment->id); ?>)">
													<?php echo e(__('Reply')); ?>

												</button>
											</div>
										</div>
									</div>
									<div class="extra">
										<?php if(count($comment->reactions ?? [])): ?>
										<div class="saved-reactions" data-item_id="<?php echo e($comment->id); ?>" data-item_type="comment">
											<?php $__currentLoopData = $comment->reactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<span class="reaction" data-reaction="<?php echo e($name); ?>" data-tooltip="<?php echo e($count); ?>" data-inverted="" style="background-image: url('<?php echo e(asset_("assets/images/reactions/{$name}.png")); ?>')"></span>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
										<?php endif; ?>

										<div class="count">
											<span><?php echo e(__(':count Comments', ['count' => $comment->children->count()])); ?></span>
										</div>
									</div>
								</div>

								<?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="item children main-item">
									<div class="main">
										<div class="ui tiny circular image">
											<img src="<?php echo e(asset_("storage/avatars/{$child->avatar}")); ?>">
										</div>

										<div class="content description body">
											<h3>
												<?php echo e($child->name ?? $child->alias_name ?? $child->fullname); ?> 
												<span class="floated right"><?php echo e($child->created_at->diffForHumans()); ?></span>
											</h3>

											<?php echo nl2br($child->body); ?>


											<div class="ui hidden divider mt-0"></div>

											<div class="ui form">
												<?php if(auth()->guard()->check()): ?>
												<div class="ui icon bottom right white pointing dropdown button like">
													<img src="<?php echo e(asset_('assets/images/like.png')); ?>" class="ui image m-0">
												  <div class="menu">
												    <div class="item reactions" data-item_id="<?php echo e($child->id); ?>" data-item_type="comment">
												    	<a class="action" data-reaction="like" style="background-image: url('<?php echo e(asset_('assets/images/reactions/like.gif')); ?>')"></a>
												    	<a class="action" data-reaction="love" style="background-image: url('<?php echo e(asset_('assets/images/reactions/love.gif')); ?>')"></a>
												    	<a class="action" data-reaction="funny" style="background-image: url('<?php echo e(asset_('assets/images/reactions/funny.gif')); ?>')"></a>
												    	<a class="action" data-reaction="wow" style="background-image: url('<?php echo e(asset_('assets/images/reactions/wow.gif')); ?>')"></a>
												    	<a class="action" data-reaction="sad" style="background-image: url('<?php echo e(asset_('assets/images/reactions/sad.gif')); ?>')"></a>
												    	<a class="action" data-reaction="angry" style="background-image: url('<?php echo e(asset_('assets/images/reactions/angry.gif')); ?>')"></a>
												    </div>
												  </div>
												</div>

												<?php endif; ?>

												<button class="ui blue circular button mr-0 uppercase circular"
																@click="setReplyTo('<?php echo e($child->name ?? $child->alias_name ?? $child->fullname); ?>', <?php echo e($comment->id); ?>)">
													<?php echo e(__('Reply')); ?>

												</button>
											</div>
										</div>
									</div>
									<div class="extra">
										<?php if(count($child->reactions ?? [])): ?>
										<div class="saved-reactions" data-item_id="<?php echo e($child->id); ?>" data-item_type="comment">
											<?php $__currentLoopData = $child->reactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<span class="reaction" data-reaction="<?php echo e($name); ?>" data-tooltip="<?php echo e($count); ?>" data-inverted="" style="background-image: url('<?php echo e(asset_("assets/images/reactions/{$name}.png")); ?>')"></span>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
										<?php endif; ?>
									</div>
								</div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
						
						<?php if(auth()->guard()->check()): ?>

						<form class="item ui form" method="post" action="<?php echo e(item_url($product)); ?>">
							<?php echo csrf_field(); ?>

							<div class="ui tiny rounded image">
					    	<img src="<?php echo e(asset_("storage/avatars/" . (auth()->user()->avatar ?? 'default.jpg'))); ?>">
					    	<input type="hidden" name="type" value="support" class="none">
							  <input type="hidden" name="comment_id" :value="replyTo.commentId" class="d-none">
					    </div>
					    	
					    <div class="content pl-1">
								<div class="ui tiny blue basic label rounded-corner mb-1-hf capitalize" v-if="replyTo.userName !== null">
									{{ replyTo.userName }}
									<i class="delete icon" @click="resetReplyTo"></i>
								</div>

								<textarea rows="5" name="comment" placeholder="<?php echo e(__('Your comment')); ?> ..."></textarea>

								<button type="submit" class="ui tiny yellow circular button right floated mt-1-hf"><?php echo e(__('Submit')); ?></button>
							</div>

						</form>

						<?php else: ?>

						<div class="ui fluid blue shadowless borderless message circular-corner">
							<?php echo __(':sign_in to post a comment', ['sign_in' => '<a href="'.route('login', ['redirect' => url()->current()]).'">'.__("Login").'</a>']); ?>

						</div>

						<?php endif; ?>
					</div>

				</div>

				<!-- Reviews -->
				<div class="sixteen wide column reviews">
					<?php if(session('review_response')): ?>
					<div class="ui fluid shadowless borderless green message circular-corner">
						<?php echo e(request()->session()->pull('review_response', 'default')); ?>

					</div>
					<?php elseif(!$reviews->count()): ?>
					<div class="ui fluid shadowless large rounded-corner message">
						<?php echo e(__('This item has not received any review yet')); ?>.
					</div>
					<?php endif; ?>

					<?php if($reviews->count()): ?>
					<div class="ui divided unstackable items">
						<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="ui tiny circular image">
								<img src="<?php echo e(asset_("storage/avatars/{$review->avatar}")); ?>">
							</div>

							<div class="content description body">
								<h3>
									<?php echo e($review->name ?? $review->alias_name ?? $review->fullname); ?> 
									<span class="floated right"><?php echo e($review->created_at->diffForHumans()); ?></span>
								</h3>

								<h4 class="mt-1-hf">
									<span class="ui star rating disabled ml-0 floated right" data-rating="<?php echo e($review->rating); ?>" data-max-rating="5"></span>
								</h4>

								<?php echo e(nl2br($review->content)); ?>

							</div>
						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php endif; ?>

					<?php if(auth()->guard()->check()): ?>
					<!-- IF PURCHASED AND NOT REVIEWED YET -->
					<?php if(!$product->reviewed && $product->purchased): ?>
					
					<div class="ui items borderless">
						<form class="item ui form" method="post" action="<?php echo e(item_url($product)); ?>">
							<?php echo csrf_field(); ?>
	
							<div class="ui tiny rounded image">
								<img src="<?php echo e(asset_("storage/avatars/" . (auth()->user()->avatar ?? 'default.jpg'))); ?>">
								<input type="hidden" name="type" value="reviews" class="none">
							</div>
								
							<div class="content pl-1">
								<span class="ui star rating active mb-1-hf" data-max-rating="5"></span>
								<input type="hidden" name="rating" class="d-none">
											
								<textarea rows="5" name="review" placeholder="Your review ..."></textarea>
	
								<button type="submit" class="ui tiny yellow circular button right floated mt-1-hf uppercase"><?php echo e(__('Submit')); ?></button>
							</div>
						</form>
					</div>
					
					<?php endif; ?>
					<?php else: ?>
				
					<div class="ui fluid blue shadowless borderless message circular-corner">
						<?php echo __(':sign_in to review this item', ['sign_in' => '<a href="'.route('login', ['redirect' => url()->current()]).'">'.__("Login").'</a>']); ?>

					</div>

					<?php endif; ?>
				</div>
					
				<!-- FAQ -->
				<div class="sixteen wide column faq">
					<?php if($product->faq): ?>
					<div class="ui divided list">
						<?php $__currentLoopData = $product->faq; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item p-1">
							<div class="header mb-1"><?php echo e(__('Q')); ?>. <?php echo e($qa->question); ?></div>
							<strong><?php echo e(__('A')); ?>.</strong> <?php echo e($qa->answer); ?>

						</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
					<?php else: ?>
					<div class="ui fluid shadowless borderless message large rounded-corner">
						<?php echo e(__('No Questions / Answers added yet.')); ?>

					</div>
					<?php endif; ?>
				</div>

				<?php if(isFolderProcess() && $product->file_name): ?>

				<!-- FILES -->
				<div class="sixteen wide column files">
					<div id="files-list" v-if="folderContent !== null">
						<div class="item" v-for="file in folderContent">
							{{ file.name }}
						</div>
					</div>
				</div>

				<?php endif; ?>
			</div>
		</div>
	
		<div class="column mx-auto r-side">
			<div class="ui fluid card item-details">
				<div class="content title">
					<div class="ui header"><?php echo e(__('Item details')); ?></div>
				</div>
				<div class="content borderless">
					<table class="ui unstackable large table basic">
						<?php if($product->version): ?>
						<tr>
							<td><strong><?php echo e(__('Version')); ?></strong></td>
							<td><?php echo e($product->version); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->category): ?>
						<tr>
							<td><strong><?php echo e(__('Category')); ?></strong></td>
							<td><?php echo e($product->category); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->release_date): ?>
						<tr>
							<td><strong><?php echo e(__('Release date')); ?></strong></td>
							<td><?php echo e($product->release_date); ?></td>
						</tr>
						<?php endif; ?>
						
						<?php if($product->last_update): ?>
						<tr>
							<td><strong><?php echo e(__('Latest update')); ?></strong></td>
							<td><?php echo e($product->last_update); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->included_files): ?>
						<tr>
							<td><strong><?php echo e(__('Included files')); ?></strong></td>
							<td><?php echo e($product->included_files); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->compatible_browsers): ?>
						<tr>
							<td><strong><?php echo e(__('Compatible browsers')); ?></strong></td>
							<td><?php echo e($product->compatible_browsers); ?></td>
						</tr>
						<?php endif; ?>

						<tr>
							<td><strong><?php echo e(__('Comments')); ?></strong></td>
							<td><?php echo e($product->comments_count); ?></td>
						</tr>

						<?php if($product->rating): ?>
						<tr>
							<td><strong><?php echo e(__('Rating')); ?></strong></td>
							<td><div class="image rating floated right"><?php echo item_rating($product->rating); ?></div></td>
						</tr>
						<?php endif; ?>

						<tr>
							<td><strong><?php echo e(__('Sales')); ?></strong></td>
							<td><?php echo e($product->sales); ?></td>
						</tr>

						<?php if($product->software): ?>
						<tr>
							<td><strong><?php echo e(__('Software')); ?></strong></td>
							<td><?php echo e($product->software); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->country ?? null): ?>
						<tr>
							<td><strong><?php echo e(__('Country')); ?></strong></td>
							<td><?php echo e($product->country); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->city ?? null): ?>
						<tr>
							<td><strong><?php echo e(__('City')); ?></strong></td>
							<td><?php echo e($product->city); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->authors): ?>
						<tr>
							<td><strong><?php echo e(__('Authors')); ?></strong></td>
							<td><?php echo $product->authors; ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->bpm): ?>
						<tr>
							<td><strong><?php echo e(__('BPM')); ?></strong></td>
							<td><?php echo e($product->bpm); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->bit_rate): ?>
						<tr>
							<td><strong><?php echo e(__('Bit rate')); ?></strong></td>
							<td><?php echo e($product->bit_rate); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->label): ?>
						<tr>
							<td><strong><?php echo e(__('Label')); ?></strong></td>
							<td><?php echo e($product->label); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->formats): ?>
						<tr>
							<td><strong><?php echo e(__('Formats')); ?></strong></td>
							<td><?php echo e($product->formats); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->words): ?>
						<tr>
							<td><strong><?php echo e(__('Words')); ?></strong></td>
							<td><?php echo e($product->words); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->language): ?>
						<tr>
							<td><strong><?php echo e(__('Language')); ?></strong></td>
							<td><?php echo e($product->language); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->pages): ?>
						<tr>
							<td><strong><?php echo e(__('Pages')); ?></strong></td>
							<td><?php echo e($product->pages); ?></td>
						</tr>
						<?php endif; ?>

						<?php if($product->database): ?>
						<tr>
							<td><strong><?php echo e(__('Database')); ?></strong></td>
							<td><?php echo e($product->database); ?></td>
						</tr>
						<?php endif; ?>

						<?php if(!is_null($product->high_resolution)): ?>
						<tr>
							<td><strong><?php echo e(__('High resolution')); ?></strong></td>
							<td><?php echo e($product->high_resolution ? __('Yes') : __('No')); ?></td>
						</tr>
						<?php endif; ?>

						<?php $__currentLoopData = $product->additional_fields ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional_field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><strong><?php echo e(__($additional_field->_name_)); ?></strong></td>
							<td><?php echo $additional_field->_value_; ?></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</table>
				</div>
			</div>

			<?php if($product->tags): ?>
			<div class="ui fluid card tags">
				<div class="content">
					<div class="ui header"><?php echo e(__('Item tags')); ?></div>
				</div>
				<div class="content borderless">
					<div class="ui labels">
						<?php $__currentLoopData = $product->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<a href="<?php echo e(route('home.products.q', ['tags' => $tag])); ?>" class="ui circular large basic label"><?php echo e($tag); ?></a>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="ui hidden divider"></div>

			<div class="ui fluid card share-on">
				<div class="content borderless">
					<div class="ui large buttons">
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('pinterest', $product)); ?>', 'Pinterest', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						  <i class="pinterest icon"></i>
						</button>	
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('twitter')); ?>', 'Twitter', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						  <i class="twitter icon"></i>
						</button>	
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('facebook')); ?>', 'Facebook', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						  <i class="facebook icon"></i>
						</button>
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('tumblr')); ?>', 'tumblr', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						  <i class="tumblr icon"></i>
						</button>
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('vk')); ?>', 'VK', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						  <i class="vk icon"></i>
						</button>
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('linkedin')); ?>', 'Linkedin', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
						  <i class="linkedin icon"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="ui modal" id="screenshots" >
	  <div class="image content p-0" v-if="activeScreenshot">
			<div class="left">
				<button class="ui icon button" type="button" @click="slideScreenhots('prev')">
				  <i class="angle big left icon m-0"></i>
				</button>
			</div>

	    <img class="image" :src="activeScreenshot">

	    <div class="right">
		    <button class="ui icon button" type="button" @click="slideScreenhots('next')">
				  <i class="angle big right icon m-0"></i>
				</button>
	    </div>
	  </div>
	</div>

	<div class="ui modal" id="reactions">
		<div class="header">
			<div class="wrapper">
				<a v-for="reaction, name in usersReactions" :class="['name ' + name, usersReaction === name ? 'active' : '']" :data-reaction="name">
					<span class="label">{{ name }}</span>
					<span class="count">{{ reaction.length }}</span>
				</a>
			</div>
		</div>
		<div class="content">
			<div class="wrapper">
				<div v-for="reaction, name in usersReactions" :class="['users ' + name, usersReaction === name ? 'active' : '']">
					<div class="user" v-for="user in reaction" :title="user.user_name">
						<span class="avatar"><img :src="'/storage/avatars/' + user.user_avatar" class="ui avatar image"></span>
						<span class="text">{{ user.user_name }}</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php if($similar_products->count()): ?>
<div class="row" id="similar-items">
	<div class="border top"></div>

	<div class="header">
		<div><?php echo e(__('Similar items')); ?></div>
	</div>

	<div class="ui five doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?>">
		@cards('item-card', $similar_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1])
	</div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\product.blade.php ENDPATH**/ ?>