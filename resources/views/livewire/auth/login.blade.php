@section('title')
    Login
@endsection

<div>
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

                                            <div class="p-2 mt-5">
                                                <form method="POST" wire:submit="submit">
                                                    @csrf
                    
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email <span
                                                                class="text-danger">*</span></label>
                                                        <input id="email" type="email"
                                                            class="form-control @error('email') is-invalid @enderror" wire:model.live="email"
                                                            value="" required autocomplete="email" autofocus placeholder="Enter your email">
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                    
                                                    <div class="mb-3">
                                                        <div class="float-end">
                                                            @if (Route::has('password.reset'))
                                                                <a class="text-muted" href="{{ route('password.reset') }}">
                                                                    {{ __('Forgot Your Password?') }}
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <label class="form-label" for="password-input">Password <span
                                                                class="text-danger">*</span></label>
                                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                                            <input id="password" type="password"
                                                                class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                                wire:model.live="password" id="password-input" required value=""
                                                                autocomplete="current-password" placeholder="Enter your password">
                                                            <button
                                                                class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                                type="button" id="password-addon"><i
                                                                    class="ri-eye-fill align-middle"></i></button>
                                                        </div>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                    
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                                            {{ old('remember') ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="remember">Remember me</label>
                                                    </div>
                    
                                                    <div class="mt-4">
                                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                                    </div>
                                                </form>
                    
                                                <div class="text-center mt-5">
                                                    <p class="mb-0">Don't have an account ? <a href="{{ url('register') }}"
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

    <!-- Announcement Modal -->
    <div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header bg-primary text-white border-0 position-relative">
                    <h5 class="modal-title text-white" id="announcementModalLabel">
                        <i class="ri-notification-2-line me-2"></i>Pengumuman / Announcement
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="position-relative">
                        <!-- Main announcement image/content -->
                        <img src="{{ asset('downloads/pengumuman_pdsi.png') }}" class="img-fluid" alt="Announcement Image">                        
                    </div>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-warning px-4" data-bs-dismiss="modal">
                        <i class="ri-close-line me-1"></i>Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
    <script>
        // Show modal on page load with multiple fallbacks
        function showAnnouncementModal() {
            console.log('Attempting to show modal...');
            const modalElement = document.getElementById('announcementModal');
            console.log('Modal element found:', !!modalElement);
            
            if (modalElement) {
                console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
                
                if (typeof bootstrap !== 'undefined') {
                    try {
                        var announcementModal = new bootstrap.Modal(modalElement);
                        console.log('Modal instance created');
                        
                        // Add event listeners to clean up backdrop
                        modalElement.addEventListener('hidden.bs.modal', function () {
                            console.log('Modal hidden, cleaning up...');
                            // Remove any remaining backdrop
                            const backdrop = document.querySelector('.modal-backdrop');
                            if (backdrop) {
                                backdrop.remove();
                                console.log('Backdrop removed');
                            }
                            // Remove modal-open class from body
                            document.body.classList.remove('modal-open');
                            // Reset body style
                            document.body.style.overflow = '';
                            document.body.style.paddingRight = '';
                            console.log('Body classes and styles reset');
                        });
                        
                        announcementModal.show();
                        console.log('Modal show() called');
                    } catch (error) {
                        console.error('Error creating/showing modal:', error);
                    }
                } else {
                    console.error('Bootstrap is not loaded');
                }
            } else {
                console.error('Modal element not found');
            }
        }

        // Try multiple approaches to ensure modal shows
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM Content Loaded');
            
            // Wait a bit for everything to load
            setTimeout(function() {
                showAnnouncementModal();
            }, 1000);
        });

        // Also try when window fully loads
        window.addEventListener('load', function() {
            console.log('Window fully loaded');
            setTimeout(function() {
                showAnnouncementModal();
            }, 500);
        });

        // For Livewire compatibility
        document.addEventListener('livewire:navigated', function() {
            console.log('Livewire navigated');
            setTimeout(function() {
                showAnnouncementModal();
            }, 500);
        });
    </script>
@endsection