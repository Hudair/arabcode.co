<title><?php echo $meta_data->title; ?></title>

<link rel="canonical" href="<?php echo e(preg_replace('/https?\:/i', '', $meta_data->url)); ?>">

<meta name="description" content="<?php echo $meta_data->description; ?>">

<meta property="og:site_name" content="<?php echo e(config('app.name')); ?>">
<meta property="og:title" content="<?php echo $meta_data->title; ?>">
<meta property="og:type" content="Website">
<meta property="og:url" content="<?php echo e($meta_data->url); ?>">
<meta property="og:description" content="<?php echo $meta_data->description; ?>">
<meta property="og:image" content="<?php echo e($meta_data->image); ?>">

<meta name="twitter:title" content="<?php echo $meta_data->title; ?>">
<meta name="twitter:url" content="<?php echo e($meta_data->url); ?>">
<meta name="twitter:description" content="<?php echo $meta_data->description; ?>">
<meta name="twitter:site" content="<?php echo e(config('app.url')); ?>">
<meta name="twitter:image" content="<?php echo e($meta_data->image); ?>">

<meta itemprop="title" content="<?php echo $meta_data->title; ?>">
<meta itemprop="name" content="<?php echo e(config('app.name')); ?>">
<meta itemprop="url" content="<?php echo e($meta_data->url); ?>">
<meta itemprop="description" content="<?php echo $meta_data->description; ?>">
<meta itemprop="image" content="<?php echo e($meta_data->image); ?>">

<meta property="fb:app_id" content="<?php echo e(config('app.fb_app_id')); ?>">
<meta name="og:image:width" content="590">
<meta name="og:image:height" content="auto"><?php /**PATH D:\laragon\www\valexa\resources\views\front\valexa\partials\meta_data.blade.php ENDPATH**/ ?>