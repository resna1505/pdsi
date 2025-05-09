<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.coming-soon'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<section class="auth-bg-cover min-vh-100 p-4 p-lg-5 d-flex align-items-center justify-content-center">
    <div class="bg-overlay"></div>
    <div class="container-fluid px-0">
        <div class="row g-0 justify-content-center">
            <div class="col-xl-4 col-lg-8">
                <div class="text-center mb-5">
                    <img src="<?php echo e(URL::asset('build/images/logo-light-full.png')); ?>" alt="" height="110" />
                </div>
                <div class="card mb-0">
                    <div class="card-body p-4 p-sm-4 m-lg-3 text-center">
                        <div class="mb-sm-5 pb-sm-0 pb-5">
                            <img src="<?php echo e(URL::asset('build/images/comingsoon.png')); ?>" alt="" height="110" class="move-animation">
                        </div>
                        <div class="mb-5">
                            <h1>Coming Soon</h1>
                        </div>
                        <div>
                            <div class="row justify-content-center mt-5">
                                <div class="col-lg-10">
                                    <div data-countdown="Oct 30, 2024" class="countdownlist"></div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h4>Get notified when we launch</h4>
                                <p class="text-muted">Don't worry we will not spam you 😊</p>
                            </div>

                            <form action="/index">
                                <div class="countdown-input-subscribe mx-auto my-4">
                                    <input type="email" class="form-control shadow" placeholder="Enter your email address" required />
                                    <button class="btn btn-primary" type="submit" id="button-email">Send<i class="ri-send-plane-2-fill align-bottom ms-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div><!-- end card body -->
                </div>
                <!-- end card -->
                <div class="text-white text-center mt-5">
                    <p class="mb-0">&copy;
                        <script>
                            document.write(new Date().getFullYear())

                        </script> PDSI. Crafted with <i class="mdi mdi-heart text-danger"></i> by ICT PDSI
                    </p>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end conatiner-->
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/pages/coming-soon.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Project\pdsi\resources\views/pages-coming-soon.blade.php ENDPATH**/ ?>