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

	<div class="row w-100" id="single-page">
		<div class="sixteen wide column">

			<div class="title-wrapper rounded-corner">
				<div class="ui shadowless fluid segment rounded-corner">
					<h1><?php echo e($page->name); ?></h1>
				</div>
			</div>

			<div class="page-content p-2">
				<?php echo $page->content; ?>

			</div>
		</div>
	</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('front.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\valexa\resources\views\front\default\page.blade.php ENDPATH**/ ?>