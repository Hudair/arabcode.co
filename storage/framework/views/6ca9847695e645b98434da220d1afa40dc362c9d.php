

<?php $__env->startSection('title', __('Coupons')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="coupons">

	<div class="ui menu shadowless">
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>
		
		<div class="right menu">
			<form action="<?php echo e(route('coupons')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
			</form>
			<a href="<?php echo e(route('coupons.create')); ?>" class="item ml-1"><?php echo e(__('Add')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items coupons">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>
						<div class="ui fitted checkbox">
						  <input type="checkbox" @change="selectAll">
						  <label></label>
						</div>
					</th>
					<th>
						<a href="<?php echo e(route('coupons', ['orderby' => 'code', 'order' => $items_order])); ?>"><?php echo e(__('Code')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('coupons', ['orderby' => 'used_by', 'order' => $items_order])); ?>"><?php echo e(__('Used by')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('coupons', ['orderby' => 'value', 'order' => $items_order])); ?>"><?php echo e(__('Value')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('coupons', ['orderby' => 'starts_at', 'order' => $items_order])); ?>"><?php echo e(__('Starts at')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('coupons', ['orderby' => 'expires_at', 'order' => $items_order])); ?>"><?php echo e(__('Expires at')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('coupons', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Updated at')); ?></a>
					</th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>

			<tbody>
				<?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr id="<?php echo e($coupon->id); ?>">

					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($coupon->id); ?>" @change="toogleId(<?php echo e($coupon->id); ?>)">
						  <label></label>
						</div>
					</td>

					<td class="center aligned"><?php echo e($coupon->code); ?></td>

					<td class="center aligned"><?php echo e($coupon->used_by); ?></td>

					<td class="center aligned">
						<?php if($coupon->is_percentage): ?>
						<?php echo e($coupon->value.'% OFF'); ?>

						<?php else: ?>
						<?php echo e(config('payments.currency_code').' '.number_format($coupon->value, 2)); ?>

						<?php endif; ?>
					</td>

					<td class="center aligned" >
						<?php echo e((new DateTime($coupon->starts_at))->format("d M Y \a\\t h:i:s A")); ?>

					</td>

					<td class="center aligned">
						<?php if($coupon->expires_at < date('Y-m-d H:i:s')): ?>
						<span class="ui basic circular red label m-0 expired">
							<?php echo e(__('Expired')); ?>

						</span>
						<?php else: ?>
						<?php echo e((new DateTime($coupon->expires_at))->format("d M Y \a\\t h:i:s A")); ?>

						<?php endif; ?>
					</td>

					<td class="center aligned">
						<?php echo e((new DateTime($coupon->updated_at))->format("d M Y \a\\t h:i:s A")); ?>

					</td>

					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars icon mx-0"></i>
							<div class="menu dropdown left rounded-corner">
								<a href="<?php echo e(route('coupons.edit', $coupon->id)); ?>" class="item"><?php echo e(__('Edit')); ?></a>
								<a @click="deleteItem($event)" href="<?php echo e(route('coupons.destroy', $coupon->id)); ?>" class="item"><?php echo e(__('Delete')); ?></a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($coupons->hasPages() ?? null): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($coupons->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($coupons->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('coupons.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Coupons'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="coupons">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('coupons'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#coupons',
	  data: {
	  	route: '<?php echo e(route('coupons.destroy', "")); ?>/',
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
	  		$('#coupons tbody .ui.checkbox.select').checkbox('toggle')
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
	  	}
	  },
	  watch: {
	  	ids: function(val)
	  	{
	  		this.isDisabled = !val.length;
	  	}
	  }
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\coupons\index.blade.php ENDPATH**/ ?>