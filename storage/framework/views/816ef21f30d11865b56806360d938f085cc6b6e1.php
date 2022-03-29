

<?php $__env->startSection('title', __('Payment links')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="payment_links">

	<?php if(session('message')): ?>
	<div class="ui positive message circular-corner">
		<?php echo e(session('message')); ?>

		<i class="close icon"></i>
	</div>
	<?php endif; ?>

	<div class="ui positive message circular-corner" v-if="response.length">
		{{ response }}
	</div>

	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu">
			<a href="<?php echo e(route('payment_links.create')); ?>" class="item ml-1"><?php echo e(__('Add')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items payment_links">
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
						<a href="<?php echo e(route('payment_links', ['orderby' => 'name', 'order' => $items_order])); ?>"><?php echo e(__('Name')); ?></a>
					</th>
					<th class="five columns wide">
						<a href="<?php echo e(route('payment_links', ['orderby' => 'processor', 'order' => $items_order])); ?>"><?php echo e(__('Processor')); ?></a>
					</th>
					<th class="five columns wide">
						<a href="<?php echo e(route('payment_links', ['orderby' => 'short_link', 'order' => $items_order])); ?>"><?php echo e(__('Short link')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('payment_links', ['orderby' => 'user', 'order' => $items_order])); ?>"><?php echo e(__('User')); ?></a>
					</th>
					<th><?php echo e(__('Amount')); ?></th>
					<th><?php echo e(__('Status')); ?></th>
					<th>
						<a href="<?php echo e(route('payment_links', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Created at')); ?></a>
					</th>
					
					<th>-</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $payment_links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($payment_link->id); ?>" @change="toogleId(<?php echo e($payment_link->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td class="one column wide"><?php echo e(ucfirst($payment_link->name)); ?></td>
					<td><?php echo e(ucfirst($payment_link->processor)); ?></td>
					<td class="center aligned"><?php echo e(urldecode($payment_link->short_link)); ?></td>
					<td class="center aligned"><?php echo e($payment_link->user); ?></td>
					<td class="center aligned"><?php echo e($payment_link->amount); ?> <sup>(<?php echo e($payment_link->currency); ?>)</sup></td>
					<td class="center aligned"><?php echo e(__(mb_ucfirst($payment_link->status))); ?></td>
					<td class="center aligned"><?php echo e($payment_link->updated_at); ?></td>
					
					<td><button class="ui yellow small button circular btn-<?php echo e($payment_link->id); ?>" <?php echo e($payment_link->status !== '-' ? 'disabled' : ''); ?> type="button" @click="intPaymentLinkModal($event, <?php echo e($payment_link->id); ?>)"><?php echo e($payment_link->status !== '-' ? __('Sent') : __('Send')); ?></button></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<form class="ui form modal payment-link-modal" :target="target" action="<?php echo e(route('payment_links.send')); ?>" method="POST">
		<input type="hidden" name="id" v-model="paymentLinkId">
		<input type="hidden" name="action" v-model="action">
		<div class="header"><?php echo e(__('Send payment link')); ?></div>
		<div class="content">
			<div class="field">
				<label><?php echo e(__('Subject')); ?></label>
				<input type="text" name="subject" v-model="subject" placeholder="<?php echo e(__('Subject')); ?>">
			</div>
			<div class="field">
				<label><?php echo e(__('Text')); ?></label>
				<input type="text" name="text" v-model="text" placeholder="<?php echo e(__('Text')); ?>">
			</div>
			<div class="field">
				<button class="ui circular yellow button" type="button" @click="sendPaymentLink('send')"><?php echo e(__('Send')); ?></button>
				<button class="ui circular red button" type="button" @click="sendPaymentLink('render')"><?php echo e(__('Preview')); ?></button>
			</div>
		</div>
	</form>
	
	<?php if($payment_links->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($payment_links->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($payment_links->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('payment_links.export')); ?>" method="payment_link">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'payment_links'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="payment_links">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('payment_links'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#payment_links',
	  data: {
	  	route: '<?php echo e(route('payment_links.destroy', "")); ?>/',
	    ids: [],
	    isDisabled: true,
	    details: <?php echo json_encode($payment_links->pluck('details', 'id')->toArray()); ?>,
	    action: 'send',
	    paymentLinkId: null,
	    subject: null,
	    text: null,
	    target: '',
	    response: ''
	  },
	  methods: {
	  	sendPaymentLink: function(action)
	  	{
	  		this.action = action;
	  		this.target = action === 'send' ? '' : '_blank';

	  		Vue.nextTick(function()
	  		{
	  			if(action === 'send')
	  			{
		  			$('.modal.payment-link-modal').modal('hide');

		  			var payload = {id: app.paymentLinkId, subject: app.subject, text: app.text, action: app.action};

		  			$('button.btn-' + app.paymentLinkId).toggleClass('disabled loading', true);

		  			$.post('<?php echo e(route('payment_links.send')); ?>', payload, 'json')
		  			.done(function(data)
		  			{
		  				$('button.btn-' + app.paymentLinkId).toggleClass('disabled loading', false);
		  				
		  				app.response = data.response;

		  				setTimeout(function()
		  				{
		  					app.response = '';
		  				}, 3000)
		  			})	
	  			}
	  			else
	  			{
	  				$('.payment-link-modal').submit();
	  			}
	  		})

	  		return;
	  	},
	  	intPaymentLinkModal: function(e, paymentLinkId)
	  	{
	  		if($(e.target).prop('disbaled'))
	  			return false;

	  		this.paymentLinkId = paymentLinkId;

	  		Vue.nextTick(function()
	  		{
	  			$('.modal.payment-link-modal').modal('show');
	  		})
	  	},
	  	toogleId: function(id)
	  	{
	  		if(this.ids.indexOf(id) >= 0)
	  			this.ids.splice(this.ids.indexOf(id), 1);
	  		else
	  			this.ids.push(id);
	  	},
	  	selectAll: function()
	  	{
	  		$('#payment_links tbody .ui.checkbox.select').checkbox('toggle')
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

	$('#search').on('submit', function(event)
	{
		if(!$('input', this).val().trim().length)
		{
			e.preventDefault();
			return false;
		}
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\payment_links\index.blade.php ENDPATH**/ ?>