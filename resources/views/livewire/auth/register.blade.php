@section('title') Register @endsection

<section class="auth-page-wrapper py-5 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <div class="auth-card card bg-primary h-100 border-0 shadow-none p-sm-3 overflow-hidden">
                                    <div class="card-body p-4 d-flex justify-content-between flex-column">
                                        <div class="auth-image">
                                            <div class="d-flex justify-content-center">
                                                <img src="{{ URL::asset('build/images/logo-light-full.png') }}" alt="" height="125" />
                                            </div>                                            
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

                                                </script> PDSI. Crafted with <i class="mdi mdi-heart text-danger"></i> by ICT PDSI
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 py-3 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center mt-2">
                                            <h5 class="text-primary fs-20">Create New Account</h5>
                                            <p class="text-muted">Get your free PDSI account now</p>
                                        </div>

                                        @if(session()->has('error'))
                                            <div class="alert alert-borderless alert-danger alert-dismissible mb-2 mx-2">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        @if(session()->has('success'))
                                            <div class="alert alert-borderless alert-success alert-dismissible mb-2 mx-2">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        
                                        <div class="p-2 mt-5">
                                            <form class="needs-validation" novalidate enctype="multipart/form-data" wire:submit="submit">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="first_name" class="form-label">First Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="first_name" type="text"
                                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                                   wire:model.live="first_name" value="{{ old('first_name') }}" required
                                                                   autocomplete="first_name" autofocus placeholder="Enter first name">
                                                            @error('first_name')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="last_name" class="form-label">Last Name <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="last_name" type="text"
                                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                                   wire:model.live="last_name" value="{{ old('last_name') }}" required
                                                                   autocomplete="last_name" autofocus placeholder="Enter last name">
                                                            @error('last_name')
                                                            <div class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="useremail" class="form-label">Email <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="email" type="email"
                                                                   class="form-control @error('email') is-invalid @enderror" wire:model.live="email"
                                                                   value="{{ old('email') }}" required autocomplete="off"
                                                                   placeholder="Enter your email">
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="avatar" class="form-label">Profile Photo <span
                                                                    class="text-danger">*</span></label>
                                                            <input id="avatar" type="file"
                                                                   class="form-control @error('avatar') is-invalid @enderror" wire:model.live="avatar"
                                                                   value="{{ old('avatar') }}" required autocomplete="off"
                                                                   placeholder="Enter your avatar">
                                                            @error('avatar')
                                                            <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                                            <div class="position-relative auth-pass-inputgroup">
                                                                <input type="password"
                                                                       class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                                       onpaste="return false" placeholder="Enter password"
                                                                       id="password-input" wire:model.live="password" aria-describedby="passwordInput"
                                                                       pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                                <button
                                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                                    type="button" id="password-addon"><i
                                                                        class="ri-eye-fill align-middle"></i></button>
                                                                @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $message }}</strong>
                                                                        </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="password-confirm">Confirm Password <span class="text-danger">*</span></label>
                                                            <div class="position-relative auth-pass-inputgroup">
                                                                <input id="confirm-password-input" type="password"
                                                                       class="form-control pe-5 password-input"
                                                                       wire:model.live="password_confirmation" required autocomplete="new-password"
                                                                       placeholder="Enter confirm password">
                                                                <button
                                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                                    type="button" id="password-addon"><i
                                                                        class="ri-eye-fill align-middle"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="otp" class="form-label">OTP <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input id="otp" type="text" class="form-control" wire:model.live="otp" required autocomplete="off" placeholder="Enter your OTP">
                                                                <button type="button" class="btn btn-primary" wire:click="sendOtp">Send OTP</button>
                                                            </div>
                                                            @error('otp')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                
                                                    <div class="mb-4">
                                                        <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the
                                                            PDSI
                                                            <a href="#"
                                                               class="text-primary text-decoration-underline fst-normal fw-medium">Terms
                                                                of
                                                                Use</a>
                                                        </p>
                                                    </div>
                
                                                    <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                                        <h5 class="fs-13">Password must contain:</h5>
                                                        <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b>
                                                        </p>
                                                        <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter
                                                            (a-z)
                                                        </p>
                                                        <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b>
                                                            letter
                                                            (A-Z)
                                                        </p>
                                                        <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)
                                                        </p>
                                                    </div>
                
                                                    <div class="mt-4">
                                                        <button class="btn btn-primary w-100" type="submit">Sign Up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Already have an account ? <a href="auth-signin-basic" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
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

@section('script')
    <!-- validation init -->
    <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
    <!-- password create init -->
    <script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>
@endsection
