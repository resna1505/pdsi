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
                        <img src="{{ URL::asset('storage/images/users/' . Auth::user()->avatar) }}" alt="" class="avatar-lg rounded-circle p-1 mt-n4">
                    </div>
                </div>
                <div class="pt-3">
                    <div class="row justify-content-between gy-4">
                        <div class="col-xl-5 col-lg-5">
                            <h5 class="fs-17">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</h5>
                            <div class="hstack gap-1 mb-3 text-muted">
                                <div class="me-2"><i class="ri-map-pin-user-line me-1 fs-16 align-middle"></i>Kemayoran, Jakarta</div>
                                <div>
                                    <i class="ri-building-line me-1 fs-16 align-middle"></i>Universitas Dummy
                                </div>
                            </div>
                            <p>Dr. SpPD</p>

                            <div class="hstack gap-2">
                                <button type="button" class="btn btn-success custom-toggle" data-bs-toggle="button" aria-pressed="false">
                                    <span class="icon-on"><i class="ri-user-add-line align-bottom me-1"></i> Connect</span>
                                    <span class="icon-off"><i class="ri-check-fill align-bottom me-1"></i> Unconnect</span>
                                </button>
                                <button type="button" class="btn btn-soft-secondary btn-icon"><i class="bi bi-chat-left-text"></i></button>
                                <div class="dropdown">
                                    <button class="btn btn-soft-danger btn-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Konsultasi</a></li>
                                        <li><a class="dropdown-item" href="#">Forum Diskusi Medis</a></li>
                                        <li><a class="dropdown-item" href="#">Update Ilmiah & Seminar</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-5">
                            <div>
                                <p class="text-muted fw-medium mb-2">place of practice</p>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item">
                                        <span class="badge text-info bg-info-subtle">Rumah Sakit Cipto Mangunkusumo (RSCM)</span>
                                    </li>
                                    <li class="list-inline-item">
                                        <span class="badge text-info bg-info-subtle">Klinik Medika Sehat</span>
                                    </li>
                                </ul>
                            </div>

                            <div>
                                <p class="text-muted fw-medium mb-2">Professional Certification</p>
                                <ul class="d-flex gap-2 flex-wrap list-unstyled mb-0">
                                    <li>
                                        <span class="badge text-body-emphasis  bg-dark-subtle">Sertifikasi USG Dasar</span>
                                    </li>
                                    <li>
                                        <span class="badge text-body-emphasis  bg-dark-subtle">Hiperkes & Keselamatan Kerja</span>
                                    </li>
                                    <li>
                                        <span class="badge text-body-emphasis  bg-dark-subtle">Sertifikasi Dokter Pemeriksa Kesehatan Kerja</span>
                                    </li>
                                    {{-- <li>
                                        <span class="badge text-body-emphasis  bg-dark-subtle">Estetika Medik Profesional</span>
                                    </li> --}}
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
                            <li class="nav-item">
                                <a class="nav-link fs-14" data-bs-toggle="tab" href="#friends" role="tab">
                                    <i class="ri-folder-4-line d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Friends</span>
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
                        <a href="pages-profile-settings" class="btn btn-secondary"><i class="ri-edit-box-line align-bottom"></i> Edit Profile</a>
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
                                                    <img src="{{ URL::asset('storage/images/users/' . Auth::user()->avatar) }}" 
                                                        alt="First slide" 
                                                        style="width: 100%; 
                                                                height: 100%; 
                                                                object-fit: cover;
                                                    ">

                                                    
                                                </div>
                                                <div style="position: absolute; bottom: 100px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    Nama : {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                                                </div>
                                                <div style="position: absolute; bottom: 80px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    Id : {{ Auth::user()->id }}
                                                </div>
                                                <div style="position: absolute; bottom: 60px; left: 0; right: 0; text-align: center; color: white; font-weight: bold;">
                                                    No.Urut Anggota : {{ Auth::user()->id }}
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
                                                        {!! QrCode::size(80)->generate(Auth::user()->name . ' ' . Auth::user()->last_name . ' ' . Auth::user()->id . ' ' . Auth::user()->created_at) !!}
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
                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-dark text-white">
                                                <i class="  ri-twitter-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-primary">
                                                <i class=" ri-facebook-circle-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-success">
                                                <i class=" ri-linkedin-box-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div>
                                        <a href="javascript:void(0);" class="avatar-xs d-block">
                                            <span class="avatar-title rounded-circle fs-16 bg-danger">
                                                <i class="ri-instagram-fill"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-4">Additional Expertise</h5>
                                <div class="d-flex flex-wrap gap-2 fs-15">
                                    <a href="javascript:void(0);" class="badge text-primary  bg-primary-subtle">Manajemen Pasien & Rekam Medis</a>
                                    <a href="javascript:void(0);" class="badge text-primary  bg-primary-subtle">Telemedicine & Konsultasi Online</a>
                                    <a href="javascript:void(0);" class="badge text-primary  bg-primary-subtle">Penelitian Medis</a>
                                    <a href="javascript:void(0);" class="badge text-primary  bg-primary-subtle">Pendidikan & Pelatihan Kedokteran</a>
                                    <a href="javascript:void(0);" class="badge text-primary  bg-primary-subtle">Kesehatan Masyarakat</a>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-0">Suggestions</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown">
                                            <a href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-more-2-fill fs-14"></i>
                                            </a>

                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                <li><a class="dropdown-item" href="#">View</a></li>
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <li><a class="dropdown-item" href="#">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center py-3">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="fs-14 mb-1">Esther James</h5>
                                                <p class="fs-13 text-muted mb-0">Frontend Developer</p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <button type="button" class="btn btn-sm btn-outline-success"><i class="ri-user-add-line align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center py-3">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="fs-14 mb-1">Jacqueline Steve</h5>
                                                <p class="fs-13 text-muted mb-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <button type="button" class="btn btn-sm btn-outline-success"><i class="ri-user-add-line align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center py-3">
                                        <div class="avatar-xs flex-shrink-0 me-3">
                                            <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">
                                            <div>
                                                <h5 class="fs-14 mb-1">George Whalen</h5>
                                                <p class="fs-13 text-muted mb-0">Backend Developer</p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 ms-2">
                                            <button type="button" class="btn btn-sm btn-outline-success"><i class="ri-user-add-line align-middle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                        <!--end card-->
                    </div>
                    <!--end col-->
                    <div class="col-xxl-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">About</h5>
                                <p>Halo, saya dr. resna pangestu. Saya adalah seorang dokter yang berdedikasi dalam memberikan pelayanan kesehatan terbaik bagi pasien. Saya percaya bahwa pendekatan yang empatik dan berbasis ilmu pengetahuan merupakan kunci utama dalam proses penyembuhan.</p>

                                <p>Sebagai tenaga medis, saya memiliki pengalaman dalam mendiagnosis, merawat, serta memberikan edukasi kesehatan kepada masyarakat. Saya aktif mengikuti perkembangan ilmu kedokteran terkini dan senantiasa meningkatkan kompetensi melalui pelatihan dan seminar medis.</p>
                                    
                                <p>Bagi saya, kesehatan pasien adalah prioritas utama. Saya berkomitmen untuk memberikan pelayanan yang profesional, manusiawi, dan beretika.</p>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-person-bounding-box"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-1">Designation :</p>
                                                <h6 class="text-truncate mb-0">Spesialis Penyakit Dalam (Internis)</h6>
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
                                                <a href="#" class="fw-semibold text-body">www.pdsionline.org/resnapangestu</a>
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
                                                <h6 class="text-truncate mb-0">+(628) 123 456 789</h6>
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
                                                <h6 class="text-truncate mb-0">resnapangestu01@gmail.com</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-geo-alt"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-2">Location :</p>
                                                <h6 class="text-truncate mb-0">Kemayoran, Jakarta</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0 avatar-sm align-self-center me-3">
                                                <div class="avatar-title border border-dashed rounded-circle fs-16 text-primary bg-transparent">
                                                    <i class="bi bi-calendar-check"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <p class="mb-2">Joining Date :</p>
                                                <h6 class="text-truncate mb-0">16 Aug 2023</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!-- end card -->

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-0">Connections</h5>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <a href="#" role="button" id="dropdownMenuLink2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-2-fill fs-14"></i>
                                                </a>

                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink2">
                                                    <li><a class="dropdown-item" href="#">View</a></li>
                                                    <li><a class="dropdown-item" href="#">Edit</a></li>
                                                    <li><a class="dropdown-item" href="#">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <div class="d-flex align-items-center pb-3">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="fs-14 mb-1">Esther James</h5>
                                                        <p class="fs-13 text-muted mb-0">475 Connections</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <button type="button" class="btn btn-sm btn-outline-info custom-toggle active" data-bs-toggle="button" aria-pressed="true">
                                                        <span class="icon-on"><i class="ri-user-follow-line align-bottom me-1"></i> Follow</span>
                                                        <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Unfollow</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center py-3">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="fs-14 mb-1">Jacqueline Steve</h5>
                                                        <p class="fs-13 text-muted mb-0">UI/UX Designer</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <button type="button" class="btn btn-sm btn-outline-info custom-toggle" data-bs-toggle="button" aria-pressed="true">
                                                        <span class="icon-on"><i class="ri-user-follow-line align-bottom me-1"></i> Follow</span>
                                                        <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Unfollow</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center py-3">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="fs-14 mb-1">George Whalen</h5>
                                                        <p class="fs-13 text-muted mb-0">Backend Developer</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <button type="button" class="btn btn-sm btn-outline-info custom-toggle" data-bs-toggle="button" aria-pressed="true">
                                                        <span class="icon-on"><i class="ri-user-follow-line align-bottom me-1"></i> Follow</span>
                                                        <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Unfollow</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center py-3">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="fs-14 mb-1">George Whalen</h5>
                                                        <p class="fs-13 text-muted mb-0">Backend Developer</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <button type="button" class="btn btn-sm btn-outline-info custom-toggle" data-bs-toggle="button" aria-pressed="true">
                                                        <span class="icon-on"><i class="ri-user-follow-line align-bottom me-1"></i> Follow</span>
                                                        <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Unfollow</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center py-3">
                                                <div class="avatar-xs flex-shrink-0 me-3">
                                                    <img src="{{ URL::asset('build/images/users/avatar-9.jpg') }}" alt="" class="img-fluid rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div>
                                                        <h5 class="fs-14 mb-1">George Whalen</h5>
                                                        <p class="fs-13 text-muted mb-0">Backend Developer</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 ms-2">
                                                    <button type="button" class="btn btn-sm btn-outline-info custom-toggle" data-bs-toggle="button" aria-pressed="true">
                                                        <span class="icon-on"><i class="ri-user-follow-line align-bottom me-1"></i> Follow</span>
                                                        <span class="icon-off"><i class="ri-user-unfollow-line align-bottom me-1"></i> Unfollow</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card body -->
                                    <div class="card-footer text-center">
                                        <a href="#!" class="link-secondar">View All Connections <i class="bi bi-arrow-right"></i></a>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-lg-6">
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
                                                {{-- <li>
                                                    <h6 class="fs-14">Adding a new event with attachments</h6>
                                                    <p class="mb-3">30 days ago</p>
                                                    <div class="row g-3">
                                                        <div class="col-auto">
                                                            <div class="d-flex position-relative gap-2 border border-dashed p-2 rounded-3">
                                                                <div class="flex-shrink-0">
                                                                    <i class="bi bi-file-earmark-image fs-17 text-danger"></i>
                                                                </div>
                                                                <div class="flex-grow-1 ms-2">
                                                                    <a href="javascript:void(0);" class="stretched-link">
                                                                        <h6 class="mb-1 fs-12">UI/UX design</h6>
                                                                    </a>
                                                                    <small class="text-muted">685 KB</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="d-flex position-relative gap-2 border border-dashed p-2 rounded-3">
                                                                <div class="flex-shrink-0">
                                                                    <i class="bi bi-file-pdf fs-17 text-info"></i>
                                                                </div>
                                                                <div class="flex-grow-1 ms-2">
                                                                    <a href="javascript:void(0);" class="stretched-link">
                                                                        <h6 class="mb-1 fs-12">PDSI Invoice</h6>
                                                                    </a>
                                                                    <small class="text-muted">342 KB</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h6 class="fs-14">Templates layout upload</h6>
                                                    <p class="mb-3">1 week ago</p>
                                                    <p class="text-muted fst-italic">
                                                        Powerful, clean & modern responsive bootstrap 5 admin template. The maximum file size for uploads in this demo :
                                                    </p>
                                                    <div class="row mt-2">
                                                        <div class="col-xxl-10">
                                                            <div class="row border border-dashed gx-2 p-2">
                                                                <div class="col-3">
                                                                    <img src="{{ URL::asset('build/images/small/img-3.jpg') }}" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-3">
                                                                    <img src="{{ URL::asset('build/images/small/img-5.jpg') }}" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-3">
                                                                    <img src="{{ URL::asset('build/images/small/img-7.jpg') }}" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                                <div class="col-3">
                                                                    <img src="{{ URL::asset('build/images/small/img-9.jpg') }}" alt="" class="img-fluid rounded">
                                                                </div>
                                                                <!--end col-->
                                                            </div>
                                                            <!--end row-->
                                                        </div>
                                                    </div>
                                                </li> --}}
                                                {{-- <li>
                                                    <div class="time">01:30 PM</div>
                                                    <p>Lunch time after which sleep just doesn't want to let go of me. 🤝</p>
                                                </li>
                                                <li>
                                                    <div class="time">3:30 PM</div>
                                                    <p>Drink the magical chai, it will ward off sleep they said. 🤷‍</p>
                                                </li>
                                                <li>
                                                    <div class="time">4:30 PM </div>
                                                    <p>The only time I don't feel sleepy cause it's work out time. I mean walking time. 😹</p>
                                                </li>
                                                <li>
                                                    <div class="time">07:00 PM </div>
                                                    <p>Food my tummy needs, sleep my body needs.👿</p>
                                                </li>
                                                <li>
                                                    <div class="time">07:30 PM </div>
                                                    <p>My tummy's happy time 🍝</p>
                                                </li>
                                                <li>
                                                    <div class="time">10:00 PM </div>
                                                    <p>uh oh!!! fuel low, get some snacks but wait should I just take a quick nap?🤓 </p>
                                                </li>
                                                <li>
                                                    <div class="time">2:30 PM </div>
                                                    <p>All hail! The time to sleep has finally arrived.😴😴😴😴😴 </p>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--end card-->
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <div class="tab-pane fade" id="activities" role="tabpanel">
                <div class="card">
                    <div class="card-body px-0">
                        <h5 class="card-title mb-4 px-3">Biodata</h5>
                        {{-- <div data-simplebar style="max-height: 405px;" class="p-3 pt-0">
                            <ul class="acitivity-timeline-2 list-unstyled mb-0">
                                <li>
                                    <h6 class="fs-14">Purchase by James Price</h6>
                                    <p>09:24 PM</p>
                                    <p class="mb-0">Product noise evolve smartwatch</p>
                                </li>
                                <li>
                                    <h6 class="fs-14">New ticket received <span class="badge text-bg-info align-middle ms-1">New</span></h6>
                                    <p class="mb-3">4 days ago</p>
                                    <p class="text-muted mb-0">User <span class="text-secondary">Erica245</span> submitted a ticket</p>
                                </li>
                                <li>
                                    <h6 class="fs-14">Adding a new event with attachments</h6>
                                    <p class="mb-3">30 days ago</p>
                                    <div class="border border-dashed p-2 rounded-3">
                                        <div class="row g-3">
                                            <div class="col-auto">
                                                <div class="d-flex position-relative gap-2">
                                                    <div class="flex-shrink-0">
                                                        <i class="bi bi-file-earmark-image fs-17 text-danger"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="javascript:void(0);" class="stretched-link">
                                                            <h6>UI/UX design</h6>
                                                        </a>
                                                        <small>685 KB</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="d-flex position-relative gap-2">
                                                    <div class="flex-shrink-0">
                                                        <i class="bi bi-file-pdf fs-17 text-info"></i>
                                                    </div>
                                                    <div class="flex-grow-1 ms-2">
                                                        <a href="javascript:void(0);" class="stretched-link">
                                                            <h6>PDSI Invoice</h6>
                                                        </a>
                                                        <small>342 KB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <h6 class="fs-14">Templates layout upload</h6>
                                    <p class="mb-3">1 week ago</p>
                                    <p class="text-muted fst-italic">
                                        Powerful, clean & modern responsive bootstrap 5 admin template. The maximum file size for uploads in this demo :
                                    </p>
                                    <div class="row mt-2">
                                        <div class="col-xxl-10">
                                            <div class="row border border-dashed gx-2 p-2">
                                                <div class="col-3">
                                                    <img src="{{ URL::asset('build/images/small/img-3.jpg') }}" alt="" class="img-fluid rounded">
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <img src="{{ URL::asset('build/images/small/img-5.jpg') }}" alt="" class="img-fluid rounded">
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <img src="{{ URL::asset('build/images/small/img-7.jpg') }}" alt="" class="img-fluid rounded">
                                                </div>
                                                <!--end col-->
                                                <div class="col-3">
                                                    <img src="{{ URL::asset('build/images/small/img-9.jpg') }}" alt="" class="img-fluid rounded">
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="time">01:30 PM</div>
                                    <p>Lunch time after which sleep just doesn't want to let go of me. 🤝</p>
                                </li>
                                <li>
                                    <div class="time">3:30 PM</div>
                                    <p>Drink the magical chai, it will ward off sleep they said. 🤷‍</p>
                                </li>
                                <li>
                                    <div class="time">4:30 PM </div>
                                    <p>The only time I don't feel sleepy cause it's work out time. I mean walking time. 😹</p>
                                </li>
                                <li>
                                    <div class="time">07:00 PM </div>
                                    <p>Food my tummy needs, sleep my body needs.👿</p>
                                </li>
                                <li>
                                    <div class="time">07:30 PM </div>
                                    <p>My tummy's happy time 🍝</p>
                                </li>
                                <li>
                                    <div class="time">10:00 PM </div>
                                    <p>uh oh!!! fuel low, get some snacks but wait should I just take a quick nap?🤓 </p>
                                </li>
                                <li>
                                    <div class="time">2:30 PM </div>
                                    <p>All hail! The time to sleep has finally arrived.😴😴😴😴😴 </p>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
                <!--end card-->

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

                                        {{-- <div class="mt-3">
                                            <div class="flex-shrink-0 ms-2">
                                                <div class="badge text-primary bg-primary-subtle fs-10">Tersedia</div>
                                            </div>
                                        </div> --}}
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

            <div class="tab-pane fade" id="friends" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="card-title flex-grow-1 mb-0">Friends</h5>
                        </div>
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown position-absolute end-0 pe-3"> <a class="fs-18" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-2-fill align-baseline"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                        <div class="text-center mb-4">
                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="avatar-md rounded-3" />
                                        </div>
                                        <div class="text-center">
                                            <a href="#member-overview" data-bs-toggle="offcanvas">
                                                <h5 class="fs-17">Dr. Andi Pratama, Sp.PD</h5>
                                            </a>
                                            <span class="badge text-secondary bg-secondary-subtle">Spesialis Penyakit Dalam</span>
                                        </div>
                                        <div class="mt-2 text-center pt-4 hstack gap-2 justify-content-center">
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-info-subtle text-info"><i class="ri-facebook-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-success-subtle text-success"><i class="ri-twitter-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-danger-subtle text-danger"><i class="ri-linkedin-fill align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body hstack gap-2 border-top">
                                        <button class="btn btn-soft-info w-100">Message</button>
                                        <button class="btn btn-soft-primary w-100">Overview</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown position-absolute end-0 pe-3"> <a class="fs-18" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-2-fill align-baseline"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                        <div class="text-center mb-4">
                                            <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="avatar-md rounded-3" />
                                        </div>
                                        <div class="text-center">
                                            <a href="#member-overview" data-bs-toggle="offcanvas">
                                                <h5 class="fs-17">Dr. Jordan Villareal SpB</h5>
                                            </a>
                                            <span class="badge text-secondary bg-secondary-subtle">Spesialis Bedah</span>
                                        </div>
                                        <div class="mt-2 text-center pt-4 hstack gap-2 justify-content-center">
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-info-subtle text-info"><i class="ri-facebook-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-success-subtle text-success"><i class="ri-twitter-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-danger-subtle text-danger"><i class="ri-linkedin-fill align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body hstack gap-2 border-top">
                                        <button class="btn btn-soft-info w-100">Message</button>
                                        <button class="btn btn-soft-primary w-100">Overview</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown position-absolute end-0 pe-3"> <a class="fs-18" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-2-fill align-baseline"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                        <div class="text-center mb-4">
                                            <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="avatar-md rounded-3" />
                                        </div>
                                        <div class="text-center">
                                            <a href="#member-overview" data-bs-toggle="offcanvas">
                                                <h5 class="fs-17">Dr. Damon Boxter SpA</h5>
                                            </a>
                                            <span class="badge text-secondary bg-secondary-subtle">Spesialis Anak</span>
                                        </div>
                                        <div class="mt-2 text-center pt-4 hstack gap-2 justify-content-center">
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-info-subtle text-info"><i class="ri-facebook-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-success-subtle text-success"><i class="ri-twitter-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-danger-subtle text-danger"><i class="ri-linkedin-fill align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body hstack gap-2 border-top">
                                        <button class="btn btn-soft-info w-100">Message</button>
                                        <button class="btn btn-soft-primary w-100">Overview</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="dropdown position-absolute end-0 pe-3"> <a class="fs-18" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-2-fill align-baseline"></i> </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                        <div class="text-center mb-4">
                                            <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="avatar-md rounded-3" />
                                        </div>
                                        <div class="text-center">
                                            <a href="#member-overview" data-bs-toggle="offcanvas">
                                                <h5 class="fs-17">Dr. Bryant Diaz SpOG</h5>
                                            </a>
                                            <span class="badge text-secondary bg-secondary-subtle">Spesialis Kandungan & Kebidanan</span>
                                        </div>
                                        <div class="mt-2 text-center pt-4 hstack gap-2 justify-content-center">
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-info-subtle text-info"><i class="ri-facebook-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-success-subtle text-success"><i class="ri-twitter-fill align-middle"></i></a>
                                            </div>
                                            <div class="avatar-xs">
                                                <a href="#" class="avatar-title rounded-circle bg-danger-subtle text-danger"><i class="ri-linkedin-fill align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body hstack gap-2 border-top">
                                        <button class="btn btn-soft-info w-100">Message</button>
                                        <button class="btn btn-soft-primary w-100">Overview</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end tab-pane-->

            <div class="tab-pane fade" id="documents" role="tabpanel">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <h5 class="card-title flex-grow-1 mb-0">Documents</h5>
                            <div class="flex-shrink-0">
                                <input class="form-control d-none" type="file" id="formFile">
                                <label for="formFile" class="btn btn-danger"><i class="ri-upload-2-fill me-1 align-bottom"></i> Upload File</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-borderless align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <th scope="col">File Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Upload Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-primary rounded fs-20">
                                                                <i class="bi bi-file-earmark-zip-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0)" class="text-body">documents.zip</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Zip File</td>
                                                <td>4.57 MB</td>
                                                <td>12 Dec 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink15" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink15">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-danger rounded fs-20">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="text-body">Ijazah</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PDF File</td>
                                                <td>8.89 MB</td>
                                                <td>24 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-danger rounded fs-20">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="text-body">STR</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PDF File</td>
                                                <td>8.89 MB</td>
                                                <td>24 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-danger rounded fs-20">
                                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="text-body">SIP</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PDF File</td>
                                                <td>8.89 MB</td>
                                                <td>24 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink3" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink3">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-secondary rounded fs-20">
                                                                <i class="bi bi-file-earmark-play"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="text-body">Tour-video.mp4</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>MP4 File</td>
                                                <td>14.62 MB</td>
                                                <td>19 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink4" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink4">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-success rounded fs-20">
                                                                <i class="bi bi-filetype-exe"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0"><a href="javascript:void(0);" class="text-body">Account-statement.xsl</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>XSL File</td>
                                                <td>2.38 KB</td>
                                                <td>14 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink5" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink5">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            <li class="dropdown-divider"></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle text-muted"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr> --}}
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-info rounded fs-20">
                                                                <i class="bi bi-folder"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0">
                                                                <a href="javascript:void(0);" class="text-body">Project Screenshots Collection</a></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Floder File</td>
                                                <td>87.24 MB</td>
                                                <td>08 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink6" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink6">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                                    </div>
                                                </th>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-sm">
                                                            <div class="avatar-title bg-transparent text-danger rounded fs-20">
                                                                <i class="bi bi-images"></i>
                                                            </div>
                                                        </div>
                                                        <div class="ms-3 flex-grow-1">
                                                            <h6 class="fs-15 mb-0">
                                                                <a href="javascript:void(0);" class="text-body">Photo.png</a>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>PNG File</td>
                                                <td>879 KB</td>
                                                <td>02 Nov 2022</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink7" data-bs-toggle="dropdown" aria-expanded="true">
                                                            <i class="bi bi-sliders2"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink7">
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-middle"></i>View</a></li>
                                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-download-2-fill me-2 align-middle"></i>Download</a></li>
                                                            <li>
                                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-5-line me-2 align-middle"></i>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
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
            <!--end tab-pane-->
        </div>
        <!--end tab-content-->
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection

@section('script')

<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{ URL::asset('build/js/pages/profile.init.js')}}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
