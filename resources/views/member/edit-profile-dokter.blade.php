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

{{-- 🆕 SINGLE FORM UNTUK SEMUA DATA --}}
@if(Request::is('member/*/edit'))
    {{-- Jika diakses melalui /member/{id}/edit (Admin edit member) --}}
    <form action="{{ route('member.update', $anggota->user_id ?? $anggota->id) }}" method="POST" enctype="multipart/form-data" id="profileForm">
@else
    <form action="{{ route('edit-profile-dokter.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
@endif
@csrf

<div class="row">
    <div class="col-xxl-12">
        <div class="card overflow-hidden profile-setting-img">
            <div class="card-body">
                <div class="row justify-content-between gy-4">
                    <div class="col-xl-3 col-lg-5">
                        <div class="border border-dashed p-3 rounded-3">
                            <div class="d-flex align-items-center mb-4 pb-1">
                                <div class="flex-grow-1">
                                    <h5 class="card-title mb-0">Photo</h5>
                                </div>
                            </div>
                            <div class="text-center mt-n4">
                                @if($anggota->avatar)
                                    <img src="{{ asset('storage/images/users/' . $anggota->avatar) }}" alt="User Avatar" class="avatar-lg rounded-circle p-1">
                                @else
                                    <img src="{{ asset('build/images/users/user-dummy-img.jpg') }}" alt="User Avatar" class="avatar-lg rounded-circle p-1">
                                @endif
                                <input type="file" name="photo" class="form-control mt-3" accept="image/*">
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
                    </div>
                </div>
                
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
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="personalDetails" role="tabpanel">
                        {{-- 🆕 PERSONAL DETAILS DALAM FORM YANG SAMA --}}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="firstnameInput" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="firstnameInput" name="nama" placeholder="Enter your firstname" value="{{ old('nama', $anggota->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="emailInput" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="emailInput" name="email" placeholder="Enter your email" value="{{ old('email', $anggota->email) }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>                                
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phonenumberInput" class="form-label">No Handphone</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="phonenumberInput" name="no_hp" placeholder="Enter your phone number" value="{{ old('no_hp', $anggota->no_hp) }}" required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="lastnameInput" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="lastnameInput" name="tempat_lahir" placeholder="Enter your lastname" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}">
                                    @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="JoiningdatInput" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="JoiningdatInput" name="tanggal_lahir" value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}" />
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="skillsInput" class="form-label">Profesi</label>
                                    <select class="form-control @error('profesi') is-invalid @enderror" name="profesi[]" data-choices data-choices-text-unique-true multiple id="skillsInput">
                                        <option value="Sarjana Kedokteran" {{ str_contains($anggota->profesi ?? '', 'Sarjana Kedokteran') ? 'selected' : '' }}>Sarjana Kedokteran</option>
                                        <option value="Dokter Umum" {{ str_contains($anggota->profesi ?? '', 'Dokter Umum') ? 'selected' : '' }}>Dokter Umum</option>
                                        <option value="Dokter Spesialis" {{ str_contains($anggota->profesi ?? '', 'Dokter Spesialis') ? 'selected' : '' }}>Dokter Spesialis</option>
                                    </select>
                                    @error('profesi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>                            
                            <div class="col-lg-4">
                                <div class="mb-3 pb-2">
                                    <label for="alamatTextarea" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamatTextarea" name="alamat" placeholder="Enter your description" rows="3">{{ old('alamat', $anggota->alamat) }}</textarea>
                                    @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="cityInput" class="form-label">Kota</label>
                                    <input type="text" class="form-control @error('kota') is-invalid @enderror" id="cityInput" placeholder="City" name="kota" value="{{ old('kota', $anggota->kota) }}" />
                                    @error('kota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="countryInput" class="form-label">Provinsi</label>
                                    <input type="text" class="form-control @error('provinsi') is-invalid @enderror" id="countryInput" placeholder="Country" name="provinsi" value="{{ old('provinsi', $anggota->provinsi) }}" />
                                    @error('provinsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3 pb-2">
                                    <label for="descriptionTextarea" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="descriptionTextarea" name="description" placeholder="Enter your description" rows="3">{{ old('description', $anggota->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            {{-- 🆕 SUBMIT BUTTON DIPINDAH KE SINI --}}
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ri-save-line me-1"></i> Update Profile
                                    </button>
                                    @if(Request::is('member/*/edit'))
                                        <a href="{{ route('member.show', $anggota->user_id ?? $anggota->id) }}" class="btn btn-soft-success">
                                            <i class="ri-arrow-left-line me-1"></i> Back to Profile
                                        </a>
                                    @else
                                        <a href="{{ route('profile.dokter') }}" class="btn btn-soft-success">
                                            <i class="ri-arrow-left-line me-1"></i> Cancel
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>                        
                    </div>
                    
                    {{-- 🆕 PASSWORD CHANGE TAB (FORM TERPISAH) --}}
                    <div class="tab-pane" id="changePassword" role="tabpanel">
                        </form> {{-- Tutup form utama sebelum password form --}}
                        
                        <form method="POST" action="{{ route('change-password') }}">
                            @csrf
                            <div class="row g-2 justify-content-lg-between align-items-center">
                                <div class="col-lg-4">
                                    <div>
                                        <label for="oldpasswordInput" class="form-label">Old Password*</label>
                                        <div class="position-relative">
                                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="oldpasswordInput" placeholder="Enter current password" required>
                                            <button class="btn btn-link position-absolute top-0 end-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            @error('old_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
                                                   class="form-control password-input @error('new_password') is-invalid @enderror" 
                                                   onpaste="return false" 
                                                   placeholder="Enter new password" 
                                                   aria-describedby="passwordInput" 
                                                   pattern="^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                                                   required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="auth-pass-inputgroup">
                                        <label for="confirm-password-input" class="form-label">Confirm Password*</label>
                                        <div class="position-relative">
                                            <input type="password" 
                                                   name="confirm_password" 
                                                   class="form-control password-input @error('confirm_password') is-invalid @enderror" 
                                                   onpaste="return false" 
                                                   placeholder="Confirm password" 
                                                   pattern="^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$"
                                                   required>
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="confirm-password-input">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            @error('confirm_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="/forget-password" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                    <div class="">
                                        <button type="submit" class="btn btn-success">Change Password</button>
                                    </div>
                                </div>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/passowrd-create.init.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection