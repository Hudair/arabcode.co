<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<style type="text/css"> 
			@import  url('//fonts.googleapis.com/css2?family=Spartan:wght@400;600&display=swap');  
			p, h1, h2, h3, h4, ol, li, ul, th, td, span {  
				font-family: 'Spartan', sans-serif;
				line-height: 1.5;
			} 
		</style>
	</head>
    
	<body>
		<table style="height: 100%; width: 100%; min-height: 500px; background: ghostwhite; padding: 1rem;">
			<tbody><tr><td>
				<table style="max-width: 600px;width: 100%;margin: auto;background: #fff;border-radius: 1rem;padding: 1.5rem;">
					<thead>
						<tr>
							<th>
								<div style="padding: 1rem;font-size: 1.8rem;color: #4d91d7;"><?php echo e(config('app.name')); ?></div>
								<div style="margin-bottom: 2rem; height: .25rem; background: #4d91d7; border-radius: 100%;"></div>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div style="font-size: 1.4rem; text-align: center; font-weight: 600; margin-bottom: 2rem;"><?php echo e(__('Thanks for shopping with us!')); ?></div>

								<div style="margin: 1rem 0 1.5rem; padding: 0 .25rem; font-size: 1rem;"><?php echo e(__('Hi there. Thank you for your order! Your order details are shown below for your reference :')); ?></div>

								<div style="border-radius: .75rem; overflow: hidden; border: 1px solid #c7c7c7;">
									<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div style="display: flex; font-size: 1rem; line-height: 1.3; padding: 1rem; font-weight: 500; <?php if(!$loop->last): ?> border-bottom: 1px solid #c7c7c7; <?php endif; ?>">
										<div><?php echo e(mb_ucfirst($item['name'])); ?></div>
										<div style="margin-left: auto;"><?php echo e($item['value']); ?></div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<div style="display: flex; font-size: 1rem; line-height: 1.3; padding: 1rem; background: #f8f8ff; font-weight: 700;">
										<div><?php echo e(__('Total')); ?></div>
										<div style="margin-left: auto;"><?php echo e($currency.' '.$total_amount); ?></div>
									</div>
								</div>

								<?php if($exchange_rate != 1): ?>
								<div style="margin-top: .75rem; font-size: .8rem; margin-left: .5rem;"><?php echo e(__('Exchange rate')); ?> : <span><?php echo e($exchange_rate); ?></span></div>
								<?php endif; ?>
								<div style="margin-top: .5rem; font-size: .8rem; margin-left: .5rem;"><?php echo e(__('Reference ID')); ?> : <span><?php echo e($reference_id ?? null); ?></span></div>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>
								<div style="margin-top: 4rem; text-align: right; padding: 0 1rem; margin-left: auto; display: table;">
									<a style="text-decoration: none; font-size: .9rem; font-weight: 600; color: #c1c1c1;" href="<?php echo e(config('app.url')); ?>" target="_blank">
										<?php echo e(__(':app_name © :year All right reserved', ['app_name' => config('app.name'), 'year' => date('y')])); ?>

									</a>
								</div>
							</td>
						</tr>
					</tfoot>
				</table>			
			</td></tr></tbody>
		</table>
	</body>

</html><?php /**PATH D:\laragon\www\valexa\resources\views\mail\order.blade.php ENDPATH**/ ?>