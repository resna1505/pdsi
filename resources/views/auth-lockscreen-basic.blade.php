@extends('layouts.master-without-nav')
@section('title')
@lang('translation.lock-screen')
@endsection
@section('content')

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
                                            <p class="mb-0">&copy;
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script> PDSI. Crafted with <i class="mdi mdi-heart text-danger"></i> by ICT PDSI
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-7">
                                <div class="card mb-0 border-0 shadow-none">
                                    <div class="card-body px-0 p-sm-5 m-lg-4">
                                        <div class="text-center">
                                            <h5 class="text-primary fs-20">Lock Screen</h5>
                                            <p class="text-muted mb-4">Enter your password to unlock the screen!</p>
                                        </div>
                                        
                                        {{-- Alert Messages --}}
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ session('success') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (session('info'))
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                {{ session('info') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif

                                        @if (session('error'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                {{ session('error') }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        
                                        <div class="user-thumb text-center">
                                            <img src="{{ Auth::user()->anggota?->avatar
                                    ? asset('storage/images/users/' . Auth::user()->anggota->avatar)
                                    : asset('build/images/users/avatar-1.jpg') }}" class="rounded-circle img-thumbnail avatar-lg" alt="thumbnail">
                                            <h5 class="font-size-15 mt-3">{{ Auth::user()->anggota?->nama ?? Auth::user()->name }}</h5>
                                        </div>
                                        <div class="p-2 mt-4">
                                            <form method="POST" action="{{ route('lockscreen.unlock') }}">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="form-label" for="userpassword">Password</label>
                                                    <input type="password" 
                                                           class="form-control @error('password') is-invalid @enderror" 
                                                           id="userpassword" 
                                                           name="password"
                                                           placeholder="Enter your password" 
                                                           required
                                                           autofocus>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-2 mt-4">
                                                    <button class="btn btn-primary w-100" type="submit">
                                                        <i class="mdi mdi-lock-open-outline me-1"></i> Unlock
                                                    </button>
                                                </div>
                                            </form><!-- end form -->

                                        </div>
                                        <div class="mt-4 text-center">
                                            <p class="mb-0">Not you ? return <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
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

@endsection

@section('script')
<script>
    // Auto focus pada input password
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('userpassword').focus();
    });
    
    // Handle enter key
    document.getElementById('userpassword').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            this.closest('form').submit();
        }
    });
</script>
@endsection