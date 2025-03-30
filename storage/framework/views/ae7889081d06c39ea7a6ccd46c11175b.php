<?php $__env->startSection('title'); ?>
    Login
<?php $__env->stopSection(); ?>

<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="card auth-card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden mb-0">
                                    <div class="card-body p-4 d-flex justify-content-between flex-column">
                                        <div class="auth-image mb-3">
                                            <div class="d-flex justify-content-center">
                                                <img src="<?php echo e(URL::asset('build/images/logo-light-full.png')); ?>" alt="" height="125" />
                                            </div>
                                            <img src="<?php echo e(URL::asset('build/images/effect-pattern/auth-effect-2.png')); ?>" alt="" class="auth-effect-2" />
                                            <img src="<?php echo e(URL::asset('build/images/effect-pattern/auth-effect.png')); ?>" alt="" class="auth-effect" />
                                            <img src="<?php echo e(URL::asset('build/images/effect-pattern/auth-effect.png')); ?>" alt="" class="auth-effect-3" />
                                        </div>

                                        <div>
                                            <h3 class="text-white">Start your journey with us.</h3>
                                            <p class="text-white-75 fs-15">It brings together your tasks, projects, timelines, files and more</p>
                                        </div>
                                        <div class="text-center text-white-75">
                                            <p class="mb-0">&copy;
                                                <script>document.write(new Date().getFullYear())</script> PDSI. Crafted with <i class="mdi mdi-heart text-danger"></i> by ICT PDSI
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">Welcome Back !</h5>
                                            <p class="text-muted">Sign in to continue to PDSI.</p>
                                        </div>

                                        <!--[if BLOCK]><![endif]--><?php if(session()->has('error')): ?>
                                            <div class="alert alert-borderless alert-danger alert-dismissible mb-2 mx-2">
                                                <?php echo e(session('error')); ?>

                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                        <!--[if BLOCK]><![endif]--><?php if(session()->has('success')): ?>
                                            <div class="alert alert-borderless alert-success alert-dismissible mb-2 mx-2">
                                                <?php echo e(session('success')); ?>

                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->

                                        <div class="p-2 mt-5">
                                            <form method="POST" wire:submit="submit">
                                                <?php echo csrf_field(); ?>
                
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email <span
                                                            class="text-danger">*</span></label>
                                                    <input id="email" type="email"
                                                        class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" wire:model.live="email"
                                                        value="" required autocomplete="email" autofocus placeholder="Enter your email">
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                                                </div>
                
                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <!--[if BLOCK]><![endif]--><?php if(Route::has('password.reset')): ?>
                                                            <a class="text-muted" href="<?php echo e(route('password.reset')); ?>">
                                                                <?php echo e(__('Forgot Your Password?')); ?>

                                                            </a>
                                                        <?php endif; ?> <!--[if ENDBLOCK]><![endif]-->
                                                    </div>
                                                    <label class="form-label" for="password-input">Password <span
                                                            class="text-danger">*</span></label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input id="password" type="password"
                                                            class="form-control pe-5 password-input <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                                            wire:model.live="password" id="password-input" required value=""
                                                            autocomplete="current-password" placeholder="Enter your password">
                                                        <button
                                                            class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon"><i
                                                                class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                    <!--[if BLOCK]><![endif]--><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong><?php echo e($message); ?></strong>
                                                        </span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> <!--[if ENDBLOCK]><![endif]-->
                                                </div>
                
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                        <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                    <label class="form-check-label" for="remember">Remember me</label>
                                                </div>
                
                                                <div class="mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                                </div>
                                            </form>
                
                                            <div class="text-center mt-5">
                                                <p class="mb-0">Don't have an account ? <a href="<?php echo e(url('register')); ?>"
                                                        class="fw-semibold text-secondary text-decoration-underline"> Sign Up</a> </p>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('build/js/pages/password-addon.init.js')); ?>"></script>
<?php $__env->stopSection(); ?><?php /**PATH D:\Project\pdsi\resources\views/livewire/auth/login.blade.php ENDPATH**/ ?>