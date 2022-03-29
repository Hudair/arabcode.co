<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<meta charset="UTF-8">
		<meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
		<title><?php echo e(config('app.name')); ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex,nofollow">
		<link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon'))); ?>">
		<link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2.css')); ?>">
		<link href="https://fonts.googleapis.com/css?family=Kodchasan:400,500,700" rel="stylesheet">

		<!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		<style>
			body, .grid
			{
				margin: 0 !important;
				overflow: hidden;
				height: 100vh;
			}

			* {
				font-family: 'Kodchasan' !important;
			}

			.column {
				text-align: center;
			}

			h1 {
				font-size: 4rem;
				color: skyblue;
			}

			h3 {
			    color: #909090;
			}

			.secondary.menu {
				display: block !important;
			}
	
			.ui.secondary.menu a {
			  display: inline-block !important;
			  margin: 0 !important;
			  text-align: center;
			}
		</style>		
	</head>

	<body>
		<div class="ui middle aligned grid">
			<div class="column">
				<h2><?php echo $message; ?></h2>

				<div class="ui hidden divider"></div>
				<div class="ui secondary menu">
					<a href="<?php echo e(config('app.url')); ?>" class="item"><?php echo e(__('Home')); ?></a>

				  <?php $__currentLoopData = config('categories')['category_parents'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<a href="<?php echo e(route('home.products.category', $category->slug)); ?>" class="item"><?php echo e($category->name); ?></a>
				  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
	</body>
</html>
<?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\message.blade.php ENDPATH**/ ?>