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
                            <a class="nav-link" data-bs-toggle="tab" id="edukasi-tab" href="#edukasi" role="tab" aria-selected="true">
                                Tips & Edukasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#infografis" role="tab" aria-selected="false">
                                Infografis Kesehatan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#wawancara" role="tab" aria-selected="false">
                                Wawancara Tokoh Medis
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#opini" role="tab" aria-selected="false">
                                Opini / Editorial
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
                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/eJV7Dqu6DMU" title="YouTube video" allowfullscreen class="rounded"></iframe>

                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Cegah Diabetes Sejak Dini dengan Gaya Hidup Sehat</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Diabetes tipe 2 bukan hanya penyakit orang tua — anak muda pun kini rentan. Artikel ini membahas bagaimana perubahan kecil seperti mengganti nasi putih dengan karbohidrat kompleks, membatasi konsumsi minuman manis, hingga menyempatkan olahraga ringan 30 menit setiap hari bisa menurunkan risiko diabetes secara signifikan.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            dr. Dinda Sari, Sp.PD
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
                                            </ul>
                                        </div>
                                        <div class="col text-end dropdown">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class=" ri-more-2-fill fs-17"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item edit-list" href="#editmemberModal" data-bs-toggle="modal" data-edit-id="12"><i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit</a></li>
                                                <li><a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="12"><i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/-qmelRdFtmk" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Cara Sederhana Menjaga Kesehatan Mental di Tempat Kerja</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Rasa cemas, kelelahan, dan burnout menjadi hal lumrah di lingkungan kerja modern. Tapi itu bukan berarti harus diabaikan. Artikel ini memberikan tips praktis untuk mengelola stres harian—mulai dari teknik pernapasan 4-7-8, manajemen waktu yang efektif, hingga pentingnya membuka komunikasi sehat dengan atasan.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            dr. Fikri Ramadhan
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/UGEUqLnwk4I" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Mengenal Gejala Awal Kanker Payudara yang Sering Diabaikan</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Banyak wanita mengira benjolan kecil di payudara adalah hal biasa, padahal bisa menjadi tanda awal kanker. Artikel ini menjelaskan gejala awal kanker payudara yang sering diabaikan, pentingnya pemeriksaan payudara sendiri (SADARI), serta kapan waktu yang tepat untuk berkonsultasi ke dokter.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            dr. Ratna Wulandari, Sp.B-Onk
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/eJV7Dqu6DMU" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Panduan Visual Konsumsi Gizi Seimbang untuk Anak Sekolah</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Infografis ini menyajikan porsi makan sehat harian untuk anak usia sekolah. Disusun berdasarkan pedoman gizi seimbang Kemenkes, konten ini mempermudah orang tua menyusun menu harian yang mencakup karbohidrat, protein, sayur, buah, dan susu. Dilengkapi ikon lucu dan warna menarik agar anak juga tertarik belajar.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Tim Infografis PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/-qmelRdFtmk" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Tahapan Perkembangan Bayi 0–12 Bulan</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Setiap bulan perkembangan bayi membawa keajaiban baru. Infografis ini merinci milestone perkembangan motorik, kognitif, dan bahasa dari usia 0 hingga 12 bulan. Disertai panduan stimulasi sederhana yang bisa dilakukan di rumah dan peringatan jika ada tanda keterlambatan.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Redaksi Visual PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/UGEUqLnwk4I" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">5 Penyakit Menular yang Dapat Dicegah dengan Vaksinasi</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Vaksin bukan hanya untuk anak-anak. Infografis ini menjelaskan lima penyakit menular yang dapat dicegah vaksin—TBC, Polio, Hepatitis B, Campak, dan DPT—dengan visual yang mudah dipahami oleh publik umum. Edukasi ini penting untuk meningkatkan cakupan imunisasi dasar lengkap.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Divisi Edukasi Visual
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/UGEUqLnwk4I" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Teknologi MRI 7 Tesla adalah Lompatan Besar” — Prof. dr. Herman</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Dalam wawancara ini, Prof. Herman menjelaskan bagaimana MRI 7 Tesla mampu menghasilkan citra otak dan organ dalam dengan resolusi luar biasa. Ia juga berbicara soal tantangan penerapan teknologi ini di rumah sakit daerah dan harapannya agar pemerataan layanan diagnostik jadi prioritas nasional.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Tim Wawancara Medis
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">dr. Tiara: Tantangan Menjadi Dokter di Daerah Terpencil</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">dr. Tiara, lulusan kedokteran yang kini bertugas di pedalaman Papua, membagikan kisahnya membangun kepercayaan dengan warga adat, menghadapi keterbatasan fasilitas, dan bagaimana satu tas medis bisa menyelamatkan nyawa dalam perjalanan lintas hutan berjam-jam.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Wawancara Eksklusif PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">“Skrining Kanker Itu Investasi Kesehatan” — dr. Alif, Onkolog</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Menurut dr. Alif, masyarakat masih menganggap skrining kanker hanya untuk yang sudah sakit. Ia menjelaskan perbedaan deteksi dini dan diagnosis, serta mengapa pemeriksaan seperti Pap Smear dan USG payudara bisa menyelamatkan ribuan nyawa setiap tahun.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Wawancara Redaksi
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Ketika Data Pasien Menjadi Komoditas: Di Mana Etika Medis?</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Di era digital, rekam medis pasien kini disimpan dalam sistem elektronik—tapi bagaimana jika datanya disalahgunakan oleh pihak ketiga? Editorial ini membahas urgensi regulasi privasi medis yang ketat dan bagaimana dokter serta rumah sakit seharusnya menjadi pelindung utama data pasien.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Redaksi PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Mengapa Literasi Kesehatan Masyarakat Masih Rendah</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Banyak istilah medis masih sulit dipahami masyarakat awam. Dalam opini ini, dr. Yanuar mengulas perlunya pendekatan humanis dalam komunikasi dokter-pasien dan bagaimana penggunaan bahasa sederhana bisa menjadi alat pencegahan penyakit paling kuat.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Wawancara Eksklusif PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Perlukah Indonesia Punya “Medical Fact Checker”?</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Di tengah gelombang hoaks kesehatan yang meresahkan, artikel ini mengusulkan pembentukan lembaga verifikasi medis independen untuk memerangi misinformasi. Bisa jadi kolaborasi antara dokter, jurnalis, dan akademisi.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Tim Editorial
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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

                            <!--end col-->
                            <div class="d-flex align-items-center border-top pt-3">
                                <div class="flex-grow-1">
                                    <div class="text-muted pagination-info mb-2"></div>
                                </div>
                                <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="edukasi" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Cegah Diabetes Sejak Dini dengan Gaya Hidup Sehat</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Diabetes tipe 2 bukan hanya penyakit orang tua — anak muda pun kini rentan. Artikel ini membahas bagaimana perubahan kecil seperti mengganti nasi putih dengan karbohidrat kompleks, membatasi konsumsi minuman manis, hingga menyempatkan olahraga ringan 30 menit setiap hari bisa menurunkan risiko diabetes secara signifikan.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            dr. Dinda Sari, Sp.PD
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Cara Sederhana Menjaga Kesehatan Mental di Tempat Kerja</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Rasa cemas, kelelahan, dan burnout menjadi hal lumrah di lingkungan kerja modern. Tapi itu bukan berarti harus diabaikan. Artikel ini memberikan tips praktis untuk mengelola stres harian—mulai dari teknik pernapasan 4-7-8, manajemen waktu yang efektif, hingga pentingnya membuka komunikasi sehat dengan atasan.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            dr. Fikri Ramadhan
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Mengenal Gejala Awal Kanker Payudara yang Sering Diabaikan</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Banyak wanita mengira benjolan kecil di payudara adalah hal biasa, padahal bisa menjadi tanda awal kanker. Artikel ini menjelaskan gejala awal kanker payudara yang sering diabaikan, pentingnya pemeriksaan payudara sendiri (SADARI), serta kapan waktu yang tepat untuk berkonsultasi ke dokter.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            dr. Ratna Wulandari, Sp.B-Onk
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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
                    <div class="tab-pane" id="infografis" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Panduan Visual Konsumsi Gizi Seimbang untuk Anak Sekolah</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Infografis ini menyajikan porsi makan sehat harian untuk anak usia sekolah. Disusun berdasarkan pedoman gizi seimbang Kemenkes, konten ini mempermudah orang tua menyusun menu harian yang mencakup karbohidrat, protein, sayur, buah, dan susu. Dilengkapi ikon lucu dan warna menarik agar anak juga tertarik belajar.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Tim Infografis PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Tahapan Perkembangan Bayi 0–12 Bulan</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Setiap bulan perkembangan bayi membawa keajaiban baru. Infografis ini merinci milestone perkembangan motorik, kognitif, dan bahasa dari usia 0 hingga 12 bulan. Disertai panduan stimulasi sederhana yang bisa dilakukan di rumah dan peringatan jika ada tanda keterlambatan.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Redaksi Visual PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">5 Penyakit Menular yang Dapat Dicegah dengan Vaksinasi</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Vaksin bukan hanya untuk anak-anak. Infografis ini menjelaskan lima penyakit menular yang dapat dicegah vaksin—TBC, Polio, Hepatitis B, Campak, dan DPT—dengan visual yang mudah dipahami oleh publik umum. Edukasi ini penting untuk meningkatkan cakupan imunisasi dasar lengkap.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Divisi Edukasi Visual
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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
                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Teknologi MRI 7 Tesla adalah Lompatan Besar” — Prof. dr. Herman</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Dalam wawancara ini, Prof. Herman menjelaskan bagaimana MRI 7 Tesla mampu menghasilkan citra otak dan organ dalam dengan resolusi luar biasa. Ia juga berbicara soal tantangan penerapan teknologi ini di rumah sakit daerah dan harapannya agar pemerataan layanan diagnostik jadi prioritas nasional.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Tim Wawancara Medis
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">dr. Tiara: Tantangan Menjadi Dokter di Daerah Terpencil</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">dr. Tiara, lulusan kedokteran yang kini bertugas di pedalaman Papua, membagikan kisahnya membangun kepercayaan dengan warga adat, menghadapi keterbatasan fasilitas, dan bagaimana satu tas medis bisa menyelamatkan nyawa dalam perjalanan lintas hutan berjam-jam.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Wawancara Eksklusif PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">“Skrining Kanker Itu Investasi Kesehatan” — dr. Alif, Onkolog</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Menurut dr. Alif, masyarakat masih menganggap skrining kanker hanya untuk yang sudah sakit. Ia menjelaskan perbedaan deteksi dini dan diagnosis, serta mengapa pemeriksaan seperti Pap Smear dan USG payudara bisa menyelamatkan ribuan nyawa setiap tahun.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Wawancara Redaksi
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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
                    <div class="tab-pane" id="opini" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Ketika Data Pasien Menjadi Komoditas: Di Mana Etika Medis?</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Di era digital, rekam medis pasien kini disimpan dalam sistem elektronik—tapi bagaimana jika datanya disalahgunakan oleh pihak ketiga? Editorial ini membahas urgensi regulasi privasi medis yang ketat dan bagaimana dokter serta rumah sakit seharusnya menjadi pelindung utama data pasien.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Redaksi PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 1 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Mengapa Literasi Kesehatan Masyarakat Masih Rendah</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Banyak istilah medis masih sulit dipahami masyarakat awam. Dalam opini ini, dr. Yanuar mengulas perlunya pendekatan humanis dalam komunikasi dokter-pasien dan bagaimana penggunaan bahasa sederhana bisa menjadi alat pencegahan penyakit paling kuat.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Wawancara Eksklusif PDSI
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 2 Month ago</li>
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
                                <!--end list-element-->

                                <div class="list-element">
                                    <div class="d-flex flex-column flex-sm-row mb-5">
                                        <div class="flex-shrink-0">
                                            <iframe src="https://www.youtube.com/embed/GfSZtaoc5bw" title="YouTube video" allowfullscreen class="rounded"></iframe>
                                        </div>
                                        <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                            <div class="position-relative">
                                                <a href="javascript:void(0);" class="stretched-link">
                                                    <h5 class="mb-3">Perlukah Indonesia Punya “Medical Fact Checker”?</h5>
                                                </a>
                                            </div>
                                            <p class="text-muted mb-2">Di tengah gelombang hoaks kesehatan yang meresahkan, artikel ini mengusulkan pembentukan lembaga verifikasi medis independen untuk memerangi misinformasi. Bisa jadi kolaborasi antara dokter, jurnalis, dan akademisi.</p>
                                            <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                <li>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <i class=" ri-user-line"></i>
                                                        </div>
                                                        <div class="flex-grow-1 fs-13 ms-1">
                                                            Tim Editorial
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ph-clock-bold align-middle"></i> 3 Month ago</li>
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
            const items = container?.querySelectorAll(".list-element") || [];
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
                    const items = videoList?.querySelectorAll(".list-element") || [];

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