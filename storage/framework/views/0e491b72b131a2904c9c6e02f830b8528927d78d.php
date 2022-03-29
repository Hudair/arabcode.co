

<?php $__env->startSection('title', __('Users')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="users">

	<div class="ui menu shadowless">		
		<a @click="deleteItems" :href="route+ids.join()" class="item" :class="{disabled: isDisabled}"><?php echo e(__('Delete')); ?></a>

		<a @click="notifyUsers" class="item"><?php echo e(__('Notify')); ?></a>

		<a class="item export"><?php echo e(__('Export')); ?></a>

		<div class="right menu mr-1">
			<form action="<?php echo e(route('users')); ?>" method="get" id="search" class="ui transparent icon input item">
        <input class="prompt" type="text" name="keywords" placeholder="<?php echo e(__('Search')); ?> ..." required>
        <i class="search link icon" onclick="$('#search').submit()"></i>
      </form>
		</div>
	</div>

	<div class="table wrapper items users">
		<table class="ui unstackable celled basic table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>
						<a href="<?php echo e(route('users', ['orderby' => 'email', 'order' => $items_order])); ?>"><?php echo e(__('Email')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users', ['orderby' => 'verified', 'order' => $items_order])); ?>"><?php echo e(__('Verified')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users', ['orderby' => 'blocked', 'order' => $items_order])); ?>"><?php echo e(__('Blocked')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users', ['orderby' => 'purchases', 'order' => $items_order])); ?>"><?php echo e(__('Purchased items')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users', ['orderby' => 'total_purchases', 'order' => $items_order])); ?>"><?php echo e(__('Total expenses')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('users', ['orderby' => 'created_at', 'order' => $items_order])); ?>"><?php echo e(__('Created at')); ?></a>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>

					<td class="center aligned">
						<div class="ui fitted checkbox">
						  <input type="checkbox" value="<?php echo e($user->id); ?>" @change="toogleIdEmail(<?php echo e($user->id); ?>, '<?php echo e($user->email); ?>')">
						  <label></label>
						</div>
					</td>

					<td><?php echo e(ucfirst($user->email)); ?></td>
					
					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="verified" <?php if($user->verified): ?> checked <?php endif; ?> data-id="<?php echo e($user->id); ?>" data-status="verified" @change="updateStatus($event)">
						  <label></label>
						</div>
					</td>

					<td class="center aligned">
						<div class="ui toggle fitted checkbox">
						  <input type="checkbox" name="blocked" <?php if($user->blocked): ?> checked <?php endif; ?> data-id="<?php echo e($user->id); ?>" data-status="blocked" @change="updateStatus($event)">
						  <label></label>
						</div>
					</td>

					<td class="center aligned"><?php echo e($user->purchases); ?></td>

					<td class="center aligned"><?php echo e(config('payments.currency_code').' '.$user->total_purchases); ?></td>

					<td class="center aligned"><?php echo e($user->created_at); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
	
	<?php if($users->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($users->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($users->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<form class="ui form modal export" action="<?php echo e(route('users.export')); ?>" method="POST">
		<div class="header"><?php echo e(__('Export :table_name table', ['table_name' => 'Users'])); ?></div>
		<div class="content">
			<input type="hidden" name="ids" :value="ids.join()">
			<input type="hidden" name="model" value="users">
			
			<table class="ui unstackable fluid basic table mt-0">
				<thead>
					<tr>
						<th><?php echo e(__('Column')); ?></th>
						<th><?php echo e(__('Rename column')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = \Schema::getColumnListing('users'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

	<form action="<?php echo e(route('users.notify')); ?>" method="POST" class="ui modal form notify">
		<div class="header"><?php echo e(__('Send notification')); ?></div>

		<div class="content">
			<input type="hidden" name="emails" :value="emails.join()">
			<div class="field">
				<label><?php echo e(__('Notification')); ?></label>
				<textarea v-model="notification" cols="30" rows="10"></textarea>
			</div>
		</div>

		<div class="actions">
			<button class="ui circular button large yellow approve" type="button"><?php echo e(__('Submit')); ?></button>
			<button class="ui circular button large blue cancel" type="button"><?php echo e(__('Cancel')); ?></button>
		</div>
	</form>
</div>

<script>
	'use strict';
	
	var app = new Vue({
	  el: '#users',
	  data: {
	  	route: '<?php echo e(route('users.destroy', "")); ?>/',
	    ids: [],
	    emails: [],
	    notification: '',
	    isDisabled: true
	  },
	  methods: {
	  	notifyUsers: function()
	  	{
	  		$('form.notify').modal({
	  			center: true,
	  			closable: false,
	  			onApprove: function()
	  			{
	  				var payload = {emails: app.emails, notification: app.notification};

	  				Vue.nextTick(function()
	  				{
		  				$.post('<?php echo e(route('users.notify')); ?>', payload)
		  				.done(function(data)
		  				{

		  				})	
	  				})
	  			}
	  		})
	  		.modal('show')
	  	},
	  	toogleIdEmail: function(id, email)
	  	{
	  		if(this.ids.indexOf(id) >= 0)
  			{
  				this.ids.splice(this.ids.indexOf(id), 1);
  				this.emails.splice(this.emails.indexOf(email), 1);
  			}
	  		else
	  		{
	  			this.emails.push(email);
	  			this.ids.push(id);
	  		}
	  	},
	  	deleteItems: function(e)
	  	{
	  		if(!this.ids.length)
	  		{
	  			e.preventDefault();
	  			return false;
	  		}
	  	},
	  	updateStatus: function(e)
	  	{	
	  		var thisEl  = $(e.target);
	  		var id 			= thisEl.data('id');
	  		var status 	= thisEl.data('status');
	  		var val  		= thisEl.prop('checked') ? 1 : 0;

	  		if(['verified', 'blocked'].indexOf(status) < 0)
	  			return;

	  		$.post('<?php echo e(route('users.status')); ?>', {status: status, id: id, val: val});
	  	},
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
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\users.blade.php ENDPATH**/ ?>