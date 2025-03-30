
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.remix'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Icons <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Remix <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row">

</div><!-- end row -->

<div class="row">
    <div class="col-12" id="icons"></div> <!-- end col-->
</div><!-- end row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/pages/remix-icons-listing.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-components', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\pdsi\resources\views/icons-remix.blade.php ENDPATH**/ ?>