<?php $__env->startSection('additional_head_tags'); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type": "WebPage",
	"image": "<?php echo e($meta_data->image); ?>",
	"name": "<?php echo e($meta_data->title); ?>",
  "url": "<?php echo e($meta_data->url); ?>",
  "description": "<?php echo e($meta_data->description); ?>"
}
</script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('body'); ?>
	<div class="one column row w-100" id="single-page">
		<div class="column">

			<div class="title-wrapper">
				<h1><?php echo e($page->name); ?></h1>
				<div class="ui big breadcrumb">
					<a href="/" class="section"><?php echo e(__('Home')); ?></a>
					<i class="right chevron icon divider"></i>
					<span class="active section"><?php echo e($page->name); ?></span>
				</div>
			</div>

			<div class="page-content p-2">
				<?php echo $page->content; ?>

			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make(view_path('master'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\tendra\page.blade.php ENDPATH**/ ?>