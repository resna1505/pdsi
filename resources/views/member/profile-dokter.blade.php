@extends('layouts.master')
@section('title')
@lang('translation.profile')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
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
                        <img src="{{ URL::asset('storage/images/users/' . $anggota->avatar) }}" alt="" class="avatar-lg rounded-circle p-1 mt-n4">
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
                        <div class="col-xl-3 col-lg-5">
                            <div>
                                <p class="text-muted fw-medium mb-2">place of practice</p>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item">
                                        <span class="badge text-info bg-info-subtle">Dummy</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="badge text-info bg-info-subtle">Dummy</span>
                                    </li>
                                </ul>
                            </div>
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
                            {{-- <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#friends" role="tab">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Friends</span>
                                </a>
                            </li> --}}
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
                                <!-- With Indicators -->
                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        <div class="carousel-item active"> 
                                            <div class="d-bloack img-fluid mx-auto" style="background: url('{{ URL::asset('build/images/kta_pdsi_depan.png') }}') no-repeat center center; background-size: cover; width: 300px; height: 500px; position: relative;">
                                                <div style="position: absolute; 
                                                            top: 51%; 
                                                            left: 50%; 
                                                            transform: translate(-50%, -50%); 
                                                            width: 220px; 
                                                            height: 220px; 
                                                            border-radius: 50%; 
                                                            overflow: hidden;
                                                            border: 2px solid white;">
                                                    <img src="{{ URL::asset('storage/images/users/' . $anggota->avatar) }}" 
                                                        alt="First slide" 
                                                        style="width: 100%; 
                                                                height: 100%; 
                                                                object-fit: cover;
                                                    ">

                                                    
                                                </div>
                                                <div style="position: absolute; bottom: 100px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    Nama : {{ $anggota->nama }}
                                                </div>
                                                <div style="position: absolute; bottom: 80px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    Id : {{ $anggota->id }}
                                                </div>
                                                <div style="position: absolute; bottom: 60px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    No.Urut Anggota : {{ $anggota->id }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item"> 
                                            <div class="d-bloack img-fluid mx-auto" style="background: url('{{ URL::asset('build/images/kta_pdsi_belakang.png') }}') no-repeat center center; background-size: cover; width: 300px; height: 500px; position: relative;">
                                                <div style="position: absolute; 
                                                            top: 15%; 
                                                            left: 83%; 
                                                            transform: translate(-50%, -50%); 
                                                           
                                                            overflow: hidden;">
                                                        {!! QrCode::size(80)->generate($anggota->name . ' ' . $anggota->last_name . ' ' . $anggota->id . ' ' . $anggota->created_at) !!}
                                                </div>
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
                        

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-5">Complete Your Profile</h5>
                                <div class="progress animated-progress custom-progress progress-label">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100">
                                        <div class="label">67%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Portfolio</h5>
                                <div class="d-flex flex-wrap gap-2">
                                    <div>
                                        <a href="{{ $anggota->twitter_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-dark text-white">
                                                <i class="  ri-twitter-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ $anggota->facebook_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class=" ri-facebook-circle-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ $anggota->linkedin_url }}" target="_blank" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                <i class=" ri-linkedin-box-fill"></i>
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
                            </div><!-- end card body -->
                        </div><!-- end card -->
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
                                    <!--end col-->
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
                                    <!--end col-->
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
                                    <!--end col-->
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
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!-- end card -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h5 class="card-title mb-0 flex-grow-1">Activity Stream</h5>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-soft-primary btn-sm">
                                                View All Activity
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body px-0">
                                        <div data-simplebar style="max-height: 400px;" class="p-3 pt-0">
                                            <ul class="acitivity-timeline-2 list-unstyled mb-0">
                                                <li>
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
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-customer-service-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">ID :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->id }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
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
                                                <i class=" ri-government-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Asal Negara Universitas :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-hotel-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Asal Universitas :</p>
                                            <a href="#" class="fw-semibold text-body">-</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-pages-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">No Ijazah :</p>
                                            <h6 class="text-truncate mb-0">-</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-file-reduce-line"></i>
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
                                                <i class=" ri-file-paper-line"></i>
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
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-input-method-line"></i>
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
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-calendar-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Tempat / Tanggal Lahir :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->tempat_lahir }} / {{ $anggota->tanggal_lahir }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-user-follow-line"></i>
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
                                                <i class=" ri-team-line"></i>
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
                                                <i class=" ri-map-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Alamat :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->alamat }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-map-2-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-1">Provinsi :</p>
                                            <a href="#" class="fw-semibold text-body">{{ $anggota->provinsi }}</a>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-map-pin-line"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="mb-2">Kab / Kota :</p>
                                            <h6 class="text-truncate mb-0">{{ $anggota->kota }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="d-flex mt-4">
                                        <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                            <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                <i class=" ri-map-pin-5-line"></i>
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
                                                <i class=" ri-map-pin-4-line"></i>
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
                                                <i class=" ri-map-pin-user-line"></i>
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
            <!--end tab-pane-->

            <div class="tab-pane fade" id="education" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="text-center mb-4 me-3">
                                                <img src="{{ URL::asset('build/images/companies/img-1.png') }}" alt="" width="30px" height="30px" class="">
                                            </div>
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Universitas Indonesia</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">2 year Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                                    J
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-success  bg-success-subtle fs-10">Completed</div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h5 class="text-muted mt-0 mb-1 fs-13">S1 Kedokteran Umum</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">2008-2012</a>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="text-center mb-4 me-3">
                                                <img src="{{ URL::asset('build/images/companies/img-1.png') }}" alt="" width="30px" height="30px" class="">
                                            </div>
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Universitas Indonesia</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">2 year Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-primary  bg-primary-subtle fs-10">Progress</div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h5 class="text-muted mt-0 mb-1 fs-13">Program Profesi Dokter (Koas)</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">2012-2014</a>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="text-center mb-4 me-3">
                                                <img src="{{ URL::asset('build/images/companies/img-1.png') }}" alt="" width="30px" height="30px" class="">
                                            </div>
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Universitas Gadjah Mada</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">1 year Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-primary  bg-primary-subtle fs-10">Progress</div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h5 class="text-muted mt-0 mb-1 fs-13">Spesialis Penyakit Dalam (Sp.PD)</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">2015-2019</a>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="text-center mb-4 me-3">
                                                <img src="{{ URL::asset('build/images/companies/img-1.png') }}" alt="" width="30px" height="30px" class="">
                                            </div>
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Pelatihan ACLS & BLS</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">6 Month Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-success  bg-success-subtle fs-10">Completed</div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h5 class="text-muted mt-0 mb-1 fs-13">PERKI</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">2020</a>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="text-center mb-4 me-3">
                                                <img src="{{ URL::asset('build/images/companies/img-1.png') }}" alt="" width="30px" height="30px" class="">
                                            </div>
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Workshop EKG Lanjut</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">3 Month Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-success  bg-success-subtle fs-10">Completed</div>
                                            </div>
                                        </div>
                                        <div class="col mt-3">
                                            <h5 class="text-muted mt-0 mb-1 fs-13">IDI Jakarta</h5>
                                            <a href="#" class="text-reset fs-14 mb-0">2021</a>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->

                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <ul class="pagination pagination-separated justify-content-center mb-0">
                                        <li class="page-item disabled">
                                            <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="javascript:void(0);" class="page-link">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end tab-pane-->

            <div class="tab-pane fade" id="projects" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">RS Cipto Mangunkusumo</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">2 year Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                                    J
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-primary bg-primary-subtle fs-10">Tersedia</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->

                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">Klinik Medika Sehat </a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">2 month Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-primary bg-primary-subtle fs-10">Tersedia</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-6">
                                <div class="card profile-project-card shadow-none mt-3">
                                    <div class="card-body p-4">

                                        <div class="d-flex">
                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                <h5 class="fs-14 text-truncate"><a href="#" class="text-body">RS Mitra Keluarga</a></h5>
                                                <p class="text-muted text-truncate mb-0">Last Update : <span class="fw-semibold text-body">1 year Ago</span></p>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="bi bi-three-dots-vertical"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                        <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex mt-3 align-items-center">
                                            <div class="flex-grow-1">
                                                <div class="d-flex align-items-center gap-2">
                                                    <div>
                                                        <h5 class="fs-12 text-muted mb-0">Members :</h5>
                                                    </div>
                                                    <div class="avatar-group">
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                                    M
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>
                                                        <div class="avatar-group-item">
                                                            <div class="avatar-xs">
                                                                <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-info bg-info-subtle fs-10">Praktik Berakhir</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mt-4">
                                    <ul class="pagination pagination-separated justify-content-center mb-0">
                                        <li class="page-item disabled">
                                            <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                        <li class="page-item active">
                                            <a href="javascript:void(0);" class="page-link">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a href="javascript:void(0);" class="page-link"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
@endsection

@section('script')

<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ URL::asset('build/js/pages/profile.init.js')}}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
