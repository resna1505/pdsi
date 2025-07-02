@extends('layouts.master')
@section('title')
@lang('translation.settings')
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-xxl-12">
        <div class="card overflow-hidden profile-setting-img">
            <div class="card-body">
                <form action="{{ route('edit-photo-dokter.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row justify-content-between gy-4">
                        <div class="col-xl-3 col-lg-5">
                            <div class="border border-dashed p-3 rounded-3">
                                <div class="d-flex align-items-center mb-4 pb-1">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Photo</h5>
                                    </div>
                                </div>
                                <div class="text-center mt-n4">
                                    <img src="{{ asset('storage/images/users/' . Auth::user()->anggota->avatar) }}" alt="User Avatar" class="avatar-lg rounded-circle p-1">
                                    <input type="file" name="photo" class="form-control mt-3">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-5">
                            <div>
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Portfolio</h5>
                                    </div>
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-dark text-white">
                                            <i class="ri-twitter-line"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="twitter_url" class="form-control" placeholder="Twitter URL" value="{{ old('twitter_url', $anggota->twitter_url) }}">
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-primary">
                                            <i class="ri-linkedin-line"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="linkedin_url" class="form-control" placeholder="LinkedIn URL" value="{{ old('linkedin_url', $anggota->linkedin_url) }}">
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-secondary text-white">
                                            <i class=" ri-instagram-line"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="instagram_url" class="form-control" placeholder="Instagram URL" value="{{ old('instagram_url', $anggota->instagram_url) }}">
                                </div>
                                <div class="mb-3 d-flex">
                                    <div class="avatar-xs d-block flex-shrink-0 me-3">
                                        <span class="avatar-title rounded-circle fs-16 bg-primary">
                                            <i class=" ri-facebook-circle-fill"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="facebook_url" class="form-control" placeholder="Facebook URL" value="{{ old('facebook_url', $anggota->facebook_url) }}">
                                </div>
                            </div>
                            <div class="col-md-auto ms-auto order-md-2">
                                <div class="flex-shrink-0">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="ri-edit-box-line align-bottom"></i> Update
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Nav tabs -->
                <div class="row align-items-center mt-3 gy-3">
                    <div class="col-md order-1">
                        <ul class="nav nav-pills animation-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#personalDetails" role="tab" aria-selected="true">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Personal Details</span>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#changePassword" role="tab" aria-selected="false" tabindex="-1">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Changes Password</span>
                                </a>
                            </li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!--end col-->
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        <form action="{{ route('edit-profile-dokter.update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="firstnameInput" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="firstnameInput" name="nama" placeholder="Enter your firstname" value="{{ $anggota->nama}}"">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="emailInput" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInput" name="email" placeholder="Enter your email" value="{{ $anggota->email }}">
                                    </div>
                                </div>                                
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="phonenumberInput" class="form-label">No Handphone</label>
                                        <input type="text" class="form-control" id="phonenumberInput" name="no_hp" placeholder="Enter your phone number" value="{{ $anggota->no_hp }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="lastnameInput" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" id="lastnameInput" name="tempat_lahir" placeholder="Enter your lastname" value="{{ $anggota->tempat_lahir }}">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="JoiningdatInput" class="form-label">Tanggal Lahir</label>
                                        <input type="text" class="form-control" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="{{ $anggota->tanggal_lahir }}" name="tanggal_lahir" placeholder="Select date" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="skillsInput" class="form-label">Profesi</label>
                                        <select class="form-control" name="profesi[]" data-choices data-choices-text-unique-true multiple id="skillsInput" required>
                                            <option value="Sarjana Kedokteran" {{ str_contains($anggota->profesi ?? '', 'Sarjana Kedokteran') ? 'selected' : '' }}>Sarjana Kedokteran</option>
                                            <option value="Dokter Umum" {{ str_contains($anggota->profesi ?? '', 'Dokter Umum') ? 'selected' : '' }}>Dokter Umum</option>
                                            <option value="Dokter Spesialis" {{ str_contains($anggota->profesi ?? '', 'Dokter Spesialis') ? 'selected' : '' }}>Dokter Spesialis</option>
                                        </select>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3 pb-2">
                                        <label for="exampleFormControlTextarea" class="form-label">Alamat Lengkap</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea" name="alamat" placeholder="Enter your description" rows="3">{{ $anggota->alamat }}</textarea>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="cityInput" class="form-label">Kota</label>
                                        <input type="text" class="form-control" id="cityInput" placeholder="City" name="kota" value="{{ $anggota->kota }}" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="countryInput" class="form-label">Provinsi</label>
                                        <input type="text" class="form-control" id="countryInput" placeholder="Country" name="provinsi" value="{{ $anggota->provinsi }}" />
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="mb-3 pb-2">
                                        <label for="exampleFormControlTextarea" class="form-label">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea" name="description" placeholder="Enter your description" rows="3">{{ $anggota->description }}</textarea>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary">Updates</button>
                                        <button type="button" class="btn btn-soft-success">Cancel</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        <form method="POST" action="{{ route('change-password') }}">
                            @csrf
                            <div class="row g-2 justify-content-lg-between align-items-center">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                        <div class="position-relative">
                                            <input type="password" name="old_password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                            <button class="btn btn-link position-absolute top-0 end-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
    <div class="auth-pass-inputgroup">
        <label for="password-input" class="form-label">New Password*</label>
        <label class="text-muted"> (Kombinasi huruf dan angka minimal 8 karakter)</label>
        <div class="position-relative">
            <input type="password" 
                   name="new_password" 
                   class="form-control password-input" 
                   onpaste="return false" 
                   placeholder="Enter new password" 
                   aria-describedby="passwordInput" 
                   pattern="^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                   required>
            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                <i class="ri-eye-fill align-middle"></i>
            </button>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="auth-pass-inputgroup">
        <label for="confirm-password-input" class="form-label">Confirm Password*</label>
        <div class="position-relative">
            <input type="password" 
                   name="confirm_password" 
                   class="form-control password-input" 
                   onpaste="return false" 
                   placeholder="Confirm password" 
                   pattern="^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                   required>
            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input">
                <i class="ri-eye-fill align-middle"></i>
            </button>
        </div>
    </div>
</div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="/forget-password" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                    <div class="">

                                        <button type="submit" class="btn btn-success">Change Password</button>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div class="card bg-light passwd-bg" id="password-contain">
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <h5 class="fs-13">Password must contain:</h5>
                                            </div>
                                            <div class="">
                                                <p id="pass-length" class="invalid fs-12 mb-2">Minimum <b>8 characters</b></p>
                                                <p id="pass-lower" class="invalid fs-12 mb-2">At <b>lowercase</b> letter (a-z)</p>
                                                <p id="pass-upper" class="invalid fs-12 mb-2">At least <b>uppercase</b> letter (A-Z)</p>
                                                <p id="pass-number" class="invalid fs-12 mb-0">A least <b>number</b> (0-9)</p>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
