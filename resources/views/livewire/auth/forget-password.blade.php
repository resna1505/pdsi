@section('title')
    Forget Password
@endsection

<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="card auth-card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden">
                                    <div class="card-body p-4 d-flex justify-content-between flex-column">
                                        <div class="auth-image">
                                            <img src="{{ URL::asset('build/images/logo-light-full.png') }}" alt="" height="26" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect-2.png') }}" alt="" class="auth-effect-2" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect" />
                                            <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect-3" />
                                        </div>

                                        <div>
                                            <h3 class="text-white">Start your journey with us.</h3>
                                            <p class="text-white-75 fs-15">It brings together your tasks, projects, timelines, files and more</p>
                                        </div>
                                        <div class="text-center text-white-75">
                                            <p class="mb-0">&copy; <script>
                                                    document.write(new Date().getFullYear())

                                                </script> PDSI. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 py-3 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">Forgot Password?</h5>
                                            <p class="text-muted mb-4">Reset password with PDSI</p>
                                            <div class="display-5 mb-4 text-danger">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>

                                        <div class="alert alert-borderless alert-warning text-center mb-2 mx-2" role="alert">
                                            Enter your email and instructions will be sent to you!
                                        </div>

                                        @if (session()->has('error'))
                                            <div class="alert alert-borderless alert-danger alert-dismissible mb-2 mx-2">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if (session()->has('success'))
                                            <div class="alert alert-borderless alert-success alert-dismissible mb-2 mx-2">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        @endif

                                        <div class="p-2">
                                            <form method="POST" wire:submit="submit">
                                                @csrf
                                                <div class="mb-4">
                                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror" wire:model.live="email"
                                                        value="{{ old('email') }}" autocomplete="email" autofocus>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                
                                                <div class="text-center mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                                                </div>
                                                <div wire:loading wire:target="submit">
                                                    <div id="preloader" style="opacity: 0.5; visibility: visible;">
                                                        <div id="status">
                                                            <div class="spinner-border text-primary avatar-sm" role="status">
                                                                <span class="visually-hidden">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form><!-- end form -->
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Wait, I remember my password... <a href="{{ Route('login') }}"
                                                    class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
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
<!-- end auth-page-wrapper -->
