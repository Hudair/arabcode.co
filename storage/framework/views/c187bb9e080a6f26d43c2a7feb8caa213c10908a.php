<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
  <head>
    <meta charset="UTF-8">
    <meta name="language" content="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo e(asset_("storage/images/".config('app.favicon'))); ?>">
    
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
    <link rel="stylesheet" href="<?php echo e(asset_('assets/front/'.config('app.template', 'valexa').'-'.locale_direction().'.css?v='.config('app.version'))); ?>">
    
    <?php echo $__env->yieldContent('additional_head_tags'); ?>
    
    <script>
      'use strict';
      
      window.props = {
        itemId: null,
        product: {},
        products: {},
        routes: {
          checkout: '<?php echo e(route('home.checkout')); ?>',
          products: '<?php echo e(route('home.products.category', '')); ?>',
          pages: '<?php echo e(route('home.page', '')); ?>',
          payment: '<?php echo e(route('home.checkout.payment')); ?>',
          coupon: '<?php echo e(route('home.checkout.validate_coupon')); ?>',
          productFolder: '<?php echo e(route('home.product_folder_async')); ?>',
          notifRead: '<?php echo e(route('home.notifications.read')); ?>',
          addToCartAsyncRoute: '<?php echo e(route('home.add_to_cart_async')); ?>',
          subscriptionPayment: '<?php echo e(config('app.subscriptions.enabled') ? route('home.subscription.payment') : ''); ?>'
        },
        currentRouteName: '<?php echo e(Route::currentRouteName()); ?>',
        trasactionMsg: '<?php echo e(session('transaction_response')); ?>',
        location: window.location,
        paymentProcessors: {
          paypal: <?php echo e(var_export(config('payments.paypal.enabled') ? true : false)); ?>,
          stripe: <?php echo e(var_export(config('payments.stripe.enabled') ? true : false)); ?>,
          skrill: <?php echo e(var_export(config('payments.skrill.enabled') ? true : false)); ?>,
          razorpay: <?php echo e(var_export(config('payments.razorpay.enabled') ? true : false)); ?>,
          iyzico: <?php echo e(var_export(config('payments.iyzico.enabled') ? true : false)); ?>,
          coingate: <?php echo e(var_export(config('payments.coingate.enabled') ? true : false)); ?>,
          midtrans: <?php echo e(var_export(config('payments.midtrans.enabled') ? true : false)); ?>,
          paystack: <?php echo e(var_export(config('payments.paystack.enabled') ? true : false)); ?>,
          adyen: <?php echo e(var_export(config('payments.adyen.enabled') ? true : false)); ?>,
          instamojo: <?php echo e(var_export(config('payments.instamojo.enabled') ? true : false)); ?>,
          offline: <?php echo e(var_export(config('payments.offline.enabled') ? true : false)); ?>

        },
        paymentProcessor: '<?php echo e($payment_processor ?? null); ?>',
        paymentFees: <?php echo json_encode(config('fees'), 15, 512) ?>,
        translation: <?php echo json_encode(config('translation'), 15, 512) ?>,
        currency: {code: '<?php echo e(config('payments.currency_code')); ?>', symbol: '<?php echo e(config('payments.currency_symbol')); ?>'},
        activeScreenshot: null,
        subcategories: <?php echo collect(config('categories.category_children', []))->toJson(); ?>,
        categories: <?php echo collect(config('categories.category_parents', []))->toJson(); ?>,
        pages: <?php echo collect(config('pages', []))->where('deletable', 1)->toJson(); ?>,
        workingWithFolders: <?php if(isFolderProcess()): ?> true <?php else: ?> false <?php endif; ?>,
        removeItemConfirmMsg: '<?php echo e(__('Are you sure you want to remove this item ?')); ?>',
        exchangeRate: <?php echo e(config('payments.exchange_rate', 1)); ?>,
        userCurrency: '<?php echo e(currency('code')); ?>',
        currencies: <?php echo json_encode(config('payments.currencies') ?? [], JSON_UNESCAPED_UNICODE, 512) ?>,
        currencyDecimals: <?php echo e(config('payments.currencies.'.currency('code').'.decimals') ?? 2); ?>,
        usersNotif: '<?php echo e(config('app.users_notif', '')); ?>'
      }
    </script>
    
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
      <div class="ui one column celled middle aligned grid m-0 shadowlessn" id="auth">
        <div class="form column mx-auto">
          <div class="ui fluid card">

            <div class="content center aligned logo">
              <a href="/">
                <img class="ui image mx-auto" src="<?php echo e(asset_("storage/images/".config('app.logo'))); ?>" alt="<?php echo e(config('app.name')); ?>">
              </a>
            </div>

            <div class="content center aligned title">
              <h2><?php echo $__env->yieldContent('title'); ?></h2>
            </div>

            <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html><?php /**PATH D:\laragon\www\valexa\resources\views\auth\master.blade.php ENDPATH**/ ?>