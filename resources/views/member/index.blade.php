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
    <div class="col">
        <div class="row">
        <div class="col-xxl-3 col-md-6">
            <div class="card card-animate card-height-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Pembayaran Sukses</p>
                            <h2 class="mt-4 fw-semibold"><span class="counter-value" data-target="15"></span></h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0"><i
                                        class="ri-arrow-up-line align-middle"></i> 8.24 % </span> last month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle text-success rounded-circle fs-2">
                                    <i class="ph-check-square-offset"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-md-6">
            <div class="card card-animate card-height-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="fw-medium text-muted mb-0">Gagal Bayar Iuran</p>
                            <h2 class="mt-4 fw-semibold"><span class="counter-value" data-target="3"></span></h2>
                            <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0"><i
                                        class="ri-arrow-down-line align-middle"></i> 10.25 % </span> last month</p>
                        </div>
                        <div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-2">
                                    <i class="ph-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div><!-- end card body -->
            </div>
        </div>
        <!--end col-->
        <div class="col-xxl-3 col-md-6">
            <div class="card card-height-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Progress SKP</h5>
                    <div class="progress animated-progress custom-progress mb-1">
                        <div class="progress-bar" role="progressbar" style="width: 38%" aria-valuenow="38" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <p class="text-muted mb-2">You used 40 of 100 of your SKP</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="apiKeyList">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title flex-grow-1 mb-0">Agenda Kegiatan</h5>
                    <div class="d-flex gap-1 flex-wrap">
                        <button class="btn btn-soft-danger" id="remove-actions" onClick="deleteMultiple()">
                            <i class="ri-delete-bin-2-line"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div id="agendaList">
                        <div class="table-responsive table-card mb-3">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="sort" data-sort="name">Nama Kegiatan</th>
                                        <th class="sort" data-sort="kategori">Kategori</th>
                                        <th class="sort" data-sort="tanggal">Tanggal</th>
                                        <th class="sort" data-sort="lokasi">Lokasi</th>
                                        <th class="sort" data-sort="skp">SKP</th>
                                        <th class="sort" data-sort="status">Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    <tr>
                                        <td class="name">Pelatihan ACLS</td>
                                        <td class="kategori">Pelatihan</td>
                                        <td class="tanggal">10 Juli 2025</td>
                                        <td class="lokasi">RSUD Kota X</td>
                                        <td class="skp">5</td>
                                        <td class="status"><span class="badge text-success bg-success-subtle">Terdaftar</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Lihat Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Webinar SKP BPJS</td>
                                        <td class="kategori">Zoom</td>
                                        <td class="tanggal">15 Agustus 2025</td>
                                        <td class="lokasi">Online (Zoom)</td>
                                        <td class="skp">3</td>
                                        <td class="status"><span class="badge text-warning bg-warning-subtle">Belum Daftar</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">Daftar</a></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Bakti Sosial Ramadan</td>
                                        <td class="kategori">Bakti Sosial</td>
                                        <td class="tanggal">18 April 2025</td>
                                        <td class="lokasi">Puskesmas Y</td>
                                        <td class="skp">2</td>
                                        <td class="status"><span class="badge text-secondary bg-secondary-subtle">Selesai</span></td>
                                        <td><a href="#" class="btn btn-sm btn-success">Sertifikat</a></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Seminar Etika Kedokteran</td>
                                        <td class="kategori">Seminar</td>
                                        <td class="tanggal">22 Mei 2025</td>
                                        <td class="lokasi">Aula X Jakarta</td>
                                        <td class="skp">4</td>
                                        <td class="status"><span class="badge text-secondary bg-secondary-subtle">Terdaftar</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Lihat Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Workshop Geriatri Nasional</td>
                                        <td class="kategori">Workshop</td>
                                        <td class="tanggal">2 September 2025</td>
                                        <td class="lokasi">RSUP Dr. Sardjito</td>
                                        <td class="skp">6</td>
                                        <td class="status"><span class="badge text-warning bg-warning-subtle">Belum Daftar</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">Daftar</a></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Pelatihan BLS</td>
                                        <td class="kategori">Pelatihan</td>
                                        <td class="tanggal">5 Oktober 2025</td>
                                        <td class="lokasi">RS Jakarta</td>
                                        <td class="skp">4</td>
                                        <td class="status"><span class="badge text-success bg-success-subtle">Terdaftar</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Lihat Detail</a></td>
                                    </tr>
                                    <tr>
                                        <td class="name">Seminar Kardiologi</td>
                                        <td class="kategori">Seminar</td>
                                        <td class="tanggal">12 November 2025</td>
                                        <td class="lokasi">Hotel Borobudur</td>
                                        <td class="skp">5</td>
                                        <td class="status"><span class="badge text-warning bg-warning-subtle">Belum Daftar</span></td>
                                        <td><a href="#" class="btn btn-sm btn-outline-primary">Daftar</a></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <div style="width:75px;height:75px; margin: 0 auto; background: #f8f9fa; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                        <i class="ri-search-line" style="font-size: 24px; color: #6c757d;"></i>
                                    </div>
                                    <h5 class="mt-2">Maaf! Tidak Ada Hasil</h5>
                                    <p class="text-muted mb-0">Kami tidak menemukan kegiatan sesuai pencarian Anda.</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <div class="text-muted small">
                                Menampilkan <span id="showing-start">1</span> - <span id="showing-end">5</span> dari <span id="total-items">10</span> data
                            </div>
                            <div class="pagination-wrap">
                                <ul class="pagination listjs-pagination mb-0"></ul>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="api-key-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create API Key</h5>
                    <button type="button" class="btn-close" id="close-modal" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div id="api-key-error-msg" class="alert alert-danger py-2 d-none"></div>
                        <input type="hidden" id="apikeyId">
                        <div class="mb-3">
                            <label for="api-key-name" class="form-label">API Key Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="api-key-name"
                                placeholder="Enter api key name">
                        </div>
                        <div class="mb-3" id="apikey-element" style="display: none;">
                            <label for="api-key" class="form-label">API Key</label>
                            <input type="text" class="form-control" id="api-key" disabled
                                value="b5815DE8A7224438932eb296Z5">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createApi-btn">Create API</button>
                        <button type="button" class="btn btn-primary" id="add-btn">Add</button>
                        <button type="button" class="btn btn-primary" id="edit-btn">Save Changes</button>
                    </div>
                </div>
            </div>
            <!-- modal content -->
        </div>
    </div>
    <!-- end modal -->

    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteApiKeyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="deleteRecord-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this API Key ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger " id="delete-record">Yes, Delete It!</button>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div>
    </div>
    <!--end modal -->

    </div> 
    <!-- end col -->

    {{-- <div class="col-auto layout-rightside-col">
        <div class="overlay"></div>
        <div class="layout-rightside">
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
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Admin 1</p>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img online">
                                        <img src="{{ URL::asset('build/images/users/avatar-2.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Admin 2</p>
                                </a>
                            </li>
                            <li>
                                <a href="#!" class="text-center avatar-sm h-auto d-block">
                                    <div class="chat-user-img away">
                                        <img src="{{ URL::asset('build/images/users/avatar-3.jpg') }}" class="avatar-sm rounded-circle chatlist-user-image" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <p class="text-muted mb-0 mt-2 text-truncate chatlist-user-name">Admin 3</p>
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
        </div> <!-- end .rightbar-->
    </div>  --}}
    <!-- end col -->
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

