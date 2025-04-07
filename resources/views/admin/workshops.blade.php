@extends('layouts.master')
@section('title')
@lang('translation.search-results')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light pb-0 border-0">
                <div class="row justify-content-between">
                    <div class="col-md-5">
                        <div class="d-flex align-items-center gap-3">
                            <div class="position-relative flex-grow-1">
                                <input type="text" class="form-control border-0" id="searchInput" placeholder="Search here..">
                                <a class="btn btn-link link-secondary position-absolute end-0 top-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><i class="ri-mic-fill"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-info addMembers-modal" data-bs-toggle="modal" data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add News</button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <ul class="nav nav-tabs nav-tabs-custom nav-secondary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#all" role="tab" aria-selected="false">
                                All Results
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" id="klinis-tab" href="#klinis" role="tab" aria-selected="true">
                                Kategori Klinis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#fasilitas" role="tab" aria-selected="false">
                                Fasilitas Medis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#wawancara" role="tab" aria-selected="false">
                                Umum
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="all" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-1.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Neurologi</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Update Terbaru Penanganan Stroke</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end list-element-->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-2.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Penyakit Dalam</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Manajemen Diabetes Melitus Terkini</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 1 month ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-3.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Fasilitas Medis</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Optimalisasi Pelayanan Gawat Darurat di Rumah Sakit</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 2 month ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-4.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Fasilitas Medis</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Integrasi Laboratorium dan Klinik dalam Diagnosis Penyakit</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-5.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Umum</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Evidence-Based Medicine dalam Praktik Sehari-hari</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-6.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Umum</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Etika dan Profesionalisme Dokter di Era Digital</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--end col-->
                            <div class="d-flex align-items-center border-top pt-3">
                                <div class="flex-grow-1">
                                    <div class="text-muted pagination-info mb-2"></div>
                                </div>
                                <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="klinis" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-1.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Neurologi</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Update Terbaru Penanganan Stroke</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end list-element-->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-2.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Penyakit Dalam</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Manajemen Diabetes Melitus Terkini</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 1 month ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="d-flex align-items-center border-top pt-3">
                                <div class="flex-grow-1">
                                    <div class="text-muted pagination-info mb-2"></div>
                                </div>
                                <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                            </div>
                        </div>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="fasilitas" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-3.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Fasilitas Medis</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Optimalisasi Pelayanan Gawat Darurat di Rumah Sakit</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 2 month ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-4.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Fasilitas Medis</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Integrasi Laboratorium dan Klinik dalam Diagnosis Penyakit</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="d-flex align-items-center border-top pt-3">
                                <div class="flex-grow-1">
                                    <div class="text-muted pagination-info mb-2"></div>
                                </div>
                                <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                            </div>
                        </div>
                    </div>
                    <!--end tab-pane-->
                    <div class="tab-pane" id="wawancara" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-5.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Umum</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Evidence-Based Medicine dalam Praktik Sehari-hari</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ URL::asset('build/images/small/img-6.jpg') }}" alt="" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-4 mt-3 mt-sm-0">
                                                <ul class="list-inline mb-2">
                                                    <li class="list-inline-item"><i class="ri-stethoscope-line me-1"></i> Umum</li>
                                                </ul>
                                                <a href="javascript:void(0);">
                                                    <h5 class="mb-3">Etika dan Profesionalisme Dokter di Era Digital</h5>
                                                </a>
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item"><i class="ph-user-bold text-primary align-middle me-1"></i> James Ballard</li>
                                                    <li class="list-inline-item"><i class="ph-clock-bold text-primary align-middle me-1"></i> 5 hrs ago</li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class=" ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                    <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="d-flex align-items-center border-top pt-3">
                                <div class="flex-grow-1">
                                    <div class="text-muted pagination-info mb-2"></div>
                                </div>
                                <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add News</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form autocomplete="off" id="memberlist-form" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" id="memberid-input" class="form-control" value="">
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" value="" id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded-3">
                                            <img src="{{ URL::asset('build/images/users/user-dummy-img.jpg') }}" id="member-img" class="avatar-md rounded-3 h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-4">
                                <label for="teammembersName" class="form-label">Title</label>
                                <input type="text" class="form-control" id="teammembersName" placeholder="Enter name" required>
                                <div class="invalid-feedback">Please Enter a member name.</div>
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">Description</label>
                                <input type="text" class="form-control" id="designation" placeholder="Enter designation" required>
                                <div class="invalid-feedback">Please Enter a designation.</div>
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">User</label>
                                <select class="form-control" data-choices name="choices-single-default" id="choices-single-default">
                                    <option value="">Select Here</option>
                                    <option value="Dr. Dummy 1">Dr. Dummy 1</option>
                                    <option value="Dr. Dummy 2">Dr. Dummy 2</option>
                                    <option value="Dr. Dummy 3">Dr. Dummy 3</option>
                                </select>
                            </div>

                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="addNewMember">Add Member</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>

