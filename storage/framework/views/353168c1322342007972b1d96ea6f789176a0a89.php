



<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/javascript">
	'use strict';
	window.props['itemId'] = null;
</script>

<?php if(config('payments.guest_checkout')): ?>
<script type="application/javascript" src="<?php echo e(asset_("assets/FileSaver.2.0.4.min.js")); ?>"></script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body'); ?>
<div class="ui shadowless celled one column grid my-0" id="guest">
	<div class="column title rounded-corner">
		<div class="ui big w-100 form">
			<div class="ui action fluid input">
			  <input type="text" spellcheck="false" v-model="guestAccessToken" placeholder="<?php echo e(__('Enter your access token')); ?>">
			  <button class="ui blue button" @click="getGuestDownloads"><?php echo e(__('Submit')); ?></button>
			</div>
		</div>
	</div>

	<div class="column items purchases px-0 mt-1">
		<div class="items-list">
			<div class="titles">
				<div class="cover"><?php echo e(__('Cover')); ?></div>
				<div class="name"><?php echo e(__('Name')); ?></div>
				<div class="category"><?php echo e(__('Category')); ?></div>
				<div class="purchased_at"><?php echo e(__('Purchased at')); ?></div>
				<div class="updated_at"><?php echo e(__('Updated at')); ?></div>
				<div class="updated_at"><?php echo e(__('Download')); ?></div>
			</div>
			
			<div v-if="Object.keys(guestItems).length" class="w-100" v-cloak>
				<div class="content" v-for="item in guestItems">
					<div class="cover">
						<a :href="'/item/' + item.slug + (item.hidden_content ? ('?guest_token=' + guestAccessToken + '#hidden-content') : '')" :style="'background-image: url(/storage/covers/' + item.cover + ')'"></a>
					</div>
					<div class="name">
						<a :href="'/item/' + item.slug + (item.hidden_content ? ('?guest_token=' + guestAccessToken + '#hidden-content') : '')">
							{{ item.name }}
						</a>
					</div>
					<div class="category capitalize">
						<a :href="'/category/' + item.category_slug">{{ item.category_name }}</a>
					</div>
					<div class="purchased_at">{{ item.purchased_at }}</div>
					<div class="updated_at">{{ item.updated_at || '-' }}</div>
					<div class="download">
						<div v-if="item.file_name != null">

							<div v-if="item.is_dir == '1'">
								<div v-if="item.enable_license == '1' || item.key_code != null">
									<div class="ui floating default yellow button large circular dropdown nothing">
										<div class="text"><?php echo e(__('Action')); ?></div>
										<div class="menu">
											<a class="item" :href="'downloads/' + item.id + '/' + item.slug + '?guest_token=' + guestAccessToken"><?php echo e(__('Open Folder')); ?></a>
											<a class="item" v-if="item.enable_license == '1'" @click="downloadLicense(item.id, '#download-license')"><?php echo e(__('License key')); ?></a>
											<a class="item" v-if="item.key_code != null" @click="downloadKey(item)"><?php echo e(__('Key code')); ?></a>
										</div>
									</div>
								</div>
								<div v-else>
									<a class="ui yellow button large circular" :href="'downloads/' + item.id + '/' + item.slug + '?guest_token=' + guestAccessToken">
										<?php echo e(__('Open Folder')); ?>

									</a>
								</div>
							</div>

							<div v-else>
								<div v-if="item.enable_license == '1' || item.key_code != null">
									<div class="ui floating default yellow button large circular dropdown nothing">
										<div class="text"><?php echo e(__('Download')); ?></div>
										<div class="menu">
											<a class="item" @click="downloadItem(item.id)"><?php echo e(__('Files')); ?></a>
											<a class="item" v-if="item.enable_license == '1'" @click="downloadLicense(item.id, '#download-license')"><?php echo e(__('License key')); ?></a>
											<a class="item" v-if="item.key_code != null" @click="downloadKey(item.id)"><?php echo e(__('Key code')); ?></a>
										</div>
									</div>
								</div>
								<div v-else>
									<a class="ui yellow button large circular" @click="downloadItem(item.id)"><?php echo e(__('Download')); ?></a>
								</div>
							</div>
						</div>
						<div v-else>-</div>
					</div>
				</div>
			</div>
		</div>

		<form action="<?php echo e(route('home.guest_download')); ?>" class="d-none" method="post" id="download-form">
			<?php echo csrf_field(); ?>
			<input type="hidden" name="item_id" v-model="itemId">
			<input type="hidden" name="access_token" v-model="guestAccessToken">
		</form>

		<form action="<?php echo e(route('home.download_license')); ?>" class="d-none" method="post" id="download-license">
			<?php echo csrf_field(); ?>
			<input type="hidden" name="itemId" v-model="itemId">
			<input type="hidden" name="access_token" v-model="guestAccessToken">
		</form>
	</div>

	<script type="application/javascript">
		'use strict';
		
		window.onload = function()
		{
			var parsedUrl = queryString.parseUrl(location.href);

		  if(parsedUrl.query.token !== undefined)
		  {
		  	app.guestAccessToken = parsedUrl.query.token;

		  	app.getGuestDownloads();
		  }
		}
	</script>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\guest.blade.php ENDPATH**/ ?>