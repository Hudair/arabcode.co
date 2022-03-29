<?php if($paginator->hasPages()): ?>
<div class="ui pagination menu mobile-only shadowless" role="navigation">
  
  <?php if($paginator->onFirstPage()): ?>
  <a class="item disabled" aria-disabled="true">
    <?php echo app('translator')->get('pagination.previous'); ?>
  </a>
  <?php else: ?>
  <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="item">
    <?php echo app('translator')->get('pagination.previous'); ?>
  </a>
  <?php endif; ?>
  
  
  <?php if($paginator->hasMorePages()): ?>
  <a class="item" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">
    <?php echo app('translator')->get('pagination.next'); ?>
  </a>
  <?php else: ?>
  <a class="item disabled" aria-disabled="true">
    <?php echo app('translator')->get('pagination.next'); ?>
  </a>
  <?php endif; ?>
</div>
<?php endif; ?>
<?php /**PATH D:\laragon\www\valexa\resources\views\vendor\pagination\simple-semantic-ui.blade.php ENDPATH**/ ?>