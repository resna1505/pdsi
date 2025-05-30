@extends('layouts.master')
@section('title')
Visi Misi Value
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
                    <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-info addMembers-modal" data-bs-toggle="modal" data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Visi Misi</button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <ul class="nav nav-tabs nav-tabs-custom nav-secondary" role="tablist">
                       <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#visimisi" role="tab" aria-selected="false">
                                Visi Misi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#value" role="tab" aria-selected="false">
                                Value
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#motto" role="tab" aria-selected="false">
                                Motto
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="visimisi" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($visimisi as $item)
                                    @if ($item->type == 'visimisi')
                                        <div class="list-element">
                                            <div class="d-flex flex-column flex-sm-row mb-5">
                                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                    <div class="position-relative">
                                                        <a href="javascript:void(0);" class="stretched-link">
                                                            <h5 class="mb-3">{{ $item->description }}</h5>
                                                        </a>
                                                    </div>
                                                    <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                        <li>
                                                            <i class="ph-clock-bold align-middle"></i>
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item edit-list" href="#editmemberModal" data-bs-toggle="modal" data-edit-id="{{ $item->id }}">
                                                                <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $item->id }}">
                                                                <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif                                    
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
                    <div class="tab-pane" id="value" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($visimisi as $item)
                                    @if ($item->type == 'value')
                                        <div class="list-element">
                                            <div class="d-flex flex-column flex-sm-row mb-5">
                                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                    <div class="position-relative">
                                                        <a href="javascript:void(0);" class="stretched-link">
                                                            <h5 class="mb-3">{{ $item->title }}</h5>
                                                        </a>
                                                    </div>
                                                    <p class="text-muted mb-2">{{ $item->description }}</p>
                                                    <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                        <li>
                                                            <i class="ph-clock-bold align-middle"></i>
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item edit-list" href="#editmemberModal" data-bs-toggle="modal" data-edit-id="{{ $item->id }}">
                                                                <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $item->id }}">
                                                                <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif                                    
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
                    <div class="tab-pane" id="motto" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($visimisi as $item)
                                    @if ($item->type == 'motto')
                                        <div class="list-element">
                                            <div class="d-flex flex-column flex-sm-row mb-5">
                                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                    <div class="position-relative">
                                                        <a href="javascript:void(0);" class="stretched-link">
                                                            <h5 class="mb-3">{{ $item->description }}</h5>
                                                        </a>
                                                    </div>
                                                    <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                        <li>
                                                            <i class="ph-clock-bold align-middle"></i>
                                                            {{ $item->created_at->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item edit-list" href="#editmemberModal" data-bs-toggle="modal" data-edit-id="{{ $item->id }}">
                                                                <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $item->id }}">
                                                                <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endif                                    
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
</div>

<div class="modal fade" id="addmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add Visi Misi</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('visimisi.store') }}" enctype="multipart/form-data" id="memberlist-form" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control @error('type') is-invalid @enderror" name="type" id="type" required onchange="toggleTitleField()">
                            <option value="">Select Here</option>
                            <option value="visimisi">Visi Misi</option>
                            <option value="value">Value</option>
                            <option value="motto">Motto</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3" id="title-wrapper">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" value="{{ old('description') }}" required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Visi Misi</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="editMemberLabel">Edit Visi Misi</h5>
                <button type="button" class="btn-close" id="editMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" enctype="multipart/form-data" id="edit-form" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">                        
                        <div class="col-md-6 mb-3">
                            <label for="edit-category_id" class="form-label">Type</label>
                            <select class="form-control" name="category_id" id="edit-category_id" required>
                                <option value="">Select Here</option>
                                <option value="visimisi">Visi Misi</option>
                                <option value="value">Value</option>
                                <option value="motto">Motto</option>
                            </select>
                        </div>                        
                        <div class="col-md-6 mb-3" id="title-wrapper">
                            <label for="edit-title"  class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>                        
                        <div class="col-md-6 mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="edit-description" name="description" required>
                        </div>                        
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Visi Misi</button>
                        </div>
                    </div>
                </form>
            </div>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle modal delete
    const removeLinks = document.querySelectorAll('.remove-list');
    const deleteForm = document.getElementById('deleteForm');
    
    removeLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const articleId = this.getAttribute('data-remove-id');
            const actionUrl = `/visimisi/${articleId}`;
            deleteForm.setAttribute('action', actionUrl);
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle edit modal
    const editLinks = document.querySelectorAll('.edit-list');
    const editForm = document.getElementById('edit-form');
    
    editLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const articleId = this.getAttribute('data-edit-id');
            
            // Fetch article data
            fetch(`/visimisi/${articleId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const article = data.article;
                        
                        // Set form action
                        editForm.setAttribute('action', `/visimisi/${articleId}`);
                        
                        // Fill form fields
                        document.getElementById('edit-title').value = article.title;
                        document.getElementById('edit-description').value = article.description;
                        document.getElementById('edit-category_id').value = article.type;
                        
                        document.getElementById('edit-errors').classList.add('d-none');
                    } else {
                        alert('Error loading article data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // alert('Error loading article data');
                });
        });
    });
});
</script>
<script>
    function toggleTitleField() {
        const typeSelect = document.getElementById('type');
        const titleWrapper = document.getElementById('title-wrapper');
        if (typeSelect.value === "value") {
            titleWrapper.style.display = "block";
        } else {
            titleWrapper.style.display = "none";
        }
    }
    document.addEventListener('DOMContentLoaded', toggleTitleField);
</script>
@endsection