

<?php $__env->startSection('title', __('Cashouts')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="cashouts">

	<div class="ui menu shadowless">
		<a href="<?php echo e(route('affiliate.balances')); ?>" class="item"><?php echo e(__('Balances')); ?></a>
		<a @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<div class="right menu mr-1">
			<form action="<?php echo e(route('affiliate.cashouts')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
		</div>
	</div>

	<div class="table wrapper items cashouts">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>
						<a href="<?php echo e(route('affiliate.cashouts', ['orderby' => 'email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('affiliate.cashouts', ['orderby' => 'method', 'order' => $items_order])); ?>"><?php echo e(__('Method')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('affiliate.cashouts', ['orderby' => 'amount', 'order' => $items_order])); ?>"><?php echo e(__('Amount')); ?></a>
					</th>
					<th>
						<?php echo e(__('Details')); ?>

					</th>
					<th>
						<a href="<?php echo e(route('affiliate.cashouts', ['orderby' => 'created_at', 'order' => $items_order])); ?>"><?php echo e(__('Created at')); ?></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $cashouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cashout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>

					<td class="center aligned">
						<div class="ui fitted checkbox">
						  <input type="checkbox" value="<?php echo e($cashout->id); ?>" @change="toogleId(<?php echo e($cashout->id); ?>)">
						  <label></label>
						</div>
					</td>

					<td><?php echo e(ucfirst($cashout->email)); ?></td>
					
					<td class="center aligned"><?php echo e(ucfirst($cashout->method)); ?></td>

					<td class="center aligned"><?php echo e(price($cashout->amount, false)); ?></td>

					<td class="center aligned">
						<button class="small ui circular yellow button mx-0" type="button" @click="showDetails(<?php echo e($cashout->details); ?>)"><?php echo e(__('Details')); ?></button>
					</td>

					<td class="center aligned"><?php echo e($cashout->updated_at); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($cashouts->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($cashouts->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($cashouts->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

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
	  el: '#cashouts',
	  data: {
	  	route: '<?php echo e(route('affiliate.destroy_cashouts', "")); ?>/',
	    ids: [],
	    emails: [],
	    notification: '',
	    isDisabled: true,
	    details: null,
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
	  		$('#cashouts tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		if(!this.ids.length)
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\affiliate\cashouts.blade.php ENDPATH**/ ?>