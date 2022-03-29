

<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="reviews">

	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>
		
		<div class="right menu mr-1">
			<form action="<?php echo e(route('reviews')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="Search ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
		</div>
	</div>
	
	<div class="table wrapper items reviews">
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
						<a href="<?php echo e(route('reviews', ['orderby' => 'item_name', 'order' => $items_order])); ?>"><?php echo e(__('Item')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('reviews', ['orderby' => 'user_name', 'order' => $items_order])); ?>"><?php echo e(__('Name')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('reviews', ['orderby' => 'user_email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('reviews', ['orderby' => 'rating', 'order' => $items_order])); ?>"><?php echo e(__('Rating')); ?></a>
					</th>
					<th>
						<?php echo e(__('Review')); ?>

					</th>
					<th>
						<a href="<?php echo e(route('reviews', ['orderby' => 'approved', 'order' => $items_order])); ?>"><?php echo e(__('Approved')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('reviews', ['orderby' => 'created_at', 'order' => $items_order])); ?>"><?php echo e(__('Posted at')); ?></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr id="<?php echo e($review->id); ?>">
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($review->id); ?>" @change="toogleId(<?php echo e($review->id); ?>)">
						  <label></label>
						</div>
					</td> 
					<td><a href="<?php echo e(route('home.product', ['id' => $review->item_id, 'slug' => $review->item_slug])); ?>#reviews"><?php echo e(ucfirst($review->item_name)); ?></a></td>
					<td class="center aligned"><?php echo e($review->user_name); ?></td>
					<td class="center aligned"><?php echo e($review->user_email); ?></td>
					<td class="center aligned">
						<span class="ui star rating" data-rating="<?php echo e($review->rating); ?>" data-max-rating="5"></span>
					</td>
					<td class="center aligned">
						<?php if($review->content): ?>
						<span class="ui basic circular blue label review-content" data-html="<?php echo e(nl2br($review->content)); ?>"><?php echo e(__('Read')); ?></span>
						<?php else: ?>
						-
						<?php endif; ?>
					</td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
							<input type="checkbox" name="approved" <?php if($review->approved): ?> checked <?php endif; ?> @click="updateStatus($event)"
										 data-id="<?php echo e($review->id); ?>" data-item-id="<?php echo e($review->item_id); ?>" data-user-id="<?php echo e($review->user_id); ?>">
						  <label></label>
						</div>
					</td>
					<td class="center aligned"><?php echo e($review->created_at); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<?php if($reviews->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($reviews->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($reviews->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('reviews.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Reviews'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="reviews">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('reviews'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#reviews',
	  data: {
	  	route: '<?php echo e(route('reviews.destroy', "")); ?>/',
	    ids: [],
	    isDisabled: true,
	    itemId: ''
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
	  		$('#reviews tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		var confirmationMsg = '<?php echo e(__('Are you sure you want to delete the selected review(s)')); ?> ?';

	  		if(!this.ids.length || !confirm(confirmationMsg))
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	deleteItem: function(e)
	  	{
	  		if(!confirm('<?php echo e(__('Are you sure you want to delete this review')); ?> ?'))
  			{
  				e.preventDefault();
  				return false;
  			}
	  	},
	  	updateStatus: function(e)
	  	{	
	  		var thisEl  = $(e.target);

				var payload = {
					'id': thisEl.data('id'),
					'item_id': thisEl.data('item-id'),
					'user_id': thisEl.data('user-id')
				};
				
	  		$.post('<?php echo e(route('reviews.status')); ?>', payload)
				.done(function(res)
				{
					if(res.success)
					{
						thisEl.checkbox('toggle');
					}
				}, 'json')
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

	$(function()
	{
		$('.ui.rating').rating('disable');

		$('.review-content')
	  .popup()
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\reviews.blade.php ENDPATH**/ ?>