

<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="subscribers">
	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu">
			<a href="<?php echo e(route('subscribers.newsletter.create')); ?>" class="item ml-1"><?php echo e(__('Create newsletter')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items subscribers">
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
						<a href="<?php echo e(route('subscribers', ['orderby' => 'email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('subscribers', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Updated at')); ?></a>
					</th>
					<th><?php echo e(__('Delete')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($subscriber->id); ?>" @change="toogleId(<?php echo e($subscriber->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td><?php echo e(ucfirst($subscriber->email)); ?></td>
					<td class="center aligned"><?php echo e($subscriber->updated_at); ?></td>
					<td class="center aligned one column wide">
						<a @click="deleteItem($event)" href="<?php echo e(route('subscribers.destroy', $subscriber->id)); ?>" class="ui basic circular labeled icon button"><i class="trash alternate outline icon"></i><?php echo e(__('Delete')); ?></a>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($subscribers->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($subscribers->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($subscribers->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('subscribers.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Newsletter_subscribers'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="subscribers">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('newsletter_subscribers'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#subscribers',
	  data: {
	  	route: '<?php echo e(route('subscribers.destroy', "")); ?>/',
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
	  		$('#subscribers tbody .ui.checkbox.select').checkbox('toggle')
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\newsletters\subscribers.blade.php ENDPATH**/ ?>