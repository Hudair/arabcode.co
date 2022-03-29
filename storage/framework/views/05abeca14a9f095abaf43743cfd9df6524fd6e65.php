

<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="faqs">

	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>
		
		<div class="right menu">
			<a href="<?php echo e(route('faq.create')); ?>" class="item ml-1"><?php echo e(__('Add')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items faqs">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>
						<div class="ui fitted checkbox">
						  <input type="checkbox" @change="selectAll">
						  <label></label>
						</div>
					</th>
					<th class="five columns wide">Question</th>
					<th>
						<a href="<?php echo e(route('faq', ['orderby' => 'active', 'order' => $items_order])); ?>"><?php echo e(__('Active')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('faq', ['orderby' => 'updated_at', 'order' => $items_order])); ?>"><?php echo e(__('Updated at')); ?></a>
					</th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($faq->id); ?>" @change="toogleId(<?php echo e($faq->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td><?php echo e(ucfirst($faq->question)); ?></td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="active" <?php if($faq->active): ?> checked <?php endif; ?> data-id="<?php echo e($faq->id); ?>" data-status="active" 
						  @click="updateStatus($event)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned"><?php echo e($faq->updated_at); ?></td>
					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars icon mx-0"></i>
							<div class="menu dropdown left rounded-corner">
								<a href="<?php echo e(route('faq.edit', $faq->id)); ?>" class="item"><?php echo e(__('Edit')); ?></a>
								<a @click="deleteItem($event)" href="<?php echo e(route('faq.destroy', $faq->id)); ?>" class="item"><?php echo e(__('Delete')); ?></a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
		
	<?php if($faqs->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($faqs->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($faqs->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('faq.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'FAQs'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="faqs">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('faqs'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#faqs',
	  data: {
	  	route: '<?php echo e(route('faq.destroy', "")); ?>/',
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
	  		$('#faqs tbody .ui.checkbox.select').checkbox('toggle')
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
	  	updateStatus: function(e)
	  	{	
	  		var thisEl  = $(e.target);
	  		var id 			= thisEl.data('id');

	  		$.post('<?php echo e(route('faq.status')); ?>', {id: id})
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\faq\index.blade.php ENDPATH**/ ?>