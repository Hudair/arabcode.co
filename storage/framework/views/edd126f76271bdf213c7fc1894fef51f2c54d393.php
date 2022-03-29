

<?php $__env->startSection('title', __('Transactions')); ?>


<?php $__env->startSection('content'); ?>

<?php if(session('response')): ?>
<div class="ui fluid small positive bold message">
	<i class="close icon"></i>
	<?php echo e(session('response')); ?>

</div>
<?php endif; ?>

<div class="row main" id="transactions">

	<div class="ui menu shadowless">
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu">
			<form action="<?php echo e(route('transactions')); ?>" method="get" id="search" class="ui transparent icon input item mr-1">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>

      <a href="<?php echo e(route('transactions.create')); ?>" class="item ml-1"><?php echo e(__('Create')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items transactions">
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
						<a href="<?php echo e(route('transactions', ['orderby' => 'buyer', 'order' => $items_order])); ?>"><?php echo e(__('Buyer')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('transactions', ['orderby' => 'amount', 'order' => $items_order])); ?>"><?php echo e(__('Amount')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('transactions', ['orderby' => 'processor', 'order' => $items_order])); ?>"><?php echo e(__('Processor')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('transactions', ['orderby' => 'status', 'order' => $items_order])); ?>"><?php echo e(__('Paid')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('transactions', ['orderby' => 'refunded', 'order' => $items_order])); ?>"><?php echo e(__('Refunded')); ?></a>
					</th>					<th>
						<a href="<?php echo e(route('transactions', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Updated at')); ?></a>
					</th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr id="<?php echo e($transaction->id); ?>">
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($transaction->id); ?>" @change="toogleId(<?php echo e($transaction->id); ?>)">
						  <label></label>
						</div>
					</td>

					<td class="left aligned"><?php echo e($transaction->buyer ?? __('Guest')); ?></td>

					<td class="center aligned"><?php echo e(price($transaction->amount)); ?></td>
					
					<td class="center aligned"><?php echo e(ucfirst($transaction->processor)); ?></td>

					<td class="center aligned" >
						<div class="ui toggle fitted checkbox" title="<?php echo e(mb_ucfirst($transaction->status)); ?>">
						  <input type="checkbox" <?php if($transaction->status === 'paid'): ?> checked <?php endif; ?> data-prop="status" data-id="<?php echo e($transaction->id); ?>" @change="updateProp($event)">
						  <label></label>
						</div>
					</td>

					<td class="center aligned" >
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" <?php if($transaction->refunded): ?> checked <?php endif; ?> data-prop="refunded" data-id="<?php echo e($transaction->id); ?>" @change="updateProp($event)">
						  <label></label>
						</div>
					</td>

					<td class="center aligned"><?php echo e($transaction->updated_at); ?></td>

					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars icon mx-0"></i>
							<div class="menu dropdown rounded-corner left">
								<a href="<?php echo e(route('transactions.show', $transaction->id)); ?>" class="item"><?php echo e(__('Details')); ?></a>

								<?php if(!$transaction->refunded): ?>
								<a class="item" @click="confirmRefund($event)" href="<?php echo e(route('transactions.mark_as_refunded', ['id' => $transaction->id, 
																																								 'processor' => $transaction->processor])); ?>">
									<?php echo e(__('Mark as refunded')); ?>

								</a>
								<?php endif; ?>

								<?php if($transaction->processor === 'manual'): ?>
								<a class="item" href="<?php echo e(route('transactions.edit', ['id' => $transaction->id])); ?>">
									<?php echo e(__('Edit')); ?>

								</a>
								<?php endif; ?>

								<a class="item" @click="deleteItem($event)" href="<?php echo e(route('transactions.destroy', $transaction->id)); ?>"><?php echo e(__('Delete')); ?></a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($transactions->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($transactions->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($transactions->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('transactions.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Transactions'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="transactions">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('transactions'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#transactions',
	  data: {
	  	route: '<?php echo e(route('transactions.destroy', "")); ?>/',
	    ids: [],
	    isDisabled: true,
	    transaction_id: null
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
	  		$('#transactions tbody .ui.checkbox.select').checkbox('toggle')
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
	  	confirmRefund: function(e)
	  	{
	  		if(!confirm('<?php echo e(__('Are you sure you want to mark this transaction as refunded ?')); ?>'))
	  		{
	  			e.preventDefault();
  				return false;
	  		}
	  	},
	  	updateProp: function(e)
	  	{	
	  		var thisEl = $(e.target);
	  		var id   = thisEl.data('id');
	  		var prop = thisEl.data('prop');

	  		if(['status', 'refunded'].indexOf(prop) < 0)
	  			return;

	  		$.post('<?php echo e(route('transactions.update_prop')); ?>', {prop: prop, id: id})
				.done(function(res)
				{
					if(res.response)
					{
						thisEl.checkbox('toggle');
					}
				})
				.fail(function(data)
				{
					alert(data.responseJSON.message)
				})
	  	}
	  },
	  watch: {
	  	ids: function(val)
	  	{
	  		this.isDisabled = !val.length;
	  	},
	  	transaction_id: function(val)
	  	{
	  		$('#refund').modal(!val ? 'hide' : 'show')
	  	}
	  }
	})

	$('.ui.modal').modal({closable: false})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\transactions\index.blade.php ENDPATH**/ ?>