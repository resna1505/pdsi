@extends('layouts.master')
@section('title')
@lang('translation.profile')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card overflow-hidden">
            <div class="rounded profile-basic position-relative" style="background-image: url('build/images/profile-bg.jpg');background-size: cover;background-position: center;">
                <div class="bg-overlay bg-primary"></div>
            </div>
            <div class="card-body">
                <div class="position-relative">
                    <div class="mt-n5">
                        {{-- Avatar --}}
                        @if($anggota && $anggota->avatar)
                            <img src="{{ URL::asset('storage/images/users/' . $anggota->avatar) }}" alt="" class="avatar-lg rounded-circle">
                        @else
                            <img src="{{ URL::asset('build/images/users/user-dummy-img.jpg') }}" alt="" class="avatar-lg rounded-circle">
                        @endif
                    </div>
                </div>
                <div class="pt-3">
                    <div class="row justify-content-between gy-4">
                        <div class="col-xl-5 col-lg-5">
                            <h5 class="fs-17">{{ $anggota->nama }}</h5>
                            <div class="hstack gap-1 mb-3 text-muted">
                                <div class="me-2"><i class="ri-map-pin-user-line me-1 fs-16 align-middle"></i>{{ $anggota->kota }}, {{ $anggota->provinsi }}</div>
                                <div>
                                    <i class="ri-building-line me-1 fs-16 align-middle"></i>-
                                </div>
                            </div>
                            <p>{{ $anggota->profesi }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 mt-lg-4 gy-3">
                    <div class="col-lg order-1">
                        <!-- Nav tabs -->
                        <ul class="nav nav-pills animation-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                    <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Overview</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#activities" role="tab">
                                    <i class="ri-list-unordered d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Membership</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#education" role="tab">
                                    <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Education</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#projects" role="tab">
                                    <i class="ri-price-tag-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Practice</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#documents" role="tab">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Documents</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-auto order-lg-2">
                        <a href="edit-profile-dokter" class="btn btn-secondary"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end card-->
    </div>
    <!--end col-->
</div>
<!--end row-->

<div class="row">
    <div class="col-lg-12">
        <!-- Tab panes -->
        <div class="tab-content text-muted">
            <div class="tab-pane active" id="overview-tab" role="tabpanel">
                <div class="row">
                    <div class="col-xxl-3">
                        <div class="card">
                            <div class="card-body p-2">
                                <div class="text-center mb-4">
                                    <h6>Download Kartu Anggota:</h6>
                                    
                                    <!-- PDF Download -->
                                    <a href="{{ route('member.download-card-pdf') }}" class="btn btn-danger btn-sm me-2">
                                        <i class="fas fa-download"></i> PDF
                                    </a>
                                    
                                    <!-- JPG Download Options -->
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                            <i class="fas fa-image"></i> JPG
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><h6 class="dropdown-header">Single Cards</h6></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jpg.front') }}">
                                                    <i class="fas fa-id-card"></i> Kartu Depan
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jpg.back') }}">
                                                    <i class="fas fa-id-card-alt"></i> Kartu Belakang
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><h6 class="dropdown-header">Complete Set</h6></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('jpg.both.zip') }}">
                                                    <i class="fas fa-file-archive"></i> Both Cards (ZIP)
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <!-- Preview -->
                                    <a href="{{ route('member.card-preview', $anggota->id) }}" target="_blank" class="btn btn-info btn-sm ms-2">
                                        <i class="fas fa-eye"></i> Preview
                                    </a>
                                </div>
                                <!-- Card Carousel -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active"> 
                                            <div class="d-bloack img-fluid mx-auto" style="background: url('{{ URL::asset('build/images/kta_pdsi_depan.jpg') }}') no-repeat center center; background-size: cover; width: 300px; height: 500px; position: relative;">
                                                <div style="position: absolute; top: 51%; left: 50%; transform: translate(-50%, -50%); width: 220px; height: 220px; border-radius: 50%; overflow: hidden; border: 2px solid white;">
                                                    <img src="{{ URL::asset('storage/images/users/' . $anggota->avatar) }}" alt="First slide" style="width: 100%; height: 100%; object-fit: cover;">
                                                </div>
                                                <div style="position: absolute; bottom: 100px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    Nama : {{ \Illuminate\Support\Str::limit($anggota->nama, 30) }}
                                                </div>
                                                <div style="position: absolute; bottom: 80px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    NPA : {{ $anggota->no_kartu_anggota }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item"> 
                                            <div class="d-bloack img-fluid mx-auto" style="background: url('{{ URL::asset('build/images/kta_pdsi_belakang.jpg') }}') no-repeat center center; background-size: cover; width: 300px; height: 500px; position: relative;">                                                
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Update di view profile-dokter.blade.php -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-5">Complete Your Profile</h5>
                                <div class="progress animated-progress custom-progress progress-label">
                                    <div class="progress-bar {{ $progressColor }}" 
                                        role="progressbar" 
                                        style="width: {{ $profilePercentage }}%;" 
                                        aria-valuenow="{{ $profilePercentage }}" 
                                        aria-valuemin="0" 
                                        aria-valuemax="100">
                                        <div class="label">{{ $profilePercentage }}%</div>
                                    </div>
                                </div>
                                
                                @if($profilePercentage < 100)
                                    <p class="text-muted mt-3 mb-0">
                                        <small>Lengkapi profil Anda untuk mendapatkan kredibilitas yang lebih baik</small>
                                    </p>
                                @else
                                    <p class="text-success mt-3 mb-0">
                                        <small><i class="fas fa-check-circle"></i> Profil Anda sudah lengkap!</small>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Portfolio</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <div>
                                        <a href="{{ $anggota->twitter_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-dark text-white">
                                                <i class="ri-twitter-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ $anggota->facebook_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class="ri-facebook-circle-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ $anggota->linkedin_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                <i class="ri-linkedin-box-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ $anggota->instagram_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                <i class="ri-instagram-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-xxl-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">About</h5>
                                <p>{{ $anggota->description }}</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-person-bounding-box"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Specialist :</p>
                                                <h6 class="text-truncate mb-0">-</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-globe"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Website :</p>
                                                <a href="#" class="fw-semibold text-body">www.pdsionline.org/{{ $anggota->nama }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-telephone"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-2">Mobile :</p>
                                                <h6 class="text-truncate mb-0">{{ $anggota->no_hp }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-envelope"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-2">E-mail :</p>
                                                <h6 class="text-truncate mb-0">{{ $anggota->email }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-calendar-check"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-2">Joining Date :</p>
                                                <h6 class="text-truncate mb-0">{{ \Carbon\Carbon::parse($anggota->created_at)->translatedFormat('d M Y') }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1">Activity Stream</h5>
                                        <div class="flex-shrink-0">
                                            {{-- <button type="button" class="btn btn-soft-primary btn-sm">
                                                View All Activity
                                            </button> --}}
                                        </div>
                                    </div>
                                    <div class="card-body px-0">
                                        <div data-simplebar style="max-height: 400px;" class="p-3 pt-0">
                                            <ul class="acitivity-timeline-2 list-unstyled mb-0">
                                                {{-- <li>
                                                    <h6 class="fs-14">Konsultasi Online</h6>
                                                    <p class="text-muted">09:24 PM</p>
                                                    <p class="mb-0">Dr. resna pangestu, Sp.PD menyelesaikan konsultasi dengan pasien melalui Telemedicine.</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">Jadwal Praktik Diperbarui <span class="badge text-bg-info align-middle ms-1">New</span></h6>
                                                    <p class="mb-3 text-muted">4 days ago</p>
                                                    <p class="mb-0">RS Cipto Mangunkusumo – 09:00 - 14:00 WIB</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">Webinar & Pelatihan</h6>
                                                    <p class="text-muted">1 minggu yang lalu</p>
                                                    <p class="mb-0">Dr. Andi Pratama mengikuti Workshop Penanganan Diabetes Mellitus Terkini.</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">Artikel Medis Dipublikasikan</h6>
                                                    <p class="text-muted">2 minggu yang lalu</p>
                                                    <p class="mb-0">"Manajemen Hipertensi pada Lansia" telah diterbitkan di Jurnal IDI.</p>
                                                </li> --}}
                                                <li>
                                                    <h6 class="fs-14">-</h6>
                                                    <p class="text-muted">-</p>
                                                    <p class="mb-0">-</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">-</h6>
                                                    <p class="text-muted">-</p>
                                                    <p class="mb-0">-</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">-</h6>
                                                    <p class="text-muted">-</p>
                                                    <p class="mb-0">-</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">-</h6>
                                                    <p class="text-muted">-</p>
                                                    <p class="mb-0">-</p>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">-</h6>
                                                    <p class="text-muted">-</p>
                                                    <p class="mb-0">-</p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membership Tab -->
            <div class="tab-pane fade" id="activities" role="tabpanel">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Keanggotaan</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="bi bi-person-bounding-box"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Status :</p>
                                            <h6 class="text-truncate mb-0">Anggota</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-customer-service-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">ID :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->id }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="bi bi-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">E-mail :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->email }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Pendidikan Dokter</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-government-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Asal Negara Universitas :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-hotel-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Asal Universitas :</p>
                                            <a href="#" class="fw-semibold text-body">-</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-pages-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">No Ijazah :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-file-reduce-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Tanggal Ijazah :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-file-paper-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Dokumen Ijazah :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Data Pribadi</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-file-user-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">No. Identitas :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->ktp }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-input-method-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Nama :</p>
                                            <a href="#" class="fw-semibold text-body">{{ $anggota->nama }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="bi bi-telephone"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Mobile :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->no_hp }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Tempat / Tanggal Lahir :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->tempat_lahir }} / {{ $anggota->tanggal_lahir }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-user-follow-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Jenis Kelamin :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-team-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Agama :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Alamat</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-map-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Alamat :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->alamat }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-map-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Provinsi :</p>
                                            <a href="#" class="fw-semibold text-body">{{ $anggota->provinsi }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-map-pin-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Kab / Kota :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->kota }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-map-pin-5-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Kelurahan :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-map-pin-4-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">RT / RW :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class="ri-map-pin-user-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Kode Pos :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Education Tab -->
            <div class="tab-pane fade" id="education" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="card-title flex-grow-1 mb-0">Education History</h5>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">
                                    <i class="ri-add-line me-1"></i> Add Education
                                </button>
                            </div>
                        </div>
                        
                        @if(isset($educations) && $educations->count() > 0)
                            <div class="row">
                                @foreach($educations as $education)
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none mt-3">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="text-center mb-4 me-3">
                                                        @if($education->institution_logo)
                                                            <img src="{{ URL::asset('storage/logos/' . $education->institution_logo) }}" alt="" width="30px" height="30px" class="">
                                                        @else
                                                            <img src="{{ URL::asset('build/images/companies/img-1.png') }}" alt="" width="30px" height="30px" class="">
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-14 text-truncate">
                                                            <a href="#" class="text-body">{{ $education->institution_name }}</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">
                                                            Last Update : <span class="fw-semibold text-body">{{ $education->last_update }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="col text-end dropdown"> 
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> 
                                                                <i class="bi bi-three-dots-vertical"></i> 
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item edit-education" href="#" 
                                                                       data-id="{{ $education->id }}"
                                                                       data-bs-toggle="modal" 
                                                                       data-bs-target="#editEducationModal">
                                                                        <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item text-danger" href="#" 
                                                                       onclick="deleteEducation({{ $education->id }})">
                                                                        <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-3 align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-12 text-muted mb-0">GPA :</h5>
                                                            </div>
                                                            <div class="text-body fw-medium">
                                                                {{ $education->gpa ? number_format($education->gpa, 2) : '-' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge {{ $education->status_badge_class }} fs-10">
                                                            {{ $education->status_label }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col mt-3">
                                                    <h5 class="text-muted mt-0 mb-1 fs-13">{{ $education->degree_type }}</h5>
                                                    @if($education->major)
                                                        <p class="text-muted mb-1 fs-12">{{ $education->major }}</p>
                                                    @endif
                                                    <a href="#" class="text-reset fs-14 mb-0">{{ $education->period }}</a>
                                                </div>
                                                
                                                @if($education->description)
                                                    <div class="mt-2">
                                                        <p class="text-muted fs-12 mb-0">{{ Str::limit($education->description, 100) }}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="avatar-sm mx-auto mb-4">
                                    <div class="avatar-title bg-soft-primary text-primary rounded-circle fs-20">
                                        <i class="ri-book-line"></i>
                                    </div>
                                </div>
                                <h5 class="fs-16">No Education Data</h5>
                                <p class="text-muted">Belum ada data pendidikan. Klik tombol "Add Education" untuk menambah data pendidikan Anda.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Practice Tab -->
            <div class="tab-pane fade" id="projects" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="card-title flex-grow-1 mb-0">Practice History</h5>
                            <div class="flex-shrink-0">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPracticeModal">
                                    <i class="ri-add-line me-1"></i> Add Practice
                                </button>
                            </div>
                        </div>
                        
                        @if(isset($practices) && $practices->count() > 0)
                            <div class="row">
                                @foreach($practices as $practice)
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card profile-project-card shadow-none mt-3">
                                            <div class="card-body p-4">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1 text-muted overflow-hidden">
                                                        <h5 class="fs-14 text-truncate">
                                                            <a href="#" class="text-body">{{ $practice->institution_name }}</a>
                                                        </h5>
                                                        <p class="text-muted text-truncate mb-0">
                                                            Last Update : <span class="fw-semibold text-body">{{ $practice->last_update }}</span>
                                                        </p>
                                                        @if($practice->position)
                                                            <p class="text-muted text-truncate mb-0 fs-12">{{ $practice->position }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="col text-end dropdown"> 
                                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> 
                                                                <i class="bi bi-three-dots-vertical"></i> 
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end">
                                                                <li>
                                                                    <a class="dropdown-item edit-practice" href="#" 
                                                                       data-id="{{ $practice->id }}"
                                                                       data-bs-toggle="modal" 
                                                                       data-bs-target="#editPracticeModal">
                                                                        <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item text-danger" href="#" 
                                                                       onclick="deletePractice({{ $practice->id }})">
                                                                        <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Delete
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex mt-3 align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <div>
                                                                <h5 class="fs-12 text-muted mb-0">Type :</h5>
                                                            </div>
                                                            <div class="text-body fw-medium fs-12">
                                                                {{ $practice->practice_type_label }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 ms-2">
                                                        <div class="badge {{ $practice->status_badge_class }} fs-10">
                                                            {{ $practice->status_label }}
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col mt-3">
                                                    @if($practice->department)
                                                        <h5 class="text-muted mt-0 mb-1 fs-13">{{ $practice->department }}</h5>
                                                    @endif
                                                    <a href="#" class="text-reset fs-14 mb-0">{{ $practice->period }}</a>
                                                    @if($practice->full_address)
                                                        <p class="text-muted fs-12 mt-1 mb-0">
                                                            <i class="ri-map-pin-line me-1"></i>{{ Str::limit($practice->full_address, 50) }}
                                                        </p>
                                                    @endif
                                                    @if($practice->phone)
                                                        <p class="text-muted fs-12 mt-1 mb-0">
                                                            <i class="ri-phone-line me-1"></i>{{ $practice->phone }}
                                                        </p>
                                                    @endif
                                                </div>
                                                
                                                @if($practice->description)
                                                    <div class="mt-2">
                                                        <p class="text-muted fs-12 mb-0">{{ Str::limit($practice->description, 100) }}</p>
                                                    </div>
                                                @endif

                                                @if($practice->schedule)
                                                    <div class="mt-2">
                                                        <h6 class="fs-12 text-muted mb-1">Schedule:</h6>
                                                        <div class="d-flex flex-wrap gap-1">
                                                            @foreach($practice->schedule as $day => $time)
                                                                @if($time)
                                                                    <span class="badge bg-soft-info text-info fs-11">
                                                                        {{ ucfirst($day) }}: {{ $time }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="avatar-sm mx-auto mb-4">
                                    <div class="avatar-title bg-soft-primary text-primary rounded-circle fs-20">
                                        <i class="ri-hospital-line"></i>
                                    </div>
                                </div>
                                <h5 class="fs-16">No Practice Data</h5>
                                <p class="text-muted">Belum ada data praktik. Klik tombol "Add Practice" untuk menambah data tempat praktik Anda.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Documents Tab -->
            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                            <div class="flex-shrink-0">
                                <form method="POST" action="{{ route('documents.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="file" id="formFile" class="d-none" onchange="this.form.submit()">
                                    <label for="formFile" class="btn btn-danger">
                                        <i class="ri-upload-2-fill me-1 align-bottom"></i> Upload File
                                    </label>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0 mt-3">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Nama File</th>
                                                <th>Tipe</th>
                                                <th>Ukuran</th>
                                                <th>Tanggal Upload</th>
                                                <th>Nama Anggota</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($documents as $doc)
                                                <tr>
                                                    <td>{{ $doc->filename }}</td>
                                                    <td>{{ $doc->type }}</td>
                                                    <td>{{ $doc->size }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($doc->upload_date)->format('d M Y') }}</td>
                                                    <td>{{ $doc->anggota->nama ?? '-' }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink{{ $doc->id }}" data-bs-toggle="dropdown" aria-expanded="true">
                                                                <i class="bi bi-sliders2"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink{{ $doc->id }}">
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('documents.view', $doc->id) }}" target="_blank">
                                                                        <i class="ri-eye-fill me-2 align-middle text-muted"></i>View
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="{{ route('documents.download', $doc->id) }}">
                                                                        <i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download
                                                                    </a>
                                                                </li>
                                                                <li class="dropdown-divider"></li>
                                                                <li>
                                                                    <form action="{{ route('documents.destroy', $doc->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus file ini?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="dropdown-item text-danger" type="submit">
                                                                            <i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="javascript:void(0);" class="text-success"><i class="mdi mdi-loading mdi-spin fs-20 align-middle me-2"></i> Load more </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
@include('member.partials.education-modals')
@include('member.partials.practice-modals')

@endsection

@section('script')
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ URL::asset('build/js/pages/profile.init.js')}}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
// Education Management
function deleteEducation(id) {
    if (confirm('Are you sure you want to delete this education record?')) {
        fetch(`/education/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Education deleted successfully!');
                location.reload();
            } else {
                alert('Error deleting education: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting education');
        });
    }
}

// Practice Management
function deletePractice(id) {
    if (confirm('Are you sure you want to delete this practice record?')) {
        fetch(`/practice/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Practice deleted successfully!');
                location.reload();
            } else {
                alert('Error deleting practice: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error deleting practice');
        });
    }
}

// Edit Education Modal Handler
document.addEventListener('DOMContentLoaded', function() {
    // Handle edit education buttons
    document.querySelectorAll('.edit-education').forEach(button => {
        button.addEventListener('click', function() {
            const educationId = this.dataset.id;
            
            // Fetch education data
            fetch(`/education/${educationId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const education = data.education;
                        
                        // Populate form
                        document.getElementById('edit_institution_name').value = education.institution_name || '';
                        document.getElementById('edit_degree_type').value = education.degree_type || '';
                        document.getElementById('edit_major').value = education.major || '';
                        document.getElementById('edit_status').value = education.status || '';
                        document.getElementById('edit_start_year').value = education.start_year || '';
                        document.getElementById('edit_end_year').value = education.end_year || '';
                        document.getElementById('edit_gpa').value = education.gpa || '';
                        const graduationDate = new Date(education.graduation_date);
                        const formattedGraduationDate = graduationDate.toISOString().slice(0, 10);
                        document.getElementById('edit_graduation_date').value = formattedGraduationDate || '';
                        document.getElementById('edit_certificate_number').value = education.certificate_number || '';
                        document.getElementById('edit_description').value = education.description || '';
                        
                        // Set form action
                        document.getElementById('editEducationForm').action = `/education/${educationId}`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading education data');
                });
        });
    });
    
    // Handle edit practice buttons
    document.querySelectorAll('.edit-practice').forEach(button => {
        button.addEventListener('click', function() {
            const practiceId = this.dataset.id;
            
            // Fetch practice data
            fetch(`/practice/${practiceId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const practice = data.practice;
                        
                        // Populate form
                        document.getElementById('edit_institution_name_practice').value = practice.institution_name || '';
                        document.getElementById('edit_practice_type').value = practice.practice_type || '';
                        document.getElementById('edit_position').value = practice.position || '';
                        document.getElementById('edit_department').value = practice.department || '';
                        document.getElementById('edit_status').value = practice.status || '';
                        document.getElementById('edit_license_number').value = practice.license_number || '';
                        document.getElementById('edit_start_date').value = practice.start_date ? practice.start_date.split('T')[0] : '';
                        document.getElementById('edit_end_date').value = practice.end_date ? practice.end_date.split('T')[0] : '';
                        document.getElementById('edit_phone').value = practice.phone || '';
                        document.getElementById('edit_city').value = practice.city || '';
                        document.getElementById('edit_address').value = practice.address || '';
                        document.getElementById('edit_province').value = practice.province || '';
                        document.getElementById('edit_description_practice').value = practice.description || '';
                        
                        // Populate schedule
                        if (practice.schedule) {
                            document.getElementById('edit_monday').value = practice.schedule.monday || '';
                            document.getElementById('edit_tuesday').value = practice.schedule.tuesday || '';
                            document.getElementById('edit_wednesday').value = practice.schedule.wednesday || '';
                            document.getElementById('edit_thursday').value = practice.schedule.thursday || '';
                            document.getElementById('edit_friday').value = practice.schedule.friday || '';
                            document.getElementById('edit_saturday').value = practice.schedule.saturday || '';
                            document.getElementById('edit_sunday').value = practice.schedule.sunday || '';
                        }
                        
                        // Set form action
                        document.getElementById('editPracticeForm').action = `/practice/${practiceId}`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading practice data');
                });
        });
    });
});

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    // Education form validation
    const educationForms = document.querySelectorAll('form[action*="education"]');
    educationForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const startYear = parseInt(this.querySelector('input[name="start_year"]').value);
            const endYear = parseInt(this.querySelector('input[name="end_year"]').value);
            
            if (endYear && startYear > endYear) {
                e.preventDefault();
                alert('End year cannot be earlier than start year');
                return false;
            }
        });
    });
    
    // Practice form validation
    const practiceForms = document.querySelectorAll('form[action*="practice"]');
    practiceForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const startDate = new Date(this.querySelector('input[name="start_date"]').value);
            const endDate = new Date(this.querySelector('input[name="end_date"]').value);
            
            if (endDate && startDate > endDate) {
                e.preventDefault();
                alert('End date cannot be earlier than start date');
                return false;
            }
        });
    });
});
</script>
@endsection