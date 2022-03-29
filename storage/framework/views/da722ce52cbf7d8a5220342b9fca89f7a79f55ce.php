<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
	<meta charset="UTF-8">
	<meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex,nofollow">
	<link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon'))); ?>">
	<title><?php echo e(__('Unsubscribe from our newsletter')); ?></title>

	<?php if(session('unsubscribed')): ?>
	<meta http-equiv="refresh" content="3;url=<?php echo e(route('home')); ?>">
	<?php endif; ?>

	<!-- CSRF Token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
	
	<!-- jQuery -->  
	<script type="application/javascript" src="<?php echo e(asset_('assets/jquery/jquery-3.5.1.min.js')); ?>"></script>
	
	<style>
		<?php echo load_font(); ?>

	</style>

  <!-- Semantic-UI -->
  <link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2-'.locale_direction().'.css')); ?>">
  <script type="application/javascript" src="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2.js')); ?>"></script>

  <!-- Spacing CSS -->
	<link rel="stylesheet" href="<?php echo e(asset_('assets/css-spacing/spacing-'.locale_direction().'.css')); ?>">

  
	<!-- App CSS -->
	<link rel="stylesheet" href="<?php echo e(asset_('assets/front/default-'.locale_direction().'.css?v='.config('app.version'))); ?>">

	<!-- Search engines verification -->
	<meta name="google-site-verification" content="<?php echo e(config('app.google')); ?>">
	<meta name="msvalidate.01" content="<?php echo e(config('app.bing')); ?>">
	<meta name="yandex-verification" content="<?php echo e(config('app.yandex')); ?>">

  <style>
    body, html {
      height: 100vh !important;
    }
    
    .main.container {
      height: 100%;
      display: contents;
      padding-top: 0 !important;
    }

    .grid {
      min-height: 100%;
    }

    .form.column {
      width: 400px !important;
    }
  </style>
</head>

<body dir="<?php echo e(locale_direction()); ?>">
  <div class="ui main fluid container pt-0" id="app">
    <div class="ui one column celled middle aligned grid m-0 shadowless newsletter-unsubscribe" id="auth">
      <div class="form column mx-auto">
        <div class="ui fluid card">

        	<?php if(!session('unsubscribed')): ?>
          <div class="content center aligned logo">
            <a href="/"><?php echo e(config('app.name')); ?></a>
          </div>

          <div class="content center aligned title">
            <h2><?php echo e(__('Unsubscribe from our newsletter')); ?></h2>
          </div>
          <?php endif; ?>

         	<div class="content">
					  <?php if(session('unsubscribed')): ?>
					  <div class="ui small positive message">
					    <div><?php echo e(__('You have been unsubscribed from our newsletter.')); ?></div>
					  </div>

					  <div class="ui small message">
					  	<div><?php echo e(__('You will be redirected to the homepage in 3 seconds.')); ?></div>
					  </div>
					 	
					 	<?php else: ?>

				   <form class="ui large form" method="post" action="<?php echo e(route('home.unsubscribe_from_newsletter')); ?>">
				   	<?php echo csrf_field(); ?>
				   	<div class="field">
				   		<label><?php echo e(__('Email address')); ?></label>
				   		<input type="email" name="newsletter_email" value="<?php echo e(old('newsletter_email')); ?>" required>
				   	</div>
				   	<div class="field right aligned">
				   		<button class="ui yellow circular button"><?php echo e(__('Submit')); ?></button>
				   	</div>
				   </form>

				    <?php endif; ?>
					</div>
        </div>
      </div>
    </div>
  </div>
</body>

</html><?php /**PATH D:\laragon\www\valexa\resources\views\mail\unsubscribe.blade.php ENDPATH**/ ?>