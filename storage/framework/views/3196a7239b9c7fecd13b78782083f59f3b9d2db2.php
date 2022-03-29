

<?php $__env->startSection('title', __('Keys, Accounts, Licenses, ...')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="keys">

	<?php if(session('message')): ?>
	<div class="ui fluid positive message">
		<i class="close icon"></i>
		<?php echo e(session('message')); ?>

	</div>
	<?php endif; ?>

	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu">
			<form action="<?php echo e(route('keys')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
			<a href="<?php echo e(route('keys.create')); ?>" class="item ml-1"><?php echo e(__('Add')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items keys">
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
						<a href="<?php echo e(route('keys', ['orderby' => 'code', 'order' => $items_order])); ?>"><?php echo e(__('Code')); ?></a>
						<div><small>(<?php echo e(__('CTRL or CMD + S to save')); ?>)</small></div>
					</th>
					<th>
						<a href="<?php echo e(route('keys', ['orderby' => 'product_name', 'order' => $items_order])); ?>"><?php echo e(__('Product')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('keys', ['orderby' => 'user_email', 'order' => $items_order])); ?>"><?php echo e(__('Purchased by')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('keys', ['orderby' => 'purchased_at', 'order' => $items_order])); ?>"><?php echo e(__('Purchased at')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('keys', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Updated at')); ?></a>
					</th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($key->id); ?>" @change="toogleId(<?php echo e($key->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td class="ui form">
						<textarea data-id="<?php echo e($key->id); ?>" data-product-id="<?php echo e($key->product_id); ?>" rows="2"><?php echo e($key->code); ?></textarea>
					</td>
					<td><a href="<?php echo e(item_url(['slug' => $key->product_slug, 'id' => $key->product_id])); ?>"><?php echo $key->product_name; ?></a></td>
					<td class="center aligned"><?php echo $key->user_email ?? '-'; ?></td>
					<td class="center aligned"><?php echo e($key->purchased_at ?? '-'); ?></td>
					<td class="center aligned"><?php echo e($key->updated_at); ?></td>
					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars icon mx-0"></i>
							<div class="menu dropdown left rounded-corner">
								<a href="<?php echo e(route('keys.edit', $key->id)); ?>" class="item"><?php echo e(__('Edit')); ?></a>
								<a @click="deleteItem($event)" href="<?php echo e(route('keys.destroy', $key->id)); ?>" class="item"><?php echo e(__('Delete')); ?></a>
								<a @click="voidPurchase($event, <?php echo e($key->id); ?>)" class="item"><?php echo e(__('Void purchase')); ?></a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($keys->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($keys->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($keys->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>


	<form class="ui form modal export" action="<?php echo e(route('keys.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Keys'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="keys">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('key_s'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
							<div class="ui checked checkbox">
							  <input type="checkbox" id="<?php echo e($column); ?>" name="columns[<?php echo e($column); ?>][active]" checked="checked">
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
</div>

<script>
	'use strict';

	var app = new Vue({
	  el: '#keys',
	  data: {
	  	route: '<?php echo e(route('keys.destroy', "")); ?>/',
	    ids: [],
	    isDisabled: true
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
	  		$('#keys tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		var confirmationMsg = '<?php echo e(__('Are you sure you want to delete the selected element(s)')); ?> ?';

	  		if(!this.ids.length || !confirm(confirmationMsg))
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	deleteItem: function(e)
	  	{
	  		if(!confirm('<?php echo e(__('Are you sure you want to delete the selected element(s)')); ?> ?'))
  			{
  				e.preventDefault();
  				return false;
  			}
	  	},
	  	updateCode: function(e)
	  	{
	  		var $this = $(e.target);
	  		var id = $this.data('id');
	  		var productId = $this.data('product-id');
	  		var code = $this.val().trim();

	  		if (!(event.which == 115 && event.ctrlKey) && !(event.which == 19)) return true;

  			$.post('/admin/keys/update_async', {id: id, code: code, product_id: productId})
  			.done(function()
  			{
  				$this.transition('pulse');
  			})
	  	},
	  	voidPurchase: function(e, keyId)
	  	{
	  	   $.post('/admin/keys/void_purchase', {id: keyId})
  			.done(function()
  			{
  			    
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
	
	    

		$('#keys textarea').on('keydown', function(e) 
		{
		    if((e.which == '115' || e.which == '83' ) && (e.ctrlKey || e.metaKey))
		    {		        
		        var $this = $(this);
			  		var id = $this.data('id');
			  		var productId = $this.data('product-id');
			  		var code = $this.val().trim();

		  			$.post('/admin/keys/update_async', {id: id, code: code, product_id: productId})
		  			.done(function()
		  			{
		  				$this.transition('pulse');
		  			})
		  			.fail(function(res)
		  			{
		  				try
		  				{
		  					var errs = res.responseJSON.errors;

		  					alert(Object.values(errs).join(','))
		  				}
		  				catch(err)
		  				{

		  				}
		  			})

		  			e.preventDefault();

		        return false;
		    }
		    else
		    {
		        return true;
		    }
		})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\keys\index.blade.php ENDPATH**/ ?>