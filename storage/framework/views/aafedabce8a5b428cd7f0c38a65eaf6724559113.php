

<?php $__env->startSection('title', __('Support')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="supports">
	
	<?php if(session('unseen_messages')): ?>
	<div class="ui positive message bold">
		<i class="close icon mx-0"></i>
		<?php echo e(session('unseen_messages')); ?>

	</div>
	<?php endif; ?>

	<div class="ui menu shadowless">
		<a id="bulk-delete" @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu">
			<form action="<?php echo e(route('support')); ?>" method="get" id="search" class="ui transparent icon input item mr-1">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
		</div>
	</div>
	
	<div class="table wrapper items supports">
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
						<a href="<?php echo e(route('support', ['orderby' => 'email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th class="five columns wide"><?php echo e(__('Subject')); ?></th>
					<th>
						<a href="<?php echo e(route('support', ['orderby' => 'read', 'order' => $items_order])); ?>"><?php echo e(__('Read')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('support', ['orderby' => 'created_at', 'order' => $items_order])); ?>"><?php echo e(__('Created at')); ?></a>
					</th>
					<th><?php echo e(__('Actions')); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $support_messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr id="<?php echo e($message->id); ?>">
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($message->id); ?>" @change="toogleId(<?php echo e($message->id); ?>)">
						  <label></label>
						</div>
					</td>
					<td><?php echo e(ucfirst($message->email)); ?></td>
					<td><?php echo e(ucfirst($message->subject)); ?></td>
					<td class="center aligned">
						<span class="ui circular basic <?php if(!$message->read): ?> blue <?php endif; ?> label support-message" 
							data-id="<?php echo e($message->id); ?>" 
							data-html="<?php echo e(nl2br($message->content)); ?>">
							<?php echo e(__('Read')); ?>

						</span>
					</td>
					<td class="center aligned"><?php echo e($message->created_at); ?></td>
					<td class="center aligned one column wide">
						<div class="ui dropdown">
							<i class="bars icon mx-0"></i>
							<div class="menu rounded-corner dropdown left">
								<a class="item" @click="replyToMessage('<?php echo e($message->email); ?>')"><?php echo e(__('Reply')); ?></a>
								<a @click="deleteItem($event)" href="<?php echo e(route('support.destroy', $message->id)); ?>" class="item"><?php echo e(__('Delete')); ?></a>
							</div>
						</div>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<?php if($support_messages->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($support_messages->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($support_messages->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<div class="ui tiny modal" id="message-form">
		<form method="post" class="ui large form content" spellcheck="false">
			<div class="field">
				<label><?php echo e(__('Message')); ?></label>
				<textarea name="message" cols="30" rows="10" class="rounded-corner"></textarea>
			</div>
			<div class="field">
				<label><?php echo e(__('Subject')); ?></label>
				<input type="text" name="subject" class="circular-corner">
				<input type="hidden" name="email" v-model="email">
			</div>
		</form>
		<div class="content actions">
			<a class="ui teal large approve circular button"><?php echo e(__('Send')); ?></a>
			<a class="ui yellow large cancel circular button"><?php echo e(__('Cancel')); ?></a>
		</div>
	</div>

	<form class="ui form modal export" action="<?php echo e(route('support.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Support'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="support">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('support'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
	  el: '#supports',
	  data: {
	  	route: '<?php echo e(route('support.destroy', "")); ?>/',
	    ids: [],
	    isDisabled: true,
	    email: ''
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
	  		$('#supports tbody .ui.checkbox').checkbox('toggle')
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
	  	replyToMessage: function(email)
	  	{
	  		this.email = email;
	  		Vue.nextTick(function()
	  		{
	  			$('#message-form').modal('show')
	  			.modal({
	  				closable: false,
	  				onApprove: function()
	  				{
	  					var formData = $('form', this).serialize();

	  					$.post('<?php echo e(route('support.create')); ?>', formData)
	  					.done(function(data)
	  					{
	  						if(data.status === true)
	  						{
	  							alert(__('Message sent.'))
	  						}
	  					})
	  					.fail(function(data)
	  					{
	  						alert(JSON.stringify(data.responseJSON))
	  					})
	  				},
	  				onDeny: function()
	  				{

	  				}
	  			});
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

	$(function()
	{
		$('.support-message').popup({
	    on: 'click',
	    onShow: function(el)
	    {
	    	var id = $(el).data('id');

	    	if($(el).hasClass('blue'))
	    	{
	    		$.post('<?php echo e(route('support.status')); ?>', {id: id}, null, 'json')
	    		.done(function()
	    		{
	    			$(el).removeClass('blue')
	    		})
	    		.fail(function()
	    		{
	    			alert('<?php echo e(__('Failed to update read status')); ?>');
	    		})
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
	})

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\support.blade.php ENDPATH**/ ?>