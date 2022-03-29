

<?php $__env->startSection('title', __('Files host settings')); ?>



<?php $__env->startSection('additional_head_tags'); ?>

<script type="application/javascript" src="https://apis.google.com/js/platform.js" async defer></script>

<script type="application/javascript">
	'use strict';
	
  var googleDriveCode2AcessTokenRoute = '<?php echo e(route('google_drive_get_refresh_token')); ?>';
  var googleDriveCurrentUserRoute     = '<?php echo e(route('google_drive_get_current_user')); ?>';
  var dropboxCurrentAccount 					= '<?php echo e(route('dropbox_get_current_user')); ?>';
  var dropBoxRedirectUri 							= '<?php echo e(url()->current()); ?>';
  var yandexDiskCode2AccessTokenRoute = '<?php echo e(route('yandex_disk_get_refresh_token')); ?>';
  var oneDriveCode2AccessTokenRoute 	= '<?php echo e(route('one_drive_get_refresh_token')); ?>';
  var oneDriveCurrentUserRoute     		= '<?php echo e(route('one_drive_get_current_user')); ?>';
  var oneDriveRedirectUrl     				= '<?php echo e(url()->current()); ?>';
</script>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>

<form class="ui large main form" method="post" spellcheck="false" action="<?php echo e(route('settings.update', 'files_host')); ?>">

	<div class="field">
		<button type="submit" class="ui pink large circular labeled icon button mx-0">
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
	
	<div class="ui fluid divider mb-0"></div>
	
	<div class="one column grid" id="settings">
		<div class="ui fluid card mt-1">
			<div class="content">
				<div class="header"><?php echo e(__('Working with')); ?></div>
			</div>
			<div class="content">
				<div class="field">
		      <div class="ui radio checkbox">
		        <input type="radio" name="working_with" <?php if($settings->working_with === 'files'): ?> checked <?php endif; ?> value="files">
		        <label><?php echo e(__('Files')); ?></label>
		      </div>
		    </div>
		    <div class="field">
		      <div class="ui radio checkbox">
		        <input type="radio" name="working_with" <?php if($settings->working_with === 'folders'): ?> checked <?php endif; ?> value="folders">
		        <label><?php echo e(__('Folders')); ?></label>
		      </div>
		    </div>
			</div>
		</div>


		<div class="ui three doubling stackable cards mt-1">
			<!-- Amazon S3 -->
			<div class="ui fluid card">
				<div class="content dropbox">
					<h3 class="header">
						<img src="<?php echo e(asset_('assets/images/amazon-s3.png')); ?>" alt="Amazon S3" class="ui avatar image mr-1">Amazon S3

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="amazon_s3[enabled]"
						    	<?php if(!empty(old('amazon_s3.enabled'))): ?>
									<?php echo e(old('amazon_s3.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->amazon_s3->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="ui small message p-1-hf">
						<i class="exclamation inverted red circular icon"></i><strong><?php echo e(__("Doesn't support working with folders")); ?></strong>
					</div>

					<div class="field">
						<label><?php echo e(__('Access key ID')); ?></label>
						<input type="text" name="amazon_s3[access_key_id]" placeholder="..." value="<?php echo e(old('amazon_s3.access_key_id', $settings->amazon_s3->access_key_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="amazon_s3[secret_key]" placeholder="..." value="<?php echo e(old('amazon_s3.secret_key', $settings->amazon_s3->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Bucket')); ?></label>
						<input type="text" name="amazon_s3[bucket]" value="<?php echo e(old('amazon_s3.bucket', $settings->amazon_s3->bucket ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Region')); ?></label>
						<input type="text" name="amazon_s3[region]" value="<?php echo e(old('amazon_s3.region', $settings->amazon_s3->region ?? 'us-west-2')); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Version')); ?></label>
						<input type="text" name="amazon_s3[version]" readonly value="<?php echo e(old('amazon_s3.version', $settings->amazon_s3->version ?? 'latest')); ?>">
					</div>

					<div class="field mb-0">
						<button class="ui circular large blue button" type="button" onclick="testAmazonS3Connection(this)"><?php echo e(__('Test connection')); ?></button>
					</div>
				</div>
			</div>


			<!-- Wasabi -->
			<div class="ui fluid card">
				<div class="content dropbox">
					<h3 class="header">
						<img src="<?php echo e(asset_('assets/images/wasabi.png')); ?>" alt="Wasabi" class="ui avatar image mr-1">Wasabi

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="wasabi[enabled]"
						    	<?php if(!empty(old('wasabi.enabled'))): ?>
									<?php echo e(old('wasabi.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->wasabi->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>

				<div class="content">
					<div class="ui small message p-1-hf">
						<i class="exclamation inverted red circular icon"></i><strong><?php echo e(__("Doesn't support working with folders")); ?></strong>
					</div>

					<div class="field">
						<label><?php echo e(__('Access key')); ?></label>
						<input type="text" name="wasabi[access_key]" placeholder="..." value="<?php echo e(old('wasabi.access_key', $settings->wasabi->access_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret key')); ?></label>
						<input type="text" name="wasabi[secret_key]" placeholder="..." value="<?php echo e(old('wasabi.secret_key', $settings->wasabi->secret_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Bucket')); ?></label>
						<input type="text" name="wasabi[bucket]" value="<?php echo e(old('wasabi.bucket', $settings->wasabi->bucket ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Region')); ?></label>
						<input type="text" name="wasabi[region]" value="<?php echo e(old('wasabi.region', $settings->wasabi->region ?? 'us-west-1')); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Version')); ?></label>
						<input type="text" name="wasabi[version]" readonly value="<?php echo e(old('wasabi.version', $settings->wasabi->version ?? 'latest')); ?>">
					</div>

					<div class="field mb-0">
						<button class="ui circular large blue button" type="button" onclick="testWasabiConnection(this)"><?php echo e(__('Test connection')); ?></button>
					</div>
				</div>
			</div>

			<!-- YANDEX DISK -->
			<div class="ui fluid card">
				<div class="content dropbox">
					<h3 class="header">
						<i class="circular blue yandex icon mr-1"></i>Yandex Disk

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="yandex[enabled]"
						    	<?php if(!empty(old('yandex.enabled'))): ?>
									<?php echo e(old('yandex.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->yandex->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<div class="ui small message p-1-hf">
						<i class="exclamation inverted red circular icon"></i><strong><?php echo e(__("Doesn't support working with folders")); ?></strong>
					</div>

					<div class="field">
						<label><?php echo e(__('Default folder path')); ?></label>
						<input type="text" name="yandex[folder_path]" placeholder="..." value="<?php echo e(old('yandex.folder_path', $settings->yandex->folder_path ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('App ID')); ?></label>
						<input type="text" name="yandex[client_id]" placeholder="..." value="<?php echo e(old('yandex.client_id', $settings->yandex->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('App password')); ?></label>
						<input type="text" name="yandex[secret_id]" placeholder="..." value="<?php echo e(old('yandex.secret_id', $settings->yandex->secret_id ?? null)); ?>">
					</div>

					<div class="field">
						<button class="ui circular large yellow button" type="button" onclick="authorizeYandexApp()"><?php echo e(__('Connect account')); ?></button>
					</div>

					<div class="field">
						<label><?php echo e(__('Refresh token')); ?></label>
						<input type="text" name="yandex[refresh_token]" readonly value="<?php echo e(old('yandex.refresh_token', $settings->yandex->refresh_token ?? null)); ?>">
					</div>
				</div>
			</div>
		</div>


		<div class="ui three doubling stackable cards">
			<!-- DROPBOX -->
			<div class="ui fluid card">
				<div class="content dropbox">
					<h3 class="header">
						<i class="circular blue dropbox icon mr-1"></i>DropBox

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="dropbox[enabled]"
						    	<?php if(!empty(old('dropbox.enabled'))): ?>
									<?php echo e(old('dropbox.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->dropbox->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content">
					<?php if($settings->dropbox->current_account ?? null): ?>
					<div class="ui basic green message p-1-hf d-flex">
						<span class="ui basic green label circular-corner large"><?php echo e(ucfirst($settings->dropbox->current_account ?? 'Null')); ?></span>	
					</div>
					<?php endif; ?>


					<div class="field">
						<label><?php echo e(__('App Default Folder Path')); ?> (<?php echo e(__('Optional')); ?>)</label>
						<input type="text" name="dropbox[folder_path]" value="<?php echo e(old('dropbox.folder_path', $settings->dropbox->folder_path ?? null)); ?>" placeholder="/PATH">
					</div>

					<div class="field">
						<label><?php echo e(__('App key')); ?></label>
						<input type="text" name="dropbox[app_key]" placeholder="..." value="<?php echo e(old('dropbox.app_key', $settings->dropbox->app_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('App secret')); ?></label>
						<input type="text" name="dropbox[app_secret]" placeholder="..." value="<?php echo e(old('dropbox.app_secret', $settings->dropbox->app_secret ?? null)); ?>">
					</div>

					<div class="field">
						<button class="ui circular large yellow button" type="button" onclick="authorizeDropBoxApp()"><?php echo e(__('Connect account')); ?></button>
					</div>

					<div class="field">
						<label><?php echo e(__('Access token')); ?></label>
						<input type="text" name="dropbox[access_token]" value="<?php echo e(old('dropbox.access_token', $settings->dropbox->access_token ?? null)); ?>">

						<input type="hidden" name="dropbox[current_account]" value="<?php echo e(old('dropbox.current_account', $settings->dropbox->current_account ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- GOOGLE DRIVE -->
			<div class="ui fluid card">

				<div class="content googledrive">
					<h3 class="header">
						<i class="circular blue google drive icon mr-1"></i>Google Drive

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="google_drive[enabled]"
						    	<?php if(!empty(old('google_drive.enabled'))): ?>
									<?php echo e(old('google_drive.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->google_drive->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>
					</h3>
				</div>
				
				<div class="content">
					<?php if($settings->google_drive->connected_email ?? null): ?>
					<div class="ui basic green message p-1-hf d-flex">
						<span class="ui basic green label circular-corner large"><?php echo e(ucfirst($settings->google_drive->connected_email ?? 'Null')); ?></span>	
					</div>
					<?php endif; ?>
					
					<div class="field">
						<label><?php echo e(__('App Default Folder ID')); ?> (<?php echo e(__('Optional')); ?>)</label>
						<input type="text" name="google_drive[folder_id]" value="<?php echo e(old('google_drive.folder_id', $settings->google_drive->folder_id ?? null)); ?>" placeholder="E.g. 1FREVJPb_R_cdNbpsfo2plpYlzerfEGV9">
					</div>

					<div class="field">
						<label><?php echo e(__('API key')); ?></label>
						<input type="text" name="google_drive[api_key]" placeholder="..." value="<?php echo e(old('google_drive.api_key', $settings->google_drive->api_key ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="google_drive[client_id]" placeholder="..." value="<?php echo e(old('google_drive.client_id', $settings->google_drive->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Secret ID')); ?></label>
						<input type="text" name="google_drive[secret_id]" placeholder="..." value="<?php echo e(old('google_drive.secret_id', $settings->google_drive->secret_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Chunk size')); ?> <sup><?php echo e(__('MB')); ?></sup></label>
						<input type="number" name="google_drive[chunk_size]" placeholder="..." value="<?php echo e(old('google_drive.chunk_size', $settings->google_drive->chunk_size ?? '1')); ?>">
					</div>

					<div class="field">
						<button class="ui circular large yellow button" type="button" onclick="authorizeGooglDriveApp()"><?php echo e(__('Connect account')); ?></button>
					</div>

					<div class="field">
						<label><?php echo e(__('Refresh token')); ?></label>
						<input type="text" name="google_drive[refresh_token]" readonly value="<?php echo e(old('google_drive.refresh_token', $settings->google_drive->refresh_token ?? null)); ?>">

						<input type="hidden" name="google_drive[connected_email]" readonly value="<?php echo e(old('google_drive.connected_email', $settings->google_drive->connected_email ?? null)); ?>">
						<input type="hidden" name="google_drive[id_token]" readonly value="<?php echo e(old('google_drive.id_token', $settings->google_drive->id_token ?? null)); ?>">
					</div>
				</div>
			</div>


			<!-- ONE DRIVE -->
			<div class="ui fluid card disabled" title="<?php echo e(__('Disabled')); ?>">
				<div class="content dropbox d-none">
					<h3 class="header">
						<img src="<?php echo e(asset_('assets/images/one_drive.png')); ?>" alt="One drive" class="ui avatar image mr-1">One Drive

						<div class="checkbox-wrapper">
							<div class="ui fitted toggle checkbox">
						    <input 
						    	type="checkbox" 
						    	name="one_drive[enabled]"
						    	<?php if(!empty(old('one_drive.enabled'))): ?>
									<?php echo e(old('one_drive.enabled') ? 'checked' : ''); ?>

									<?php else: ?>
									<?php echo e(($settings->one_drive->enabled ?? null) ? 'checked' : ''); ?>

						    	<?php endif; ?>
						    >
						    <label></label>
						  </div>
						</div>

					</h3>
				</div>

				<div class="content d-none">
					<?php if($settings->one_drive->connected_email ?? null): ?>
					<div class="ui basic green message p-1-hf d-flex">
						<span class="ui basic green label circular-corner large">
							<?php echo e(ucfirst($settings->one_drive->connected_email ?? 'Null')); ?>

						</span>	
					</div>
					<?php endif; ?>

					<div class="field">
						<label><?php echo e(__('App Default Folder ID')); ?> (<?php echo e(__('Optional')); ?>)</label>
						<input type="text" name="one_drive[folder_id]" value="<?php echo e(old('one_drive.folder_id', $settings->one_drive->folder_id ?? null)); ?>" placeholder="E.g. DD3E6389F8A75064!115">
					</div>

					<div class="field">
						<label><?php echo e(__('Client ID')); ?></label>
						<input type="text" name="one_drive[client_id]" placeholder="..." value="<?php echo e(old('one_drive.client_id', $settings->one_drive->client_id ?? null)); ?>">
					</div>

					<div class="field">
						<label><?php echo e(__('Client secret')); ?></label>
						<input type="text" name="one_drive[client_secret]" placeholder="..." value="<?php echo e(old('one_drive.client_secret', $settings->one_drive->client_secret ?? null)); ?>">
					</div>

					<div class="field">
						<button class="ui circular large yellow button" type="button" onclick="authorizeOneDriveApp()"><?php echo e(__('Connect account')); ?></button>
					</div>

					<div class="field">
						<label><?php echo e(__('Refresh token')); ?></label>
						<input type="text" name="one_drive[refresh_token]" readonly value="<?php echo e(old('one_drive.refresh_token', $settings->one_drive->refresh_token ?? null)); ?>">
					</div>

					<div class="field d-none">
						<label><?php echo e(__('ID token')); ?></label>
						<input type="text" name="one_drive[id_token]" readonly value="<?php echo e(old('one_drive.id_token', $settings->one_drive->id_token ?? null)); ?>">
					</div>

					<div class="field d-none">
						<label><?php echo e(__('Access token')); ?></label>
						<input type="text" name="one_drive[access_token]" readonly value="<?php echo e(old('one_drive.access_token', $settings->one_drive->access_token ?? null)); ?>">
					</div>

					<input type="hidden" name="one_drive[connected_email]" readonly value="<?php echo e(old('one_drive.connected_email', $settings->one_drive->connected_email ?? null)); ?>">
				</div>
			</div>
		</div>
	</div>
</form>

<script>
	'use strict';

	$(function()
	{
		$('#settings .ui.checkbox').checkbox();
		
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
	})
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\settings\files_host.blade.php ENDPATH**/ ?>