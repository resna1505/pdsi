@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <!-- Konten Utama -->
    <div class="col-xl-9 col-lg-8"> <!-- Sesuaikan lebar sesuai kebutuhan -->
        <!-- Isi konten utama Anda di sini -->
        <div class="row">
            <!-- Card statistik -->
            <div class="col-xl-4">
                <div class="row">
                    <div class="col-xl-12 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">Total Earnings</p>
                                        <h4 class="fs-22 fw-semibold mb-3">Rp. <span class="counter-value" data-target="12300000">0</span></h4>
                                        <div class="d-flex align-items-center gap-2">
                                            <h5 class="text-success fs-12 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +18.30 %
                                            </h5>
                                            <p class="text-muted mb-0">than last year</p>
                                        </div>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                            <div class="animation-effect-6 text-success opacity-25 fs-18">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="animation-effect-4 text-success opacity-25 fs-18">
                                <i class="bi bi-currency-pound"></i>
                            </div>
                            <div class="animation-effect-3 text-success opacity-25 fs-18">
                                <i class="bi bi-currency-euro"></i>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-12 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                    <div class="text-end flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">Seminar</p>
                                        <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value" data-target="187">0</span></h4>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <h5 class="text-danger fs-12 mb-0">
                                                <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -2.74 %
                                            </h5>
                                            <p class="text-muted mb-0">than last year</p>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                            <div class="animation-effect-6 text-info opacity-25 left fs-18">
                                <i class="bi bi-handbag"></i>
                            </div>
                            <div class="animation-effect-4 text-info opacity-25 left fs-18">
                                <i class="bi bi-shop"></i>
                            </div>
                            <div class="animation-effect-3 text-info opacity-25 left fs-18">
                                <i class="bi bi-bag-check"></i>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-12 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="flex-grow-1">
                                        <p class="text-uppercase fw-medium text-muted text-truncate fs-13">SKP</p>
                                        <h4 class="fs-22 fw-semibold mb-3"><span class="counter-value" data-target="385">0</span></h4>
                                        <div class="d-flex align-items-center gap-2">
                                            <h5 class="text-success fs-12 mb-0">
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                            </h5>
                                            <p class="text-muted mb-0">than last week</p>
                                        </div>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                            <div class="animation-effect-6 text-warning opacity-25 fs-18">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="animation-effect-4 text-warning opacity-25 fs-18">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="animation-effect-3 text-warning opacity-25 fs-18">
                                <i class="bi bi-people"></i>
                            </div>
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header border-0 align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Dokter</h4>
                        <div>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                ALL
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                1M
                            </button>
                            <button type="button" class="btn btn-soft-secondary btn-sm">
                                6M
                            </button>
                            <button type="button" class="btn btn-secondary btn-sm">
                                1Y
                            </button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-header p-0 border-0 bg-light-subtle">
                        <div class="row g-0 text-center">
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="765">0</span></h5>
                                    <p class="text-muted mb-0">Daftar</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="715">0</span></h5>
                                    <p class="text-muted mb-0">Aktif</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0">
                                    <h5 class="mb-1"><span class="counter-value" data-target="50">0</span></h5>
                                    <p class="text-muted mb-0">Non Aktif</p>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-6 col-sm-3">
                                <div class="p-3 border border-dashed border-start-0 border-end-0">
                                    <h5 class="mb-1 text-success"><span class="counter-value" data-target="18.92">0</span>%</h5>
                                    <p class="text-muted mb-0">Conversation Ratio</p>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body p-0 pb-2">
                        <div class="w-100">
                            <div id="customer_impression_charts" data-colors='["--tb-dark", "--tb-primary", "--tb-secondary"]' class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!-- end card body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4">
                <div class="card card-height-100">
                    <div class="card-header border-bottom-dashed align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Statistik</h4>
                        <div>
                            <div class="dropdown">
                                <button class="btn btn-soft-primary btn-sm" href="#" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="text-uppercase">ALL<i
                                            class="mdi mdi-chevron-down align-middle ms-1"></i></span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">DRU</a>
                                    <a class="dropdown-item" href="#">DRG</a>
                                    <a class="dropdown-item" href="#">DRS</a>
                                    <a class="dropdown-item" href="#">DRSS</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end cardheader -->
                    <div class="card-body">
                        <div id="portfolio_donut_charts"
                            data-colors='["--tb-primary", "--tb-info", "--tb-warning", "--tb-success"]' class="apex-charts"
                            dir="ltr"></div>

                        <ul class="list-group list-group-flush border-dashed mb-0">
                            <li class="list-group-item px-0">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <span class="avatar-title bg-light p-1 rounded-circle">
                                            <img src="{{ URL::asset('build/images/svg/crypto-icons/btc.svg') }}" class="img-fluid"
                                                alt="">
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Dr. Umum</h6>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">320</h6>
                                    </div>
                                </div>
                            </li><!-- end -->
                            <li class="list-group-item px-0">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <span class="avatar-title bg-light p-1 rounded-circle">
                                            <img src="{{ URL::asset('build/images/svg/crypto-icons/eth.svg') }}" class="img-fluid"
                                                alt="">
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Dr. Gigi</h6>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">250</h6>
                                    </div>
                                </div>
                            </li><!-- end -->
                            <li class="list-group-item px-0">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <span class="avatar-title bg-light p-1 rounded-circle">
                                            <img src="{{ URL::asset('build/images/svg/crypto-icons/ltc.svg') }}" class="img-fluid"
                                                alt="">
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Dr. Spesialist</h6>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">130</h6>
                                    </div>
                                </div>
                            </li><!-- end -->
                            <li class="list-group-item px-0 pb-0">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xs">
                                        <span class="avatar-title bg-light p-1 rounded-circle">
                                            <img src="{{ URL::asset('build/images/svg/crypto-icons/dash.svg') }}" class="img-fluid"
                                                alt="">
                                        </span>
                                    </div>
                                    <div class="flex-grow-1 ms-2">
                                        <h6 class="mb-1">Dr. Sub Spesialist</h6>
                                    </div>
                                    <div class="flex-shrink-0 text-end">
                                        <h6 class="mb-1">5</h6>
                                    </div>
                                </div>
                            </li><!-- end -->
                        </ul><!-- end -->
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Stock Report</h4>
                        <div class="flex-shrink-0">
                            <button type="button" class="btn btn-soft-info btn-sm">
                                <i class="ri-file-list-3-line align-middle"></i> Generate Report
                            </button>
                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless table-centered table-hover align-middle table-nowrap mb-0">
                                <thead class=" table-light">
                                    <tr>
                                        <th scope="col">Product ID</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Updated Date</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Stock Status</th>
                                        <th scope="col">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="#!" class="fw-medium link-primary">#00541</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ URL::asset('build/images/products/img-1.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Rockerz Ear Bluetooth Headphones</div>
                                            </div>
                                        </td>
                                        <td>16 Aug, 2022</td>
                                        <td>
                                            <span class="text-secondary">$658.00</span>
                                        </td>
                                        <td>
                                            <span class="badge text-success  bg-success-subtle">In Stock</span>
                                        </td>
                                        <td>15 PCS</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="#!" class="fw-medium link-primary">#07484</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ URL::asset('build/images/products/img-5.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">United Colors Of Benetton</div>
                                            </div>
                                        </td>
                                        <td>05 Sep, 2022</td>
                                        <td>
                                            <span class="text-secondary">$145.00</span>
                                        </td>
                                        <td>
                                            <span class="badge text-warning bg-warning-subtle">Low Stock</span>
                                        </td>
                                        <td>05 PCS</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="#!" class="fw-medium link-primary">#01641</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ URL::asset('build/images/products/img-4.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Striped Baseball Cap</div>
                                            </div>
                                        </td>
                                        <td>28 Sep, 2022</td>
                                        <td>
                                            <span class="text-secondary">$215.00</span>
                                        </td>
                                        <td>
                                            <span class="badge text-danger  bg-danger-subtle">Out of Stock</span>
                                        </td>
                                        <td>0 PCS</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="#!" class="fw-medium link-primary">#00065</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ URL::asset('build/images/products/img-3.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">350 ml Glass Grocery Container</div>
                                            </div>
                                        </td>
                                        <td>02 Oct, 2022</td>
                                        <td>
                                            <span class="text-secondary">$79.99</span>
                                        </td>
                                        <td>
                                            <span class="badge text-success  bg-success-subtle">In Stock</span>
                                        </td>
                                        <td>37 PCS</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="#!" class="fw-medium link-primary">#00156</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ URL::asset('build/images/products/img-2.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">One Seater Sofa</div>
                                            </div>
                                        </td>
                                        <td>11 Oct, 2022</td>
                                        <td>
                                            <span class="text-secondary">$264.99</span>
                                        </td>
                                        <td>
                                            <span class="badge text-success  bg-success-subtle">In Stock</span>
                                        </td>
                                        <td>23 PCS</td>
                                    </tr><!-- end tr -->
                                    <tr>
                                        <td>
                                            <a href="#!" class="fw-medium link-primary">#09102</a>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ URL::asset('build/images/products/img-8.png') }}" alt="" class="avatar-xs rounded-circle" />
                                                </div>
                                                <div class="flex-grow-1">Men's Running Shoes Active Grip</div>
                                            </div>
                                        </td>
                                        <td>19 Nov, 2022</td>
                                        <td>
                                            <span class="text-secondary">$264.99</span>
                                        </td>
                                        <td>
                                            <span class="badge text-warning bg-warning-subtle">Low Stock</span>
                                        </td>
                                        <td>23 PCS</td>
                                    </tr><!-- end tr -->
                                </tbody><!-- end tbody -->
                            </table><!-- end table -->
                        </div>
                    </div>
                </div> <!-- .card-->
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div>
                    <h5>Timeline</h5>
                    <div class="horizontal-timeline my-3">
                        <div class="swiper timelineSlider">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <div class="timeline-content p-3 rounded border border-dashed">
                                            <div>
                                                <p class="text-muted fw-medium mb-2">April, 2025</p>
                                                <h6 class="mb-0 fs-15">Seminar edukasi tentang hipertensi</h6>
                                            </div>
                                        </div>
                                        <div class="time"><span class="badge text-bg-secondary">23 Apr</span></div>
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <div class="timeline-content p-3 rounded border border-dashed">
                                            <div>
                                                <p class="text-muted mb-2">Mei, 2025</p>
                                                <h6 class="mb-0 fs-15">Kerja bakti bersih-bersih puskesmas</h6>
                                            </div>
                                        </div>
                                        <div class="time"><span class="badge text-bg-secondary">2 Mei</span></div>
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <div class="timeline-content p-3 rounded border border-dashed">
                                            <div>
                                                <p class="text-muted mb-2">Mei, 2025</p>
                                                <h6 class="mb-0 fs-15">Bakti sosial cek kesehatan gratis</h6>
                                            </div>
                                        </div>
                                        <div class="time"><span class="badge text-bg-secondary">24 Mei</span></div>
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <div class="timeline-content p-3 rounded border border-dashed">
                                            <div>
                                                <p class="text-muted mb-2">Juni, 2025</p>
                                                <h6 class="mb-0 fs-15">Pelatihan kader kesehatan desa</h6>
                                            </div>
                                        </div>
                                        <div class="time"><span class="badge text-bg-secondary">14 Jun</span></div>
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <div class="timeline-content p-3 rounded border border-dashed">
                                            <div>
                                                <p class="text-muted mb-2">Juli, 2025</p>
                                                <h6 class="mb-0 fs-15">Diskusi inovasi pelayanan kesehatan</h6>
                                            </div>
                                        </div>
                                        <div class="time"><span class="badge text-bg-secondary">2 Jul</span></div>
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                                <div class="swiper-slide">
                                    <div class="card pt-2 border-0 item-box text-center">
                                        <div class="timeline-content p-3 rounded border border-dashed">
                                            <div>
                                                <p class="text-muted mb-2">Agustus, 2025</p>
                                                <h6 class="mb-0 fs-15">Diskusi inovasi pelayanan kesehatan</h6>
                                            </div>
                                        </div>
                                        <div class="time"><span class="badge text-bg-secondary">11 Agu</span></div>
                                    </div>
                                </div>
                                <!--end swiper-slide-->
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Panel Recent Chat -->
    <div class="col-xl-3 col-lg-4"> <!-- Sesuaikan lebar sesuai kebutuhan -->
        <div class="layout-rightside">
            <!-- Isi panel chat di sini -->
            <div class="card h-100 rounded-0">
                <div class="widget-userlist" data-simplebar>
                    <div class="card-body pb-0">
                        <p class="text-muted text-uppercase fw-medium fs-13">Recent Chat</p>
                        <ul class="hstack gap-2 chat-panel-list list-unstyled">
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img online">
                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Ashley Silva</p>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img online">
                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Misty Taylor</p>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img away">
                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Scott Wilson</p>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img online">
                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Patricia Wilson</p>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img away">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Allyson Wigfall</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="search-box flex-grow-1">
                                <input type="text" class="form-control" id="searchResultList" autocomplete="off" placeholder="Search for ...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="chat-panel-list list-group list-group-flush mb-0 border-dashed">
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Ashley Silva</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-info mb-0 text-truncate">Good Morning</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="mb-1 text-muted fs-12">04:32 PM</p>
                                        <span class="badge text-info bg-info-subtle rounded-circle fs-10">4</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Misty Taylor</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-info mb-0 text-truncate">Okay, Byy</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="mb-1 text-muted fs-12">02:49 PM</p>
                                        <span class="badge text-info bg-info-subtle rounded-circle fs-10">1</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Scott Wilson</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-info mb-0 text-truncate">Yeah everything is fine...</p>
                                    </div>
                                    <div class="text-end">
                                        <p class="mb-1 text-muted fs-12">12:04 PM</p>
                                        <span class="badge text-info bg-info-subtle rounded-circle fs-10">8</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Patricia Wilson</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Hey! there I'm available</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">11:11 AM</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Allyson Wigfall</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">I've finished it! See you so</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">09:24 AM</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-6.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Martha Griffin</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Wow that's great</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">16/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-7.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Mark Sargent</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Nice to meet you</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">16/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-8.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Ray Stricklin</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Hey, Hi Ray Stricklin ...!</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">16/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-9.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Frank Taylor</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Happy holiday 🙂</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">15/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-10.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Karla Basso</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Okay, Sure.</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">14/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Sally McPherson</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Thanks</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">14/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Lizzie Beil</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Our next meeting tomorrow at 10.00 AM</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">13/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Mark Williams</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">See you tomorrow</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">12/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-4.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Vina Scott</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Yeah everything is fine...</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">11/11</p>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="d-flex align-items-center gap-1">
                                    <div class="flex-shrink-0 me-2">
                                        <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}" alt="" class="avatar-xs rounded-circle chatlist-user-image" />
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mb-1 chatlist-user-name">Keli Henry</h6>
                                        </a>
                                        <p class="chatlist-desc fs-13 text-muted mb-0 text-truncate">Good afternoon</p>
                                    </div>
                                    <div class="text-end align-self-start">
                                        <p class="mb-1 text-muted fs-12">11/11</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="widget-user-chatlist">
                    <div class="chat-topbar p-4 border-bottom border-bottom-dashed">
                        <div class="align-items-center d-flex">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-2">
                                        <div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                            <div class="avatar-xs">
                                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="rounded-circle img-fluid userprofile" alt="">
                                                <span class="user-status"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="fs-14 mb-0 profile-username">Ashley Silva</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <div class="d-flex align-items-start gap-2">
                                    <div class="dropdown">
                                        <a class="btn btn-ghost-secondary btn-sm fs-16" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ri-more-2-fill"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#"><i class="bi bi-archive text-muted me-2"></i> Archive</a>
                                            <a class="dropdown-item" href="#"><i class="bi bi-mic-mute text-muted me-2"></i> Muted</a>
                                            <a class="dropdown-item" href="#"><i class="bi bi-trash3 text-muted me-2"></i> Delete</a>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-soft-danger btn-sm fs-16" id="close-chatlist"><i class="ri-close-fill"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end chat-topbar -->
                    <div class="card-body p-0">
                        <div>
                            <div id="users-chat">
                                <div class="chat-conversation p-3" id="chat-conversation" data-simplebar>
                                    <ul class="list-unstyled chat-conversation-list chat-sm" id="users-conversation">
                                        <li class="chat-list left">
                                            <div class="conversation-list">
                                                <div class="chat-avatar">
                                                    <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="">
                                                </div>
                                                <div class="user-chat-content">
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0 ctext-content">Good morning 😊</p>
                                                        </div>
                                                        <div class="dropdown align-self-start message-box-drop">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-reply me-2 text-muted align-bottom"></i>Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-share me-2 text-muted align-bottom"></i>Forward</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-files me-2 text-muted align-bottom"></i>Copy</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-bookmark me-2 text-muted align-bottom"></i>Bookmark</a>
                                                                <a class="dropdown-item delete-item" href="javascript:void(0)"><i class="bi bi-trash3 me-2 text-muted align-bottom"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="conversation-name"><small class="text-muted time">09:07 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- chat-list -->

                                        <li class="chat-list right">
                                            <div class="conversation-list">
                                                <div class="user-chat-content">
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0 ctext-content">Good morning, How are you? What about our next meeting?</p>
                                                        </div>
                                                        <div class="dropdown align-self-start message-box-drop">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-reply me-2 text-muted align-bottom"></i>Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-share me-2 text-muted align-bottom"></i>Forward</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-files me-2 text-muted align-bottom"></i>Copy</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-bookmark me-2 text-muted align-bottom"></i>Bookmark</a>
                                                                <a class="dropdown-item delete-item" href="javascript:void(0)"><i class="bi bi-trash3 me-2 text-muted align-bottom"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="conversation-name"><small class="text-muted time">09:08 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- chat-list -->

                                        <li class="chat-list left">
                                            <div class="conversation-list">
                                                <div class="chat-avatar">
                                                    <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="">
                                                </div>
                                                <div class="user-chat-content">
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0 ctext-content">Yeah everything is fine. Our next meeting tomorrow at 10.00 AM</p>
                                                        </div>
                                                        <div class="dropdown align-self-start message-box-drop">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-reply me-2 text-muted align-bottom"></i>Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-share me-2 text-muted align-bottom"></i>Forward</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-files me-2 text-muted align-bottom"></i>Copy</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-bookmark me-2 text-muted align-bottom"></i>Bookmark</a>
                                                                <a class="dropdown-item delete-item" href="javascript:void(0)"><i class="bi bi-trash3 me-2 text-muted align-bottom"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0 ctext-content">Yeah everything is fine.</p>
                                                        </div>
                                                        <div class="dropdown align-self-start message-box-drop">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-reply me-2 text-muted align-bottom"></i>Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-share me-2 text-muted align-bottom"></i>Forward</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-files me-2 text-muted align-bottom"></i>Copy</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-bookmark me-2 text-muted align-bottom"></i>Bookmark</a>
                                                                <a class="dropdown-item delete-item" href="javascript:void(0)"><i class="bi bi-trash3 me-2 text-muted align-bottom"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0 ctext-content">Hey, I'm going to meet a friend of mine at the department store. I have to buy some presents for my parents 🎁.</p>
                                                        </div>
                                                        <div class="dropdown align-self-start message-box-drop">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-reply me-2 text-muted align-bottom"></i>Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-share me-2 text-muted align-bottom"></i>Forward</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-files me-2 text-muted align-bottom"></i>Copy</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-bookmark me-2 text-muted align-bottom"></i>Bookmark</a>
                                                                <a class="dropdown-item delete-item" href="javascript:void(0)"><i class="bi bi-trash3 me-2 text-muted align-bottom"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="conversation-name"><small class="text-muted time">09:10 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- chat-list -->

                                        <li class="chat-list right">
                                            <div class="conversation-list">
                                                <div class="user-chat-content">
                                                    <div class="ctext-wrap">
                                                        <div class="ctext-wrap-content">
                                                            <p class="mb-0 ctext-content">Wow that's great</p>
                                                        </div>
                                                        <div class="dropdown align-self-start message-box-drop">
                                                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bi bi-three-dots-vertical"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-reply me-2 text-muted align-bottom"></i>Reply</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-share me-2 text-muted align-bottom"></i>Forward</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-files me-2 text-muted align-bottom"></i>Copy</a>
                                                                <a class="dropdown-item" href="javascript:void(0)"><i class="bi bi-bookmark me-2 text-muted align-bottom"></i>Bookmark</a>
                                                                <a class="dropdown-item delete-item" href="javascript:void(0)"><i class="bi bi-trash3 me-2 text-muted align-bottom"></i>Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="conversation-name"><small class="text-muted time">09:12 am</small> <span class="text-success check-message-icon"><i class="ri-check-double-line align-bottom"></i></span></div>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- chat-list -->

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative p-4 border-top border-top-dashed">
                        <form class="chat-form" autocomplete="off">
                            <div class="row g-2">
                                <div class="col">
                                    <div class="position-relative">
                                        <input type="text" id="chat-input" class="form-control border-light bg-light" placeholder="Enter Message...">
                                        <div class="chat-input-feedback">
                                            Please enter a message
                                        </div>
                                    </div>
                                </div><!-- end col -->
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-send-fill"></i></button>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </form>
                    </div>
                </div>
            </div> <!-- end card-->
        </div>
    </div>
</div>

<div>
    <button type="button" class="btn-success btn-rounded shadow-lg btn btn-icon layout-rightside-btn fs-22"><i class="ri-chat-smile-2-line"></i></button>
</div>

@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/timeline.init.js') }}"></script>

    <!-- for basic area chart -->
    <script src="https://img.ICT PDSI.com/velzon/apexchart-js/stock-prices.js"></script>
    <script src="{{ URL::asset('build/js/maps/us-merc-en.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>
@endsection
