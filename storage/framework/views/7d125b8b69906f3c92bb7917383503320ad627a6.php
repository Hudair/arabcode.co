

<?php $__env->startSection('title', __('Balances')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="balances">

	<div class="ui menu shadowless">
		<a href="<?php echo e(route('affiliate.cashouts')); ?>" class="item"><?php echo e(__('Cashouts')); ?></a>
		<a @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<div class="right menu mr-1">
			<form action="<?php echo e(route('affiliate.balances')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
		</div>
	</div>

	<div class="table wrapper items balances">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>
						<a href="<?php echo e(route('affiliate.balances', ['orderby' => 'email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('affiliate.balances', ['orderby' => 'earnings', 'order' => $items_order])); ?>"><?php echo e(__('Earnings')); ?></a>
					</th>
					<th><?php echo e(__('Eligible')); ?></th>
					<th>
						<a href="<?php echo e(route('affiliate.balances', ['orderby' => 'method', 'order' => $items_order])); ?>"><?php echo e(__('Method')); ?></a>
					</th>
					<th>
						<?php echo e(__('Details')); ?>

					</th>
					<th>
						<a href="<?php echo e(route('affiliate.balances', ['orderby' => 'created_at', 'order' => $items_order])); ?>"><?php echo e(__('Created at')); ?></a>
					</th>
					<th><?php echo e(__('Action')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $balances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>

					<td class="center aligned">
						<div class="ui fitted checkbox">
						  <input type="checkbox" value="<?php echo e($balance->ids); ?>" @change="toogleIds('<?php echo e($balance->ids); ?>')">
						  <label></label>
						</div>
					</td>

					<td><?php echo e(ucfirst($balance->email)); ?></td>

					<td class="center aligned"><?php echo e(price($balance->earnings, false)); ?></td>

					<td class="center aligned">
						<?php if($balance->has_minimum): ?>
						<i class="circle green icon mx-0"></i>
						<?php else: ?>
						<i class="circle red icon mx-0"></i>
						<?php endif; ?>
					</td>
					
					<td class="center aligned"><?php echo e(ucfirst(explode('_', $balance->method)[0] ?? null)); ?></td>

					<td class="center aligned"><button class="small ui circular yellow button mx-0" type="button" @click="showDetails(<?php echo e($balance->details); ?>)"><?php echo e(__('Details')); ?></button></td>

					<td class="center aligned"><?php echo e($balance->updated_at); ?></td>

					<td class="center aligned">
						<?php if($balance->has_minimum): ?>
							<?php if($balance->method === 'paypal_account'): ?>
							<button class="ui yellow small circular button fluid nowrap mx-0" type="button" @click="transferToPaypal('<?php echo e($balance->ids); ?>', $event)"><?php echo e(__('Pay')); ?></button>
							<?php elseif($balance->method === 'bank_account'): ?>
							<button class="ui yellow small circular button fluid nowrap mx-0" type="button" @click="markAsPaid('<?php echo e($balance->ids); ?>', $event)"><?php echo e(__('Mark as paid')); ?></button>
							<?php endif; ?>
						<?php else: ?>
						-
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($balances->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($balances->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($balances->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<div class="ui tiny modal" id="details">
		<div class="content">
			<table class="ui large fluid table">
				<tbody>
					<tr v-for="(v, k) of details">
						<td>{{ k }}</td>
						<td>{{ v }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	'use strict';
	
	var app = new Vue({
	  el: '#balances',
	  data: {
	  	route: '<?php echo e(route('affiliate.destroy_balances', "")); ?>/',
	    ids: [],
	    emails: [],
	    notification: '',
	    isDisabled: true,
	    details: {}
	  },
	  methods: {
	  	toogleIds: function(ids)
	  	{
	  		if(this.ids.indexOf(ids) >= 0)
	  			this.ids.splice(this.ids.indexOf(ids), 1);
	  		else
	  			this.ids.push(ids);
	  	},
	  	selectAll: function()
	  	{
	  		$('#balances tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		if(!this.ids.length)
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	markAsPaid: function(ids, e)
	  	{
	  		var btn = $(e.target);
	  		var ids = ids.split(',');

	  		if(!ids.length)
	  		{
	  			return;
	  		}

	  		btn.prop('disabled', true).toggleClass('loading', true);

	  		$.post('/admin/affiliate/mark_as_paid', {ids: ids})
	  		.done(function(data)
	  		{
	  			if(data.status)
	  			{
	  				btn.closest('td').html('-');
	  				alert(data.message);
	  			}
	  		})
	  		.always(function()
	  		{
	  			if(btn.length)
	  			{
	  				btn.prop('disabled', false).toggleClass('loading', false);
	  			}
	  		})
	  	},
	  	transferToPaypal: function(ids, e)
	  	{
	  		var btn = $(e.target);
	  		var ids = ids.split(',');

	  		if(!ids.length)
	  		{
	  			return;
	  		}

	  		btn.prop('disabled', true).toggleClass('loading', true);

	  		$.post('/admin/affiliate/transfer_to_paypal', {ids: ids})
	  		.done(function(data)
	  		{
	  			if(data.status)
	  			{
	  				btn.closest('td').html('-');
	  				alert(data.message);
	  			}
	  		})
	  		.always(function()
	  		{
	  			if(btn.length)
	  			{
	  				btn.prop('disabled', false).toggleClass('loading', false);
	  			}
	  		})
	  	},
	  	showDetails: function(details)
	  	{
	  		this.details = details;

	  		Vue.nextTick(function()
	  		{
	  			$('#details').modal('show');
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\affiliate\balances.blade.php ENDPATH**/ ?>