<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title> <?php echo $__env->yieldContent('title'); ?> | PDSI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="PDSI Laravel Admin & Dashboard Template" name="description" />
    <meta content="ICT PDSI" name="author" />
     <meta name="keywords" content="PDSI,PDSI laravel,admin,dashboard,vite,livewire,livewire admin,laravel vite">
     
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(URL::asset('build/images/favicon.png')); ?>">

    <!-- include head css -->
    <?php echo $__env->make('layouts.head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- vendor-scripts -->
    <?php echo $__env->make('layouts.vendor-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html>

<?php /**PATH D:\Project\pdsi\resources\views/layouts/master-without-nav.blade.php ENDPATH**/ ?>