<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/api-key.init.js') }}"></script>

<script>
    // Script yang diperbaiki untuk pagination List.js
    document.addEventListener('DOMContentLoaded', function() {
        // Konfigurasi List.js
        const options = {
            valueNames: ['name', 'kategori', 'tanggal', 'lokasi', 'skp', 'status'],
            page: 5, // Items per halaman
            pagination: {
                innerWindow: 1,
                outerWindow: 1,
                left: 1,
                right: 1,
                paginationClass: 'listjs-pagination'
            }
        };

        // Inisialisasi List.js
        const agendaList = new List('agendaList', options);

        // Fungsi untuk update info pagination
        function updatePaginationInfo() {
            const totalItems = agendaList.matchingItems.length;
            const itemsPerPage = agendaList.page;
            const currentPage = agendaList.i;
            
            if (totalItems === 0) {
                document.getElementById('showing-start').textContent = '0';
                document.getElementById('showing-end').textContent = '0';
                document.getElementById('total-items').textContent = '0';
            } else {
                const start = ((currentPage - 1) * itemsPerPage) + 1;
                const end = Math.min(currentPage * itemsPerPage, totalItems);
                
                document.getElementById('showing-start').textContent = start;
                document.getElementById('showing-end').textContent = end;
                document.getElementById('total-items').textContent = totalItems;
            }
        }

        // Event listeners
        agendaList.on('updated', function() {
            updatePaginationInfo();
            
            // Show/hide no results message
            const noResultDiv = document.querySelector('.noresult');
            if (agendaList.matchingItems.length === 0) {
                noResultDiv.style.display = 'block';
            } else {
                noResultDiv.style.display = 'none';
            }
        });

        // Event listener untuk search
        const searchInput = document.getElementById('searchResultList');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                agendaList.search(this.value);
            });
        }

        // Inisialisasi pertama kali
        updatePaginationInfo();

        // Fungsi untuk multiple delete
        window.deleteMultiple = function() {
            const selectedItems = document.querySelectorAll('input[type="checkbox"]:checked');
            if (selectedItems.length === 0) {
                alert('Pilih item yang akan dihapus');
                return;
            }
            
            if (confirm(`Yakin ingin menghapus ${selectedItems.length} item?`)) {
                // Implementasi hapus multiple di sini
                selectedItems.forEach(item => {
                    const row = item.closest('tr');
                    if (row) {
                        row.remove();
                    }
                });
                
                // Update list setelah penghapusan
                agendaList.reIndex();
                updatePaginationInfo();
                
                alert('Item berhasil dihapus');
            }
        };

        // Custom styling untuk pagination
        const style = document.createElement('style');
        style.textContent = `
            .listjs-pagination {
                display: flex;
                gap: 5px;
                justify-content: center;
                margin: 0;
                padding: 0;
            }
            
            .listjs-pagination li {
                list-style: none;
            }
            
            .listjs-pagination li a {
                display: block;
                padding: 8px 12px;
                text-decoration: none;
                border: 1px solid #dee2e6;
                color: #6c757d;
                border-radius: 4px;
                transition: all 0.2s;
                cursor: pointer;
            }
            
            .listjs-pagination li a:hover {
                background-color: #e9ecef;
                border-color: #adb5bd;
                color: #495057;
            }
            
            .listjs-pagination li.active a {
                background-color: #0d6efd;
                border-color: #0d6efd;
                color: white !important;
            }
            
            .listjs-pagination li.disabled a {
                color: #6c757d !important;
                background-color: #fff;
                border-color: #dee2e6;
                cursor: not-allowed;
                opacity: 0.5;
            }
            
            .btn-soft-danger {
                background-color: #f8d7da;
                border-color: #f5c6cb;
                color: #721c24;
            }
            
            .btn-soft-danger:hover {
                background-color: #f1aeb5;
                border-color: #e85d75;
                color: #721c24;
            }
            
            .table-responsive {
                margin-bottom: 1rem;
            }
            
            .noresult {
                padding: 2rem;
                text-align: center;
            }
            
            .pagination-wrap {
                display: flex;
                justify-content: center;
                align-items: center;
            }
        `;
        document.head.appendChild(style);
    });
</script>

@endsection
