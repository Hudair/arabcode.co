<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex,nofollow">
    <link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon', 'favicon.png'))); ?>">

    <style>
      <?php echo load_font(); ?>

    </style>

    <link rel="stylesheet" href="<?php echo e(asset_('assets/semantic-ui/semantic.min.2.4.2-'.locale_direction().'.css')); ?>">


    <title><?php echo e(__('Error')); ?> <?php echo $__env->yieldContent('code'); ?></title>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style>
        body, .grid
        {
            margin: 0 !important;
            overflow: hidden;
            height: 100vh;
        }

        h1, h2, h3 {
            font-family: Valexa !important;
        }

        .column {
            text-align: center;
        }

        h1 {
            font-size: 4rem;
            color: #db2828;
        }

        h3 {
            color: #909090;
        }

        h4 {
        margin-top: .1rem !important;
        }

        i, .button {
            margin: 0 !important;
        }

        .button {
            height: 57px;
            width: 57px;
        }

        .icon.button {
          background-color: #ffc724 !important;
          color: #000 !important;
        }

        .icon.button:hover {
          background: #ffd129;
          color: #000;
        }
    </style>
  </head>

  <body>
      <div class="ui middle aligned grid">
          <div class="column">

              <h1><?php echo e(__('Error')); ?> <?php echo $__env->yieldContent('code'); ?></h1>

              <?php echo $__env->yieldContent('message'); ?>

              <div class="ui hidden divider"></div>
              <a href="<?php echo e(config('app.url')); ?>" class="ui circular icon button"><h4><i class="home big icon"></i></h4></a>
          </div>
      </div>
  </body>
</html>
<?php /**PATH D:\laragon\www\valexa\resources\views\errors\minimal.blade.php ENDPATH**/ ?>