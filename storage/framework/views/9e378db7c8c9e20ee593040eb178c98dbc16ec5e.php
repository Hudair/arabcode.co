



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
  <?php if(!$product->for_subscriptions): ?>
  "offers": {
    "@type": "AggregateOffer",
    "lowPrice": "<?php echo e(number_format($product_prices[$product->license_id]['price'] ?? 0, 2)); ?>",
    "highPrice": "<?php echo e(number_format($product_prices[$product->license_id]['price'] ?? 0, 2)); ?>",
    "priceCurrency": "<?php echo e(config('payments.currency_code')); ?>",
    "offerCount": "1"
  },
  <?php endif; ?>
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
		<?php if(!$product->for_subscriptions): ?>
		price: <?php echo e($product_prices[$product->license_id]['price'] ?? '0'); ?>,
		<?php endif; ?>
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


<div class="ui two columns shadowless celled grid my-0 <?php echo e($product->type); ?>" id="item" vhidden>	

	<div class="one column row" id="header">
		<div class="sixteen wide column mx-auto">
			<div class="ui unstackable items w-100">
			  <div class="item">
				  <div class="cover-wrapper type-<?php echo e($product->type); ?>">
				  	<?php if(out_of_stock($product)): ?>
				  	<div class="out-of-stock"><?php echo e(__('This item is out of stock.')); ?></div>
				  	<?php endif; ?>

				  	<?php if($product->preview): ?>

				  		<?php if(preg_match('/^video|graphic$/i', $product->type)): ?>

				  		<div class="video">
								<?php echo preview($product); ?>

							</div>

				  		<?php elseif($product->type == 'audio'): ?>

							<div class="audio-container" data-src="<?php echo e(preview_link($product)); ?>" data-id="<?php echo e($product->id); ?>">
								<div class="thumbnail">
									<img src="<?php echo e(asset_("storage/covers/{$product->cover}")); ?>">	
								</div>

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

							<div class="ui image">
								<img src="<?php echo e(asset_("storage/covers/{$product->cover}")); ?>">
					    </div>

				  		<?php endif; ?>

						<?php else: ?>

						<div class="ui image">
							<img src="<?php echo e(asset_("storage/covers/{$product->cover}")); ?>">
				    </div>

				    <?php endif; ?>
				  </div>

			    <div class="content">
			    	<div class="wrapper">
				      <div class="header"><?php echo e(ucfirst($product->name)); ?></div>

				      <?php if(!out_of_stock($product) && !$product->for_subscriptions): ?>
				      <div class="price" :class="{promotional: itemHasPromo}">
				      	<strong><?php echo e(__('Price')); ?></strong> : 

				      	<?php if($product->free): ?>
				    		<span class="reduced"><?php echo e(__('Free')); ?></span>
				    		<?php else: ?>
				    		<span class="reduced" v-if="itemHasPromo">{{ price(itemPrices[licenseId]['promo_price'], 1, 1) }}</span>
				    		<span class="normal" v-if="!itemIsFree()">{{ price(itemPrices[licenseId]['price'], 1, 1) }}</span>
				    		<span class="normal" v-else>{{ __('Free') }}</span>
				    		<?php endif; ?>

				      	<?php if($product->free && $product->free_time): ?>
						    <div class="card promo mt-0">
									<div class="promo-count" data-json="<?php echo e($product->free_time); ?>"><?php echo e(__('Ends in')); ?> <span></span></div>
								</div>
						    <?php else: ?>
						    <div class="card promo mt-0" v-if="itemHasPromo">
									<div class="promo-count" data-json="<?php echo e(collect($product_prices)->where('promotional_time', '!=', null)->first()['promotional_time'] ?? null); ?>"><?php echo e(__('Ends in')); ?> <span></span></div>
								</div>
								<?php endif; ?>
				      </div>
				      <?php endif; ?>

				      <div class="update">
				      	<strong><?php echo e(__('Last update')); ?></strong> : <?php echo e(format_date($product->updated_at, 'd M, Y')); ?>

				      </div>

				      <div class="rating">
				      	<strong><?php echo e(__('Rating')); ?></strong> : <span class="image rating floated right"><?php echo item_rating($product->rating); ?></span>
				      </div>

				      <div class="actions">
				      	<div class="ui spaced buttons">
				      		<?php if($product->file_name && ($valid_subscription || $product->purchased)): ?>

										<?php if(!$product->is_dir): ?>

										<button class="ui button download" @click="downloadItem(<?php echo e($product->id); ?>, '#download')"><?php echo e(__('Download')); ?> 
											<?php if($product->remaining_downloads): ?>
											<sup>(<?php echo e($product->remaining_downloads); ?>)</sup>
											<?php endif; ?>
										</button>

										<form action="<?php echo e(route('home.download')); ?>" class="d-none" id="download" method="post">
											<?php echo csrf_field(); ?>
											<input type="hidden" name="itemId" v-model="itemId">
										</form>

										<?php else: ?>

										<a class="ui open-dir button" target="_blank" href="<?php echo e(item_folder_sync($product)); ?>"><?php echo e(__('Open folder')); ?></a>

										<?php endif; ?>

									<?php endif; ?>
									
									<?php if(!$product->for_subscriptions): ?>
										<?php if(!out_of_stock($product)): ?>
										<?php if((!$product->free)): ?>
					      		<button class="ui purple button buy-now" v-if="!itemIsFree()" @click="buyNow(product, $event)"><?php echo e(__('Buy Now')); ?></button>
					      		<?php endif; ?>

								  	<button class="ui blue button add-to-cart" @click="addToCartAsync(product, $event)"><?php echo e(__('Add To Cart')); ?></button>
								  	<?php endif; ?>
							  	<?php endif; ?>

							  	<?php if($product->preview_url): ?>
									<a href="<?php echo e($product->preview_url); ?>" target="_blank" class="ui pink button preview"><?php echo e(__('Preview')); ?></a>
							  	<?php endif; ?>
				      	</div>
				      </div>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</div>

	<?php if(!$valid_subscription && $product->for_subscriptions): ?>
	<div class="ui fluid blue shadowless borderless message circular-corner bold mx-auto mt-0"><?php echo e(__('This item is available via subscriptions only')); ?></div>
	<?php endif; ?>

	<div class="row main">
		<div class="column mx-auto l-side">
			<div class="ui top unstackable secondary menu p-1">
			  <a class="active item ml-0" data-tab="details"><?php echo e(__('Details')); ?></a>
			  <?php if($product->hidden_content && ($valid_subscription || $product->purchased || $product->free)): ?>
			  <a class="item" data-tab="hidden-content"><?php echo e(__('Hidden content')); ?></a>
				<?php endif; ?>
				<?php if($product->table_of_contents): ?>
				<a class="item" data-tab="table_of_contents"><?php echo e(__('Table of contents')); ?></a>
				<?php endif; ?>
			  <a class="item" data-tab="support"><?php echo e(__('Comments')); ?></a>
			  <a class="item" data-tab="reviews"><?php echo e(__('Reviews')); ?></a>
			  <a class="item mr-0" data-tab="faq"><?php echo e(__('FAQ')); ?></a>
			  <?php if(isFolderProcess() && $product->file_name): ?>
			  <a class="item mr-0" data-tab="files" @click="getFolderContent"><?php echo e(__('Files')); ?></a>
			  <?php endif; ?>
			</div>

			<div class="row item">
				<!-- Details -->
				<div class="sixteen wide column details">
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

					<div class="ui hidden divider"></div>
					<?php endif; ?>
					
					<?php if($product->overview): ?>
					<div class="ui fluid card">
						<div class="content overview body">
							<?php echo $product->overview; ?>

						</div>
					</div>
					<?php endif; ?>						
				</div>
				
				<!-- Hidden Content -->
				<?php if($product->hidden_content && ($valid_subscription || $product->purchased || $product->free)): ?>
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

					<div class="ui fluid shadowless borderless green basic message circular-corner">
						<?php echo e(request()->session()->pull('comment_response')); ?>

					</div>

					<?php elseif(!$comments->count()): ?>

					<div class="ui fluid shadowless borderless message circular-corner">
						<?php echo e(__('No comments found')); ?>.
					</div>

					<?php endif; ?>

					<div class="ui divided unstackable items mt-1">
						<div class="mb-1">
							<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="comments-wrapper">
								<div class="item main-item parent">
									<div class="main">
										<div class="ui tiny circular image">
											<img src="<?php echo e(asset_("storage/avatars/".$comment->avatar)); ?>">
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
								<div class="item main-item children">
									<div class="main">
										<div class="ui tiny circular image">
											<img src="<?php echo e(asset_("storage/avatars/".$child->avatar)); ?>">
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

									<?php if(count($child->reactions ?? [])): ?>
									<div class="extra">
										<div class="saved-reactions" data-item_id="<?php echo e($child->id); ?>" data-item_type="comment">
											<?php $__currentLoopData = $child->reactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<span class="reaction" data-reaction="<?php echo e($name); ?>" data-tooltip="<?php echo e($count); ?>" data-inverted="" style="background-image: url('<?php echo e(asset_("assets/images/reactions/{$name}.png")); ?>')"></span>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</div>
									</div>
									<?php endif; ?>
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
								<div class="ui blue basic label mb-1-hf capitalize" v-if="replyTo.userName !== null">
									{{ replyTo.userName }}
									<i class="delete icon" @click="resetReplyTo"></i>
								</div>

								<textarea rows="5" name="comment" placeholder="<?php echo e(__('Your comment')); ?> ..."></textarea>

								<button type="submit" class="ui yellow circular button right floated mt-1-hf"><?php echo e(__('Submit')); ?></button>
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
					<div class="ui fluid shadowless borderless green basic message circular-corner">
						<?php echo e(request()->session()->pull('review_response', 'default')); ?>

					</div>
					<?php elseif(!$reviews->count()): ?>
					<div class="ui fluid shadowless borderless message circular-corner">
						<?php echo e(__('This item has not received any review yet')); ?>.
					</div>
					<?php endif; ?>

					<?php if($reviews->count()): ?>
					<div class="ui divided unstackable items">
						<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="item">
							<div class="ui tiny circular image">
								<img src="<?php echo e(asset_("storage/avatars/".$review->avatar)); ?>">
							</div>

							<div class="content description body">
								<h3>
									<?php echo e($review->name ?? $review->alias_name ?? $review->fullname); ?> 
									<span class="floated right"><?php echo e($review->created_at->diffForHumans()); ?></span>
								</h3>

								<h4 class="mt-1-hf">
									<span class="image rating"><?php echo item_rating($review->rating); ?></span>
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
	
							<div class="ui tiny circular image">
								<img src="<?php echo e(asset_("storage/avatars/" . (auth()->user()->avatar ?? 'default.jpg'))); ?>">
								<input type="hidden" name="type" value="reviews" class="none">
							</div>
								
							<div class="content pl-1">
								<span class="ui star rating active mb-1-hf" data-max-rating="5"></span>
								<input type="hidden" name="rating" class="d-none">
											
								<textarea rows="5" name="review" placeholder="Your review ..."></textarea>
	
								<button type="submit" class="ui yellow circular button right floated mt-1-hf uppercase"><?php echo e(__('Submit')); ?></button>
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
					<div class="ui fluid shadowless borderless message circular-corner">
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
			<?php if(!is_null($product->minimum_price) && !$product->for_subscriptions): ?>
    	<div class="ui big form mb-1">
    		<div class="field">
	    		<label class="ml-1-hf mb-1"><?php echo e(__('Custom price')); ?></label>
	    		<input class="circular-corner" type="number" step="0.0001" v-model="customItemPrice" placeholder="<?php echo e(__('Minimum :price', ['price' => price($product->minimum_price, false)])); ?>">
	    	</div>
    	</div>
	    <?php endif; ?>

	    <?php if(!$product->for_subscriptions): ?>
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
			<?php endif; ?>

			<div class="ui fluid card item-details <?php echo e(count($product_prices) === 1 ? 'mt-0' : ''); ?>">
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

						<?php $__currentLoopData = $product->additional_fields ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><strong><?php echo e(__($field->_name_)); ?></strong></td>
							<td><?php echo $field->_value_; ?></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						<tr>
							<td><strong><?php echo e(__('Comments')); ?></strong></td>
							<td><?php echo e($product->comments_count); ?></td>
						</tr>

						<?php if($product->rating): ?>
						<tr>
							<td><strong><?php echo e(__('Rating')); ?></strong></td>
							<td><div class="ui star rating disabled" data-rating="<?php echo e($product->rating); ?>" data-max-rating="5"></div></td>
						</tr>
						<?php endif; ?>

						<?php if($product->high_resolution): ?>
						<tr>
							<td><strong><?php echo e(__('High resolution')); ?></strong></td>
							<td><?php echo e($product->high_resolution ? 'Yes' : 'No'); ?></td>
						</tr>
						<?php endif; ?>

						<tr>
							<td><strong><?php echo e(__('Sales')); ?></strong></td>
							<td><?php echo e($product->sales); ?></td>
						</tr>
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
						<button class="ui circular basic icon button" onclick="window.open('<?php echo e(share_link('pinterest')); ?>', 'Pinterest', 'toolbar=0, status=0, width=\'auto\', height=\'auto\'')">
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
<div class="row w-100" id="similar-items">
	<div class="header">
		<div><?php echo e(__('Similar items')); ?></div>
	</div>

	<div class="ui five doubling cards <?php if(config('app.masonry_layout')): ?> is_masonry <?php endif; ?>">
		@cards('item-card', $similar_products, 'item', ['category' => 1, 'sales' => 0, 'rating' => 1, 'home' => 0])
	</div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\product.blade.php ENDPATH**/ ?>