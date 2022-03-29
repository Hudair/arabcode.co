



<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/javascript" src="<?php echo e(asset_("assets/FileSaver.2.0.4.min.js")); ?>"></script>

<script type="application/javascript">
	'use strict';
	window.props['itemId'] = null;
	window.props['keycodes'] = <?php echo json_encode($keycodes ?? [], 15, 512) ?>;
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<div class="ui shadowless celled one column grid my-0" id="user">	
	<div class="column title rounded-corner">
		<div class="ui secondary menu">
			<a href="<?php echo e(route('home.profile')); ?>" class="header item <?php echo e(route_is('home.profile') ? 'active' : ''); ?>"><?php echo e(__('Profile')); ?></a>
			<a href="<?php echo e(route('home.notifications')); ?>" class="header item <?php echo e(route_is('home.notifications') ? 'active' : ''); ?>"><?php echo e(__('Notifications')); ?></a>
			<a href="<?php echo e(route('home.favorites')); ?>" class="header item <?php echo e(route_is('home.favorites') ? 'active' : ''); ?>"><?php echo e(__('Collection')); ?></a>
			<a href="<?php echo e(route('home.purchases')); ?>" class="header item <?php echo e(route_is('home.purchases') ? 'active' : ''); ?>"><?php echo e(__('Purchases')); ?></a>
			<?php if(config('app.subscriptions.enabled')): ?>
			<a href="<?php echo e(route('home.user_subscriptions')); ?>" class="header item <?php echo e(route_is('home.user_subscriptions') ? 'active' : ''); ?>"><?php echo e(__('Subscriptions')); ?></a>
			<?php endif; ?>
			<a href="<?php echo e(route('home.invoices')); ?>" class="header item <?php echo e(route_is('home.invoices') ? 'active' : ''); ?>"><?php echo e(__('Invoices')); ?></a>
		</div>
	</div>

	<?php if($errors->any()): ?>
  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <div class="ui negative fluid circular-corner bold w-100 large message">
     	<i class="times icon close"></i>
     	<?php echo e($error); ?>

     </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>
	
	<?php if(route_is('home.purchases')): ?>

		<div class="column items purchases px-0 mt-1">
			<?php if($products): ?>

			<div class="items-list">
				<div class="titles">
					<div class="cover"><?php echo e(__('Cover')); ?></div>
					<div class="name"><?php echo e(__('Name')); ?></div>
					<div class="category"><?php echo e(__('Category')); ?></div>
					<div class="rating"><?php echo e(__('Rating')); ?></div>
					<div class="purchased_at"><?php echo e(__('Purchased at')); ?></div>
					<div class="updated_at"><?php echo e(__('Updated at')); ?></div>
					<div>-</div>
				</div>
				<?php $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="content">
					<div class="cover">
						<a href="<?php echo e(item_url($product)); ?>" style="background-image: url(<?php echo e(asset_("storage/covers/{$product->cover}")); ?>)"></a>
					</div>
					<div class="name">
						<a href="<?php echo e(item_url($product)); ?>"><?php echo e($product->name); ?></a>
					</div>
					<div class="category capitalize">
						<a href="<?php echo e(category_url($product->category_slug)); ?>"><?php echo e($product->category_name); ?></a>
					</div>
					<div class="rating">
						<span class="image rating"><?php echo item_rating($product->rating); ?></span>
					</div>
					<div class="purchased_at"><?php echo e(format_date($product->purchased_at, 'jS M Y \a\\t H:i')); ?></div>
					<div class="updated_at"><?php echo e(format_date($product->updated_at, 'jS M Y \a\\t H:i')); ?></div>
					<div class="download">
						<?php if(!$product->refunded): ?>
							<?php if($product->is_dir): ?>
								<?php if($product->enable_license || $product->key_code): ?>
								<div class="ui floating default yellow button large circular dropdown mx-0">
									<div class="text"><?php echo e(__('Action')); ?></div>
									<div class="menu">
									    <?php if($product->file_name): ?>
										<a class="item" href="<?php echo e(item_folder_sync($product)); ?>"><?php echo e(__('Open Folder')); ?></a>
										<?php endif; ?>
										<?php if($product->enable_license): ?>
										<a class="item" @click="downloadLicense(<?php echo e($product->id); ?>, '#download-license')"><?php echo e(__('License key')); ?></a>
										<?php endif; ?>
										<?php if($product->key_code): ?>
										<a class="item" @click="downloadKey('<?php echo e($product->key_id); ?>', '<?php echo e($product->slug); ?>')"><?php echo e(__('Key code')); ?></a>
										<?php endif; ?>
									</div>
								</div>
								<?php elseif($product->file_name): ?>
									<a class="ui yellow button large circular" href="<?php echo e(item_folder_sync($product)); ?>">
										<?php echo e(__('Open Folder')); ?>

									</a>
								<?php endif; ?>
							<?php else: ?>
								<?php if($product->enable_license || $product->key_code): ?>
								<div class="ui floating default yellow button large circular dropdown mx-0">
									<div class="text"><?php echo e(__('Download')); ?></div>
									<div class="menu">
									  <?php if($product->file_name): ?>
										  <?php if(config("app.direct_download_links.enabled")): ?>
										  <a class="item" target="_blank" href="<?php echo get_direct_download_link($product->id); ?>"><?php echo e(__('Files')); ?></a>
										  <?php else: ?>
											<a class="item" @click="downloadItem(<?php echo e($product->id); ?>)"><?php echo e(__('Files')); ?></a>
											<?php endif; ?>
										<?php endif; ?>
										<?php if($product->enable_license): ?>
										<a class="item" @click="downloadLicense(<?php echo e($product->id); ?>, '#download-license')"><?php echo e(__('License key')); ?></a>
										<?php endif; ?>
										<?php if($product->key_code): ?>
										<a class="item" @click="downloadKey('<?php echo e($product->key_id); ?>', '<?php echo e($product->slug); ?>')"><?php echo e(__('Key code')); ?></a>
										<?php endif; ?>
									</div>
								</div>
								<?php elseif($product->file_name): ?>
									<?php if(config("app.direct_download_links.enabled")): ?>
								  <a class="ui yellow button large circular mx-0" target="_blank" href="<?php echo get_direct_download_link($product->id); ?>">
									  <?php echo e(__('Download')); ?>

									</a>
								  <?php else: ?>
								  <a class="ui yellow button large circular mx-0" @click="downloadItem(<?php echo e($product->id); ?>)"><?php echo e(__('Download')); ?></a>
								  <?php endif; ?>
								<?php endif; ?>
							<?php endif; ?>
						<?php else: ?>
							<div class="ui red big basic label circular"><?php echo e(__('Refunded')); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<div class="content">
					<?php if($products->hasPages()): ?>
					<?php echo e($products->appends(request()->query())->onEachSide(1)->links()); ?>

					<?php echo e($products->appends(request()->query())->links('vendor.pagination.simple-semantic-ui')); ?>

					<?php endif; ?>
				</div>
			</div>

			<form action="<?php echo e(route('home.download')); ?>" class="d-none" method="post" id="download-form">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="itemId" v-model="itemId">
			</form>

			<form action="<?php echo e(route('home.download_license')); ?>" class="d-none" method="post" id="download-license">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="itemId" v-model="itemId">
			</form>

			<?php else: ?>

			<div class="ui fluid large white rounded-corner bold message m-1">
				<?php echo e(__('You have not purchased any item yet.')); ?>

			</div>

			<?php endif; ?>
		</div>

	<?php elseif(route_is('home.favorites')): ?>
	
		<div class="column items favorites px-0 mt-1">
			<div class="wrapper w-100" v-if="Object.keys(favorites).length" v-cloak>

				<div class="item" v-for="product in favorites">

					<div class="cover">
						<a :title="product.name" :href="'item/' + product.id + '/' + product.slug" :style="'background-image: url(storage/covers/' + product.cover + ')'">
								</a>
					</div>

					<div class="name">
						<a :title="product.name" :href="'item/' + product.id + '/' + product.slug">{{ product.name }}</a>
					</div>

					<div class="category">
						<a class="ui pink circular button" :href="'/items/category/' + product.category_slug">{{ product.category_name }}</a>
					</div>

					<div class="sales">{{ __(':count Sales', {'count': product.sales}) }}</div>

					<div class="price">{{ price(product.price) }}</div>

					<div class="actions">
						<button class="ui yellow circular button" @click="addToCartAsync(product, $event)">{{ __('Add to cart') }}</button>
						<button class="ui red circular button" @click="collectionToggleItem($event, product.id)">{{ __('Remove') }}</button>
					</div>

				</div>

			</div>
			
			<div class="ui fluid large white rounded-corner bold message m-1" v-else v-cloak>
				<?php echo e(__('Your collection is empty.')); ?>

			</div>
		</div>

	<?php elseif(route_is('home.user_subscriptions') && config('app.subscriptions.enabled')): ?>
	
		<div class="column items subscriptions px-0 mt-1">
			<?php if($user_subscriptions->count()): ?>

			<div class="wrapper">
				<div class="item titles">
					<div class="name"><?php echo e(__('Name')); ?></div>
					<div class="date"><?php echo e(__('Starts at')); ?></div>
					<div class="date"><?php echo e(__('Expires at')); ?></div>
					<div class="days"><?php echo e(__('Remaining days')); ?></div>
					<div class="downloads"><?php echo e(__('Downloads')); ?></div>
					<div class="downloads"><?php echo e(__('Daily Downloads')); ?></div>
					<div class="status"><?php echo e(__('Status')); ?></div>
				</div>

				<?php $__currentLoopData = $user_subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="item">
					<div class="name"><?php echo e($user_subscription->name); ?></div>
					<div class="date"><?php echo e(format_date($user_subscription->starts_at, 'jS M Y \a\\t H:i')); ?></div>
					<div class="date">
						<?php if($user_subscription->ends_at): ?>
						<?php echo e(format_date($user_subscription->ends_at, 'jS M Y \a\\t H:i')); ?>

						<?php else: ?>
						<?php echo e(__('Unlimited')); ?>

						<?php endif; ?>
					</div>
					<div class="days">
						<?php if($user_subscription->ends_at): ?>
						<?php echo e($user_subscription->remaining_days); ?>

						<?php else: ?>
						<?php echo e(__('Unlimited')); ?>

						<?php endif; ?>
					</div>
					<div class="downloads">
						<?php if($user_subscription->limit_downloads > 0): ?>
						<?php echo e("{$user_subscription->downloads}/{$user_subscription->limit_downloads}"); ?>

						<?php else: ?>
						<?php echo e(__('Unlimited')); ?>

						<?php endif; ?>
					</div>
					<div class="downloads">
						<?php if($user_subscription->limit_downloads_per_day > 0): ?>
						<?php echo e("{$user_subscription->daily_downloads}/{$user_subscription->limit_downloads_per_day}"); ?>

						<?php else: ?>
						<?php echo e(__('Unlimited')); ?>

						<?php endif; ?>
					</div>
					<div class="status">
						<?php if($user_subscription->expired): ?>
						<div class="ui red basic circular large label"><?php echo e(__('Expired')); ?></div>
						<?php elseif(!$user_subscription->payment_status): ?>
						<div class="ui orange basic circular large label"><?php echo e(__('Pending')); ?></div>
						<?php else: ?>
						<div class="ui teal basic circular large label"><?php echo e(__('Active')); ?></div>
						<?php endif; ?>
					</div>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>

			<?php else: ?>

			<div class="ui fluid large white rounded-corner bold message m-1">
				<?php echo e(__("You don't have any subscription.")); ?>

			</div>

			<?php endif; ?>
		</div>

	<?php elseif(route_is('home.notifications')): ?>
	
		<div class="column items notifications mt-1">
	    <?php if($notifications->count()): ?>
	    
	    <div class="items">
	      <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	      <a class="item mx-0 <?php if(!$notification->read): ?> unread <?php endif; ?>"
	          data-id="<?php echo e($notification->id); ?>"
	          data-href="<?php echo e(route('home.product', ['id' => $notification->product_id, 'slug' => $notification->slug . ($notification->for == 1 ? '#support' : ($notification->for == 2 ? '#reviews' : ''))])); ?>">

	        <div class="image" style="background-image: url(<?php echo e(asset_("storage/".($notification->for == 0 ? 'covers' : 'avatars')."/{$notification->image}")); ?>)"></div>

	        <div class="content pl-1">
	          <p><?php echo __($notification->text, ['product_name' => "<strong>{$notification->name}</strong>"]); ?></p>
	          <time><?php echo e(\Carbon\Carbon::parse($notification->updated_at)->diffForHumans()); ?></time>
	        </div>
	      </a>
	      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	    </div>

	    <?php if($notifications->hasPages()): ?>
	    <div class="ui divider"></div>

	    <?php echo e($notifications->onEachSide(1)->links()); ?>

		  <?php echo e($notifications->links('vendor.pagination.simple-semantic-ui')); ?>

	    <?php endif; ?>
	    <?php else: ?>
	    
	    <div class="ui fluid large white rounded-corner bold message m-1">
				<?php echo e(__("You don't have any notification.")); ?>

			</div>
	    <?php endif; ?>
		</div>

	<?php elseif(route_is('home.profile')): ?>
	
		<div class="column items profile p-1 mt-1">
			<form class="ui large form w-100" action="<?php echo e(route('home.profile')); ?>" enctype="multipart/form-data" method="post">
				<?php echo csrf_field(); ?>

				<div class="field avatar">
					<div class="ui unstackable items">
						<div class="item">
							<div class="content">
								<div class="ui circular image">
									<img src="<?php echo e(asset_("storage/avatars/".($user->avatar ?? 'default.jpg').'?v='.time())); ?>">
								</div>

								<button class="ui yellow circular button mx-0" type="button" 
												onclick="$('#user .profile input[name=\'avatar\']').click()"><?php echo e(__('Upload')); ?></button>
								<input type="file" name="avatar" class="d-none">
							</div>

							<div class="content">
								<div class="name"><?php echo e($user->name ?? null); ?></div>
								<div class="country"><?php echo e($user->country ?? null); ?></div>
								<div class="member-since"><?php echo e(format_date($user->created_at, 'd F Y')); ?></div>
								<div class="email">
									<?php echo e($user->email); ?>

									<?php if(config('app.email_verification')): ?>
									<?php if($user->email_verified_at): ?>
									<sup class="verified">(<?php echo e(__('Verified')); ?>)</sup>
									<?php else: ?>
									<sup>(<?php echo e(__('Unverified')); ?> - <a @click="sendEmailVerificationLink('<?php echo e($user->email); ?>')"><?php echo e(__('Send verification link')); ?></a>)</sup>
									<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="two fields">
					<div class="field">
						<label><?php echo e(__('First name')); ?></label>
						<input type="text" name="firstname" value="<?php echo e(old('firstname', $user->firstname ?? null)); ?>">
					</div>
					<div class="field">
						<label><?php echo e(__('Last name')); ?></label>
						<input type="text" name="lastname" value="<?php echo e(old('lastname', $user->lastname ?? null)); ?>">
					</div>
				</div>

				<div class="two fields">
					<div class="field">
						<label><?php echo e(__('Username')); ?></label>
						<input type="text" name="name" value="<?php echo e(old('name', $user->name ?? null)); ?>" required>
					</div>
					<div class="field">
						<label><?php echo e(__('Affiliate name')); ?></label>
						<input type="text" name="affiliate_name" value="<?php echo e(old('affiliate_name', $user->affiliate_name ?? null)); ?>">
					</div>
				</div>

				<div class="two fields">
					<div class="field">
						<label><?php echo e(__('Country')); ?></label>
						<input type="text" name="country" value="<?php echo e(old('country', $user->country ?? null)); ?>">
					</div>
					<div class="field">
						<label><?php echo e(__('City')); ?></label>
						<input type="text" name="city" value="<?php echo e(old('city', $user->city ?? null)); ?>">
					</div>
				</div>

				<div class="two fields">
					<div class="field">
						<label><?php echo e(__('Address')); ?></label>
						<input type="text" name="address" value="<?php echo e(old('address', $user->address ?? null)); ?>">
					</div>
					<div class="field">
						<label><?php echo e(__('Zip code')); ?></label>
						<input type="text" name="zip_code" value="<?php echo e(old('zip_code', $user->zip_code ?? null)); ?>">
					</div>
				</div>

				<div class="two fields">
					<div class="field">
						<label><?php echo e(__('ID number')); ?></label>
						<input type="text" name="id_number" value="<?php echo e(old('id_number', $user->id_number ?? null)); ?>">
					</div>
					<div class="field">
						<label><?php echo e(__('Phone')); ?></label>
						<input type="text" name="phone" value="<?php echo e(old('phone', $user->phone ?? null)); ?>">
					</div>	
				</div>
				
				<div class="field">
					<label><?php echo e(__('State')); ?></label>
					<input type="text" name="state" value="<?php echo e(old('state', $user->state ?? null)); ?>">
				</div>

				<?php if(config('affiliate.enabled') && mb_strlen($user->affiliate_name)): ?>
				<div class="field">
					<label><?php echo e(__('Earnings cashout method')); ?></label>
					<div class="ui floating selection fluid dropdown">
						<input type="hidden" value="<?php echo e(old('cashout_method', $user->cashout_method)); ?>" name="cashout_method">
						<div class="text"></div>
						<div class="menu">
							<?php if(config('affiliate.cashout_methods.paypal_account')): ?>
							<a class="item" data-value="paypal_account"><?php echo e(__('Paypal account')); ?></a>
							<?php endif; ?>

							<?php if(config('affiliate.cashout_methods.bank_account')): ?>
							<a class="item" data-value="bank_account"><?php echo e(__('Bank Transfer')); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>

				<div class="option paypal_account <?php echo e($user->cashout_method != 'paypal_account' ? 'd-none' : ''); ?> mb-1">
					<div class="field">
						<label><?php echo e(__('PayPal Email Address')); ?></label>
						<input type="text" name="paypal_account" value="<?php echo e(old('paypal_account', $user->paypal_account ?? null)); ?>">
					</div>
				</div>

				<div class="option bank_account <?php echo e($user->cashout_method != 'bank_account' ? 'd-none' : ''); ?> mb-1">
					<div class="field">
						<label><?php echo e(__('Bank address')); ?></label>
						<input type="text" name="bank_account[bank_address]" value="<?php echo e(old('bank_account.bank_address', $user->bank_account->bank_address ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Account holder name')); ?></label>
						<input type="text" name="bank_account[holder_name]" value="<?php echo e(old('bank_account.holder_name', $user->bank_account->holder_name ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Account holder address')); ?></label>
						<input type="text" name="bank_account[holder_address]" value="<?php echo e(old('bank_account.holder_address', $user->bank_account->holder_address ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Account number')); ?></label>
						<input type="text" name="bank_account[account_number]" value="<?php echo e(old('bank_account.account_number', $user->bank_account->account_number ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('IBAN Code')); ?></label>
						<input type="text" name="bank_account[iban]" value="<?php echo e(old('bank_account.iban', $user->bank_account->iban ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('SWIFT Code')); ?></label>
						<input type="text" name="bank_account[swift]" value="<?php echo e(old('bank_account.swift', $user->bank_account->swift ?? null)); ?>">
					</div>
				</div>
				<?php endif; ?>

				<div class="field">
					<label><?php echo e(__('Receive notifications via email')); ?></label>
					<div class="ui floating selection fluid dropdown">
						<input type="hidden" value="<?php echo e(old('receive_notifs', $user->receive_notifs ?? '1')); ?>" name="receive_notifs">
						<div class="text"></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>
				
				<div class="ui fluid yellow shadowless segment">
					<h4 class="ui red header"><?php echo e(__('Change password')); ?></h4>

					<div class="two fields mb-0">
						<div class="field">
							<label><?php echo e(__('Old password')); ?></label>
							<input type="text" name="old_password" value="<?php echo e(old('old_password')); ?>">
						</div>
						<div class="field">
							<label><?php echo e(__('New password')); ?></label>
							<input type="text" name="new_password" value="<?php echo e(old('old_password')); ?>">
						</div>
					</div>	
				</div>
				
				<div class="ui fluid divider"></div>

				<div class="field">
					<button class="ui blue circular button" type="submit"><?php echo e(__('Save changes')); ?></button>
				</div>
			</form>
		</div>

	<?php elseif(route_is('home.invoices')): ?>

		<div class="column items invoices mt-1">
			<?php if($invoices): ?>

			<div class="table wrapper">
				<table class="ui basic large unstackable table">
					<thead>
						<tr>
							<th><?php echo e(__('Reference')); ?></th>
							<th><?php echo e(__('Date')); ?></th>
							<th><?php echo e(__('Amount')); ?></th>
							<th><?php echo e(__('Export PDF')); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = $invoices ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><?php echo e($invoice->reference_id); ?></td>
							<td><?php echo e($invoice->created_at); ?></td>
							<td><?php echo e($invoice->currency .' '. $invoice->amount); ?></td>
							<td><button class="ui large yellow circular button" type="button" @click="downloadItem(<?php echo e($invoice->id); ?>, '#download-invoice')"><?php echo e(__('Export')); ?></button></td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
				</table>
			</div>

			<?php if($invoices->hasPages()): ?>
			<div class="ui hidden divider"></div>
			<?php echo e($invoices->appends(request()->query())->onEachSide(1)->links()); ?>

			<?php echo e($invoices->appends(request()->query())->links('vendor.pagination.simple-semantic-ui')); ?>

			<?php endif; ?>

			<form action="<?php echo e(route('home.export_invoice')); ?>" class="d-none" method="post" id="download-invoice">
				<?php echo csrf_field(); ?>
				<input type="hidden" name="itemId" v-model="itemId">
			</form>

			<?php else: ?>

			<div class="ui fluid large white rounded-corner bold message m-1">
				<?php echo e(__('No invoice found.')); ?>

			</div>

			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\user.blade.php ENDPATH**/ ?>