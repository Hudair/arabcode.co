

<?php $__env->startSection('title', __('Products')); ?>

<?php $__env->startSection('additional_head_tags'); ?>
<script src="<?php echo e(asset_('assets/wavesurfer.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="products">

	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="routes.delete+ids.join()" class="item" :class="{disabled: isDisabled}">
			<?php echo e(__('Delete')); ?>

		</a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu">
			<form action="<?php echo e(route('products')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?>..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
			<a href="<?php echo e(route('products.create')); ?>" class="item ml-1"><?php echo e(__('Add')); ?></a>
		</div>
	</div>
	
	<div class="ui fluid message circuclar-corner" v-if="peaksGenerated.length">
		{{ peaksGenerated }}
	</div>

	<div class="table wrapper items products">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>
						<div class="ui fitted checkbox">
						  <input type="checkbox" @change="selectAll">
						  <label></label>
						</div>
					</th>
					<th class="five columns wide">
						<a href="<?php echo e(route('products', ['orderby' => 'name', 'order' => $items_order])); ?>"><?php echo e(__('Name')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'price', 'order' => $items_order])); ?>"><?php echo e(__('Price')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'sales', 'order' => $items_order])); ?>"><?php echo e(__('Sales')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'category', 'order' => $items_order])); ?>"><?php echo e(__('Category')); ?></a>
					</th>
					<th>
						<div class="ui dropdown">
							<div class="text"><?php echo e(__('Type')); ?></div>
							<div class="menu rounded-corner overflow-hidden">
								<a href="/admin/products" class="item">&nbsp;</a>
								<a href="<?php echo e(route('products', ['type' => '-'])); ?>" class="item">-</a>
								<a href="<?php echo e(route('products', ['type' => 'audio'])); ?>" class="item"><?php echo e(__('Audio')); ?></a>
								<a href="<?php echo e(route('products', ['type' => 'video'])); ?>" class="item"><?php echo e(__('Video')); ?></a>
								<a href="<?php echo e(route('products', ['type' => 'graphic'])); ?>" class="item"><?php echo e(__('Graphic')); ?></a>
								<a href="<?php echo e(route('products', ['type' => 'ebook'])); ?>" class="item"><?php echo e(__('Ebook')); ?></a>
							</div>
						</div>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'active', 'order' => $items_order])); ?>"><?php echo e(__('Active')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'trending', 'order' => $items_order])); ?>"><?php echo e(__('Trending')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'featured', 'order' => $items_order])); ?>"><?php echo e(__('Featured')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'newest', 'order' => $items_order])); ?>"><?php echo e(__('Newest')); ?></a>
					</th>
					<th><?php echo e(__('Files')); ?></th>
					<th>
						<a href="<?php echo e(route('products', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Updated at')); ?></a>
					</th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($product->id); ?>" @change="toogleId(<?php echo e($product->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td><a href="<?php echo e(item_url($product)); ?>"><?php echo e($product->id.' - '.ucfirst($product->name)); ?></a></td>
					<td class="center aligned"><?php echo e(currency().' '.format_amount($product->price)); ?></td>
					<td class="center aligned"><?php echo e($product->sales); ?></td>
					<td class="center aligned"><?php echo e($product->category); ?></td>
					<td class="center aligned"><?php echo e(__(ucfirst($product->type ?? '-'))); ?></td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="active" <?php if($product->active): ?> checked <?php endif; ?> data-id="<?php echo e($product->id); ?>" data-status="active" @change="updateStatus($event)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="trending" <?php if($product->trending): ?> checked <?php endif; ?> data-id="<?php echo e($product->id); ?>" data-status="trending" @change="updateStatus($event)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="featured" <?php if($product->featured): ?> checked <?php endif; ?> data-id="<?php echo e($product->id); ?>" data-status="featured" @change="updateStatus($event)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="newest" <?php if($product->newest): ?> checked <?php endif; ?> data-id="<?php echo e($product->id); ?>" data-status="newest" @change="updateStatus($event)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned">
						<?php if($product->file_name): ?>
							<?php if($product->is_dir): ?>
								<a href="<?php echo e(item_folder_sync($product)); ?>" target="_blank"><i class="cloud large download link grey icon mx-0"></i></a>
							<?php else: ?>
								<i class="cloud large download link grey icon mx-0" @click="downloadFile(<?php echo e($product->id); ?>)"></i>
							<?php endif; ?>
						<?php else: ?>
						-
						<?php endif; ?>
					</td>
					<td class="center aligned"><?php echo e($product->updated_at); ?></td>
					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars large grey icon mx-0"></i>
							<div class="menu dropdown left rounded-corner">
								<a href="<?php echo e(route('products.edit', $product->id)); ?>" class="item"><?php echo e(__('Edit')); ?></a>
								<a @click="deleteItem($event)" href="<?php echo e(route('products.destroy', $product->id)); ?>" class="item"><?php echo e(__('Delete')); ?></a>
								<?php if($product->type === 'audio'): ?>
								<a class="item <?php echo e(cache("peaks.{$product->id}") ? 'exists' : ''); ?>" @click="generateSavePeaks($event, '<?php echo e($product->preview); ?>', <?php echo e($product->id); ?>)"><?php echo e(__('Generate peaks')); ?></a>
								<?php endif; ?>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<?php if($products->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($products->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($products->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>
	
	<form action="<?php echo e(route('home.download')); ?>" method="post" class="d-none" id="download-file">
		<?php echo csrf_field(); ?>
		<input type="hidden" name="itemId" v-model="itemId">
	</form>

	
	<form class="ui form modal export" action="<?php echo e(route('products.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Products'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="products">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('products'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
							<div class="ui checked checkbox">
							  <input type="checkbox" name="columns[<?php echo e($column); ?>][active]" checked="checked">
							  <label for="<?php echo e($column); ?>"><?php echo e($column); ?></label>
							</div>
							
							<input type="hidden" name="columns[<?php echo e($column); ?>][name]" value="<?php echo e($column); ?>">
						</td>
						<td>
							<input type="text" name="columns[<?php echo e($column); ?>][new_name]" placeholder="...">
						</td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>				
			</table>
		</div>
		<div class="actions">
			<button class="ui yellow large circular button approve"><?php echo e(__('Export')); ?></button>
			<button class="ui red circular large button cancel" type="button"><?php echo e(__('Cancel')); ?></button>
		</div>
	</form>

	<div id="wavesurfer" class="d-none"></div>
</div>

<script>
	'use strict';

	var app = new Vue({
	  el: '#products',
	  data: {
	  	routes: {
	  		delete: '<?php echo e(route('products.destroy', "")); ?>/',
	  		export: '<?php echo e(route('products.export', "")); ?>/'
	  	},
	    ids: [],
	    peaksGenerated: '',
	    isDisabled: true,
	    itemId: ''
	  },
	  methods: {
	  	toogleId: function(id)
	  	{
	  		if(this.ids.indexOf(id) >= 0)
	  			this.ids.splice(this.ids.indexOf(id), 1);
	  		else
	  			this.ids.push(id);
	  	},
	  	selectAll: function()
	  	{
	  		$('#products tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		var confirmationMsg = '<?php echo e(__('Are you sure you want to delete the selected product(s)')); ?> ?';

	  		if(!this.ids.length || !confirm(confirmationMsg))
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	deleteItem: function(e)
	  	{
	  		if(!confirm('<?php echo e(__('Are you sure you want to delete this product')); ?> ?'))
  			{
  				e.preventDefault();
  				return false;
  			}
	  	},
	  	generateSavePeaks: function(e, previewFile, itemId)
	  	{
			    if(/https?.+/.test(previewFile))
			    {
			    	$.post('<?php echo e(route('products.get_temp_url')); ?>', {url: previewFile, id: itemId})
					  .done(function(tempUrl)
					  {
					    app.savePeaks(e, tempUrl, itemId);
					  })
			    }
			    else
			    {
			    	previewFile = '/storage/previews/'+previewFile;

			    	this.savePeaks(e, previewFile, itemId)
			    }
	  	},
	  	savePeaks: function(e, previewFile, itemId)
	  	{
	  			$(e.target).closest('.ui.dropdown').toggleClass('loading', true);

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
			          	$(e.target).closest('.ui.dropdown').toggleClass('loading', false);
			            app.peaksGenerated = __("Peaks for item :id has been generated and saved.", {id: itemId});

			            setTimeout(function()
			            {
			            	app.peaksGenerated = '';
			            }, 3000)
			          })
			        })
			    });

			    wSuffer.load(previewFile);
	  	},
	  	updateStatus: function(e)
	  	{	
	  		var thisEl  = $(e.target);
	  		var id 			= thisEl.data('id');
	  		var status 	= thisEl.data('status');

	  		if(['active', 'trending', 'featured', 'newest'].indexOf(status) < 0)
	  			return;

	  		$.post('<?php echo e(route('products.status')); ?>', {status: status, id: id})
				.done(function(res)
				{
					if(res.success)
					{
						thisEl.checkbox('toggle');
					}
				}, 'json')
				.fail(function()
				{
					alert('Failed')
				})
	  	},
	  	downloadFile: function(itemId)
	  	{
	  		this.itemId = itemId;

	  		this.$nextTick(function()
	  		{
	  			$('#download-file').submit();
	  		})
	  	}
	  },
	  watch: {
	  	ids: function(val)
	  	{
	  		this.isDisabled = !val.length;
	  	}
	  }
	})


	$(function()
	{
		$('#search').on('submit', function(event)
		{
			if(!$('input', this).val().trim().length)
			{
				e.preventDefault();
				return false;
			}
		})
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views/back/products/index.blade.php ENDPATH**/ ?>