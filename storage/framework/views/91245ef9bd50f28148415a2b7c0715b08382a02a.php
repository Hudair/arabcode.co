<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo e(__('Invoice')); ?></title>
	<style>
		#watermark {
	    position: fixed;
	    top: 45%;
	    width: 100%;
	    text-align: center;
	    opacity: .05;
	    transform: rotate(10deg);
	    transform-origin: 50% 50%;
	    z-index: -1000;
	    font-size: 8rem;
	    font-weight: bold;
	    font-family: 'sans-serif';
	  }

	  #app-name {
	  	padding: 1rem;
	  }

	  #refunded {
	  	position: fixed;
	    top: 90%;
	    width: 100%;
	    text-align: left;
	    opacity: 1;
	    z-index: -1000;
	    font-size: 2rem;
	    font-weight: bold;
	    font-family: 'sans-serif';
	    color: #FF3B3B;
	  }

	  #reference {
	  	max-width: 400px;
	  	float: right;
	  }
	</style>
</head>

<body dir="<?php echo e(locale_direction()); ?>">
	<div id="watermark">
    <?php echo e(config('app.name')); ?>

  </div>

  <?php if($refunded): ?>
  <div id="refunded"><?php echo e(__('Refunded')); ?></div>
  <?php endif; ?>

	<div style="line-height: 2rem; font-size: 1.1rem;">
		<div style="display: flex;padding: 0 2rem;">
			<div style="flex: 1;">
				<div style="font-weight: 500; font-size: 3rem;" id="app-name"><?php echo e(config('app.name')); ?></div>
				<div><?php echo e(__('Email')); ?> : <?php echo e(config('app.email')); ?></div>
				<div><?php echo e(__('Website')); ?> : <?php echo e(config('app.url')); ?></div>
			</div>

			<div style="flex: 1; text-align: right;">
				<div><?php echo e(__('Date')); ?> : <?php echo e($transaction->created_at); ?></div>
				<div id="reference"><?php echo e(__('Reference')); ?> : <?php echo e($reference); ?></div>
			</div>
		</div>

		<div style="padding: 2rem;">
			<div style="font-weight: 500; font-size: 1.2rem;"><?php echo e(__('Bill to :')); ?></div>
			<div><?php echo e(__('Name')); ?> : <?php echo e($buyer->name); ?></div>
			<div><?php echo e(__('Email')); ?> : <?php echo e($buyer->email); ?></div>
		</div>

		<div>
			<div>
				<table style="border-spacing: 0; width: 100%;">
					<thead style="background: ghostwhite">
						<tr>
							<th style="border: 1px solid #acacac; padding: .5rem; text-transform: uppercase;"><?php echo e(__('Description')); ?></th>
							<th style="border: 1px solid #acacac; padding: .5rem; text-transform: uppercase;"><?php echo e(__('Unit price')); ?></th>
							<th style="border: 1px solid #acacac; padding: .5rem; text-transform: uppercase;"><?php echo e(__('Quantity')); ?></th>
							<th style="border: 1px solid #acacac; padding: .5rem; text-transform: uppercase;"><?php echo e(__('Total')); ?></th>
						</tr>	
					</thead>
					<tbody>
						<?php $__currentLoopData = $items ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td style="border: 1px solid #acacac; padding: .5rem;">
									<?php echo e($item['name']); ?>

									<?php if($is_subscription): ?>
									<sup>(<?php echo e(__('Subscription')); ?>)</sup>
									<?php endif; ?>
								</td>
								<td style="border: 1px solid #acacac; padding: .5rem; text-align: right;"><?php echo e($item['value']); ?></td>
								<td style="border: 1px solid #acacac; padding: .5rem; text-align: right;">1</td>
								<td style="border: 1px solid #acacac; padding: .5rem; text-align: right;"><?php echo e($item['value']); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody>
					<tfoot style="text-align: right;">
						<tr>
							<td></td>
							<td></td>
							<td style="padding: .5rem; font-weight: 500;"><?php echo e(__('Subtotal')); ?></td>
							<td style="border: 1px solid #acacac; padding: .5rem;"><?php echo e($currency .' '. $subtotal); ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td style="padding: .5rem; font-weight: 500;"><?php echo e(__('Handling Fee')); ?></td>
							<td style="border: 1px solid #acacac; padding: .5rem;"><?php echo e($currency .' '. $fee); ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td style="padding: .5rem; font-weight: 500;"><?php echo e(__('Tax')); ?></td>
							<td style="border: 1px solid #acacac; padding: .5rem;"><?php echo e($currency .' '. $tax); ?></td>
						</tr>
						<?php if($discount): ?>
						<tr>
							<td></td>
							<td></td>
							<td style="padding: .5rem; font-weight: 500;"><?php echo e(__('Discount')); ?></td>
							<td style="border: 1px solid #acacac; padding: .5rem;"><?php echo e($currency .' '. $discount); ?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td></td>
							<td></td>
							<th style="padding: .5rem; text-align: right; font-weight: 500;"><?php echo e(__('Total due')); ?></td>
							<td style="border: 1px solid #acacac; padding: .5rem; background: ghostwhite"><?php echo e($currency .' '. $total_due); ?></td>
						</tr>
					</tfoot>
				</table>			
			</div>
		</div>
	</div>
</body>
</html><?php /**PATH D:\laragon\www\valexa\resources\views\invoice.blade.php ENDPATH**/ ?>