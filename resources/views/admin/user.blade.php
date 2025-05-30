@extends('layouts.master')
@section('title')
@lang('translation.search-results')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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
                    {{-- <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-info addMembers-modal" data-bs-toggle="modal" data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add News</button>
                        </div>
                    </div> --}}
                </div>
                <div class="mt-4">
                    <ul class="nav nav-tabs nav-tabs-custom nav-secondary" role="tablist">
                       <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#admin" role="tab" aria-selected="false">
                                Admin
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#member" role="tab" aria-selected="false">
                                Member
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="admin" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1 video-lists">
                            @foreach ($admin as $item)
                                <div class="col list-element">
                                    <div class="card">
                                        <div class="card-body p-4 m-2">
                                            <div class="row mb-4 pb-2">
                                                <div class="col">
                                                    <div class="flex-shrink-0 me-2">
                                                        <button type="button"
                                                        class="btn btn-outline-success custom-toggle rounded-circle btn-icon btn-sm"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#viewVerification"
                                                        data-id="{{ $item->user_id }}"
                                                        data-nama="{{ $item->nama }}"
                                                        data-ktp="{{ $item->ktp }}"
                                                        data-npwp="{{ $item->npwp }}"
                                                        data-lahir="{{ $item->tempat_lahir }}"
                                                        data-birthday="{{ $item->tanggal_lahir }}"
                                                        data-email="{{ $item->email }}"
                                                        data-phone="{{ $item->no_hp }}"
                                                        data-address="{{ $item->alamat }}"
                                                        data-city="{{ $item->kota }}"
                                                        data-provinsi="{{ $item->provinsi }}"
                                                        data-profesi="{{ $item->profesi }}"
                                                        data-avatar="{{  URL::asset("storage/images/users/{$item->avatar}") }}"
                                                        >
                                                            <i class="ri-eye-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill fs-17"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        {{-- <li>
                                                            <a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12">
                                                            <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $item->user_id }}">
                                                            <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="text-center mb-4">
                                                <img src="{{  URL::asset("storage/images/users/{$item->avatar}") }}" alt="" class="avatar-md rounded-3" />
                                            </div>
                                            <div class="text-center">
                                                <a href="#member-overview" data-bs-toggle="offcanvas">
                                                    <h5 class="fs-17">{{ $item->nama }}</h5>
                                                </a>
                                                <p class="text-muted mb-0">{{ $item->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach                           
                        </div>
                        <div class="d-flex align-items-center border-top pt-3">
                            <div class="flex-grow-1">
                                <div class="text-muted pagination-info mb-2"></div>
                            </div>
                            <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                        </div>                        
                    </div>
                    <div class="tab-pane" id="member" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-md-2 row-cols-1 video-lists">
                            @foreach ($dokter as $item)
                                <div class="col list-element">
                                    <div class="card">
                                        <div class="card-body p-4 m-2">
                                            <div class="row mb-4 pb-2">
                                                <div class="col">
                                                    <div class="flex-shrink-0 me-2">
                                                        <button type="button"
                                                        class="btn btn-outline-success custom-toggle rounded-circle btn-icon btn-sm"
                                                        data-bs-toggle="offcanvas"
                                                        data-bs-target="#viewVerification"
                                                        data-id="{{ $item->user_id }}"
                                                        data-nama="{{ $item->nama }}"
                                                        data-ktp="{{ $item->ktp }}"
                                                        data-npwp="{{ $item->npwp }}"
                                                        data-lahir="{{ $item->tempat_lahir }}"
                                                        data-birthday="{{ $item->tanggal_lahir }}"
                                                        data-email="{{ $item->email }}"
                                                        data-phone="{{ $item->no_hp }}"
                                                        data-address="{{ $item->alamat }}"
                                                        data-city="{{ $item->kota }}"
                                                        data-provinsi="{{ $item->provinsi }}"
                                                        data-profesi="{{ $item->profesi }}"
                                                        data-avatar="{{  URL::asset("storage/images/users/{$item->avatar}") }}"
                                                        >
                                                            <i class="ri-eye-fill"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill fs-17"></i> </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        {{-- <li>
                                                            <a class="dropdown-item edit-list" href="#addmemberModal" data-bs-toggle="modal" data-edit-id="12">
                                                            <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li> --}}
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $item->user_id }}">
                                                            <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="text-center mb-4">
                                                <img src="{{  URL::asset("storage/images/users/{$item->avatar}") }}" alt="" class="avatar-md rounded-3" />
                                            </div>
                                            <div class="text-center">
                                                <a href="#member-overview" data-bs-toggle="offcanvas">
                                                    <h5 class="fs-17">{{ $item->nama }}</h5>
                                                </a>
                                                <p class="text-muted mb-0">{{ $item->email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach                                                        
                        </div>
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

<div class="modal fade" id="addmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add New Member</h5>
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
                                <label for="teammembersName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="teammembersName" placeholder="Enter name" required>
                                <div class="invalid-feedback">Please Enter a member name.</div>
                            </div>

                            <div class="mb-4">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" placeholder="Enter designation" required>
                                <div class="invalid-feedback">Please Enter a designation.</div>
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

<div class="offcanvas offcanvas-end" tabindex="-1" id="viewVerification" aria-labelledby="viewVerificationLabel">
    <div class="offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <input type="hidden" id="targetUserId">
        <div class="text-center">
            <div class="mb-3">
                <img src="" alt="" class="avatar-lg d-block mx-auto rounded-circle overview-userimg overview-avatar" />
            </div>
            <h5 class="offcanvas-title mb-2 overview-name" id="viewVerificationLabel">-</h5>
            <p class="text-muted mb-4 overview-profesi">-</p>
        </div>
        <div class="table-responsive">
            <table class="table table-borderless">
                <tbody>
                    <form id="verifikasiForm" method="POST" style="display:none;">
                    @csrf
                    <tr>
                        <th scope="row">Email</th>
                        <td class="overview-email"></td>
                    </tr>
                    <tr>
                        <th scope="row">KTP</th>
                        <td class="overview-ktp">-</td>
                    </tr>
                    <tr>
                        <th scope="row">NPWP</th>
                        <td class="overview-npwp">-</td>
                    </tr>
                    <tr>
                        <th scope="row">Phone Number</th>
                        <td class="overview-phone">-</td>
                    </tr>
                    <tr>
                        <th scope="row">Tempat Tinggal</th>
                        <td class="overview-address">-</td>
                    </tr>
                    <tr>
                        <th scope="row">Kota</th>
                        <td class="overview-city">-</td>
                    </tr>
                    <tr>
                        <th scope="row">Provinsi</th>
                        <td class="overview-provinsi">-</td>
                    </tr>
                    <tr>
                        <th scope="row">Tempat Lahir</th>
                        <td class="overview-lahir">-</td>
                    </tr>                    
                    <tr>
                        <th scope="row">Tanggal Lahir</th>
                        <td class="overview-birthday">-</td>
                    </tr>                    
                    </form>
                </tbody>
            </table>
        </div>
        <div class="hstack gap-2 w-100">
            <button type="button" class="btn btn-secondary w-100" id="btnVerifikasi" data-anggota-id="{{ Auth::user()->anggota?->id ?? '' }}">
                Verifikasi
            </button>
        </div>
    </div>
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
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-sm btn-danger" id="remove-item">Yes, Delete It!</button>
                    </form>
                    {{-- <button type="button" class="btn w-sm btn-danger" id="remove-item">Yes, Delete It!</button> --}}
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection

@section('script')
{{-- <script src="{{ URL::asset('build/js/pages/team.init.js') }}"></script> --}}
<script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/search-result.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const itemsPerPage = 15;

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle modal delete
        const removeLinks = document.querySelectorAll('.remove-list');
        const deleteForm = document.getElementById('deleteForm');
        
        removeLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const articleId = this.getAttribute('data-remove-id');
                const actionUrl = `/user/${articleId}`;
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    });
</script>
<script>
    const viewVerification = document.getElementById('viewVerification');
    viewVerification.addEventListener('show.bs.offcanvas', function (event) {
        const button = event.relatedTarget;
        // const id = button.getAttribute('data-id');
        const id = button.getAttribute('data-id');
        const nama = button.getAttribute('data-nama');
        const ktp = button.getAttribute('data-ktp');
        const npwp = button.getAttribute('data-npwp');
        const lahir = button.getAttribute('data-lahir');
        const birthday = button.getAttribute('data-birthday');
        const email = button.getAttribute('data-email');
        const phone = button.getAttribute('data-phone');
        const address = button.getAttribute('data-address');
        const city = button.getAttribute('data-city');
        const provinsi = button.getAttribute('data-provinsi');
        const profesi = button.getAttribute('data-profesi');
        const avatar = button.getAttribute('data-avatar');

        document.getElementById('targetUserId').value = id;
        // viewVerification.querySelector('.overview-id').textContent = id;
        viewVerification.querySelector('.overview-name').textContent = nama;
        viewVerification.querySelector('.overview-email').textContent = email;
        viewVerification.querySelector('.overview-phone').textContent = phone;
        viewVerification.querySelector('.overview-address').textContent = address;
        viewVerification.querySelector('.overview-city').textContent = city;
        viewVerification.querySelector('.overview-provinsi').textContent = provinsi;
        viewVerification.querySelector('.overview-profesi').textContent = profesi;
        viewVerification.querySelector('.overview-ktp').textContent = ktp;
        viewVerification.querySelector('.overview-npwp').textContent = npwp;
        viewVerification.querySelector('.overview-lahir').textContent = lahir;
        viewVerification.querySelector('.overview-birthday').textContent = birthday;
        viewVerification.querySelector('.overview-avatar').src = avatar;
        // Tambahkan yang lain sesuai kebutuhan
    });
</script>
<script>
    btnVerifikasi.addEventListener('click', function () {
    const anggotaId = document.getElementById('targetUserId').value;
    if (!anggotaId) {
        alert('ID anggota tidak ditemukan!');
        return;
    }
    verifikasiForm.setAttribute('action', `/verifikasi-user/${anggotaId}`);
    verifikasiForm.submit();
});

</script>

@endsection