<div class="ui unstackable secondary menu top attached" id="top-menu">
  
  <div class="wrapper">
    <a class="item header logo" href="<?php echo e(route('home')); ?>">
      <img class="ui image" src="<?php echo e(asset_("storage/images/".config('app.logo'))); ?>" alt="<?php echo e(config('app.name')); ?>">
    </a>

    <div class="right menu pr-1"> 
      <div class="item search dropdown">
        <div><i class="search icon toggler"></i></div>

        <div class="menu">
          <div class="ui unstackable items">
            <form method="get" action="<?php echo e(route('home.products.q')); ?>" class="ui item form">
              <div class="ui icon input">
                <input type="text" name="q" placeholder="<?php echo e(__('Search')); ?>...">
                <i class="search link icon"></i>
              </div>
            </form>
          </div>
        </div>
      </div>
      
      <div class="item ui dropdown categories">
        <div class="toggler">
          <?php echo e(__('Categories')); ?>

        </div>

        <div class="menu">
          <?php $__currentLoopData = config('categories.category_parents', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e(route('home.products.category', ['category_slug' => $category->slug])); ?>" class="item capitalize">
            <?php echo e($category->name); ?>

          </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      
      <?php if(config('app.blog.enabled')): ?>
      <a href="<?php echo e(route('home.blog')); ?>" class="item blog">
        <?php echo e(__('Blog')); ?>

      </a>
      <?php endif; ?>
      
      <?php if(!auth_is_admin()): ?>
      <a href="<?php echo e(route('home.favorites')); ?>" class="item collection" title="Collection">
        <?php echo e(__('Collection')); ?>

      </a>
      <?php endif; ?>
      
      <?php if(config('app.subscriptions.enabled')): ?>
      <a href="<?php echo e(route('home.subscriptions')); ?>" class="item help">
        <?php echo e(__('Pricing')); ?>

      </a>
      <?php endif; ?>
      
      <?php if(!auth_is_admin()): ?>
      <div class="item notifications dropdown toggler">
        <div><i class="bell outline icon"></i><span v-cloak>(<?php echo e(count(config('notifications', []))); ?>)</span></div>

        <div class="menu">
          <div>
           
            <div class="ui unstackable items">
              <?php if(config('notifications')): ?>
              <div class="items-wrapper">
                <?php $__currentLoopData = config('notifications'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="item mx-0"
                   data-id="<?php echo e($notif->id); ?>"
                   data-href="<?php echo e(route('home.product', ['id' => $notif->product_id, 'slug' => $notif->slug . ($notif->for == 1 ? '#support' : ($notif->for == 2 ? '#reviews' : ''))])); ?>">

                  <div class="image" style="background-image: url(<?php echo e(asset_("storage/".($notif->for == 0 ? 'covers' : 'avatars')."/{$notif->image}")); ?>)"></div>

                  <div class="content pl-1">
                    <p><?php echo __($notif->text, ['product_name' => "<strong>{$notif->name}</strong>"]); ?></p>
                    <time><?php echo e(\Carbon\Carbon::parse($notif->updated_at)->diffForHumans()); ?></time>
                  </div>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <?php else: ?>
              
              <div class="item mx-0">
                <div class="ui w-100 borderless shadowless rounded-corner message p-1">
                  <?php echo e(__('You have 0 new notifications')); ?>

                </div>
              </div>
              
              <?php endif; ?>

              <?php if(auth()->guard()->check()): ?>
              <a href="<?php echo e(route('home.notifications')); ?>" class="item mx-0 all"><?php echo e(__('View all')); ?></a>
              <?php endif; ?>
            </div>
            
          </div>
        </div>
      </div>
      <?php endif; ?>

      <?php if(auth()->guard()->guest()): ?>
      <a href="<?php echo e(route('login', ['redirect' => url()->current()])); ?>" class="item">
        <span class="text"><?php echo e(__('Account')); ?></span>
      </a>
      <?php endif; ?>

      <div class="item cart dropdown toggler">
        <div><i class="shopping cart icon"></i><span v-cloak>({{ cartItems }})</span></div>

        <div class="menu" v-if="Object.keys(cart).length">
          <div>
            <div class="ui unstackable items">
              
              <div class="items-wrapper">
                <div class="item mx-0" v-for="product in cart">
                  <div class="image" :style="'background-image: url('+ product.cover +')'"></div>
                  <div class="content pl-1">
                    <strong :title="product.name"><a :href="product.url">{{ product.name }}</a></strong> 
                    <div class="subcontent mt-1">
                      <div class="price">
                        {{ price(product.price, true) }}
                      </div>
                      <div class="remove" :disabled="couponRes.status">
                        <i class="trash alternate outline icon mx-0" @click="removeFromCart(product.id)"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <a href="<?php echo e(route('home.checkout')); ?>" class="item mx-0 checkout"><?php echo e(__('Checkout')); ?></a>

            </div>
          </div>
        </div>

        <div class="menu" v-else>
          <div class="ui unstackable items">
            <div class="item p-1-hf">
              <div class="ui message borderless shadowless rounded-corner w-100 left aligned p-1">
                <?php echo e(__('Your cart is empty')); ?>

              </div>
            </div>
          </div>
        </div>
      </div>

      <?php if(auth()->guard()->check()): ?>
      <div class="item ui dropdown user">
          <img src="<?php echo e(asset_("storage/avatars/". if_null(auth()->user()->avatar, 'default.jpg'))); ?>" class="ui avatar image mx-0">
      
          <div class="left menu">
            <?php if(auth_is_admin()): ?>
              <a class="item" href="<?php echo e(route('admin')); ?>">
                <i class="circle blue icon"></i>
                <?php echo e(__('Administration')); ?>

              </a>

              <a class="item" href="<?php echo e(route('profile.edit')); ?>">
                  <i class="user outline icon"></i>
                  <?php echo e(__('Profile')); ?>

              </a>

              <a class="item" href="<?php echo e(route('transactions')); ?>">
                  <i class="shopping cart icon"></i>
                  <?php echo e(__('Transactions')); ?>

              </a>

              <div class="item">
                <i class="cog icon"></i>
                <?php echo e(__('Settings')); ?>

                <div class="menu settings left d-block w-100">
                  <a href="<?php echo e(route('settings', ['settings_name' => 'general'])); ?>" class="item d-block w-100"><?php echo e(__('General')); ?></a>
                  <a href="<?php echo e(route('settings', ['settings_name' => 'search_engines'])); ?>" class="item d-block w-100"><?php echo e(__('Search engines')); ?></a>
                  <a href="<?php echo e(route('settings', ['settings_name' => 'payments'])); ?>" class="item d-block w-100"><?php echo e(__('Payments')); ?></a>
                  <a href="<?php echo e(route('settings', ['settings_name' => 'social_login'])); ?>" class="item d-block w-100"><?php echo e(__('Social Login')); ?></a>
                  <a href="<?php echo e(route('settings', ['settings_name' => 'mailer'])); ?>" class="item d-block w-100"><?php echo e(__('Mailer')); ?></a>
                  <a href="<?php echo e(route('settings', ['settings_name' => 'files_host'])); ?>" class="item d-block w-100"><?php echo e(__('Files host')); ?></a>
                  <a href="<?php echo e(route('settings', ['settings_name' => 'adverts'])); ?>" class="item d-block w-100"><?php echo e(__('Ads')); ?></a>
                </div>
              </div>
              <div class="item">
                <i class="file code outline icon"></i>
                <?php echo e(__('Products')); ?>

                <div class="menu left d-block w-100">
                    <a href="<?php echo e(route('products')); ?>" class="item d-block w-100"><?php echo e(__('List')); ?></a>
                    <a href="<?php echo e(route('products.create')); ?>" class="item d-block w-100"><?php echo e(__('Create')); ?></a>
                </div>
              </div>
              <div class="item" href="">
                <i class="sticky note outline icon"></i>
                <?php echo e(__('Pages')); ?>

                <div class="menu left d-block w-100">
                    <a href="<?php echo e(route('pages')); ?>" class="item d-block w-100"><?php echo e(__('List')); ?></a>
                    <a href="<?php echo e(route('pages.create')); ?>" class="item d-block w-100"><?php echo e(__('Create')); ?></a>
                </div>
              </div>
              <div class="item" href="">
                <i class="file alternate outline icon"></i>
                <?php echo e(__('Posts')); ?>

                <div class="menu left d-block w-100">
                    <a href="<?php echo e(route('posts')); ?>" class="item d-block w-100"><?php echo e(__('List')); ?></a>
                    <a href="<?php echo e(route('posts.create')); ?>" class="item d-block w-100"><?php echo e(__('Create')); ?></a>
                </div>
              </div>
              <div class="item" href="">
                <i class="tags icon"></i>
                <?php echo e(__('Categories')); ?>

                <div class="menu left d-block w-100">
                    <a href="<?php echo e(route('categories')); ?>" class="item d-block w-100"><?php echo e(__('List')); ?></a>
                    <a href="<?php echo e(route('categories.create')); ?>" class="item d-block w-100"><?php echo e(__('Create')); ?></a>
                </div>
              </div>
              <div class="item" href="">
                <i class="question circle icon"></i>
                <?php echo e(__('Faq')); ?>

                <div class="menu left d-block w-100">
                    <a href="<?php echo e(route('faq')); ?>" class="item d-block w-100"><?php echo e(__('List')); ?></a>
                    <a href="<?php echo e(route('faq.create')); ?>" class="item d-block w-100"><?php echo e(__('Create')); ?></a>
                </div>
              </div>
              <a class="item" href="<?php echo e(route('support')); ?>">
                  <i class="comments outline icon"></i>
                  <?php echo e(__('Support')); ?>

              </a>
            <?php else: ?>
              <?php if(auth_is_affiliate()): ?>
              <div class="item header earnings">
                  <?php echo e(__('Earnings : :value', ['value' => price(config('affiliate_earnings', 0), false)])); ?>

              </div>
              <?php endif; ?>

              <a class="item" href="<?php echo e(route('home.profile')); ?>">
                  <i class="user outline icon"></i>
                  <?php echo e(__('Profile')); ?>

              </a>

              <a class="item" href="<?php echo e(route('home.favorites')); ?>">
                  <i class="heart outline icon"></i>
                  <?php echo e(__('Collection')); ?>

              </a>

              <a class="item" href="<?php echo e(route('home.notifications')); ?>">
                  <i class="bell outline icon"></i>
                  <?php echo e(__('Notifications')); ?>

              </a>

              <a class="item" href="<?php echo e(route('home.user_subscriptions')); ?>">
                  <i class="circle outline icon"></i>
                  <?php echo e(__('Subscriptions')); ?>

              </a>

              <a class="item" href="<?php echo e(route('home.purchases')); ?>">
                  <i class="cloud download icon"></i>
                  <?php echo e(__('Purchases')); ?>

              </a>

              <a class="item" href="<?php echo e(route('home.invoices')); ?>">
                  <i class="sticky note outline icon icon"></i>
                  <?php echo e(__('Invoices')); ?>

              </a>
            <?php endif; ?>

            <div class="ui divider my-0"></div>

            <a class="item logout w-100 mx-0" @click="logout">
                <i class="sign out alternate icon"></i>
                <?php echo e(__('Sign out')); ?>

            </a>

          </div>
      </div>
      <?php endif; ?>
      
      <a class="item px-1 mobile-only mr-0" @click="toggleMobileMenu">
        <i class="bars icon mx-0"></i>
      </a>
    </div>

  </div>
</div>

<form id="mobile-top-search" method="get" action="<?php echo e(route('home.products.q')); ?>" class="ui form">
    <input type="text" name="q" value="<?php echo e(request()->query('q')); ?>" placeholder="<?php echo e(__('Search')); ?>...">
</form>

<div id="mobile-menu" class="ui vertical menu">
  <div class="wrapper">
    <div class="body" v-if="menu.mobile.type === null">

      <a href="<?php echo e(route('home')); ?>" class="item">
        <i class="home icon"></i>
        <?php echo e(__('Home')); ?>

      </a>

      <a class="item" @click="setSubMenu($event, '', true, 'categories')">
        <i class="tags icon"></i>
        <?php echo e(__('Categories')); ?>

      </a>
      
      <?php if(config('app.subscriptions.enabled')): ?>
      <a href="<?php echo e(route('home.subscriptions')); ?>" class="item">
        <i class="dollar sign icon"></i>
        <?php echo e(__('Pricing')); ?>

      </a>
      <?php endif; ?>
      
      <?php if(config('app.blog.enabled')): ?>
      <a href="<?php echo e(route('home.blog')); ?>" class="item">
        <i class="bold icon"></i>
        <?php echo e(__('Blog')); ?>

      </a>
      <?php endif; ?>

      <a href="<?php echo e(route('home.favorites')); ?>" class="item">
        <i class="heart outline icon"></i>
        <?php echo e(__('Collection')); ?>

      </a>

      <a class="item" @click="setSubMenu($event, '', true, 'pages')">
        <i class="file alternate outline icon"></i>
        <?php echo e(__('Pages')); ?>

      </a>
      
      <?php if(auth()->guard()->guest()): ?>
      <a href="<?php echo e(route('login')); ?>" class="item">
        <i class="user outline icon"></i>
        <?php echo e(__('Account')); ?>

      </a>
      <?php endif; ?>

      <?php if(auth()->guard()->check()): ?>
      <?php if(auth_is_admin()): ?>
      <a href="<?php echo e(route('profile.edit')); ?>" class="item">
        <i class="user outline icon"></i>
        <?php echo e(__('Profile')); ?>

      </a>
      <a class="item" href="<?php echo e(route('admin')); ?>">
        <i class="chart pie icon"></i>
        <?php echo e(__('Dashboard')); ?>

      </a>
      <?php else: ?>
      <a href="<?php echo e(route('home.profile')); ?>" class="item">
        <i class="user outline icon"></i>
        <?php echo e(__('Profile')); ?>

      </a>

      <a href="<?php echo e(route('home.purchases')); ?>" class="item">
        <i class="cloud download icon"></i>
        <?php echo e(__('Purchases')); ?>

      </a>
      <?php endif; ?>
      <?php endif; ?>
      
      <a href="<?php echo e(route('home.page', 'privacy-policy')); ?>" class="item">
        <i class="circle outline icon"></i>
        <?php echo e(__('Privacy policy')); ?>

      </a>

      <a href="<?php echo e(route('home.page', 'terms-and-conditions')); ?>" class="item">
        <i class="circle outline icon"></i>
        <?php echo e(__('Terms and conditions')); ?>

      </a>

      <a href="<?php echo e(route('home.support')); ?>" class="item">
        <i class="question circle outline icon"></i>
        <?php echo e(__('Support')); ?>

      </a>

      <a class="item" @click="setSubMenu($event, '', true, 'languages')">
        <i class="globe icon"></i>
        <?php echo e(__('Language')); ?>

      </a>

      <?php if(auth()->guard()->check()): ?>
      <a class="item logout" @click="logout">
          <i class="sign out alternate icon"></i>
          <?php echo e(__('Sign out')); ?>

      </a>
      <?php endif; ?>
    </div>

    <div class="sub-body" v-else>
      <div class="item link" @click="mainMenuBack">
        <i class="arrow alternate circle left blue icon"></i>
        <?php echo e(__('Back')); ?>

      </div>

      <div v-if="menu.mobile.type === 'categories'">
        <div v-if="menu.mobile.selectedCategory === null">
          <a class="item" v-for="category in menu.mobile.submenuItems" @click="setSubMenu($event, category.id, true, 'subcategories')">
            {{ category.name }}
          </a>
        </div>
      </div>

      <div v-else-if="menu.mobile.type === 'subcategories'">
        <a class="item" v-for="subcategory in menu.mobile.submenuItems"
           :href="setProductsRoute(menu.mobile.selectedCategory.slug+'/'+subcategory.slug)">
          {{ subcategory.name }}
        </a>
      </div>

      <div v-else-if="menu.mobile.type === 'pages'">
        <a class="item" v-for="page in menu.mobile.submenuItems" :title="page['name']"
           :href="setPageRoute(page['slug'])">
          {{ page['name'] }}
        </a>
      </div>

      <div v-else-if="menu.mobile.type === 'languages'">
        <?php $__currentLoopData = \LaravelLocalization::getSupportedLocales(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale_code => $supported_locale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a class="item" @click="setLocale('<?php echo e($locale_code); ?>')">
          <?php echo e($supported_locale['native'] ?? ''); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </div>
</div>

<div id="mobile-menu-2" class="ui secondary menu">
  <a href="/" class="item">
    <div class="icon">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 21 21" enable-background="new 0 0 21 21" xml:space="preserve">
        <g id="icon">
          <polyline points="3.5,9.4 3.5,18.5 8.5,18.5 8.5,12.5 12.5,12.5 12.5,18.5 17.5,18.5 17.5,9.4" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <polygon points="18.35,10 10.5,3.894 2.65,10 1.5,8.522 10.5,1.523 19.5,8.522" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
        </g>
      </svg>
    </div>
    <div class="text"><?php echo e(__('Home')); ?></div>
  </a>
  <div class="ui dropdown item">
    <div>
      <div class="icon">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 21 21" enable-background="new 0 0 21 21" xml:space="preserve">
          <g id="icon">
            <path d="M18.7,18.5H2.3c-0.442,0,-0.8,-0.358,-0.8,-0.8V3.3c0,-0.442,0.358,-0.8,0.8,-0.8h16.4c0.442,0,0.8,0.358,0.8,0.8v14.4C19.5,18.142,19.142,18.5,18.7,18.5z" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
            <path d="M1.5,6.5h18M7.5,2.5v16M13.5,2.5v16M1.5,10.5h18M1.5,14.5h18" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          </g>
        </svg>
      </div>
      <div class="text"><?php echo e(__('Categories')); ?></div>
    </div>  
    <div class="menu">
      <?php $__currentLoopData = config('categories.category_parents', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(route('home.products.category', ['category_slug' => $category->slug])); ?>" class="item capitalize">
        <?php echo e($category->name); ?>

      </a>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
  </div>
  <a href="<?php echo e(!\Auth::check() ? route('login', ['redirect' => route('home.notifications')]) : route('home.notifications')); ?>" class="item">
    <div class="icon">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 21 21" enable-background="new 0 0 21 21" xml:space="preserve">
        <g id="icon">
          <path d="M3.788,7.39c0.295,-0.804,0.755,-1.562,1.38,-2.224c0.614,-0.65,1.329,-1.145,2.099,-1.486M1.553,6.558c0.403,-1.096,1.029,-2.131,1.881,-3.033c0.837,-0.886,1.813,-1.562,2.862,-2.026" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round" opacity="0.5"/>
          <path d="M13.787,3.68c0.77,0.34,1.485,0.836,2.099,1.486c0.625,0.662,1.084,1.42,1.38,2.224M14.756,1.499c1.05,0.464,2.026,1.14,2.862,2.026c0.852,0.902,1.479,1.936,1.881,3.033" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round" opacity="0.5"/>
          <path d="M12.553,17.57c0,1.169,-0.971,1.93,-2.095,1.93c-1.124,0,-2.065,-0.762,-2.065,-1.93" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <path d="M17.697,16.069c-1.06,-1.144,-2.85,-3.623,-2.85,-5.534c0,-1.806,-1.203,-3.346,-2.891,-3.942c0.014,-0.086,0.023,-0.173,0.023,-0.264c0,-0.845,-0.663,-1.529,-1.48,-1.529s-1.48,0.685,-1.48,1.529c0,0.07,0.006,0.138,0.015,0.206c-1.78,0.548,-3.068,2.131,-3.068,3.999c0,2.676,-1.766,4.307,-2.757,5.582c-1,1.039,5.23,1.5,7.244,1.5S18.757,17.212,17.697,16.069z" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
        </g>
      </svg>
    </div>
    <div class="text"><?php echo e(__('Notifications')); ?></div>
  </a>
  <a href="<?php echo e(route('home.checkout')); ?>" class="item">
    <div class="icon">
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 21 21" enable-background="new 0 0 21 21" xml:space="preserve">
        <g id="icon">
          <path d="M6.8814,13.2403C8.5,13.2403,16.896,12.5585,17.5,12.5c1.0278,-0.0995,1.5,-0.6501,1.5,-1.1231l0.5,-4.1848c0,-0.4087,-0.3061,-0.7533,-0.7119,-0.8017L4.718,4.664" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <path d="M9.0901,18.095c0,0.776,-0.629,1.405,-1.405,1.405s-1.405,-0.629,-1.405,-1.405s0.629,-1.405,1.405,-1.405S9.0901,17.319,9.0901,18.095zM16.5503,16.69c-0.776,0,-1.405,0.629,-1.405,1.405s0.629,1.405,1.405,1.405s1.405,-0.629,1.405,-1.405S17.3263,16.69,16.5503,16.69z" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <path d="M18.5,16.5H6.1995c-0.2305,0,-0.3654,-0.2483,-0.4381,-0.3729c-0.1566,-0.2684,-0.1542,-0.6537,0.006,-0.937c0.0279,-0.0493,0.9105,-1.5099,0.9105,-1.5099c0.2964,-0.4944,0.2739,-1.3885,0.0808,-1.9675c-0.0348,-0.1046,-2.4411,-8.314,-2.4825,-8.4381C4.1905,3.0177,3.9036,2.5,3.5313,2.5C3.2765,2.5,1.5,2.4874,1.5,2.4874" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <path d="M6.1512,14.5993" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
        </g>
      </svg>
      <span v-cloak>({{ cartItems }})</span>
    </div>
    <div class="text"><?php echo e(__('Cart')); ?></div>
  </a>
  <a href="<?php echo e(!\Auth::check() ? route('login', ['redirect' => url()->current()]) : (auth_is_admin() ? route('admin') : route('home.profile'))); ?>" class="item">
    <div class="icon">
      <?php if(auth_is_admin()): ?>
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 21 21" enable-background="new 0 0 21 21" xml:space="preserve">
        <g id="icon">
          <path d="M6.6799,18h7.6395c0.8564,0,1.6805,-0.3252,2.3077,-0.9083c1.5863,-1.475,2.6396,-3.5153,2.8386,-5.8006c0.475,-5.4535,-4.0687,-10.1129,-9.5323,-9.7736C5.2268,1.8099,1.5,5.7197,1.5,10.5c0,2.6233,1.1226,4.9842,2.9135,6.6292C5.03,17.6955,5.8428,18,6.6799,18z" fill="none" stroke="#3D73AD" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <circle cx="10.5" cy="14" r="1.5" fill="none" stroke="#3D73AD" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <line x1="11.497" y1="12.6" x2="15.1" y2="7.7" fill="none" stroke="#3D73AD" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
          <path d="M3.5,10.5c0,-3.866,3.134,-7,7,-7s7,3.134,7,7" fill="none" stroke="#3D73AD" stroke-width="0.9" stroke-linecap="round" stroke-miterlimit="1" stroke-linejoin="round"/>
        </g>
      </svg>
      <?php else: ?>
      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="21px" height="21px" viewBox="0 0 21 21" enable-background="new 0 0 21 21" xml:space="preserve">
        <g id="icon">
          <circle cx="10.5" cy="10.5" r="9" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-miterlimit="1"/>
          <path d="M17.2253,16.3995c-0.4244,-1.183,-1.3275,-1.4113,-4.1682,-2.5227c-0.4969,-0.2068,-0.6372,-0.52,-0.6,-0.9446c0.9599,-1.2714,1.5383,-3.3359,1.5383,-4.7737c0,-2.2266,-0.6858,-3.641,-3.4947,-3.641S7.0624,5.9259,7.0624,8.1526c0,1.4378,0.5761,3.4895,1.536,4.7609c0.0372,0.4246,-0.1042,0.7236,-0.6011,0.9304c-2.8435,1.1126,-3.746,1.3626,-4.17,2.556" fill-rule="evenodd" fill="none" stroke="#FFFFFF" stroke-width="1" stroke-linecap="round" stroke-miterlimit="1"/>
        </g>
      </svg>
      <?php endif; ?>
    </div>
    <div class="text"><?php echo e(auth_is_admin() ? __('Dashboard') : __('Account')); ?></div>
  </a>
</div>

<?php /**PATH D:\laragon\www\valexa\resources\views/front/tendra/partials/top_menu.blade.php ENDPATH**/ ?>