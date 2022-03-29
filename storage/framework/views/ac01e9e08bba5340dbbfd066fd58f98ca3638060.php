

<?php $__env->startSection('title', $title); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="comments">

	<div class="ui menu shadowless">		
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>
		
		<div class="right menu mr-1">
			<form action="<?php echo e(route('comments')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
		</div>
	</div>
	
	<div class="table wrapper items comments">
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
						<a href="<?php echo e(route('comments', ['orderby' => 'item_name', 'order' => $items_order])); ?>"><?php echo e(__('Items')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('comments', ['orderby' => 'user_name', 'order' => $items_order])); ?>"><?php echo e(__('Name')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('comments', ['orderby' => 'user_email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th>
						Comment
					</th>
					<th>
						<a href="<?php echo e(route('comments', ['orderby' => 'approved', 'order' => $items_order])); ?>"><?php echo e(__('Approved')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('comments', ['orderby' => 'created_at', 'order' => $items_order])); ?>"><?php echo e(__('Posted at')); ?></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr id="<?php echo e($comment->id); ?>">
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($comment->id); ?>" @change="toogleId(<?php echo e($comment->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td><a href="<?php echo e(route('home.product', ['id' => $comment->item_id, 'slug' => $comment->item_slug])); ?>#support"><?php echo e(ucfirst($comment->item_name)); ?></a></td>
					<td class="center aligned"><?php echo e($comment->user_name); ?></td>
					<td class="center aligned"><?php echo e($comment->user_email); ?></td>
					<td class="center aligned">
						<span class="ui basic circular blue label comment-content" data-html="<?php echo e(nl2br($comment->body)); ?>">
							<?php echo e(__('Read')); ?>

						</span>
					</td>
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
							<input type="checkbox" name="approved" <?php if($comment->approved): ?> checked <?php endif; ?>  @change="updateStatus($event)"
							data-id="<?php echo e($comment->id); ?>" data-item-id="<?php echo e($comment->item_id); ?>" data-user-id="<?php echo e($comment->user_id); ?>">
						  <label></label>
						</div>
					</td>
					<td class="center aligned"><?php echo e($comment->created_at); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<div class="ui fluid divider"></div>

	<?php echo e($comments->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($comments->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>


	<form class="ui form modal export" action="<?php echo e(route('comments.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Comments'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="comments">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('comments'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#comments',
	  data: {
	  	route: '<?php echo e(route('comments.destroy', "")); ?>/',
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
	  		$('#comments tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	deleteItems: function(e)
	  	{
	  		var confirmationMsg = '<?php echo e(__('Are you sure you want to delete the selected comment(s)')); ?> ?';

	  		if(!this.ids.length || !confirm(confirmationMsg))
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	deleteItem: function(e)
	  	{
	  		if(!confirm('<?php echo e(__('Are you sure you want to delete this comment')); ?> ?'))
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

	  		$.post('<?php echo e(route('comments.status')); ?>', payload)
				.done(function(res)
				{
					if(res.success)
					{
						thisEl.checkbox('toggle');
					}
				}, 'json')
				.fail(function()
				{
					alert('<?php echo e(__('Failed')); ?>')
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
		$('.comment-content').popup()
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\comments.blade.php ENDPATH**/ ?>