@extends('layouts.master-without-nav')
@section('title')
@lang('translation.logout')
@endsection
@section('content')

<section class="auth-page-wrapper-2 py-4 position-relative d-flex align-items-center justify-content-center min-vh-100 bg-light">
    <div class="container">
        <div class="row g-0">
            <div class="col-lg-5">
                <div class="auth-card card bg-primary h-100 rounded-0 rounded-start border-0 d-flex align-items-center justify-content-center overflow-hidden p-4">
                    <div class="auth-image">
                        <img src="{{ URL::asset('build/images/logo-light-full.png') }}" alt="" height="42" />
                        <img src="{{ URL::asset('build/images/effect-pattern/auth-effect-2.png') }}" alt="" class="auth-effect-2" />
                        <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect" />
                        <img src="{{ URL::asset('build/images/effect-pattern/auth-effect.png') }}" alt="" class="auth-effect-3" />
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card mb-0 rounded-0 rounded-end border-0">
                    <div class="card-body p-4 p-sm-5 m-lg-4 text-center">
                        <div class="display-4 text-primary">
                            <i class="bi bi-box-arrow-right"></i>
                        </div>
                        <div class="mt-4 pt-2">
                            <h5 class="fs-18">You are Logged Out</h5>
                            <p class="text-muted">Thank you for using <span class="fw-semibold">PDSI</span> admin template</p>
                            <div class="mt-4">
                                <a href="auth-signin-basic" class="btn btn-primary w-100">Sign In</a>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--edn container-->
</section>

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}"></script>

@endsection
