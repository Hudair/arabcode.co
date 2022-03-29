

<?php $__env->startSection('title', __('Dashboard')); ?>

<?php $__env->startSection('additional_head_tags'); ?>
<script src="<?php echo e(asset_('assets/admin/chart.bundle.2.9.3.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row main" id="dashboard">

	<div class="ui four doubling cards general">

		<div class="card fluid items">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Items')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/items.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->products); ?></h3>
				</div>
			</div>
		</div>

		<div class="card fluid orders">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Orders')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/cart.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->orders); ?></h3>
				</div>
			</div>
		</div>

		<div class="card fluid earnings">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Earnings')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/dollar.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e(config('payments.currency_code') .' '. number_format($counts->earnings, 2)); ?></h3>
				</div>
			</div>
		</div>

		<div class="card fluid users">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Users')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/users.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->users); ?></h3>
				</div>
			</div>
		</div>

		<div class="card fluid comments">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Comments')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/comments.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->comments); ?></h3>
				</div>
			</div>
		</div>

		<div class="card fluid subscribers">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Subscribers')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/subscribers.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->newsletter_subscribers); ?></h3>
				</div>
			</div>
		</div>

		<div class="card fluid categories">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Categories')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/tag.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->categories); ?></h3>
				</div>
			</div>
		</div>


		<div class="card fluid posts">
			<div class="content top">
				<h3 class="header"><?php echo e(__('Posts')); ?></h3>
			</div>
			<div class="content bottom px-0">
				<div class="l-side">
					<div class="ui image">
						<img src="<?php echo e(asset_('assets/images/pages.png')); ?>">
					</div>
				</div>
				<div class="r-side">
					<h3><?php echo e($counts->posts); ?></h3>
				</div>
			</div>
		</div>
	</div>



	<div class="transactions-sales-wrapper">
		<div class="latest transactions">
			<table class="ui celled unstackable table">
				<thead>
					<tr>
						<th colspan="5" class="left aligned header"><h3><?php echo e(__('Latest transactions')); ?></h3></th>
					</tr>
					<tr>
						<th class="left aligned w-auto"><?php echo e(__('Products')); ?></th>
						<th class="left aligned"><?php echo e(__('Buyer')); ?></th>
						<th class="left aligned"><?php echo e(__('Amount')); ?> (<?php echo e(config('payments.currency_code')); ?>)</th>
						<th class="left aligned"><?php echo e(__('Processor')); ?></th>
						<th class="left aligned"><?php echo e(__('Date')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td>
							<?php if($transaction->is_subscription): ?>
								<?php echo e(__('Subscription') .' - '. $transaction->products[0]); ?>

							<?php else: ?>
								<div class="ui bulleted list">
									<?php $__currentLoopData = $transaction->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php echo e($product); ?>

									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							<?php endif; ?>
						</td>
						<td class="left aligned"><?php echo e($transaction->buyer_name ?? $transaction->buyer_email); ?></td>
						<td class="left aligned"><?php echo e(number_format($transaction->amount, 2)); ?></td>
						<td class="left aligned capitalize"><?php echo e($transaction->processor); ?></td>
						<td class="left aligned"><?php echo e($transaction->date); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>

		<div class="sales chart">
			<div class="ui fluid card">
				<div class="content top">
				  <img class="left floated mini ui image mb-0" src="<?php echo e(asset_('assets/images/chart.png')); ?>">
				  <div class="ui floating dropdown scrolling large blue labeled icon button right floated circular" id="sales-months">
				  	<input type="hidden" name="month" value="<?php echo e(date('F')); ?>">
				  	<i class="dropdown icon"></i>
				  	<div class="text"><?php echo e(date('F')); ?></div>
				  	<div class="menu">
				  		<?php $__currentLoopData = cal_info(0)['months']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<a class="item" data-value="<?php echo e($month); ?>"><?php echo e(__($month)); ?></a>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  	</div>
				  </div>
				  <div class="header"><?php echo e(__('Sales')); ?></div>
				  <div class="meta">
				    <span class="date"><?php echo e(__('Sales evolution per month')); ?></span>
				  </div>
				</div>
				<div class="content">
					<div><canvas id="sales-chart" height="320" width="1284" min-width="1284"></canvas></div>
				</div>
			</div>
		</div>
	</div>


	<div class="ui two stackable cards latest mt-2">
		<div class="card fluid">
			<table class="ui celled unstackable table borderless">
				<thead>
					<tr>
						<th class="left aligned" colspan="2"><h3><?php echo e(__('Latest newsletter subscribers')); ?></h3></th>
					</tr>
					<tr>
						<th class="left aligned w-auto"><?php echo e(__('Email')); ?></th>
						<th class="left aligned"><?php echo e(__('Date')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $newsletter_subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsletter_subscriber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td class="capitalize"><?php echo e($newsletter_subscriber->email); ?></td>
						<td><?php echo e($newsletter_subscriber->created_at); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>

		<div class="card fluid">
			<table class="ui celled unstackable table borderless">
				<thead>
					<tr>
						<th class="left aligned" colspan="3"><h3><?php echo e(__('Latest reviews')); ?></h3></th>
					</tr>
					<tr>
						<th class="left aligned w-auto"><?php echo e(__('Product')); ?></th>
						<th class="left aligned"><?php echo e(__('Review')); ?></th>
						<th><?php echo e(__('Date')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><a href="<?php echo e(route('home.product', ['id' => $review->product_id, 'slug' => $review->product_slug.'#reviews'])); ?>"><?php echo e($review->product_name); ?></a></td>
						<td><div class="ui star small rating" data-rating="<?php echo e($review->rating); ?>" data-max-rating="5"></div></td>
						<td><?php echo e($review->created_at); ?></td>
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
			</table>
		</div>
	</div>

	<script type="application/javascript">
		'use strict';
		
		var ctx1 = document.getElementById("sales-chart").getContext('2d');

		window.chart = new Chart(ctx1, {
			type: 'bar',
			responsive: false,
			data: {
				labels: <?php echo json_encode(range(1, date('t'))); ?>, // days
				datasets: [{
					label: 'Sales',
					backgroundColor: '#EDEDED',
					data: <?php echo json_encode($sales); ?>, // Sales
					borderWidth: 0
				}]
			},
			options: {
				tooltips: {
					mode: 'index',
					intersect: false,
					backgroundColor: '#fff',
					cornerRadius: 0,
					bodyFontColor: '#000',
					titleFontColor: '#000',
					legendColorBackground: '#000'
				},
				legend: {
					display: false,
				},
				responsive: false,
				maintainAspectRatio: false,
				scales: {
					xAxes: [{
						stacked: true,
					}],
					yAxes: [{
						stacked: false,
						ticks: {
	            stepSize: 1,
	            min: 0
	          }
					}]
				}
			}
		});

		$('#sales-months').dropdown();

		$('#sales-months input').on('change', function()
		{
			$.post('<?php echo e(route('admin.update_sales_chart')); ?>', {month: $(this).val()}, null, 'json')
			.done(function(res)
			{
				chart.data.labels = res.labels;
				chart.data.datasets[0]['data'] = res.data;

				chart.update();
			})
			.fail(function()
			{
				alert('Failed to update sales chart')
			})
		})
	</script>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\back\index.blade.php ENDPATH**/ ?>