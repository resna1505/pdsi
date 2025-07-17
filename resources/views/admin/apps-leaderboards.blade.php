@extends('layouts.master')
@section('title') @lang('translation.leaderboard') @endsection
@section('content')
@component('components.breadcrumb')
@slot('li_1')  Apps  @endslot
@slot('title') Leaderboard @endslot
@endcomponent

<!-- start row -->
<div class="row">
    <div class="col-xl-8">
        <!-- start row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="d-flex border-bottom pb-3 border-light border-opacity-25">
                            <div class="flex-grow-1 overflow-hidden">
                                <h4 class="fs-17 fw-semibold text-white">-</h4>
                                <p class="text-white text-truncate mb-0"> Welcome to Leaderboard</p>
                            </div>

                            <div class="flex-shrink-0">
                                <div class="avatar-sm">
                                    <span class="avatar-title rounded fs-2">
                                        🎉
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 pt-1">
                            <p class="text-white-50 mb-0 fs-14 mb-0 text-truncate"> <span class="text-white">#-</span> -</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex border-bottom pb-3">
                            <div class="flex-grow-1">
                                <h4 class="fs-17 fw-semibold"><span class="counter-value" data-target="0">-</span>k </h4>
                                <p class="text-muted mb-0">Total Member</p>
                            </div>

                            <div class="flex-shrink-0">
                                <div class="avatar-sm">
                                    <span class="avatar-title rounded fs-2">
                                        <div id="mini-chart-1" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 pt-1">
                            <p class="text-success mb-0 fs-14 mb-0 text-truncate"><i class="mdi mdi-trending-up align-middle me-1"></i>0 <span class="text-muted">-</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex border-bottom pb-3">
                            <div class="flex-grow-1">
                                <h4 class="fs-17 fw-semibold">-</h4>
                                <p class="text-muted mb-0">All Time Winner</p>
                            </div>

                            <div class="flex-shrink-0">
                                <div class="avatar-sm">
                                    <span class="avatar-title rounded fs-2">
                                        <img class="rounded img-fluid" src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2 pt-1">
                            <p class="text-muted mb-0 fs-14 mb-0 text-truncate"> -</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- start row -->

        <div class="align-items-center d-flex pb-4">
            <h4 class="card-title mb-0 flex-grow-1">Top 3 Employees Of The Month</h4>
            <div class="flex-shrink-0">
                <div class="dropdown card-header-dropdown">
                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fw-semibold text-uppercase fs-12">Sort by:
                        </span><span class="text-muted">This Month<i class="mdi mdi-chevron-down ms-1"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#">Today</a>
                        <a class="dropdown-item" href="#">Yesterday</a>
                        <a class="dropdown-item" href="#">Last 7 Days</a>
                        <a class="dropdown-item" href="#">Last 30 Days</a>
                        <a class="dropdown-item" href="#">This Month</a>
                        <a class="dropdown-item" href="#">Last Month</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- start row -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body ribbon-box right">
                        <div class="text-center py-3">
                            <div class="ribbon ribbon-info vertical-shape"><span>1<sup>st</sup></span></div>
                            <div class="mx-auto avatar-md p-1 border rounded-circle">
                                <img src="{{ URL::asset('build/images/users/test.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>

                            <h5 class="mt-3 fs-17">-</h5>
                            <p class="text-muted mb-0">-</p>

                            <div class="row mt-4 pt-2">
                                <div class="col-6">
                                    <div id="user-chart-1" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                            </div>

                            <div class="row text-muted text-center mt-4 pt-3">
                                <div class="col-4 border-end border-end-dashed">
                                    <h5 class="mb-1 projects-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                                <div class="col-4 border-end border-end-dashed">
                                    <h5 class="mb-1 projects-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-1 tasks-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-body ribbon-box right">
                        <div class="text-center py-3">
                            <div class="ribbon ribbon-success vertical-shape"><span>2<sup>nd</sup></span></div>
                            <div class="mx-auto avatar-md p-1 border rounded-circle">
                                <img src="{{ URL::asset('build/images/users/test.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>

                            <h5 class="mt-3 fs-17">-</h5>
                            <p class="text-muted mb-0">-</p>

                            <div class="row mt-4 pt-2">
                                <div class="col-6">
                                    <div id="user-chart-2" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1"> -</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                            </div>

                            <div class="row text-muted text-center mt-4 pt-3">
                                <div class="col-4 border-end border-end-dashed">
                                    <h5 class="mb-1 projects-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                                <div class="col-4 border-end border-end-dashed">
                                    <h5 class="mb-1 projects-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-1 tasks-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-body ribbon-box right">
                        <div class="text-center py-3">
                            <div class="ribbon ribbon-danger vertical-shape"><span>3<sup>rd</sup></span></div>
                            <div class="mx-auto avatar-md p-1 border rounded-circle">
                                <img src="{{ URL::asset('build/images/users/test.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>

                            <h5 class="mt-3 fs-17">-</h5>
                            <p class="text-muted mb-0">-</p>

                            <div class="row mt-4 pt-2">
                                <div class="col-6">
                                    <div id="user-chart-3" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1"> -</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                            </div>

                            <div class="row text-muted text-center mt-4 pt-3">
                                <div class="col-4 border-end border-end-dashed">
                                    <h5 class="mb-1 projects-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                                <div class="col-4 border-end border-end-dashed">
                                    <h5 class="mb-1 projects-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                                <div class="col-4">
                                    <h5 class="mb-1 tasks-num">-</h5>
                                    <p class="text-muted mb-0">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- start row -->
    </div>

    <div class="col-xl-4">
        <div class="d-flex flex-column h-100">
            <div class="card h-100">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Hours Spent</h4>
                    <div class="flex-shrink-0">
                        <div class="dropdown card-header-dropdown">
                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="fw-semibold text-uppercase fs-12">Sort by:
                                </span><span class="text-muted">Today<i class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Today</a>
                                <a class="dropdown-item" href="#">Yesterday</a>
                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                <a class="dropdown-item" href="#">This Month</a>
                                <a class="dropdown-item" href="#">Last Month</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body py-0">
                    <div id="hours_spent_chart" data-colors='["--tb-info-rgb, 0.4","--tb-info-rgb, 0.4","--tb-info-rgb, 0.4","--tb-info-rgb, 0.4","--tb-info","--tb-info","--tb-info","--tb-info","--tb-info", "--tb-info"]' class="apex-chart"></div>
                </div>
            </div>
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Productivity Growth</h4>
                </div>
                <div class="card-body py-0">
                    <div id="chart-radialBar" class="apex-charts" data-colors='["--tb-primary", "--tb-danger", "--tb-warning"]'></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->


