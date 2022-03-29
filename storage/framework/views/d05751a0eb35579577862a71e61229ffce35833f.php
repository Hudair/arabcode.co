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
				<table style="max-width: 600px;width: 100%;margin: auto;background: #1d1d1d;border-radius: 1rem;padding: 1.5rem;">
					<thead>
						<tr>
							<th>
								<div style="padding: 1rem;font-size: 1.8rem;color: #ffffff;background: #2c2c2c;border-radius: 2rem 2rem 0 0;"><?php echo e(config('app.name')); ?></div>
								<div style="margin-bottom: 2rem;height: .25rem;background: #b7003c;border-radius: 100%;"></div>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<div style="font-size: 1.4rem;text-align: center;font-weight: 600;margin-bottom: 1rem;color: #fff;display: table;margin-right: auto;"><?php echo e(__('Hi :username', ['username' => $username])); ?></div>

								<div style="color: #fff;margin: 1rem 0 1.5rem;padding: 0 .25rem;font-size: 1rem;"><?php echo e(($text ?? null) ? __($text) : __('You have received a new payment request for :')); ?></div>

								<div style="border-radius: .75rem;overflow: hidden;color: #fff;background: #1d2224;">
									<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div style="display: flex; font-size: 1rem; line-height: 1.3; padding: 1rem; font-weight: 500; <?php if(!$loop->last): ?> border-bottom: 1px solid #c7c7c7; <?php endif; ?>">
										<div><?php echo e(mb_ucfirst($item['name'])); ?></div>
										<div style="margin-left: auto;"><?php echo e($item['value']); ?></div>
									</div>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

									<div style="display: flex;font-size: 1rem;line-height: 1.3;padding: 1rem;background: #2c2c2c;font-weight: 700;">
										<div><?php echo e(__('Total')); ?></div>
										<div style="margin-left: auto;"><?php echo e(price($total_amount, false, true, 2, 'code', false, $currency)); ?></div>
									</div>

									<?php if($custom_amount ?? null): ?>
									<div style="display: flex;font-size: 1rem;line-height: 1.3;padding: 1rem;background: #006250;font-weight: 700;">
										<div><?php echo e(__('You will pay only')); ?></div>
										<div style="margin-left: auto;"><?php echo e(price($custom_amount, false, true, 2, 'code', false, $currency)); ?></div>
									</div>
									<?php endif; ?>
								</div>

								<?php if($exchange_rate != 1): ?>
								<div style="margin-top: .75rem;font-size: .8rem;margin-left: .5rem;color: #fff;"><?php echo e(__('Exchange rate')); ?> : <span><?php echo e($exchange_rate); ?></span></div>
								<?php endif; ?>
								<div style="margin-top: 1rem;"><a href="<?php echo urldecode($short_link); ?>" target="_blank" style=" text-decoration: none; color: #000; font-weight: 600; padding: .5rem 1rem .4rem; display: table; background: yellow; border-radius: 1rem; margin-left: auto;"><?php echo e(__('Pay now')); ?></a></div>
								
								<div style="margin-top: 1rem;">
									<p style="margin-bottom: 0;font-size: .8rem;color: #fff;"><?php echo e(__('Note')); ?> : <?php echo e(__("If the button doesn't work, please try with the following link :")); ?></p>
									<div style="font-size: .8rem;text-decoration: none;color: #c12868;font-weight: 500;"><?php echo urldecode($short_link); ?></div>
								</div>
							</td>
						</tr>
					</tbody>
					<tfoot>
						<tr>
							<td>
								<div style="text-align: right;padding: 2rem 1.75rem 1.5rem;margin: 4rem -1.5rem -1.5rem;border-radius: 0 0 .75rem .75rem;background: #2c2c2c;">
									<a style="text-decoration: none;font-size: .9rem;font-weight: 500;color: #ffffff;" href="<?php echo e(config('app.url')); ?>" target="_blank">
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

</html><?php /**PATH D:\laragon\www\valexa\resources\views\mail\payment_link.blade.php ENDPATH**/ ?>