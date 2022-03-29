

<?php $__env->startSection('title', __('Categories')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="categories">
	<div class="ui menu large shadowless">
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>
		
		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="ui pointing dropdown link item">
			<span class="default text"><?php echo e(__(ucfirst(request()->for ?? 'Filter'))); ?></span>
			<i class="dropdown icon"></i>
			<div class="menu">
				<a href="<?php echo e(route('categories')); ?>" class="item"><?php echo e(__('All')); ?></a>
				<a href="<?php echo e(route('categories', 'posts')); ?>" class="item"><?php echo e(__('Posts')); ?></a>
				<a href="<?php echo e(route('categories', 'products')); ?>" class="item"><?php echo e(__('Products')); ?></a>
			</div>
		</div>

		<div class="right menu">
			<a href="<?php echo e(route('categories.create')); ?>" class="item"><?php echo e(__('Add')); ?></a>
		</div>
	</div>
	
	<div class="table wrapper items categories">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>
						<div class="ui fitted checkbox">
						  <input type="checkbox" @change="selectAll">
						  <label></label>
						</div>
					</th>
					<th>ID</th>
					<th class="five columns wide"><?php echo e(__('Name')); ?></th>
					<th><?php echo e(__('Position')); ?></th>
					<th><?php echo e(__('Parent')); ?></th>
					<th><?php echo e(__('Created at')); ?></th>
					<th><?php echo e(__('Updated at')); ?></th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($category->id); ?>" @change="toogleId(<?php echo e($category->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td class="center aligned"><?php echo e($category->id); ?></td>
					<td><?php echo e(ucfirst($category->name)); ?></td>
					<td class="center aligned"><?php echo e($category->range); ?></td>
					<td class="center aligned"><?php echo e($category->parent_name ?? '-'); ?></td>
					<td class="center aligned"><?php echo e($category->created_at); ?></td>
					<td class="center aligned"><?php echo e($category->updated_at); ?></td>
					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars icon mx-0"></i>
							<div class="menu dropdown left">
								<a href="<?php echo e(route('categories.edit', ['id' => $category->id, 'for' => $category->for])); ?>" class="item"><?php echo e(__('Edit')); ?></a>
								<a href="<?php echo e(route('categories.destroy', ['ids' => $category->id, 'for' => $category->for])); ?>" class="item"><?php echo e(__('Delete')); ?></a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<form class="ui form modal export" action="<?php echo e(route('categories.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Categories'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="categories">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('categories'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#categories',
	  data: {
	  	route: '<?php echo e(route('categories.destroy', "")); ?>/',
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
	  		$('#categories tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		var confirmationMsg = '<?php echo e(__('Are you sure you want to delete the selected element(s)')); ?> ?';

	  		if(!this.ids.length || !confirm(confirmationMsg))
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\categories\index.blade.php ENDPATH**/ ?>