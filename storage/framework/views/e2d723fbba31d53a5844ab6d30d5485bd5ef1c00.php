<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<?php echo config('app.google_analytics'); ?>


		<meta charset="UTF-8">
		<meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon'))); ?>">
		
		<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		
		<!-- jQuery -->  
		<script type="application/javascript" src="<?php echo e(asset_('assets/jquery/jquery-3.5.1.min.js')); ?>"></script>

		<!-- Countdown -->
		<script type="application/javascript" src="<?php echo e(asset('assets/jquery.countdown.min.js')); ?>"></script>
		

		<style>
			<?php echo load_font(); ?>

		</style>

    <!-- Semantic-UI -->
    <link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2-'.locale_direction().'.css')); ?>">
    <script type="application/javascript" src="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2.js')); ?>"></script>

    <!-- Spacing CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/css-spacing/spacing-'.locale_direction().'.css')); ?>">

		<!-- App CSS -->
		<link rel="stylesheet" href="<?php echo e(asset_('assets/front/tendra-'.locale_direction().'.css?v='.config('app.version'))); ?>">

		<!-- Search engines verification -->
		<meta name="google-site-verification" content="<?php echo e(config('app.google')); ?>">
		<meta name="msvalidate.01" content="<?php echo e(config('app.bing')); ?>">
		<meta name="yandex-verification" content="<?php echo e(config('app.yandex')); ?>">

		<title><?php echo e(config('app.maintenance.title')); ?></title>

		<?php
			$bg_color = config('app.maintenance.bg_color'); 
			$opac_color = adjustBrightness($bg_color, 0.1);
		?>

		<style>
			#maintenance-page {
				background: <?php echo e($bg_color); ?>;
			}

			#maintenance-page .timeout-wrapper .item, #maintenance-page .more {
				background: <?php echo e($opac_color); ?>;
			}
		</style>
	</head>

	<body dir="<?php echo e(locale_direction()); ?>">
			<div class="ui main fluid container" id="maintenance-page">
				<div class="ui celled grid m-0 shadowless">
					<div class="row">
						<?php if(config('app.maintenance.expires_at')): ?>
						<div class="timeout-wrapper">
							<div class="item days">
								<div class="count">00</div>
								<div class="text"><?php echo e(__('Days')); ?></div>
							</div>

							<div class="item hours">
								<div class="count">00</div>
								<div class="text"><?php echo e(__('Hours')); ?></div>
							</div>

							<div class="item minutes">
								<div class="count">00</div>
								<div class="text"><?php echo e(__('Minutes')); ?></div>
							</div>

							<div class="item seconds">
								<div class="count">00</div>
								<div class="text"><?php echo e(__('Seconds')); ?></div>
							</div>
						</div>
						<?php endif; ?>

						<div class="logo">
							<img src="<?php echo e(asset_('storage/images/'.config('app.logo'))); ?>">
						</div>

						<div class="ui header">
							<?php echo config('app.maintenance.header'); ?>

							
							<div class="ui sub header">
								<?php echo config('app.maintenance.subheader'); ?>

							</div>
						</div>

						<?php if(config('app.maintenance.text')): ?>
						<div class="more">
							<div class="content">
								<?php echo config('app.maintenance.text'); ?>

							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<script>
				$(function()
				{
						<?php if(config('app.maintenance.expires_at')): ?>
						var counter = $('.timeout-wrapper');
						var finalDate = '<?php echo e(config('app.maintenance.expires_at')); ?>';
						var titles = ['days', 'hours', 'minutes', 'seconds'];

					  counter.countdown(finalDate)
						.on('update.countdown', function(event)
						{
								for(var i = 0; i < titles.length; i++)
								{
									var count = event.offset[titles[i]];

									$('.timeout-wrapper .item.'+ titles[i] + ' .count').text(count > 0 ? count : '00');
								}
						})
						.on('finish.countdown', function(event)
						{
							$('.timeout-wrapper').remove()

							<?php if(config('app.maintenance.auto_disable')): ?>
							location.reload();
							<?php endif; ?>
						});
						<?php endif; ?>
				})
			</script>
	</body>
</html><?php /**PATH D:\laragon\www\valexa\resources\views\errors\307.blade.php ENDPATH**/ ?>