<div class="modal fade" id="editmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Edit News</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form autocomplete="off" id="memberlist-form" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" id="memberid-input" class="form-control" value="">
                            <div class="text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute top-100 start-100 translate-middle">
                                        <label for="member-image-input" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Member Image">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none" value="" id="member-image-input" type="file" accept="image/png, image/gif, image/jpeg">
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded-3">
                                            <img src="{{ URL::asset('build/images/users/user-dummy-img.jpg') }}" id="member-img" class="avatar-md rounded-3 h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-4">
                                <label for="teammembersName" class="form-label">Title</label>
                                <input type="text" class="form-control" id="teammembersName" placeholder="Enter name" required>
                                <div class="invalid-feedback">Please Enter a member name.</div>
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">Description</label>
                                <input type="text" class="form-control" id="designation" placeholder="Enter designation" required>
                                <div class="invalid-feedback">Please Enter a designation.</div>
                            </div>

                            <div class="mb-3">
                                <label for="designation" class="form-label">User</label>
                                <select class="form-control" data-choices name="choices-single-default" id="choices-single-default">
                                    <option value="">Select Here</option>
                                    <option value="Dr. Dummy 1">Dr. Dummy 1</option>
                                    <option value="Dr. Dummy 2">Dr. Dummy 2</option>
                                    <option value="Dr. Dummy 3">Dr. Dummy 3</option>
                                </select>
                            </div>

                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="addNewMember">Add Member</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--end modal-content-->
    </div>
    <!--end modal-dialog-->
</div>

<div id="removeMemberModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-removeMemberModal"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this member ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn w-sm btn-danger" id="remove-item">Yes, Delete It!</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/search-result.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const itemsPerPage = 5;

        function initPagination(tabPane) {
            const container = tabPane.querySelector(".video-lists");
            const items = container?.querySelectorAll(".card") || [];
            const pagination = tabPane.querySelector(".pagination");
            const paginationInfo = tabPane.querySelector(".pagination-info");
            const totalItems = items.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);
            let currentPage = 1;

            if (!container || !pagination || totalItems === 0 || totalPages <= 1) {
                if (pagination) pagination.innerHTML = "";
                if (paginationInfo) paginationInfo.innerHTML = "";
                return;
            }

            function showPage(page) {
                items.forEach((item, index) => {
                    item.style.display = (index >= (page - 1) * itemsPerPage && index < page * itemsPerPage) ? "block" : "none";
                });

                pagination.querySelectorAll(".page-item.numbered").forEach((li, idx) => {
                    li.classList.toggle("active", idx === page - 1);
                });

                pagination.querySelector(".prev")?.classList.toggle("disabled", page === 1);
                pagination.querySelector(".next")?.classList.toggle("disabled", page === totalPages);

                // Update pagination-info
                if (paginationInfo) {
                    const start = (page - 1) * itemsPerPage + 1;
                    const end = Math.min(page * itemsPerPage, totalItems);
                    paginationInfo.innerHTML = `Showing <span class="fw-semibold">${start}–${end}</span> of <span class="fw-semibold">${totalItems}</span> Results`;
                }
            }

            function buildPagination() {
                pagination.innerHTML = "";

                const prev = document.createElement("li");
                prev.className = "page-item prev disabled";
                prev.innerHTML = `<a href="#" class="page-link"><i class="mdi mdi-chevron-left"></i></a>`;
                prev.addEventListener("click", e => {
                    e.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        showPage(currentPage);
                    }
                });
                pagination.appendChild(prev);

                for (let i = 1; i <= totalPages; i++) {
                    const li = document.createElement("li");
                    li.className = `page-item numbered ${i === 1 ? 'active' : ''}`;
                    li.innerHTML = `<a href="#" class="page-link">${i}</a>`;
                    li.addEventListener("click", e => {
                        e.preventDefault();
                        currentPage = i;
                        showPage(currentPage);
                    });
                    pagination.appendChild(li);
                }

                const next = document.createElement("li");
                next.className = "page-item next" + (totalPages === 1 ? " disabled" : "");
                next.innerHTML = `<a href="#" class="page-link"><i class="mdi mdi-chevron-right"></i></a>`;
                next.addEventListener("click", e => {
                    e.preventDefault();
                    if (currentPage < totalPages) {
                        currentPage++;
                        showPage(currentPage);
                    }
                });
                pagination.appendChild(next);
            }

            buildPagination();
            showPage(currentPage);
        }

        // Init first visible tab
        const activeTabPane = document.querySelector(".tab-pane.active");
        if (activeTabPane) {
            initPagination(activeTabPane);
        }

        // Re-init on tab switch
        const tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
        tabLinks.forEach(link => {
            link.addEventListener("shown.bs.tab", function() {
                const targetId = this.getAttribute("href");
                const targetPane = document.querySelector(targetId);
                if (targetPane) initPagination(targetPane);
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const searchKeyword = document.getElementById("searchKeyword");

        if (searchInput) {
            searchInput.addEventListener("input", function() {
                const keyword = this.value.toLowerCase();
                searchKeyword.textContent = this.value;

                // Loop semua tab-pane yang memiliki .video-lists
                document.querySelectorAll(".tab-pane").forEach(tab => {
                    const videoList = tab.querySelector(".video-lists");
                    const pagination = tab.querySelector(".pagination");
                    const paginationInfo = tab.querySelector(".pagination-info");
                    const items = videoList?.querySelectorAll(".card") || [];

                    let matchedCount = 0;

                    items.forEach(item => {
                        const text = item.textContent.toLowerCase();
                        const match = text.includes(keyword);
                        item.style.display = match ? "block" : "none";
                        if (match) matchedCount++;
                    });

                    // Sembunyikan pagination dan info jika search aktif
                    if (pagination) pagination.style.display = keyword ? "none" : "flex";
                    if (paginationInfo) paginationInfo.style.display = keyword ? "none" : "block";
                });
            });
        }
    });
</script>
@endsection