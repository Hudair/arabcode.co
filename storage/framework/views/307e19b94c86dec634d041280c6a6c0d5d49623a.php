

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('additional_head_tags'); ?>

<link href="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset_('assets/admin/summernote-lite-0.8.12.js')); ?>"></script>
<script src="<?php echo e(asset_('assets/wavesurfer.min.js')); ?>"></script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="product">
	<form class="ui large main form" method="post" autocomplete="off" enctype="multipart/form-data" action="<?php echo e(route('products.update', $product->id)); ?>">
		<div class="field">
			<input type="submit" id="submit" class="d-none">
			<button class="ui icon labeled circular large purple button" :class="{disabled: anyInputOff()}" type="button" id="save">
			  <i class="save outline icon"></i>
			  <?php echo e(__('Save')); ?>

			</button>
			<a class="ui icon labeled circular large yellow button" :class="{disabled: anyInputOff()}" href="<?php echo e(route('products')); ?>">
				<i class="times icon"></i>
				<?php echo e(__('Cancel')); ?>

			</a>
		</div>

		<div class="ui compact blue segment">
			<div class="ui radio checkbox">
			  <input type="checkbox" name="notify_buyers">
			  <label><?php echo e(__('Notify buyers about the update.')); ?></label>
			</div>
		</div>		
		
		<?php if($errors->any()): ?>
      <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="ui negative fluid small message">
				<i class="times icon close"></i>
				<?php echo e($error); ?>

			</div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>

		<div class="ui fluid divider"></div>

		<div class="ui one column grid">
			<div class="column tabs">
				<div class="ui top attached tabular menu">
			    <a class="active item" data-tab="overview"><?php echo e(__('Overview')); ?></a>
			  	<a class="item" data-tab="description"><?php echo e(__('Description')); ?></a>
				  <a class="item" data-tab="hidden-content"><?php echo e(__('Hidden content')); ?></a>
				  <a class="item" data-tab="pricing"><?php echo e(__('Pricing')); ?></a>
				  <a class="item" :class="{'d-none': itemType !== 'ebook'}" data-tab="table-of-contents"><?php echo e(__('Table of contents')); ?></a>
				  <a class="item" data-tab="faq"><?php echo e(__('FAQ')); ?></a>
				  <a class="item" data-tab="additional-fields"><?php echo e(__('Additional fields')); ?></a>
			  </div>

			  <div class="ui tab segment active" data-tab="overview">
			  	<input type="hidden" name="is_dir" value="<?php echo e(isFolderProcess() ? '1' : '0'); ?>">

			  	<div class="field">
			  		<label><?php echo e(__('Type')); ?></label>
			  		<div class="ui selection floating search dropdown">
						  <input type="hidden" name="type" @change="setItemType($event)" value="<?php echo e(old('type', $product->type ?? config('app.default_product_type', '-'))); ?>">
						  <div class="default text">-</div>
						  <div class="menu">
								<?php $__currentLoopData = config('app.item_types') ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="item" data-value="<?php echo e($k); ?>"><?php echo e(__($v)); ?></div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </div>
						</div>
			  	</div>

			  	<div class="field">
						<label><?php echo e(__('Name')); ?></label>
						<input type="text" name="name" placeholder="..." value="<?php echo e(old('name', $product->name)); ?>" autofocus required>
					</div>

					<div class="field">
						<label><?php echo e(__('Short description')); ?></label>
						<textarea name="short_description" cols="30" rows="5"><?php echo e(old('short_description', $product->short_description)); ?></textarea>
					</div>

					<div class="field">
						<label><?php echo e(__('Category')); ?></label>
						<div class="ui selection floating dropdown">
						  <input type="hidden" name="category" value="<?php echo e(old('category', $product->category)); ?>">
						  <i class="dropdown icon"></i>
						  <div class="default text">-</div>
						  <div class="menu">
						  	<?php $__currentLoopData = $category_parents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category_parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="item" data-value="<?php echo e($category_parent->id); ?>">
									<?php echo e(ucfirst($category_parent->name)); ?>

								</div>
						  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						  </div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Subcategories')); ?></label>
						<div class="ui multiple selection floating dropdown" id="subcategories">
							<input type="hidden" name="subcategories" value="<?php echo e(old('subcategories', $product->subcategories)); ?>">
							<i class="dropdown icon"></i>
							<div class="default text"><?php echo e(__('Select subcategory')); ?></div>
							<div class="menu"></div>
						</div>
					</div>

					<div v-if="itemType === 'audio'">
						<div class="field">
							<label><?php echo e(__('Label')); ?></label>
							<input type="text" name="label" value="<?php echo e(old('label', $product->label ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('BPM')); ?></label>
							<input type="text" name="bpm" value="<?php echo e(old('bpm', $product->bpm ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Bit Rate')); ?></label>
							<input type="number" name="bit_rate" value="<?php echo e(old('bit_rate', $product->bit_rate ?? null)); ?>">
						</div>
					</div>

					<div class="mb-1" v-if="itemType === 'ebook'">
						<div class="field">
							<label><?php echo e(__('Pages')); ?></label>
							<input type="number" name="pages" value="<?php echo e(old('pages', $product->pages ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Language')); ?></label>
							<input type="text" name="language" value="<?php echo e(old('language', $product->language ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Formats')); ?></label>
							<input type="text" name="formats" value="<?php echo e(old('formats', $product->formats ?? null)); ?>">
						</div>

						<div class="field">
							<label><?php echo e(__('Words')); ?></label>
							<input type="text" name="words" value="<?php echo e(old('words', $product->words ?? null)); ?>">
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Tools used')); ?> <i class="exclamation circle icon" title="languages, libraries, frameworks..."></i></label>
						<input type="text" name="software" value="<?php echo e(old('software', $product->software ?? null)); ?>" placeholder="...">
					</div>
					
					<div class="mb-1" v-if="itemType === '-'">
						<div class="field">
							<label><?php echo e(__('Database used')); ?> <i class="exclamation circle icon" title="MongoDB, MySQL, SQLite..."></i></label>
							<input type="text" name="database" value="<?php echo e(old('database', $product->database ?? null)); ?>" placeholder="...">
						</div>

						<div class="ui hidden divider"></div>

						<div class="field">
							<label><?php echo e(__('Compatible browsers')); ?></label>
							<input type="text" name="compatible_browsers" value="<?php echo e(old('compatible_browsers', $product->compatible_browsers ?? null)); ?>" placeholder="...">
						</div>

						<div class="ui hidden divider"></div>
						
						<div class="field">
							<label><?php echo e(__('Compatible OS')); ?></label>
							<input type="text" name="compatible_os" value="<?php echo e(old('compatible_os', $product->compatible_os ?? null)); ?>" placeholder="...">
						</div>
					</div>

					<div class="ui hidden divider"></div>
						
					<div class="field">
						<label><?php echo e(__('High resolution')); ?></label>
						<div class="ui selection floating dropdown">
							<input type="hidden" name="high_resolution" value="<?php echo e(old('high_resolution', $product->high_resolution ?? '0')); ?>">
							<div class="text">...</div>
							<div class="menu">
								<a class="item" data-value="">-</a>
								<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
								<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Included files')); ?></label>
						<input type="text" name="included_files" value="<?php echo e(old('included_files', $product->included_files ?? null)); ?>" placeholder="...">
					</div>

					<div class="field">
						<label><?php echo e(__('Version')); ?></label>
						<input type="text" name="version" value="<?php echo e(old('version', $product->version ?? null)); ?>" placeholder="...">
					</div>

					<div class="ui hidden divider"></div>

					<div class="field">
						<label><?php echo e(__('Release date')); ?></label>
						<input type="date" name="release_date" value="<?php echo e(old('release_date', $product->release_date ?? null)); ?>" placeholder="...">
					</div>

					<div class="ui hidden divider"></div>

					<div class="field">
						<label><?php echo e(__('Latest update')); ?></label>
						<input type="date" name="last_update" value="<?php echo e(old('last_update', $product->last_update ?? null)); ?>" placeholder="...">
					</div>

					<div class="field">
						<label><?php echo e(__('Authors')); ?></label>
						<input type="text" name="authors" value="<?php echo e(old('authors', $product->authors ?? null)); ?>">
					</div>
					
					<div class="field">
						<label><?php echo e(__('Tags')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></label>
						<input type="text" name="tags" value="<?php echo e(old('tags', $product->tags ?? null)); ?>" placeholder="...">
					</div>

					<div class="field">
						<label><?php echo e(__('Preview link')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></label>
						<input type="text" name="preview_url" class="d-block" placeholder="https://..." value="<?php echo e(old('preview_url', $product->preview_url ?? null)); ?>">
					</div>

					<div class="ui hidden divider"></div>

					<div class="field">
						<label><?php echo e(__('Quantity in stock')); ?></label>
						<input type="number" name="stock" value="<?php echo e(old('stock', $product->stock ?? null)); ?>">
						<small><i class="circular exclamation small red icon"></i><?php echo e(__('Leave empty if not applicable.')); ?></small>
					</div>

					<div class="ui hidden divider"></div>

					<div class="field">
						<label><?php echo e(__('Enable license')); ?></label>
						<div class="ui floating selection dropdown">
							<input type="hidden" name="enable_license" value="<?php echo e(old('enable_license', $product->enable_license ?? '0')); ?>">
							<div class="text">...</div>
							<div class="menu">
								<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
								<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('Available via subscription only')); ?></label>
						<div class="ui floating selection dropdown">
							<input type="hidden" name="for_subscriptions" value="<?php echo e(old('for_subscriptions', $product->for_subscriptions ?? '0')); ?>">
							<div class="text">...</div>
							<div class="menu">
								<a class="item" data-value="1"><?php echo e(__('Yes')); ?></a>
								<a class="item" data-value="0"><?php echo e(__('No')); ?></a>
							</div>
						</div>
					</div>

					<?php if(config('app.products_by_country_city')): ?>
					<div class="field">
						<label><?php echo e(__('Country')); ?></label>
						<div class="ui floating search selection dropdown countries">
							<input type="hidden" name="country_city[country]" value="<?php echo e(old('country_city.country', $product->country_city->country ?? null)); ?>">
							<div class="text">...</div>
							<div class="menu">
								<a class="item" data-value=""></a>
								<?php $__currentLoopData = config('app.countries_cities'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country => $cities): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<a class="item" data-value="<?php echo e($country); ?>"><?php echo e($country); ?></a>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
					</div>

					<div class="field">
						<label><?php echo e(__('City')); ?></label>
						<div class="ui floating search selection dropdown cities">
							<input type="hidden" name="country_city[city]" value="<?php echo e(old('country_city.city', $product->country_city->city ?? null)); ?>">
							<div class="text">...</div>
							<div class="menu"></div>
						</div>
					</div>
					<?php endif; ?>

					<div class="files">
						<p class="m-0 bold"><?php echo e(__('Files')); ?></p>

						<div class="ui four stackable doubling cards">
							<div class="fluid card">
								<div class="content">
									<div class="header"><?php echo e(__('Main file')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></div>
								</div>
								<div class="content">
									<input type="hidden" name="file_host" :value="selectedDrive" class="d-none">
									<input type="hidden" name="file_name" :value="fileId" class="d-none">

									<div v-if="oldUploads.download.length" class="ui fluid large pink label">
										<?php echo e($download); ?>

										<i class="close icon ml-auto mr-0" @click="deleteExistingFile('<?php echo e("storage/app/downloads/{$download}"); ?>', 'download')"></i>
									</div>

									<div v-else-if="fileId">
										<div class="ui red fluid label circular-corner">
											{{ fileId }}
											<i class="close icon ml-auto mr-0" @click="removeSelectedFile"></i>	
										</div>
									</div>

									<div class="w-100" v-else>
										<div v-if="hasProgress('download')">
											<div v-if="uploadInProgress('download')">
												<progress :value="ajaxRequests.cover.progress" max="100"></progress>
												<a  v-if="!finishedUploading('download')" class="ui mini red button circular mb-1-hf" @click="abortUpload('download')"><?php echo e(__('Abort upload')); ?></a>
											</div>

											<div class="ui fluid large pink label mb-1" v-else>
												{{ ajaxRequests.download.file_name }}
												<i class="close icon ml-auto mr-0" @click="removeUploadedFile('download')"></i>
											</div>
										</div>

										<div class="ui floating circular fluid dropdown large blue basic button mx-0 files" :class="{disabled: inputIsOff('download') || fileId}">
											<div class="text d-block center aligned"><?php echo e(__('Browse')); ?></div>
											<div class="menu">
												<a class="item" @click="browserMainFile('local')"><?php echo e(__('Default')); ?></a>

												<?php if(config('filehosts.amazon_s3.enabled') && !isFolderProcess()): ?>
												<div class="item" @click="browserMainFile('amazon_s3')"><?php echo e(__('Amazon S3')); ?></div>
												<?php endif; ?>

												

												<?php if(config('filehosts.google_drive.enabled')): ?>
												<div class="item" @click="browserMainFile('google')"><?php echo e(__('Google Drive')); ?></div>
												<?php endif; ?>

												<?php if(config('filehosts.wasabi.enabled') && !isFolderProcess()): ?>
												<div class="item" @click="browserMainFile('wasabi')"><?php echo e(__('Wasabi')); ?></div>
												<?php endif; ?>

												<?php if(config('filehosts.dropbox.enabled')): ?>
												<div class="item" @click="browserMainFile('dropbox')"><?php echo e(__('DropBox')); ?></div>
												<?php endif; ?>

												<?php if(config('filehosts.yandex.enabled') && !isFolderProcess()): ?>
												<div class="item" @click="browserMainFile('yandex')"><?php echo e(__('Yandex')); ?></div>
												<?php endif; ?>

												<div class="item" @click="browserMainFile('main_file_upload_link')"><?php echo e(__('Upload link')); ?></div>
												
												<?php if(!isFolderProcess()): ?>
												<div class="item" @click="browserMainFile('main_file_download_link')"><?php echo e(__('Download link')); ?></div>
												<?php endif; ?>
											</div>
										</div>

										<input type="url" name="main_file_upload_link" :class="{disabled: inputIsOff('download')}" placeholder="<?php echo e(__('Upload link')); ?>" value="<?php echo e(old('main_file_upload_link')); ?>"  @change="setDefaultDrive" class="mt-1">

										<?php if(!isFolderProcess()): ?>
										<input type="url" name="main_file_download_link" :class="{disabled: inputIsOff('download')}" class="mt-1 <?php echo e(old('main_file_download_link', $product->direct_download_link) ? 'active' : ''); ?>" placeholder="<?php echo e(__('Download link')); ?>" value="<?php echo e(old('main_file_download_link', $product->direct_download_link)); ?>"  @change="setDefaultDrive">
										<?php endif; ?>
									</div>
								</div>
							</div>

							<div class="fluid card">
								<div class="content">
									<div class="header"><?php echo e(__('Cover')); ?> <sup>(<?php echo e(__('Required')); ?>)</sup></div>
								</div>
								<div class="content">
									<div v-if="oldUploads.cover.length">
										<div class="image position-relative">
									  	<i class="close circular icon ml-auto link mr-0" @click="deleteExistingFile('<?php echo e("public/storage/covers/{$cover}"); ?>', 'cover')"></i>
									    <?php if($cover): ?>
											<img src="<?php echo e(asset_("storage/covers/{$cover}")); ?>">
											<?php endif; ?>
									  </div>
									</div>
									<div v-else>
										<div v-if="hasProgress('cover')">
											<div v-if="uploadInProgress('cover')">
												<progress :value="ajaxRequests.cover.progress" max="100"></progress>
												<a  v-if="!finishedUploading('cover')" class="ui mini red button circular mb-1-hf" @click="abortUpload('cover')"><?php echo e(__('Abort upload')); ?></a>
											</div>

											<div class="ui fluid large pink label mb-1" v-else>
												{{ ajaxRequests.cover.file_name }}
												<i class="close icon ml-auto mr-0" @click="removeUploadedFile('cover')"></i>
											</div>
										</div>
										<button class="ui basic large circular blue fluid button" type="button" :class="{disabled: inputIsOff('cover')}" @click="selectFile('cover')"><?php echo e(__('Browse')); ?></button>
									</div>
								</div>
							</div>

							<div class="fluid card">
								<div class="content">
									<div class="header"><?php echo e(__('Screenshots')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></div>
								</div>

								<div class="content">
									<div class="w-100" v-if="oldUploads.screenshots.length">
										<?php if($screenshots): ?>
											<div class="ui fluid pink large label">
												<?php echo e($screenshots); ?>

												<i class="close icon ml-auto mr-0" @click="deleteExistingFile('<?php echo e("public/storage/screenshots/{$screenshots}"); ?>', 'screenshots')"></i>
											</div>						
										<?php else: ?>
											<div class="screenshots w-100">
												<?php $__currentLoopData = $screenshots_files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $screenshot_file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<div class="image position-relative" style="background-image: url('<?php echo e(asset_("storage/screenshots/{$screenshot_file}")); ?>')">
													<i class="close circular icon ml-auto link mr-0" @click="deleteScreenshot($event, '<?php echo e("public/storage/screenshots/{$screenshot_file}"); ?>')"></i>
												</div>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
											</div>
										<?php endif; ?>
									</div>

									<div class="w-100" v-else>
										<div class="w-100" v-if="hasProgress('screenshots')">
											<div v-if="uploadInProgress('screenshots')">
												<progress :value="ajaxRequests.screenshots.progress" max="100"></progress>
												<a  v-if="!finishedUploading('screenshots')" class="ui mini red button circular mb-1-hf" @click="abortUpload('screenshots')"><?php echo e(__('Abort upload')); ?></a>
											</div>

											<div class="ui fluid large pink label mb-1" v-else>
												{{ ajaxRequests.screenshots.file_name }}
												<i class="close icon ml-auto mr-0" @click="removeUploadedFile('screenshots')"></i>
											</div>
										</div>

										<button class="ui basic large circular blue fluid button" :class="{disabled: inputIsOff('screenshots')}" type="button" @click="selectFile('screenshots')"><?php echo e(__('Browse')); ?></button>
									</div>
								</div>
							</div>

							<div class="fluid card">
								<div class="content">
									<div class="header"><?php echo e(__('Preview')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></div>
								</div>

								<div class="content">
									<div v-if="oldUploads.preview.length">
										<div class="ui fluid large pink label">
											<?php echo e($preview); ?>

											<i class="close icon ml-auto mr-0" @click="deleteExistingFile('<?php echo e("public/storage/previews/{$preview}"); ?>', 'preview')"></i>
										</div>	
									</div>
									<div class="w-100" v-else>
										<div v-if="hasProgress('preview')">
											<div v-if="uploadInProgress('preview')">
												<progress :value="ajaxRequests.preview.progress" max="100"></progress>
												<a  v-if="!finishedUploading('preview')" class="ui mini red button circular mb-1-hf" @click="abortUpload('preview')"><?php echo e(__('Abort upload')); ?></a>
											</div>

											<div class="ui fluid large pink label mb-1" v-else>
												{{ ajaxRequests.preview.file_name }}
												<i class="close icon ml-auto mr-0" @click="removeUploadedFile('preview')"></i>
											</div>
										</div>

										<div class="ui floating circular fluid dropdown preview large blue basic button mx-0" :class="{disabled: inputIsOff('preview')}">
											<div class="text d-block center aligned"><?php echo e(__('Browse')); ?></div>
											<div class="menu">
												<a class="item" @click="browsePreviewFile('preview')"><?php echo e(__('Default')); ?></a>
												<a class="item" @click="browsePreviewFile('preview_upload_link')"><?php echo e(__('Upload link')); ?></a>
												<a class="item" @click="browsePreviewFile('preview_direct_link')"><?php echo e(__('Direct link')); ?></a>
											</div>
										</div>

										<input type="url" name="preview_upload_link" :class="{disabled: inputIsOff('preview')}" placeholder="<?php echo e(__('Upload link')); ?>" value="<?php echo e(old('preview_upload_link')); ?>" class="mt-1">

										<input type="url" name="preview_direct_link" :class="{disabled: inputIsOff('preview')}" placeholder="<?php echo e(__('Direct link')); ?>" value="<?php echo e(old('preview_direct_link', $product->preview_direct_link)); ?>" class="mt-1 <?php echo e(old('preview_direct_link', $product->preview_direct_link) ? 'active' : ''); ?>">

										<div class="ui floating circular fluid dropdown large blue basic button mt-1">
											<input type="hidden" name="preview_type" value="<?php echo e(old('preview_type', $product->preview_type ?? null)); ?>">
											<div class="text">...</div>
											<div class="menu">
												<div class="item" data-value="audio"><?php echo e(__('Audio')); ?></div>
												<div class="item" data-value="video"><?php echo e(__('Video')); ?></div>
												<div class="item" data-value="zip"><?php echo e(__('Zip')); ?></div>
												<div class="item" data-value="pdf"><?php echo e(__('PDF')); ?></div>
												<div class="item" data-value="other"><?php echo e(__('Other')); ?></div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
			  </div>

			  <div class="ui tab segment" data-tab="description">
					<textarea name="overview" class="summernote"><?php echo e(old('overview', $product->overview)); ?></textarea>
			  </div>

			  <div class="ui tab segment" data-tab="hidden-content">
					<textarea name="hidden_content" class="summernote"><?php echo e(old('hidden_content', $product->hidden_content ?? null)); ?></textarea>
			  </div>

			  <div class="ui tab segment" data-tab="pricing">
			  	<?php $__currentLoopData = config('licenses') ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item_type => $licenses): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  	<div class="table wrapper licenses <?php echo e($item_type); ?>" v-if="'<?php echo e($item_type); ?>' === itemType">
				  	<table class="ui basic table unstackable w-100">
					  	<?php $__currentLoopData = $licenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $license): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					  	<tr>
					  		<td class="three columns wide"><strong><?php echo e(__($license->name)); ?></strong></td>
					  		<td>
					  			<input type="number" name="license[price][<?php echo e($license->id); ?>]" step="0.01" placeholder="<?php echo e(__('Default price')); ?>" value="<?php echo e(old("license.price[$license->id]", $product_prices[$license->id]['price'] ?? null)); ?>">
					  		</td>
					  		<td>
					  			<input type="number" name="license[promo_price][<?php echo e($license->id); ?>]" step="0.01" placeholder="<?php echo e(__('Promo price')); ?>" value="<?php echo e(old("license.promo_price[$license->id]", $product_prices[$license->id]['promo_price'] ?? null)); ?>">
					  		</td>
					  	</tr>
					  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					  </table>
				  </div>
			  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			  	<div class="table wrapper free">
				  	<table class="ui basic table unstackable w-100">
					  	<tr>
					  		<td class="three columns wide"><strong><?php echo e(__('Minimum price')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></strong></td>
					  		<td><input type="number" step="0.0001" name="minimum_price" value="<?php echo e(old('minimum_price', $product->minimum_price ?? null)); ?>"></td>
					  	</tr>
					  </table>
				  </div>

			  	<div class="table wrapper free">
				  	<table class="ui basic table unstackable w-100">
					  	<tr>
					  		<td class="three columns wide"><strong><?php echo e(__('Free')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></strong></td>
					  		<td><input type="text" name="free[from]" value="<?php echo e(old('free.from', $product->free->from ?? null)); ?>" placeholder="<?php echo e(__('From')); ?> : YYYY-MM-DD"></td>
					  		<td><input type="text" name="free[to]" value="<?php echo e(old('free.to', $product->free->to ?? null)); ?>" placeholder="<?php echo e(__('To')); ?> : YYYY-MM-DD"></td>
					  	</tr>
					  </table>
				  </div>

				  <div class="table wrapper promo_price">
				  	<table class="ui basic table unstackable w-100">
					  	<tr>
					  		<td class="three columns wide"><strong><?php echo e(__('Promotional price')); ?> <sup>(<?php echo e(__('Optional')); ?>)</sup></strong></td>
					  		<td><input type="text" name="promotional_price_time[from]" value="<?php echo e(old('promotional_price_time.from', $product->promotional_price_time->from ?? null)); ?>" placeholder="<?php echo e(__('From')); ?> : YYYY-MM-DD"></td>
					  		<td><input type="text" name="promotional_price_time[to]" value="<?php echo e(old('promotional_price_time.to', $product->promotional_price_time->to ?? null)); ?>" placeholder="<?php echo e(__('To')); ?> : YYYY-MM-DD"></td>
					  	</tr>
					  </table>
				  </div>
			  </div>

			  <div class="ui tab segment" data-tab="table-of-contents">
			    <table class="ui celled unstackable single line table" 
						 		   data-dict='{"Header": "<?php echo e(__('Header')); ?>", "Type": "<?php echo e(__('Type')); ?>", "Subheader": "<?php echo e(__('Subheader')); ?>", "Sub-Subheader": "<?php echo e(__('Sub-Subheader')); ?>", "Add": "<?php echo e(__('Add')); ?>", "Remove": "<?php echo e(__('Remove')); ?>"}'>
						<thead>
							<tr>
								<th class="left aligned"><?php echo e(__('Type')); ?></th>
								<th class="left aligned"><?php echo e(__('Text')); ?></th>
								<th class="center aligned"><?php echo e(__('Action')); ?></th>
							</tr>
						</thead>

						<tbody>
							<?php if(old('text_type', $product->text_type ?? null)): ?>
							
							<?php $__currentLoopData = old('text_type', $product->text_type ?? null); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $text_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td>
									<div class="ui floating circular fluid dropdown large basic button mx-0">
										<input type="hidden" name="text_type[<?php echo e($key); ?>]" value="<?php echo e($text_type); ?>" class="toc-type">
										<span class="default text"><?php echo e(__('Type')); ?></span>
										<i class="dropdown icon"></i>
										<div class="menu">
											<a class="item" data-value="header"><?php echo e(__('Header')); ?></a>
											<a class="item" data-value="subheader"><?php echo e(__('Subheader')); ?></a>
											<a class="item" data-value="subsubheader"><?php echo e(__('Sub-Subheader')); ?></a>
										</div>
									</div>
								</td>
								<td class="ten column wide right aligned">
									<input type="text" name="text[<?php echo e($key); ?>]" placeholder="..." value="<?php echo e(old('text', $product->text ?? null)[$key] ?? ''); ?>" class="toc-text">
								</td>
								<td class="two column wide center aligned actions">
									<i class="times grey circle big icon link" data-action="remove" title="<?php echo e(__('Remove')); ?>"></i>
									<i class="plus blue circle big icon link mx-0" data-action="add" title="<?php echo e(__('Add')); ?>"></i>
								</td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<?php else: ?>

							<tr>
								<td>
									<div class="ui floating circular fluid dropdown large basic button mx-0">
										<input type="hidden" name="text_type[0]" class="toc-type">
										<span class="default text"><?php echo e(__('Type')); ?></span>
										<i class="dropdown icon"></i>
										<div class="menu">
											<a class="item" data-value="header"><?php echo e(__('Header')); ?></a>
											<a class="item" data-value="subheader"><?php echo e(__('Subheader')); ?></a>
											<a class="item" data-value="subsubheader"><?php echo e(__('Sub-Subheader')); ?></a>
										</div>
									</div>
								</td>
								<td class="ten column wide right aligned">
									<input type="text" name="text[0]" placeholder="..." class="toc-text">
								</td>
								<td class="two column wide center aligned actions">
									<i class="times grey circle big icon link" data-action="remove" title="<?php echo e(__('Remove')); ?>"></i>
									<i class="plus blue circle big icon link mx-0" data-action="add" title="<?php echo e(__('Add')); ?>"></i>
								</td>
							</tr>

							<?php endif; ?>
						</tbody>
					</table>
			  </div>

			  <div class="ui tab segment" data-tab="faq" data-dict='{"Question": "<?php echo e(__('Question')); ?>", "Answer": "<?php echo e(__('Answer')); ?>", "Remove": "<?php echo e(__('Remove')); ?>", "Add": "<?php echo e(__('Add')); ?>"}'>
						<?php if(old('question', $product->question ?? null) && old('answer', $product->answer ?? null)): ?>

							<?php $__currentLoopData = old('question', $product->question ?? []) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $qa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="ui segment">
									<div class="field">
										<label><?php echo e(__('Question')); ?></label>
										<input type="text" name="question[<?php echo e($k); ?>]" class="faq-question" placeholder="..." value="<?php echo e($qa); ?>">
									</div>
									<div class="field">
										<label><?php echo e(__('Answer')); ?></label>
										<textarea name="answer[<?php echo e($k); ?>]" cols="30" rows="3" class="faq-answer" placeholder="..."><?php echo e(old('answer')[$k] ?? $product->answer[$k] ?? ''); ?></textarea>
									</div>
									<div class="actions right aligned">
										<i class="times grey circle big icon link" data-action="remove" title="<?php echo e(__('Remove')); ?>"></i>
										<i class="plus blue circle big icon link mx-0" data-action="add" title="<?php echo e(__('Add')); ?>"></i>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						<?php else: ?>

						<div class="ui segment">
							<div class="field">
								<label><?php echo e(__('Question')); ?></label>
								<input type="text" name="question[0]" class="faq-question" placeholder="...">
							</div>
							<div class="field">
								<label><?php echo e(__('Answer')); ?></label>
								<textarea name="answer[0]" cols="30" rows="3" class="faq-answer" placeholder="..."></textarea>
							</div>
							<div class="actions right aligned">
								<i class="times grey circle big icon link" data-action="remove" title="<?php echo e(__('Remove')); ?>"></i>
								<i class="plus blue circle big icon link mx-0" data-action="add" title="<?php echo e(__('Add')); ?>"></i>
							</div>
						</div>

						<?php endif; ?>
				</div>

				<div class="ui tab segment" data-tab="additional-fields" data-dict='{"Name": "<?php echo e(__('Name')); ?>", "Value": "<?php echo e(__('Value')); ?>", "Remove": "<?php echo e(__('Remove')); ?>", "Add": "<?php echo e(__('Add')); ?>"}'>
					<?php if(old('_name_', $product->_name_ ?? null) && old('_value_', $product->_value_ ?? null)): ?>

							<?php $__currentLoopData = old('_name_', $product->_name_ ?? []) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $na): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="ui segment">
									<div class="two fields">
										<div class="three columns wide field">
											<label><?php echo e(__('Name')); ?></label>
											<input type="text" name="_name_[<?php echo e($k); ?>]" class="addtional-info-name" placeholder="..." value="<?php echo e($na); ?>">
										</div>
										<div class="thirteen columns wide field">
											<label><?php echo e(__('Value')); ?></label>
											<input type="text" name="_value_[<?php echo e($k); ?>]" class="addtional-info-value" placeholder="..." value="<?php echo e(old('value')[$k] ?? $product->_value_[$k] ?? ''); ?>">
										</div>
									</div>
									<div class="actions right aligned">
										<i class="times grey circle big icon link" data-action="remove" title="<?php echo e(__('Remove')); ?>"></i>
										<i class="plus blue circle big icon link mx-0" data-action="add" title="<?php echo e(__('Add')); ?>"></i>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						<?php else: ?>

						<div class="ui segment">
							<div class="two fields">
								<div class="three columns wide field">
									<label><?php echo e(__('Name')); ?></label>
									<input type="text" name="_name_[0]" class="addtional-info-name" placeholder="...">
								</div>
								<div class="thirteen columns wide field">
									<label><?php echo e(__('Value')); ?></label>
									<input type="text" name="_value_[0]" class="addtional-info-value" placeholder="...">
								</div>
							</div>
							<div class="actions right aligned">
								<i class="times grey circle big icon link" data-action="remove" title="<?php echo e(__('Remove')); ?>"></i>
								<i class="plus blue circle big icon link mx-0" data-action="add" title="<?php echo e(__('Add')); ?>"></i>
							</div>
						</div>

						<?php endif; ?>
				</div>
			</div>

			<div class="ui modal" id="files-list">
				<div class="content head p-1">
					<h3>{{ drivesTitles[selectedDrive] }}</h3>
					
					<div class="ui icon input" v-if="!/yandex|amazon_s3|wasabi/.test(selectedDrive)">
					  <input type="text" placeholder="<?php echo e(__('Folder')); ?>..." v-model="parentFolder" spellcheck="false">
					  <i class="paper plane outline link icon" @click="setFolder"></i>
					</div>
				</div>

				<div class="content body" v-if="selectedDrive">
					<div class="ui six cards">

						<a href="javascript:void(0)" 
							 class="ui card" 
							 v-for="item in mainFilesList[selectedDrive]" 
							 :title="item.name"
							 @click="setSelectedFile(item.id)">
							<div class="image">
						    <img :src="getFileExtension(item)">
						  </div>
						  <div class="content p-0">
						  	<h4 class="header">
						  		{{ item.name }}
						  	</h4>
						  </div>
						</a>

					</div>
				</div>

				<div class="actions">
					<div class="ui icon input large">
					  <input type="text" placeholder="<?php echo e(__('Search')); ?>..." v-model="searchFile" spellcheck="false">
					  <i class="search link icon" @click="searchFiles"></i>
					</div>

					<button v-if="googleDriveNextPageToken && selectedDrive === 'google'" 
									class="ui blue large circular button" 
									type="button"
									@click="googleDriveLoadMore($event)">
						<?php echo e(__('Load more files')); ?>

					</button>

					<button v-if="amazonS3Marker && selectedDrive === 'amazon_s3'" 
									class="ui blue large circular button" 
									type="button"
									@click="amazonS3LoadMore($event)">
						<?php echo e(__('Load more files')); ?>

					</button>

					<button v-if="wasabiMarker && selectedDrive === 'wasabi'" 
									class="ui blue large circular button" 
									type="button"
									@click="wasabiLoadMore($event)">
						<?php echo e(__('Load more files')); ?>

					</button>

					<button v-if="oneDriveNextLink && selectedDrive === 'onedrive'" 
									class="ui blue large circular button" 
									type="button"
									@click="oneDriveLoadMore($event)">
						<?php echo e(__('Load more files')); ?>

					</button>

					<button v-if="dropBoxCursor && selectedDrive === 'dropbox'" 
									class="ui blue large circular button"
									type="button"
									@click="dropBoxDriveLoadMore($event)">
						<?php echo e(__('Load more files')); ?>

					</button>

					<button v-if="yandexDiskOffset && selectedDrive === 'yandex'" 
									class="ui blue large circular button"
									type="button"
									@click="yandexDiskLoadMore($event)">
						<?php echo e(__('Load more files')); ?>

					</button>

					<button class="ui yellow large circular button"type="button" @click="closeDriveModal"><?php echo e(__('Close')); ?></button>
				</div>
			</div>
		</div>
	</form>
	
	<form>
		<input type="file" name="download" data-destination="downloads" @change="uploadFileAsync" class="d-none" accept=".zip,.rar,.7z">
	</form>

	<form>
		<input type="file" name="preview" :accept="inputFileType()" data-destination="previews" @change="uploadFileAsync" class="d-none">
	</form>

	<form>
		<input type="file" name="cover" data-destination="covers" @change="uploadFileAsync" class="d-none" accept="image/*" >
	</form>

	<form>
		<input type="file" name="screenshots" data-destination="screenshots" @change="uploadFileAsync" class="d-none" accept=".zip">
	</form>

	<div id="wavesurfer" class="d-none"></div>

	<div class="ui inverted dimmer"><div class="ui text loader"><?php echo e(__('Generating and caching audio wave')); ?></div></div>
</div>

<script type="application/javascript">
	'use strict';

	

	var app = new Vue({
  	el: '#product',
  	data: {
  		mainFilesList: {google: [], amazon_s3: [], onedrive: [], dropbox: [], yandex: [], wasabi: []},
  		selectedDrive: '<?php echo e(old('file_host', $product->file_host ?? 'local')); ?>',
  		googleDriveNextPageToken: null,
  		dropBoxCursor: null,
  		oneDriveNextLink: null,
  		yandexDiskOffset: null,
  		amazonS3Marker: null,
  		wasabiMarker: null,
  		drivePageSize: 20,
  		drivesTitles: {google: 'Google Drive', amazon_s3: 'Amazon S3', onedrive: 'OneDrive', dropbox: 'DropBox', yandex: 'Yandex Disk', wasabi: 'Wasabi'},
  		searchFile: null,
  		parentFolder: null,
  		fileId: '<?php echo old('file_name', $product->file_host !== 'local' ? $product->file_name : null); ?>',
  		localFileName: '',
  		itemType: '<?php echo e(old('type', $product->type ?? config('app.default_product_type') ?? '-')); ?>',
  		freeForLimitedTime: true,
  		ajaxRequests: {
  			download: {}, 
  			cover: {}, 
  			screenshots: {}, 
  			preview: {}
  		},
  		oldUploads: {
  			download: "<?php echo e($download); ?>", 
  			cover: "<?php echo e($cover); ?>", 
  			screenshots: "<?php echo e($screenshots ?? ($screenshots_files ? implode(',', $screenshots_files) : '')); ?>",
  			preview: "<?php echo e($preview); ?>"
  		}
  	},
  	methods: {
  		browsePreviewFile: function(from)
  		{
  			$('input[name="preview_upload_link"], input[name="preview_direct_link"]').hide().removeClass('active');

  			if(from === 'preview')
  			{
  				$('input[name="preview"]').click();
  			}
  			else
  			{
  				$('input[name="'+from+'"]').show();
  			}
  		},
  		browserMainFile: function(from)
  		{
  			if(from === 'local')
  			{  				
  				$('input[name="download"]').click();
  			}
  			else if(from === 'google')
  			{
  				this.googleDriveInit();
  			}
  			else if(from === 'amazon_s3')
  			{
  				this.amazonS3Init();
  			}
  			else if(from === 'wasabi')
  			{
  				this.wasabiInit();
  			}
  			else if(from === 'onedrive')
  			{
  				this.oneDriveInit();
  			}
  			else if(from === 'dropbox')
  			{
  				this.dropboxDriveInit();
  			}
  			else if(from === 'yandex')
  			{
  				this.yandexDiskInit();
  			}

  			if(!/^main_file_(upload|download)_link$/i.test(from))
  			{
  				this.selectedDrive = from;
  			}
  			else
  			{
  				$('input[name="'+from+'"]').show();
  			}

  			if(/^(google|amazon_s3|oneDrive|dropbox|yandex|wasabi)$/i.test(from))
  			{
  				$('#files-list').modal('show')
  			}
  		},
  		googleDriveLoadMore: function(e)
  		{
  			var e = e;

  			e.target.disabled = true;

  			if(this.googleDriveNextPageToken)
  			{
  				var payload = {
  					'files_host': 'GoogleDrive', 
						'page_size': this.drivePageSize, 
						'nextPageToken': this.googleDriveNextPageToken,
						'is_dir': $('input[name="is_dir"]').val().trim() || 0,
					};

  				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
  				.done(function(res)
  				{
  					if(!res.files_list)
  						return;

						app.googleDriveNextPageToken = res.files_list.nextPageToken || null;
  					
  					e.target.disabled = app.googleDriveNextPageToken ? false : true;

  					Vue.set(app.mainFilesList, 'google', 
  								  app.mainFilesList.google.concat(res.files_list.files || []));
  				})
  			}
  		},
  		amazonS3LoadMore: function(e)
  		{
  			var e = e;

  			e.target.disabled = true;

  			if(this.amazonS3Marker)
  			{
  				var payload = {
  					'files_host': 'AmazonS3', 
						'page_size': this.drivePageSize, 
						'marker': this.amazonS3Marker
					};

  				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
  				.done(function(res)
  				{
  					if(!res.files_list)
  						return;

						app.amazonS3Marker = res.files_list.marker || null;
  					e.target.disabled = res.files_list.has_more ? false : true;

  					Vue.set(app.mainFilesList, 'amazon_s3', 
  								  app.mainFilesList.amazon_s3.concat(res.files_list.files || []));
  				})
  			}
  		},
  		wasabiLoadMore: function(e)
  		{
  			var e = e;

  			e.target.disabled = true;

  			if(this.wasabiMarker)
  			{
  				var payload = {
  					'files_host': 'Wasabi', 
						'page_size': this.drivePageSize, 
						'marker': this.wasabiMarker
					};

  				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
  				.done(function(res)
  				{
  					if(!res.files_list)
  						return;

						app.wasabiMarker = res.files_list.marker || null;
  					e.target.disabled = res.files_list.has_more ? false : true;

  					Vue.set(app.mainFilesList, 'wasabi', 
  								  app.mainFilesList.wasabi.concat(res.files_list.files || []));
  				})
  			}
  		},
  		oneDriveLoadMore: function(e)
  		{
  			var e = e;

  			e.target.disabled = true;

  			if(this.oneDriveNextLink)
  			{
  				var payload = {
  					'files_host': 'OneDrive', 
						'page_size': this.drivePageSize, 
						'nextLink': this.oneDriveNextLink
					};

  				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
  				.done(function(res)
  				{
  					if(!res.files_list)
  						return;

						app.oneDriveNextLink = res.files_list.nextLink || null;
  					
  					e.target.disabled = app.oneDriveNextLink ? false : true;

  					Vue.set(app.mainFilesList, 'onedrive', 
  								  app.mainFilesList.onedrive.concat(res.files_list.files || []));
  				})
  			}
  		},
  		dropBoxDriveLoadMore: function(e)
  		{
  			var e = e;

  			e.target.disabled = true;

  			var payload = {
  				'files_host': 'DropBox', 
	  			'cursor': this.dropBoxCursor, 
	  			'limit': this.drivePageSize,
	  			'is_dir': $('input[name="is_dir"]').val().trim() || 0,
	  		};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					if(!res.files_list)
						return;

					app.dropBoxCursor = res.files_list.has_more ? res.files_list.cursor : null;

					e.target.disabled = res.files_list.has_more ? false : true;

					Vue.set(app.mainFilesList, 'dropbox', 
  								app.mainFilesList.dropbox.concat(res.files_list.files || []));
				})
  		},
  		yandexDiskLoadMore: function(e)
  		{
  			var e = e;

  			e.target.disabled = true;

  			var payload = {
  				'files_host': 'YandexDisk', 
	  			'offset': this.yandexDiskOffset, 
	  			'limit': this.drivePageSize
	  		};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					if(!res.files_list)
						return;

					app.yandexDiskOffset = res.files_list.offset;

					e.target.disabled = app.yandexDiskOffset === null;

					Vue.set(app.mainFilesList, 'yandex', 
  								app.mainFilesList.yandex.concat(res.files_list.items || []));
				})
  		},
  		setFolder: function()
  		{
  			if(this.selectedDrive === 'google')
  			{  				
  				this.googleDriveInit();
  			}
  			else if(this.selectedDrive === 'amazon_s3')
  			{
  				this.amazonS3Init();
  			}
  			else if(this.selectedDrive === 'wasabi')
  			{
  				this.wasabiInit();
  			}
  			else if(this.selectedDrive === 'onedrive')
  			{
  				this.oneDriveInit();
  			}
  			else if(this.selectedDrive === 'dropbox')
  			{
  				this.dropboxDriveInit();
  			}
  		},
  		googleDriveInit: function()
  		{
				var payload = {
					'files_host': 'GoogleDrive', 
					'page_size': this.drivePageSize, 
					'parent': this.parentFolder,
					'keyword': this.searchFile,
					'is_dir': $('input[name="is_dir"]').val().trim() || 0,
				};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					try
					{
						if(!res.files_list.files.length || null)
						{
							Vue.set(app.mainFilesList, 'google', []);
							return;
						}	
					}
					catch(error){}

					app.googleDriveNextPageToken = res.files_list.nextPageToken || null;
					
					Vue.set(app.mainFilesList, 'google', res.files_list.files);
				})
  		},
  		amazonS3Init: function()
  		{
				var payload = {
					'files_host': 'AmazonS3', 
					'page_size': this.drivePageSize, 
					'parent': this.parentFolder,
					'keyword': this.searchFile
				};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					try
					{
						if(!res.files_list.files.length || null)
						{
							Vue.set(app.mainFilesList, 'amazon_s3', []);
							return;
						}	
					}
					catch(error){}

					app.amazonS3Marker = res.files_list.marker || null;
					
					Vue.set(app.mainFilesList, 'amazon_s3', res.files_list.files);
				})
  		},
  		wasabiInit: function()
  		{
				var payload = {
					'files_host': 'Wasabi', 
					'page_size': this.drivePageSize, 
					'parent': this.parentFolder,
					'keyword': this.searchFile
				};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					try
					{
						if(!res.files_list.files.length || null)
						{
							Vue.set(app.mainFilesList, 'wasabi', []);
							return;
						}	
					}
					catch(error){}

					app.wasabiMarker = res.files_list.marker || null;
					
					Vue.set(app.mainFilesList, 'wasabi', res.files_list.files);
				})
  		},
  		oneDriveInit: function()
  		{
				var payload = {
					'files_host': 'OneDrive', 
					'page_size': this.drivePageSize, 
					'folder': this.parentFolder,
					'keyword': this.searchFile
				};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					try
					{
						if(!res.files_list.files.length || null)
						{
							Vue.set(app.mainFilesList, 'onedrive', []);
							return;
						}	
					}
					catch(error){}

					app.oneDriveNextLink = res.files_list.nextLink || null;
					
					Vue.set(app.mainFilesList, 'onedrive', res.files_list.files);
				})
  		},
  		dropboxDriveInit: function()
  		{
  			var payload = {
  				'files_host': 'DropBox', 
  				'limit': this.drivePageSize,
  				'path': this.parentFolder,
  				'keyword': this.searchFile,
  				'is_dir': $('input[name="is_dir"]').val().trim() || 0,
  			};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					try
					{
						if(!res.files_list.files.length || null)
						{
							Vue.set(app.mainFilesList, 'dropbox', []);
							return;
						}
					}
					catch(error){}

					app.dropBoxCursor = (res.files_list || {}).hasOwnProperty('has_more') ? res.files_list.cursor : null;
  				
  				Vue.set(app.mainFilesList, 'dropbox', res.files_list.files);
				})
  		},
  		yandexDiskInit: function()
  		{
  			var payload = {
  				'files_host': 'YandexDisk', 
  				'limit': this.drivePageSize,
  				'keyword': this.searchFile
  			};

				$.post('<?php echo e(route('products.list_files')); ?>', payload, null, 'json')
				.done(function(res)
				{
					try
					{
						if(!res.files_list.items.length || null)
						{
							Vue.set(app.mainFilesList, 'yandex', []);
							return;
						}
					}
					catch(error){}

					app.yandexDiskOffset = (res.files_list.offset > 0) ? res.files_list.offset : null;
  				
  				Vue.set(app.mainFilesList, 'yandex', res.files_list.items);
				})
  		},
  		searchFiles: function()
  		{
  			if(this.selectedDrive === 'google')
  			{  				
  				this.googleDriveInit();
  			}
  			else if(this.selectedDrive === 'amazon_s3')
  			{
  				this.amazonS3Init();
  			}
  			else if(this.selectedDrive === 'wasabi')
  			{
  				this.wasabiInit();
  			}
  			else if(this.selectedDrive === 'onedrive')
  			{  				
  				this.oneDriveInit();
  			}
  			else if(this.selectedDrive === 'dropbox')
  			{
  				this.dropboxDriveInit();
  			}
  			else if(this.selectedDrive === 'yandex')
  			{
  				this.yandexDiskInit();
  			}
  		},
  		setSelectedFile: function(fileId)
  		{
  			this.fileId = fileId;

  			$('#files-list').modal('hide');
  		},
  		removeSelectedFile: function()
  		{
  			this.selectedDrive = '';
  			this.fileId 			 = null;

  			Vue.nextTick(function()
  			{
  				$('.ui.dropdown').dropdown();
  			})
  		},
  		getFileExtension(item)
  		{
  			var baseUrl = '/assets/images/';

  			if(this.selectedDrive === 'dropbox')
  			{
	  			var sufx = item.name.slice(-4);
	  			
	  			if(/\.zip/i.test(sufx))
  					baseUrl += 'zip';
  				else if(/\.rar/i.test(sufx))
  					baseUrl += 'rar';
  				else
  					baseUrl += 'file';
  			}
  			else if(/^oneDrive|google|amazon_s3|wasabi$/i.test(this.selectedDrive))
  			{
  				var mt = item.mimeType;

  				if(/zip/i.test(mt))
  					baseUrl += 'zip';
  				else if(/rar/i.test(mt))
  					baseUrl += 'rar';
  				else
  					baseUrl += 'file';
  			}
  			else if(this.selectedDrive === 'yandex')
  			{
  				var mt = item.mime_type;

  				if(/zip/i.test(mt))
  					baseUrl += 'zip';
  				else if(/rar/i.test(mt))
  					baseUrl += 'rar';
  				else
  					baseUrl += 'file';
  			}

  			return baseUrl + '.png';
  		},
  		closeDriveModal: function()
  		{
  			$('#files-list').modal('hide')
  		},
  		setDefaultDrive: function()
  		{
  			this.selectedDrive = 'local';
  		},
  		selectFile: function(name)
  		{
  			$('input[name="'+name+'"]').click()
  		},
  		previewInput: function(name)
  		{
  			$('input[name^="preview"]').hide();

  			if(name === 'preview')
  			{
  				$('input[name="preview"]').click();
  			}
  			else
  			{
  				$('input[name="'+name+'"]').show();
  			}
  		},
  		abortUpload: function(name)
  		{
  			this.ajaxRequests[name].abort();

  			Vue.set(app.ajaxRequests, name, {});

  			$('input[name="'+name+'"]').closest('form')[0].reset()
  		},
  		removeUploadedFile: function(name)
  		{
  			$.post('<?php echo e(route('products.delete_file_async')); ?>', {path: this.ajaxRequests[name].file_path})
  			.done(function()
  			{
  				$('input[name="'+name+'"]').closest('form')[0].reset();

  				Vue.set(app.ajaxRequests, name, {});
  			})
  			.always(function()
  			{
  				Vue.nextTick(function()
  				{
  					$('.ui.dropdown').dropdown();
  				})
  			})
  		},
  		deleteExistingFile: function(path, name)
  		{
  			$.post('<?php echo e(route('products.delete_file_async')); ?>', {path: path})
  			.done(function()
  			{
  				Vue.set(app.oldUploads, name, '');
  			})
  			.always(function()
  			{
  				Vue.nextTick(function()
  				{
  					$('.ui.dropdown').dropdown();
  				})
  			})
  		},
  		deleteScreenshot: function(e, path)
  		{
  			var _this = $(e.target);

  			$.post('<?php echo e(route('products.delete_file_async')); ?>', {path: path})
  			.done(function()
  			{
  				_this.closest('.image').remove();

  				if($('.screenshots .image').length === 0)
  				{
  					Vue.set(app.oldUploads, 'screenshots', '');
  				}
  			})
  		},
  		uploadFileAsync: function(e)
  		{
  			var file = e.target;
  			var name = file.name;

  			Vue.set(app.ajaxRequests, name, {});

  			var destination = file.getAttribute('data-destination');

  			var formData = new FormData();

				formData.append('file', file.files[0]);
				formData.append('destination', destination);
				formData.append('id', <?php echo e($product->id); ?>)
				formData.append('type', this.itemType);
				
				var ajaxRequests = this.ajaxRequests;
  				
	  		ajaxRequests[name] = $.ajax({
            url: '<?php echo e(route('products.upload_file_async')); ?>',
            xhr: function()
            {
            	var xhr = new window.XMLHttpRequest();

            	Vue.set(app.ajaxRequests[name], 'progress', 0);

            	xhr.upload.addEventListener('progress', function(event)
            	{
            		if(event.lengthComputable)
            		{
            			var complete = Number((event.loaded / event.total) * 100).toFixed();

            			Vue.set(app.ajaxRequests[name], 'progress', complete);
            		}
            	}, false);

            	return xhr;
            },
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function()
            {

            },
            success: function(response)
            {
              if(response.status === 'success')
              { 
              	Vue.set(app.ajaxRequests[name], 'file_name', response.file_name);
              	Vue.set(app.ajaxRequests[name], 'file_path', response.file_path);
              }
            },
            error: function()
            {

            }
        });

        this.ajaxRequests = ajaxRequests;
  		},
  		deleteFileAsync: function(path)
  		{
  			$.post('<?php echo e(route('products.delete_file_async')); ?>', {path: path})
  			.done(function()
  			{
  				
  			})
  		},
  		hasProgress: function(name)
  		{
  			if(this.ajaxRequests.hasOwnProperty(name))
  			{
  				return this.ajaxRequests[name].hasOwnProperty('progress');
  			}
  			
  			return false;
  		},
  		uploadInProgress: function(name)
  		{
  			if(this.hasProgress(name))
  			{
  				var progress = this.ajaxRequests[name].progress;

  				return (progress == 0 || progress <= 100) && !this.ajaxRequests[name].hasOwnProperty('file_name');
  			}

  			return false;
  		},
  		finishedUploading: function(name)
  		{
  			if(this.hasProgress(name))
  			{
  				return this.ajaxRequests[name].progress == 100;
  			}

  			return false;
  		},
  		inputIsOff: function(name)
  		{
  			return this.uploadInProgress(name) || this.finishedUploading(name);
  		},
  		anyInputOff: function()
  		{
  			var inputs = ['download', 'cover', 'screenshots', 'preview'];
  			var app 	 = this;

  			for(var k = 0; k < inputs.length; k++)
  			{
  				if(this.uploadInProgress(inputs[k]))
  					return true;
  			}

  			return false;
  		},
  		setItemType: function(e)
  		{
  			this.itemType = e.target.value;
  		},
  		inputFileType: function()
  		{
  			var types = {
  				'ebook'  	: '.pdf',
  				'audio'  	: '.mp3',
  				'video'  	: '.mp4',
  				'graphic'	: '*',
  				'external_membership': '*',
  				'-'				: '*'
  			};
  			
  			return types[this.itemType] || '*';
  		},
  		setPreviewType: function(val)
  		{
  			var previewType = (val === 'audio') ? 'audio' : (val === 'video') ? 'video' : (val === 'ebook') ? 'pdf' : (val === 'graphic') ? 'zip' : 'other';

  			$('input[name="preview_type"]').val(previewType).closest('.ui.dropdown').dropdown();
  		}
  	},
  	watch: {
  		itemType: function(val)
  		{
  			Vue.nextTick(function()
  			{
  				app.setPreviewType(val);
  			})
  		}
  	},
  	mounted: function()
  	{
  		this.setPreviewType(this.itemType);
  	}
  })


	function savePeaks(previewUrl, filename = null)
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
						$.post("<?php echo e(route('products.save_wave')); ?>", { filename: filename, peaks: res, id: '<?php echo e($product->id); ?>' })
						.always(function()
						{
							$('.ui.inverted.dimmer').toggleClass('active', false);

							$('#submit').click()
						})
					})
	    });

			wSuffer.load(previewUrl);
	}


	function savePeaksFromTempUrl(url)
	{
		$('.ui.inverted.dimmer').toggleClass('active', true);

		$.post('<?php echo e(route('products.get_temp_url')); ?>', {url: url, id: '<?php echo e($product->id); ?>'})
		.done(function(tempUrl)
		{
			savePeaks(tempUrl, tempUrl.split('/').pop());
		})
	}


	$(function()
  {
  	<?php if(config('app.products_by_country_city')): ?>
	  	var countriesCities = <?php echo json_encode(config('app.countries_cities'), 15, 512) ?>;

	  	$('.ui.dropdown.countries').dropdown({
	  		onChange: function(value, text, $choice)
	  		{
	  			if(countriesCities.hasOwnProperty(value))
	  			{
		  			$('.ui.dropdown.cities').dropdown({
		  				values: countriesCities[value].sort().map(function(city)
		  				{
		  					return {value: city, name: city};
		  				}).concat({value: '', name: '&nbsp;'})
		  			})
	  			}
	  		}
	  	})

	  	<?php if($country = old('country_city.country', $product->country_city->country ?? null)): ?>
			$('.ui.dropdown.cities').dropdown({
				values: countriesCities['<?php echo e($country); ?>'].sort().map(function(city)
				{
					return {value: city, name: city};
				}).concat({value: '', name: '&nbsp;'})
			})

			<?php if($city = old('country_city.city', $product->country_city->city ?? null)): ?>
			$('.ui.dropdown.cities').dropdown('set selected', '<?php echo e($city); ?>');
			<?php endif; ?>
	  	<?php endif; ?>
  	<?php endif; ?>

  	$('.summernote').summernote({
	    placeholder: '...',
	    tabsize: 2,
	    height: 350,
	    tooltip: false
	  });


	  $('#product .tabs .menu .item')
	  .tab({
	    context: 'parent'
	  })


		$('input[name="category"]').on('change', function()
		{
			setSubcategories($(this).val());
		})


		function setSubcategories(parentId = null, selectedValues = '')
		{
			var subcategories = <?php echo json_encode($category_children ?? (object)[], 15, 512) ?>;

			if(!isNaN(parentId))
			{
				var values = [];

				if(Object.keys(subcategories).length)
				{
					if(!subcategories.hasOwnProperty(parentId))
						return;

					for(var k in (subcategories[parentId] || []))
					{
						var subcategory = subcategories[parentId][k];

						values.push({name: subcategory.name, value: subcategory.id});
					}	
				}

				$('#subcategories').dropdown('clear').dropdown({values: values});

				if(selectedValues.length)
				{
					$('input[name="subcategories"]').val(selectedValues);
					
					$('#subcategories').dropdown();
				}
			}
		}

		<?php if(old('category', $product->category)): ?>
		{
			setSubcategories(<?php echo e(old('category', $product->category)); ?>, '<?php echo e(old('subcategories', $product->subcategories)); ?>');
		}
		<?php endif; ?>

		$('#files-list').modal({
			closable: false
		})

		$('input[name="download"]').on('change', function()
		{
			app.fileId = null;
			app.localFileName = $(this)[0].files[0].name;
		})

		$('#save').on('click', function(e)
		{			
			if($('input[name="type"]').val() === 'audio')
			{
				var preview_upload_link = $('input[name="preview_upload_link"]').val() || '';
				var preview_direct_link = $('input[name="preview_direct_link"]').val() || '';

				if(preview_upload_link.length || preview_direct_link.length)
				{
					savePeaksFromTempUrl(preview_upload_link.length ? preview_upload_link : preview_direct_link);
				}
				else if($('input[name="preview"]')[0].files.length || 0)
				{
					$('.ui.inverted.dimmer').toggleClass('active', true);

					savePeaks(URL.createObjectURL($('input[name="preview"]')[0].files[0]));
				}
				else
				{
					$('#submit').click()
				}
			}
			else
			{
				$('#submit').click()
			}
		})

		$(document).on('keydown', '#product input', function(e)
		{
			if(e.keyCode == 13)
			{
				e.preventDefault();
				return false;
			}
		})
  })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\products\edit.blade.php ENDPATH**/ ?>