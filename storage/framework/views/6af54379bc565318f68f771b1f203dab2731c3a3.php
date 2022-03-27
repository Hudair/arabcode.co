<?php $__env->startSection('title', __('General settings')); ?>

<?php $__env->startSection('additional_head_tags'); ?>

<link href="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.js')); ?>"></script>
<script src="<?php echo e(asset_('assets/wavesurfer.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'general')); ?>" enctype="multipart/form-data">
	<div class="field">
		<button type="submit" class="ui circular large pink labeled icon button mx-0">
		  <i class="save outline icon mx-0"></i>
		  <?php echo e(__('Update')); ?>

		</button>
	</div>

	<?php if($errors->any()): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <div class="ui negative fluid small message">
         	<i class="times icon close"></i>
         	<?php echo e($error); ?>

         </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

	<?php if(session('settings_message')): ?>
	<div class="ui positive fluid message">
		<i class="times icon close"></i>
		<?php echo e(session('settings_message')); ?>

	</div>
	<?php endif; ?>

	<div class="ui fluid divider"></div>

	<div class="one column grid" id="settings">
		<div class="column">
			<fieldset>
				<legend><?php echo e(__('General')); ?></legend>
				<div class="field">
					<label><?php echo e(__('Name')); ?></label>
					<input type="text" name="name" placeholder="..." value="<?php echo e(old('name', $settings->name ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Title')); ?></label>
					<input type="text" name="title" placeholder="..." value="<?php echo e(old('title', $settings->title ?? null)); ?>">
				</div>
			
				<div class="field">
					<label><?php echo e(__('Description')); ?></label>
					<textarea name="description" cols="30" rows="5"><?php echo e(old('description', $settings->description ?? null)); ?></textarea>
				</div>

				<div class="field">
					<label><?php echo e(__('Email')); ?></label>
					<input type="email" name="email" placeholder="..." value="<?php echo e(old('email', $settings->email ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Keywords')); ?></label>
					<input type="text" name="keywords" placeholder="..." value="<?php echo e(old('keywords', $settings->keywords ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Items per page')); ?></label>
					<input type="number" name="items_per_page" value="<?php echo e(old('items_per_page', $settings->items_per_page ?? null)); ?>">
				</div>

				<div class="field">
					<label><?php echo e(__('Search panel headers')); ?></label>
					<input type="text" name="search_header" placeholder="Header..." value="<?php echo e(old('search_header', $settings->search_header ?? null)); ?>">
					<input type="text" name="search_subheader" placeholder="Subheader..." value="<?php echo e(old('search_subheader', $settings->search_subheader ?? null)); ?>" class="mt-1">
				</div>

				<div class="field">
					<label><?php echo e(__('Facebook APP ID')); ?></label>
					<input type="text" name="fb_app_id" placeholder="Header..." value="<?php echo e(old('fb_app_id', $settings->fb_app_id ?? null)); ?>">
				</div>

				<div class="field" id="timezone">
					<label><?php echo e(__('Timezone')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="timezone" value="<?php echo e(old('timezone', $settings->timezone ?? 'UTC')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<?php $__currentLoopData = config('app.timezones'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item" data-value="<?php echo e($key); ?>"><?php echo e($key); ?> - <?php echo $val; ?></div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>

				<div class="field" id="recently_viewed_items">
					<label><?php echo e(__('Enable recently viewed items')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="recently_viewed_items" value="<?php echo e(old('recently_viewed_items', $settings->recently_viewed_items ?? '0')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="1"><?php echo e(__('Yes')); ?></div>
							<div class="item" data-value="0"><?php echo e(__('No')); ?></div>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Notification for users')); ?></label>
					<input type="text" name="users_notif" value="<?php echo e(old('users_notif', $settings->users_notif ?? null )); ?>">
					<small><i class="circular exclamation small red icon"></i><?php echo e(__('A text alert informing users about anything.')); ?></small>
				</div>
			</fieldset>
			
			<fieldset>
				<legend><?php echo e(__('Blog')); ?></legend>
				<div class="field" id="blog">
					<label><?php echo e(__('Enable blog')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="blog[enabled]" value="<?php echo e(old('blog.enabled', $settings->blog->enabled ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Title and description')); ?></label>
					<input type="text" name="blog[title]" placeholder="<?php echo e(__('Blog title')); ?>" value="<?php echo e(old('blog.title', $settings->blog->title ?? null)); ?>">
					<textarea name="blog[description]" cols="30" rows="5" placeholder="<?php echo e(__('Blog description')); ?>" class="mt-1"><?php echo e(old('blog.description', $settings->blog->description ?? null)); ?></textarea>
				</div>
			</fieldset>

			<fieldset>
				<legend><?php echo e(__('Subscriptions')); ?></legend>
			
				<div class="field" id="subscriptions">
					<label><?php echo e(__('Enable subscriptions')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="subscriptions[enabled]" value="<?php echo e(old('subscriptions.enabled', $settings->subscriptions->enabled ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field" id="subscriptions-purchases">
					<label><?php echo e(__('Allow accumulating subscriptions')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="subscriptions[accumulative]" value="<?php echo e(old('subscriptions.accumulative', $settings->subscriptions->accumulative ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
					<small><?php echo e(__('Allow users to subscribe to a plan before their first subscription expires.')); ?></small>
				</div>
			</fieldset>

			<fieldset id="products">
				<legend><?php echo e(__('Products')); ?></legend>
				<div class="field" id="products_by_country_city">
					<label><?php echo e(__('Enable filtering products by Country / City')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="products_by_country_city" value="<?php echo e(old('products_by_country_city', $settings->products_by_country_city ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>
				
				<div class="field" id="products_by_country_city">
					<label><?php echo e(__('Randomize homepage items')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="randomize_homepage_items" value="<?php echo e(old('randomize_homepage_items', $settings->randomize_homepage_items ?? '0')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Default product type')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="default_product_type" value="<?php echo e(old('default_product_type', $settings->default_product_type ?? '-')); ?>">
						<div class="text">-</div>
						<div class="menu">
							<a class="item" data-value="-">-</a>
							<a class="item" data-value="audio"><?php echo e(__('Audio')); ?></a>
							<a class="item" data-value="graphic"><?php echo e(__('Graphic')); ?></a>
							<a class="item" data-value="ebook"><?php echo e(__('Ebook')); ?></a>
							<a class="item" data-value="video"><?php echo e(__('Video')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Generate audio peaks')); ?></label>
					<div class="ui multiple floating selection search fluid dropdown items-search">
						<input type="hidden" name="products_ids">
						<div class="default text"><?php echo e(__('Search products')); ?></div>
						<i class="dropdown icon"></i>
						<div class="menu"></div>
					</div>
					<div class="mt-1-hf"><small>* <?php echo e(__('Leave empty to generate peaks for all audios.')); ?></small></div>
					<button class="ui blue peaks button circular mt-1-hf" type="button"><?php echo e(__('Generate & Save')); ?></button>

					<div class="d-none" id="wavesurfer"></div>

					<div class="ui progress peaks d-none mt-1-hf mb-0">
					  <div class="bar">
					    <div class="progress"></div>
					  </div>
					</div>
				</div>

				<div class="field" id="masonry-layout">
					<label><?php echo e(__('Enable Masonry layout')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="masonry_layout" value="<?php echo e(old('masonry_layout', $settings->masonry_layout ?? '0')); ?>">
						<div class="text"><?php echo e(__('No')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>
			</fieldset>

			<fieldset id="direct-download-links">
				<legend><?php echo e(__('Direct download links')); ?></legend>
				<div class="field" id="direct-download-links-enable">
					<label><?php echo e(__('Enable download links')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="direct_download_links[enabled]" value="<?php echo e(old('direct_download_links.enabled', $settings->direct_download_links->enabled ?? '0')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field" id="direct-download-links-filter-by-ip">
					<label><?php echo e(__('Filter download links by user ip')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="direct_download_links[by_ip]" value="<?php echo e(old('direct_download_links.by_ip', $settings->direct_download_links->by_ip ?? '0')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field" id="direct-download-links-filter-by-ip">
					<label><?php echo e(__('Authentication required')); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="direct_download_links[authenticated]" value="<?php echo e(old('direct_download_links.authenticated', $settings->direct_download_links->authenticated ?? '0')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
					<small><?php echo e(__('User must be authenticated')); ?></small>
				</div>

				<div class="field" id="direct-download-links-expiration">
					<label><?php echo e(__('Expire in x hours')); ?></label>
					<input type="number" name="direct_download_links[expire_in]" value="<?php echo e(old('direct_download_links.expire_in', $settings->direct_download_links->expire_in ?? null)); ?>" placeholder="12">
					<small>Leave empty for no expiration</small>
				</div>
			</fieldset>

			<fieldset>
				<legend><?php echo e(__('Cookies')); ?></legend>
				<div class="field">
					<label><?php echo e(__('Cookie')); ?></label>
					<div class="ui segment fluid rounded-corner">
						<textarea name="cookie[text]" class="summernote" rows="4" placeholder="..."><?php echo e(old('cookie.text', $settings->cookie->text ?? null)); ?></textarea>
						<div class="ui right action input mt-1">
						  <input type="text" name="cookie[background][raw]" placeholder="<?php echo e(__('Container color')); ?>" value="<?php echo e(old('cookie.background.raw', $settings->cookie->background ?? 'linear-gradient(45deg, #ce2929, #ce2929, #ffc65d)')); ?>">
							<div class="ui blue icon button" onclick="this.nextElementSibling.click()"><?php echo e(__('Container color')); ?></div>
						  <input type="color" class="d-none" name="cookie[background][picker]" value="<?php echo e(old('cookie.background.raw', $settings->cookie->background ?? 'linear-gradient(45deg, #ce2929, #ce2929, #ffc65d)')); ?>">
						</div>
						<div class="ui right action input mt-1">
						  <input type="text" name="cookie[color][raw]" placeholder="<?php echo e(__('Text color')); ?>" value="<?php echo e(old('cookie.color.raw', $settings->cookie->color ?? '')); ?>">
							<div class="ui blue icon button" onclick="this.nextElementSibling.click()"><?php echo e(__('Text color')); ?></div>
						  <input type="color" class="d-none" name="cookie[color][picker]" value="<?php echo e(old('cookie.color.raw', $settings->cookie->color ?? '')); ?>">
						</div>
						<div class="ui right action input mt-1">
						  <input type="text" name="cookie[button_bg][raw]" placeholder="<?php echo e(__('Button background')); ?>" value="<?php echo e(old('cookie.color.button_bg', $settings->cookie->button_bg ?? '')); ?>">
							<div class="ui blue icon button" onclick="this.nextElementSibling.click()"><?php echo e(__('Button background')); ?></div>
						  <input type="color" class="d-none" name="cookie[button_bg][picker]" value="<?php echo e(old('cookie.button_bg.raw', $settings->cookie->button_bg ?? '')); ?>">
						</div>
					</div>
				</div>
			</fieldset>
			
			
			<fieldset>
				<legend><?php echo e(__('Languages')); ?></legend>
				<div class="field" id="langs">
					<label><?php echo e(__('Languages')); ?></label>
					<div class="ui dropdown multiple search floating selection">
						<input type="hidden" name="langs" value="<?php echo e(old('langs', $settings->langs ?? 'en')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<?php $__currentLoopData = $langs ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item uppercase" data-value="<?php echo e($lang); ?>"><?php echo e($lang); ?></div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</fieldset>
		
			<fieldset>
				<legend><?php echo e(__('Fonts')); ?></legend>
				<div id="fonts">
					<div class="two stackable fields mb-1-hf">
						<div class="field">
							<label><?php echo e(__('Font - LTR')); ?></label>
							<textarea name="fonts[ltr]" id="" cols="30" rows="5" placeholder="Google font url or font-face(s)"><?php echo old('fonts.ltr', $settings->fonts->ltr ?? null); ?></textarea>
						</div>
						<div class="field">
							<label><?php echo e(__('Font - RTL')); ?></label>
							<textarea name="fonts[rtl]" id="" cols="30" rows="5" placeholder="Google font url or font-face(s)"><?php echo old('fonts.rtl', $settings->fonts->rtl ?? null); ?></textarea>
						</div>
					</div>
					<small><i class="circular exclamation small red icon"></i><?php echo e(__("Fonts files/folders can be put in 'public/assets/fonts' and are accessible via '/assets/fonts/(FONT_FOLDER)/FILE_NAME' .")); ?></small>
				</div>
			</fieldset>



			<fieldset>
				<legend><?php echo e(__('Templates')); ?></legend>
				<div class="field" id="template">
					<label><?php echo e(__('Templates')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="template" value="<?php echo e(old('template', $settings->template ?? 'valexa')); ?>">
						<div class="text capitalize">...</div>
						<div class="menu">
							<?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="item capitalize" data-value="<?php echo e($template); ?>"><?php echo e($template); ?></div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</div>
					</div>
				</div>
			</fieldset>


			<fieldset>
				<legend><?php echo e(__('Home page')); ?></legend>
				<div class="field homepage-items" id="homepage-items">
					<label><?php echo e(__('Home page items')); ?></label>
					<div class="table-wrapper">
						<table class="ui fluid unstackable celled striped small table default mt-0 <?php echo e(config('app.template') === 'default' ? '' : 'd-none'); ?>">
							<tbody>
								<tr>
									<th><?php echo e(__('Featured items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[default][featured][limit]" value="<?php echo e(old('homepage_items.default.featured.limit', $settings->homepage_items->default->featured->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[default][featured][items_per_line]" value="<?php echo e(old('homepage_items.default.featured.items_per_line', $settings->homepage_items->default->featured->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Trending items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[default][trending][limit]" value="<?php echo e(old('homepage_items.default.trending.limit', $settings->homepage_items->default->trending->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[default][trending][items_per_line]" value="<?php echo e(old('homepage_items.default.trending.items_per_line', $settings->homepage_items->default->trending->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Newest items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[default][newest][limit]" value="<?php echo e(old('homepage_items.default.newest.limit', $settings->homepage_items->default->newest->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[default][newest][items_per_line]" value="<?php echo e(old('homepage_items.default.newest.items_per_line', $settings->homepage_items->default->newest->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Free items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[default][free][limit]" value="<?php echo e(old('homepage_items.default.free.limit', $settings->homepage_items->default->free->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[default][free][items_per_line]" value="<?php echo e(old('homepage_items.default.free.items_per_line', $settings->homepage_items->default->free->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Posts')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[default][posts][limit]" value="<?php echo e(old('homepage_items.default.posts.limit', $settings->homepage_items->default->posts->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[default][posts][items_per_line]" value="<?php echo e(old('homepage_items.default.posts.items_per_line', $settings->homepage_items->default->posts->items_per_line ?? null)); ?>">
									</td>
								</tr>
							</tbody>
						</table>

						<table class="ui fluid unstackable celled striped small table valexa mt-0 <?php echo e(config('app.template') === 'valexa' ? '' : 'd-none'); ?>">
							<tbody>
								<tr>
									<th><?php echo e(__('Featured items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[valexa][featured][limit]" value="<?php echo e(old('homepage_items.valexa.featured.limit', $settings->homepage_items->valexa->featured->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[valexa][featured][items_per_line]" value="<?php echo e(old('homepage_items.valexa.featured.items_per_line', $settings->homepage_items->valexa->featured->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Trending items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[valexa][trending][limit]" value="<?php echo e(old('homepage_items.valexa.trending.limit', $settings->homepage_items->valexa->trending->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[valexa][trending][items_per_line]" value="<?php echo e(old('homepage_items.valexa.trending.items_per_line', $settings->homepage_items->valexa->trending->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Newest items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[valexa][newest][limit]" value="<?php echo e(old('homepage_items.valexa.newest.limit', $settings->homepage_items->valexa->newest->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[valexa][newest][items_per_line]" value="<?php echo e(old('homepage_items.valexa.newest.items_per_line', $settings->homepage_items->valexa->newest->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Free items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[valexa][free][limit]" value="<?php echo e(old('homepage_items.valexa.free.limit', $settings->homepage_items->valexa->free->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[valexa][free][items_per_line]" value="<?php echo e(old('homepage_items.valexa.free.items_per_line', $settings->homepage_items->valexa->free->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Posts')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[valexa][posts][limit]" value="<?php echo e(old('homepage_items.valexa.posts.limit', $settings->homepage_items->valexa->posts->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[valexa][posts][items_per_line]" value="<?php echo e(old('homepage_items.valexa.posts.items_per_line', $settings->homepage_items->valexa->posts->items_per_line ?? null)); ?>">
									</td>
								</tr>
							</tbody>
						</table>

						<table class="ui fluid unstackable celled striped small table tendra mt-0 <?php echo e(config('app.template') === 'tendra' ? '' : 'd-none'); ?>">
							<tbody>
								<tr>
									<th><?php echo e(__('Featured items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[tendra][featured][limit]" value="<?php echo e(old('homepage_items.tendra.featured.limit', $settings->homepage_items->tendra->featured->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[tendra][featured][items_per_line]" value="<?php echo e(old('homepage_items.tendra.featured.items_per_line', $settings->homepage_items->tendra->featured->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Newest items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[tendra][newest][limit]" value="<?php echo e(old('homepage_items.tendra.newest.limit', $settings->homepage_items->tendra->newest->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[tendra][newest][items_per_line]" value="<?php echo e(old('homepage_items.tendra.newest.items_per_line', $settings->homepage_items->tendra->newest->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Free items')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[tendra][free][limit]" value="<?php echo e(old('homepage_items.tendra.free.limit', $settings->homepage_items->tendra->free->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[tendra][free][items_per_line]" value="<?php echo e(old('homepage_items.tendra.free.items_per_line', $settings->homepage_items->tendra->free->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Posts')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[tendra][posts][limit]" value="<?php echo e(old('homepage_items.tendra.posts.limit', $settings->homepage_items->tendra->posts->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[tendra][posts][items_per_line]" value="<?php echo e(old('homepage_items.tendra.posts.items_per_line', $settings->homepage_items->tendra->posts->items_per_line ?? null)); ?>">
									</td>
								</tr>
								<tr>
									<th><?php echo e(__('Pricing plans')); ?></th>
									<td>
										<input type="number" placeholder="<?php echo e(__('Limit of items to show')); ?>" name="homepage_items[tendra][pricing_plans][limit]" value="<?php echo e(old('homepage_items.tendra.pricing_plans.limit', $settings->homepage_items->tendra->pricing_plans->limit ?? null)); ?>">
									</td>
									<td>
										<input type="number" placeholder="<?php echo e(__('Items per line')); ?>" name="homepage_items[tendra][pricing_plans][items_per_line]" value="<?php echo e(old('homepage_items.tendra.pricing_plans.items_per_line', $settings->homepage_items->tendra->pricing_plans->items_per_line ?? null)); ?>">
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend><?php echo e(__('Social')); ?></legend>
				<div class="field">
					<div class="table wrapper mt-0">
						<table class="ui celled unstackable table">
							<thead>
								<tr>
									<th colspan="2"><?php echo e(__('Social links')); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="one column wide">Facebook</td>
									<td><input type="text" name="facebook" value="<?php echo e(old('facebook', $settings->facebook ?? null )); ?>"></td>
								</tr>
								<tr>
									<td class="one column wide">Twitter</td>
									<td><input type="text" name="twitter" value="<?php echo e(old('twitter', $settings->twitter ?? null )); ?>"></td>
								</tr>
								<tr>
									<td class="one column wide">Pinterest</td>
									<td><input type="text" name="pinterest" value="<?php echo e(old('pinterest', $settings->pinterest ?? null )); ?>"></td>
								</tr>
								<tr>
									<td class="one column wide">Youtube</td>
									<td><input type="text" name="youtube" value="<?php echo e(old('youtube', $settings->youtube ?? null )); ?>"></td>
								</tr>
								<tr>
									<td class="one column wide">Tumblr</td>
									<td><input type="text" name="tumblr" value="<?php echo e(old('tumblr', $settings->tumblr ?? null )); ?>"></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend><?php echo e(__('Favicon, Logo, Cover, ...')); ?></legend>
				<div class="field">
					<div class="table wrapper files">
						<table class="ui celled unstackable table">
							<thead>
								<tr>
									<th><?php echo e(__('Favicon')); ?></th>
									<th><?php echo e(__('Logo')); ?></th>
									<th><?php echo e(__('Website Cover')); ?></th>
									<th><?php echo e(__('Top Cover')); ?></th>
									<th><?php echo e(__('Top Mask')); ?></th>
									<th><?php echo e(__('Blog Cover')); ?></th>
									<th><?php echo e(__('Watermark')); ?></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<button class="ui basic circular large fluid button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?></button>
										<input type="file" class="d-none" name="favicon" accept="image/*">
									</td>

									<td>
										<button class="ui basic circular large fluid button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?></button>
										<input type="file" class="d-none" name="logo" accept="image/*">
									</td>

									<td>
										<button class="ui basic circular large fluid button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?></button>
										<input type="file" class="d-none" name="cover" accept="image/*">
									</td>

									<td>
										<div class="d-flex">
											<button class="ui basic circular large button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?> <sup>Default</sup></button>
											<input type="file" class="d-none" name="top_cover[default]" accept="image/*">

											<?php if($settings->default_top_cover ?? null): ?>
											<button class="ui red inverted circular large icon button mr-0" type="button" onclick="this.nextElementSibling.remove(); this.remove()">
												<i class="close icon mx-0"></i>
											</button>
											<input type="hidden" name="top_cover[default]" value="<?php echo e($settings->default_top_cover ?? null); ?>">
											<?php endif; ?>
										</div>

										<div class="d-flex mt-1">
											<button class="ui basic circular large button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?> <sup>vAlexa</sup></button>
											<input type="file" class="d-none" name="top_cover[valexa]" accept="image/*">

											<?php if($settings->valexa_top_cover ?? null): ?>
											<button class="ui red inverted circular large icon button mr-0" type="button" onclick="this.nextElementSibling.remove(); this.remove()">
												<i class="close icon mx-0"></i>
											</button>
											<input type="hidden" name="top_cover[valexa]" value="<?php echo e($settings->valexa_top_cover ?? null); ?>">
											<?php endif; ?>
										</div>
										
										<div class="d-flex mt-1">
											<button class="ui basic circular large button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?> <sup>Tendra</sup></button>
											<input type="file" class="d-none" name="top_cover[tendra]" accept="image/*">

											<?php if($settings->tendra_top_cover ?? null): ?>
											<button class="ui red inverted circular large icon button mr-0" type="button" onclick="this.nextElementSibling.remove(); this.remove()">
												<i class="close icon mx-0"></i>
											</button>
											<input type="hidden" name="top_cover[tendra]" value="<?php echo e($settings->tendra_top_cover ?? null); ?>">
											<?php endif; ?>
										</div>
									</td>

									<td>
										<div class="d-flex">
											
										</div>
										
										<div class="d-flex mt-1">
											<button class="ui basic circular large button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?> <sup>Tendra</sup></button>
											<input type="file" class="d-none" name="top_cover_mask[tendra]" accept="image/*">

											<?php if($settings->tendra_top_cover_mask ?? null): ?>
											<button class="ui red inverted circular large icon button mr-0" type="button" onclick="this.nextElementSibling.remove(); this.remove()">
												<i class="close icon mx-0"></i>
											</button>
											<input type="hidden" name="top_cover_mask[tendra]" value="<?php echo e($settings->tendra_top_cover_mask ?? null); ?>">
											<?php endif; ?>
										</div>
									</td>

									<td>
										<button class="ui basic circular large fluid button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?></button>
										<input type="file" class="d-none" name="blog_cover" accept="image/*">
									</td>

									<td>
										<button class="ui basic circular large fluid button" type="button" onclick="this.nextElementSibling.click()"><?php echo e(__('Browse')); ?></button>
										<input type="file" class="d-none" name="watermark" accept="image/*">
										<?php if($settings->watermark): ?>
										<button class="ui circular large red fluid button mt-1" type="button" onclick="this.nextElementSibling.remove(); this.remove()"><?php echo e(__('Remove')); ?></button>
										<input type="hidden" name="watermark" value="<?php echo e($settings->watermark); ?>">
										<?php endif; ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</fieldset>


			<fieldset>
				<legend><?php echo e(__('Notification')); ?></legend>
				<div class="field">
					<label><?php echo e(__('Receive email notifications on :what', ['what' => __('Comments')])); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="admin_notifications[comments]" value="<?php echo e(old('admin_notifications.comments', $settings->admin_notifications->comments ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Receive email notifications on :what', ['what' => __('Reviews')])); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="admin_notifications[reviews]" value="<?php echo e(old('admin_notifications.reviews', $settings->admin_notifications->reviews ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Receive email notifications on :what', ['what' => __('Sales')])); ?></label>
					<div class="ui selection floating dropdown">
						<input type="hidden" name="admin_notifications[sales]" value="<?php echo e(old('admin_notifications.sales', $settings->admin_notifications->sales ?? '1')); ?>">
						<div class="text"><?php echo e(__('Yes')); ?></div>
						<div class="menu">
							<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
							<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
						</div>
					</div>
				</div>

				<div class="field">
					<label><?php echo e(__('Enable email verification')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="email_verification" value="<?php echo e(old('email_verification', $settings->email_verification ?? '0')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="1"><?php echo e(__('Yes')); ?></div>
							<div class="item" data-value="0"><?php echo e(__('No')); ?></div>
						</div>
					</div>
				</div>
			</fieldset>


			<fieldset>
				<legend><?php echo e(__('Reviews and comments approval')); ?></legend>

				<div class="field" id="auto_approve[support]">
					<label><?php echo e(__('Auto approve comments')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="auto_approve[support]" value="<?php echo e(old('auto_approve.support', $settings->auto_approve->support ?? '0')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="1"><?php echo e(__('Yes')); ?></div>
							<div class="item" data-value="0"><?php echo e(__('No')); ?></div>
						</div>
					</div>
				</div>

				<div class="field" id="auto_approve[reviews]">
					<label><?php echo e(__('Auto approve reviews')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="auto_approve[reviews]" value="<?php echo e(old('auto_approve.reviews', $settings->auto_approve->reviews ?? '0')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="1"><?php echo e(__('Yes')); ?></div>
							<div class="item" data-value="0"><?php echo e(__('No')); ?></div>
						</div>
					</div>
				</div>
			</fieldset>


			<fieldset>
				<legend><?php echo e(__('Debugging')); ?></legend>
				<div class="field" id="env">
					<label><?php echo e(__('Environment')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="env" value="<?php echo e(old('env', $settings->env ?? 'production')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="production"><?php echo e(__('Production')); ?></div>
							<div class="item" data-value="development"><?php echo e(__('Development')); ?></div>
						</div>
					</div>
				</div>

				<div class="field" id="debug">
					<label><?php echo e(__('Mode Debug')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="debug" value="<?php echo e(old('debug', $settings->debug ?? '1')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="1"><?php echo e(__('On')); ?></div>
							<div class="item" data-value="0"><?php echo e(__('Off')); ?></div>
						</div>
					</div>
				</div>
			</fieldset>

			<fieldset>
				<legend><?php echo e(__('Maintenance mode')); ?></legend>

				<div class="field" id="maintenance[enabled]">
					<label><?php echo e(__('Maintenance mode')); ?></label>
					<div class="ui dropdown floating selection">
						<input type="hidden" name="maintenance[enabled]" value="<?php echo e(old('maintenance.enabled', $settings->maintenance->enabled ?? '0')); ?>">
						<div class="default text">...</div>
						<div class="menu">
							<div class="item" data-value="1"><?php echo e(__('On')); ?></div>
							<div class="item" data-value="0"><?php echo e(__('Off')); ?></div>
						</div>
					</div>
				</div>

				<div class="mt-1 ui segment fluid red rounded-corner maintenance-info  <?php echo e(($settings->maintenance->enabled ?? '0') ? '' : 'd-none'); ?>">
					<div class="field">
						<label><?php echo e(__('Expires at')); ?></label>
						<input type="text" name="maintenance[expires_at]" placeholder="YYYY-MM-DD HH:mm:ss" value="<?php echo e(old('maintenance.expires_at', $settings->maintenance->expires_at ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Auto disable')); ?></label>
						<div class="ui dropdown floating selection">
							<input type="hidden" name="maintenance[auto_disable]" value="<?php echo e(old('maintenance.auto_disable', $settings->maintenance->auto_disable ?? '0')); ?>">
							<div class="default text">...</div>
							<div class="menu">
								<div class="item" data-value="1"><?php echo e(__('On')); ?></div>
								<div class="item" data-value="0"><?php echo e(__('Off')); ?></div>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Page title')); ?></label>
						<input type="text" name="maintenance[title]" value="<?php echo e(old('maintenance.title', $settings->maintenance->title ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Page header')); ?></label>
						<input type="text" name="maintenance[header]" value="<?php echo e(old('maintenance.header', $settings->maintenance->header ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Page subheader')); ?></label>
						<input type="text" name="maintenance[subheader]" value="<?php echo e(old('maintenance.subheader', $settings->maintenance->subheader ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Page text')); ?></label>
						<input type="text" name="maintenance[text]" value="<?php echo e(old('maintenance.text', $settings->maintenance->text ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Background color')); ?></label>
						<div class="ui right action input">
						  <input type="text" name="maintenance[bg_color]" value="<?php echo e(old('maintenance.bg_color', $settings->maintenance->bg_color ?? null)); ?>">
							<div class="ui blue icon button" onclick="this.nextElementSibling.click()">Color</div>
						  <input type="color" class="d-none" name="maintenance[bg_color]" value="<?php echo e(old('maintenance.bg_color', $settings->maintenance->bg_color ?? null)); ?>">
						</div>
					</div>
				</div>
			</fieldset>

			<div class="ui blue large rounded-corner segment fluid" id="purchase_code">
				<div class="field">
					<label><?php echo e(__('Your Envato purchase code')); ?></label>
					<input type="text" name="purchase_code" placeholder="..." value="<?php echo e(old('purchase_code', env('PURCHASE_CODE') ?? $settings->purchase_code ?? null)); ?>">
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	'use strict';

	function savePeaks(previewFile, itemId)
	{
		var wSuffer = WaveSurfer.create({
			    container: $('#wavesurfer')[0],
			    responsive: true,
			    partialRender: true,
			    waveColor: '#D9DCFF',
			    progressColor: '#4353FF',
			    cursorColor: '#4353FF',
			    barWidth: 2,
			    barRadius: 3,
			    cursorWidth: 1,
			    height: 60,
			    barGap: 2
			});

			wSuffer.once('ready', () => 
			{
					wSuffer.exportPCM(1024, 10000, true).then(function(res)
					{
						$.post("<?php echo e(route('products.save_wave')); ?>", { peaks: res, id: itemId })
						.done(function()
						{
							if(lastItemId == itemId)
							{
								$('#settings button.peaks').toggleClass('loading disabled', false);
								$('.items-search input.search').toggleClass('disabled', false);
							}
						})
						.always(function()
						{
							$('.ui.progress.peaks').progress('increment', 1);
						})
					})
	    });

			wSuffer.load(previewFile);
	}


	function savePeaksFromTempUrl(previewFile, itemId)
	{
		$.post('<?php echo e(route('products.get_temp_url')); ?>', {url: previewFile, id: itemId})
		.done(function(tempUrl)
		{
			savePeaks(tempUrl, itemId);
		})
	}

	$(function()
	{
		$('input[name="maintenance[enabled]"]').on('change', function()
		{
			$('.maintenance-info').toggleClass('d-none', $(this).val() === '0')
		})

		$(document).on('click', '#settings button.peaks', function()
		{
			window.lastItemId = null;
			window.peaksItemsLenght = 0;

			$(this).toggleClass('loading disabled', true);
			$('.items-search input.search').toggleClass('disabled', true);

			var items = $('input[name="products_ids"]').val().trim();

			$('.ui.progress.peaks').toggleClass('d-none', false).progress({
				value: 0,
				onSuccess: function()
				{
					alert('<?php echo e(__('Peaks have been generated and saved.')); ?>');
				}
			});

			if(items.length)
			{
				items = items.split(',');
				lastItemId = items[items.length -1].split('|')[0];
				peaksItemsLenght = items.length;

				$('.ui.progress.peaks').progress('set total', peaksItemsLenght);

				for(var k in items)
				{
					var item = items[k].split('|');

					if(/https?.+/.test(item[1]))
					{
						savePeaksFromTempUrl(item[1], item[0])
					}
					else
					{
						savePeaks('/storage/previews/'+item[1], item[0])
					}
				}
			}
			else
			{
				$.post('<?php echo e(route('products.api')); ?>', {where: {'type': 'audio'}, 'limit': 9999999}, null, 'json')
				.done(function(res)
				{
					if(res.products.length)
					{
						var items = res.products;
						lastItemId = items[items.length-1].id;

						peaksItemsLenght = items.length;

						peaksItemsLenght = items.length;

						$('.ui.progress.peaks').progress('set total', peaksItemsLenght);

						for(var k in items)
						{
							if(/https?.+/.test(items[k].preview))
							{
								savePeaksFromTempUrl(items[k].preview, items[k].id)
							}
							else
							{
								savePeaks('/storage/previews/'+items[k].preview, items[k].id)
							}
						}
					}
				})
			}
		})

		$('#settings input, #settings textarea').on('keydown', function(e) 
		{
		    if((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
		    {		        
		        $('form.main').submit();

		  			e.preventDefault();

		        return false;
		    }
		    else
		    {
		        return true;
		    }
		})

		$(document).on('keyup', '.items-search input.search', debounce(function(e)
		{
			var _this = $(e.target);

			var val = _this.val().trim();

			if(!val.length)
				return;

			$.post('<?php echo e(route('products.api')); ?>', {'keywords': val, where: {'type': 'audio'}}, null, 'json')
			.done(function(res)
			{
				var items = res.products.reduce(function(carry, item)
										{
											carry.push('<a class="item" data-value="'+item.id+'|'+item.preview+'">'+item.name+'</a>');
											return carry;
										}, []);

				_this.closest('.items-search').find('.menu').html(items.join(''));
			})
		}, 200));

		$('input[name="template"]').on('change', function()
		{
			var template = $(this).val().trim();

			$('.homepage-items .table.' + template)
			.toggleClass('d-none', false)
			.siblings('.table').toggleClass('d-none', true);
		})

	  $('.summernote').summernote({
	    placeholder: '<?php echo e(__('Content')); ?>',
	    tabsize: 2,
	    height: 100,
	    tooltip: false
	  });
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views/back/settings/general.blade.php ENDPATH**/ ?>