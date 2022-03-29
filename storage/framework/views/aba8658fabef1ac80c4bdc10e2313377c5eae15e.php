

<?php $__env->startSection('title', __('Notifications')); ?>


<?php $__env->startSection('content'); ?>

<div class="row main" id="admin-notifs">

	<div class="ui menu shadowless">		
		<a @click="readNotif($event, false)" class="item" :class="{disabled: !Object.keys(ids).length}"><?php echo e(__('Mark as read')); ?></a>
	</div>

	<div class="table wrapper items admin-notifs">
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
						<a href="<?php echo e(route('admin_notifs', ['orderby' => 'user', 'order' => $items_order])); ?>"><?php echo e(__('User')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('admin_notifs', ['orderby' => 'item_created_at', 'order' => $items_order])); ?>"><?php echo e(__('Created at')); ?></a>
					</th>
					<th>
						<a href="<?php echo e(route('admin_notifs', ['orderby' => 'table', 'order' => $items_order])); ?>"><?php echo e(__('Type')); ?></a>
					</th>
					<th>-</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $admin_notifs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="center aligned">
						<div class="ui fitted checkbox select">
						  <input type="checkbox" value="<?php echo e($notif->item_id); ?>" @change="toogleId(<?php echo e(json_encode($notif)); ?>)">
						  <label></label>
						</div>
					</td>
					<td><?php echo e($notif->user); ?></td>
					<td class="center aligned"><?php echo e($notif->item_created_at); ?></td>
					<td class="center aligned"><?php echo e($notif->table); ?></td>
					<td class="center aligned"><button class="ui small circular button" data-content="<?php echo e(base64_encode($notif->item_content)); ?>" data-id="<?php echo e($notif->item_id); ?>" data-table="<?php echo e($notif->table); ?>" type="button" @click="readNotif($event)"><?php echo e(__('Read')); ?></button></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>

	<?php if($admin_notifs->hasPages()): ?>
	<div class="ui fluid divider"></div>

	<?php echo e($admin_notifs->appends($base_uri)->onEachSide(1)->links()); ?>

	<?php echo e($admin_notifs->appends($base_uri)->links('vendor.pagination.simple-semantic-ui')); ?>

	<?php endif; ?>

	<div class="ui small modal" id="notif-content">
		<div class="content">{{ notifContent }}</div>
	</div>
</div>

<script>
	'use strict';
	
	var app = new Vue({
	  el: '#admin-notifs',
	  data: {
	    ids: {},
	    isDisabled: true,
	    itemId: '',
	    notifContent: ''
	  },
	  methods: {
	  	toogleId: function(item)
	  	{
	  		var keys = Object.keys(this.ids);

	  		if(keys.indexOf(item.item_id + '-' + item.table) >= 0)
	  		{
	  			var ids = {};

	  			for(var i in keys)
	  			{
	  				if(keys[i] != item.item_id + '-' + item.table)
	  				{
	  					ids[keys[i]] = this.ids[keys[i]];
	  				}
	  			}

	  			this.ids = ids;
	  		}
	  		else
	  		{
	  			var key = item.item_id + '-' + item.table;

	  			Vue.set(this.ids, key, {id: item.item_id, table: item.table});
	  		}
	  	},
	  	selectAll: function()
	  	{
	  		$('#admin-notifs tbody .ui.checkbox.select').checkbox('toggle')
	  	},
	  	readNotif: function(e, single = true)
	  	{	
	  		if(single)
	  		{
	  			var thisEl  = $(e.target);
	  			var data = thisEl.data();
					var payload = {0: {id: data.id, table: data.table}};

					app.notifContent = decodeURIComponent(atob(data.content));

					Vue.nextTick(function()
					{
						$('#notif-content').modal('show');
					})
	  		}
	  		else
	  		{
	  			var payload = this.ids;
	  		}

	  		if(!Object.keys(payload).length)
	  		{
	  			return;
	  		}

	  		$.post('<?php echo e(route('admin_notifs.mark_as_read')); ?>', {items: payload})
	  		.done(function()
	  		{
	  			if(!single)
	  			{
	  				app.notifContent = '<?php echo e(__('Done')); ?>';

						Vue.nextTick(function()
						{
							$('#notif-content')
							.modal({
								closable: true,
								onHidden: function()
								{
									location.reload();
								}
							})
							.modal('show')
						})
	  			}
	  		})
	  	}
	  }
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\admin_notifs.blade.php ENDPATH**/ ?>