<!-- start row -->
<div class="row">
    <div class="col-xl-9">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Employees</h4>
                <div class="flex-shrink-0">
                    <div class="dropdown card-header-dropdown">
                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">Download Report</a>
                            <a class="dropdown-item" href="#">Export</a>
                            <a class="dropdown-item" href="#">Import</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-card">
                    <table class="table table-centered align-middle table-nowrap mb-0">
                        <tbody>
                            {{-- <tr>
                                <td>
                                    <span class="fw-medium">#8</span>
                                </td>
                                <td style="width: 160px;">
                                    <div class="d-flex">
                                        <div class="avatar-sm p-1 border rounded-circle me-3">
                                            <img src="{{ URL::asset('build/images/users/avatar-10.jpg') }}" class="img-fluid rounded-circle" alt="">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Branded T-Shirts</h6>
                                            <span class="text-muted fs-13">Designer</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div id="other-chart-5" data-colors='["--tb-primary"]' class="apex-charts" dir="ltr"></div>
                                </td>

                                <td>
                                    <h6 class="mb-1"> 32h 52m</h6>
                                    <span class="text-muted fs-13">Total Working Time</span>
                                </td>

                                <td>
                                    <h6 class="mb-1">632</h6>
                                    <span class="text-muted fs-13">Accuracy</span>
                                </td>
                                <td>
                                    <h6 class="mb-1">423</h6>
                                    <span class="text-muted fs-13">Aesthetic</span>
                                </td>
                                <td>
                                    <h6 class="mb-1">3265</h6>
                                    <span class="text-muted fs-13">Total Points</span>
                                </td>

                                <td>
                                    <span>
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ri-menu-add-fill fs-14"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item" href=""><i class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item edit-list" href=""><i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                                </li>
                                                <li class="dropdown-divider"></li>
                                                <li>
                                                    <a class="dropdown-item remove-list" href="#"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </span>

                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>

                <div class="align-items-center mt-4 pt-2 justify-content-between d-flex">
                    <div class="flex-shrink-0">
                        <div class="text-muted">
                            Showing <span class="fw-semibold">5</span> of <span class="fw-semibold">25</span> Results
                        </div>
                    </div>
                    <ul class="pagination pagination-separated pagination-sm mb-0">
                        <li class="page-item disabled">
                            <a href="#" class="page-link">←</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item active">
                            <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">→</a>
                        </li>
                    </ul>
                </div>


            </div>
        </div>
    </div>

    <div class="col-xl-3">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Latest News</h4>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-soft-primary btn-sm">
                        Show All
                    </button>
                </div>
            </div>
            <div class="card-body px-0">
                <div data-simplebar style="max-height: 380px;" class="p-3 pt-0">
                    {{-- <a href="#!" class="d-flex border-bottom pb-3">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm p-1 border rounded-circle me-3">
                                <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" class="img-fluid rounded-circle" alt="">
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="fs-16 mb-1">Henry Carter</h5>
                            <span class="text-muted mb-0">Andrei Coman magna sed porta finibus, risus posted a new article: <b class="text-primary">Forget UX Rowland</b></span>
                        </div>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection
@section('script')
<script src="{{ URL::asset('build/libs/tom-select/js/tom-select.base.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/leaderboard.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
