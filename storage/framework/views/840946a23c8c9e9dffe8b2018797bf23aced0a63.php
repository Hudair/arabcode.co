

<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="subscriptions">

	<div class="ui menu shadowless">		
		<a @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>
		<div class="item ui floating dropdown">
			<div class="text"><?php echo e(__('Send renewal payment link')); ?></div>
			<i class="dropdown icon"></i>
			<div class="menu">
				<a @click="createSendRenewalPaymentLink($event)" class="item" :class="{disabled: isDisabled}"><?php echo e(__('To selected users')); ?></a>
				<a @click="createSendRenewalPaymentLink($event, true)" class="item" ><?php echo e(__('To users with expiring subscription')); ?></a>
			</div>
		</div>
	</div>

	<?php if(session('message')): ?>
	<div class="ui fluid message">
			<i class="close icon"></i>
			<?php echo e(session('message')); ?>

	</div>
	<?php endif; ?>


	<div class="ui fluid message response d-none">
			<i class="close icon"></i>
			<div class="content"></div>
	</div>

	<div class="table wrapper items subscriptions">
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
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'username', 'order' => $items_order])); ?>"><?php echo e(__('Name')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'name', 'order' => $items_order])); ?>"><?php echo e(__('Subscription')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'starts_at', 'order' => $items_order])); ?>"><?php echo e(__('Starts at')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'ends_at', 'order' => $items_order])); ?>"><?php echo e(__('Ends at')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'remaining_days', 'order' => $items_order])); ?>"><?php echo e(__('Remaining days')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'downloads', 'order' => $items_order])); ?>"><?php echo e(__('Downloads')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users_subscriptions', ['orderby' => 'expired', 'order' => $items_order])); ?>"><?php echo e(__('Status')); ?></a>
					</th>
				</tr>
			</thead>

			<tbody>
				<?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($subscription->id); ?>" @change="toogleId(<?php echo e($subscription->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned">
						<?php echo e($subscription->username); ?>

					</td>
					<td class="center aligned">
						<?php echo e($subscription->name); ?>

					</td>
					<td class="center aligned">
						<?php echo e($subscription->starts_at); ?>

					</td>
					<td class="center aligned">
						<?php echo e($subscription->ends_at ?? '-'); ?>

					</td>
					<td class="center aligned">
						<?php echo e($subscription->ends_at ? $subscription->remaining_days : '∞'); ?>

					</td>
					<td class="center aligned">
						<?php echo e($subscription->downloads); ?>

					</td>
					<td class="center aligned">
					  <?php if($subscription->status == 'pending'): ?>
					    <span class="ui basic circular fluid label orange"><?php echo e(__('Pending')); ?></span>
						<?php elseif($subscription->refunded): ?>
							<span class="ui basic circular fluid label red"><?php echo e(__('Refunded')); ?></span>
						<?php elseif(!$subscription->expired): ?>
							<span class="ui basic circular fluid label teal"><?php echo e(__('Active')); ?></span>
						<?php else: ?>
							<span class="ui basic circular fluid label red"><?php echo e(__('Expired')); ?></span>
						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($subscriptions->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($subscriptions->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($subscriptions->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>
</div>

<script>
	'use strict';

	var app = new Vue({
	  el: '#subscriptions',
	  data: {
	  	route: '<?php echo e(route('users_subscriptions.destroy', "")); ?>/',
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
	  		$('#subscriptions tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		var confirmationMsg = '<?php echo e(__('Are you sure you want to delete the selected subscriptions(s)')); ?> ?';

	  		if(!this.ids.length || !confirm(confirmationMsg))
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	deleteItem: function(e)
	  	{
	  		if(!confirm('<?php echo e(__('Are you sure you want to delete this subscription')); ?> ?'))
  			{
  				e.preventDefault();
  				return false;
  			}
	  	},
	  	createSendRenewalPaymentLink(e, all = false)
	  	{
	  		if(!all && !this.ids.length)
	  		{
	  			e.preventDefault();
	  			return;
	  		}

	  		$(e.target).closest('.ui.dropdown').toggleClass('disabled loading', true);

	  		$.post('<?php echo e(route('users_subscriptions.sendRenewalPaymentLink')); ?>', {ids: this.ids})
	  		.done(function(data)
	  		{ 	 
	  			if(data.errors)
	  			{
	  				for(var k in data.errors)
	  				{
	  					$('.ui.message.response .content').html('<p>' + data.errors[k] +'</p>')
	  				}
	  			}

	  			if(data.success)
	  			{
	  				for(var k in data.success)
	  				{
	  					$('.ui.message.response .content').html('<p>' + data.success[k] +'</p>')
	  				}
	  			}

	  			if(data.errors != undefined || data.success != undefined)
	  			{
	  				$('.ui.message.response').removeClass('d-none').removeClass('transition hidden');
	  			}
	  		})
	  		.always(function()
	  		{
	  			$(e.target).closest('.ui.dropdown').toggleClass('disabled loading', false);
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\subscriptions.blade.php ENDPATH**/ ?>