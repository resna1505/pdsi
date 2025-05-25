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
                    <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-info addMembers-modal" data-bs-toggle="modal" data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Mitra</button>
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
                       @foreach ($categories as $item)
                           <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#category-{{$item->id}}" role="tab" aria-selected="false">
                                    {{$item->name}}
                                </a>
                            </li>
                       @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="all" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($articles as $article)
                                    <div class="list-element">
                                        <div class="d-flex flex-column flex-sm-row mb-5">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/mitras/' . $article->image) }}" alt="est" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                <div class="position-relative">
                                                    <a href="javascript:void(0);" class="stretched-link">
                                                        <h5 class="mb-3">{{ $article->title }}</h5>
                                                    </a>
                                                </div>
                                                <p class="mb-2"><i class="ri-phone-line"></i> {{ $article->telephone }}</p>
                                                <p class="mb-2"><i class="ri-mail-line"></i> {{ $article->email }}</p>
                                                <p class="mb-2"><i class=" ri-chat-poll-line"></i> {{ $article->website }}</p>
                                                <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                    {{-- <li>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="ri-user-line"></i>
                                                            </div>
                                                            <div class="flex-grow-1 fs-13 ms-1">
                                                                {{ $article->author }}
                                                            </div>
                                                        </div>
                                                    </li> --}}
                                                    <li>
                                                        <i class="ph-clock-bold align-middle"></i>
                                                        {{ $article->created_at->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-list" href="#editmemberModal" data-bs-toggle="modal" data-edit-id="{{ $article->id }}">
                                                            <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $article->id }}">
                                                            <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                        </a>
                                                    </li>
                                                </ul>
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
                    
                    <!--end tab-pane-->
                    @foreach ($categories as $category)
                        <div class="tab-pane" id="category-{{ $category->id }}" role="tabpanel">
                            <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                             <div class="row">
                                <div class="col-xxl-8 video-lists">
                                    @php
                                        $filtered = $articles->where('category_id', $category->id);
                                    @endphp

                                    @if ($filtered->isEmpty())
                                        <p class="text-muted">Belum ada artikel pada kategori ini.</p>
                                    @else
                                        @foreach ($filtered as $article)
                                        <div class="list-element">
                                            <div class="d-flex flex-column flex-sm-row mb-5">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('storage/mitras/' . $article->image) }}" alt="est" width="125" class="rounded" />
                                                </div>
                                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                    <div class="position-relative">
                                                        <a href="javascript:void(0);" class="stretched-link">
                                                            <h5 class="mb-3">{{ $article->title }}</h5>
                                                        </a>
                                                    </div>                                                    
                                                    <p class="mb-2"><i class="ri-phone-line"></i> {{ $article->telephone }}</p>
                                                    <p class="mb-2"><i class="ri-mail-line"></i> {{ $article->email }}</p>
                                                    <p class="mb-2"><i class=" ri-chat-poll-line"></i> {{ $article->website }}</p>
                                                    <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                        {{-- <li>
                                                            <div class="d-flex align-items-center">
                                                                <i class="ri-user-line"></i>
                                                                <span class="ms-1 fs-13">{{ $article->author }}</span>
                                                            </div>
                                                        </li> --}}
                                                        <li>
                                                            <i class="ph-clock-bold align-middle"></i>
                                                            {{ $article->created_at->diffForHumans() }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col text-end dropdown">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-2-fill fs-17"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a class="dropdown-item edit-list" href="#editmemberModal" data-bs-toggle="modal" data-edit-id="{{ $article->id }}">
                                                                <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $article->id }}">
                                                                <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                             </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add Mitra</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('mitra.store') }}" enctype="multipart/form-data" id="memberlist-form" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="image" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" accept="image/png, image/gif, image/jpeg">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category_id" class="form-label">Category</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id" required>
                            <option value="">Select Here</option>
                            @foreach ($categories as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label">Name</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="number" class="form-control @error('telephone') is-invalid @enderror" id="telephone" name="telephone" value="{{ old('telephone') }}" required>
                        @error('telephone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}" required>
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Mitra</button>
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
                <h5 class="modal-title" id="editMemberLabel">Edit Mitra</h5>
                <button type="button" class="btn-close" id="editMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" enctype="multipart/form-data" id="edit-form" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Error Display --}}
                    <div id="edit-errors" class="alert alert-danger d-none">
                        <ul class="mb-0" id="edit-error-list"></ul>
                    </div>

                    <div class="row">
                        <!-- Current Image Preview -->
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Current Image</label>
                            <div id="current-image-preview">
                                <!-- Image will be loaded here -->
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="edit-image" class="form-label">New Image (optional)</label>
                            <input type="file" class="form-control" name="image" id="edit-image" accept="image/png, image/gif, image/jpeg">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="edit-category_id" class="form-label">Category</label>
                            <select class="form-control" name="category_id" id="edit-category_id" required>
                                <option value="">Select Here</option>
                                @foreach ($categories as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="edit-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea name="description" id="edit-description" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <div class="col-md-12 mb-4">
                            <label for="edit-author" class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" id="edit-author" required>
                        </div>
                        
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update News</button>
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
            const actionUrl = `/articles/${articleId}`;
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
            fetch(`/articles/${articleId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const article = data.article;
                        
                        // Set form action
                        editForm.setAttribute('action', `/articles/${articleId}`);
                        
                        // Fill form fields
                        document.getElementById('edit-title').value = article.title;
                        document.getElementById('edit-description').value = article.description;
                        document.getElementById('edit-author').value = article.author;
                        document.getElementById('edit-category_id').value = article.category_id;
                        
                        // Show current image
                        const imagePreview = document.getElementById('current-image-preview');
                        if (article.attachment) {
                            imagePreview.innerHTML = `
                                <img src="{{ asset('storage/articles/') }}/${article.attachment}" 
                                     alt="Current Image" width="150" class="rounded">
                            `;
                        } else {
                            imagePreview.innerHTML = '<p class="text-muted">No image</p>';
                        }
                        
                        // Clear previous errors
                        document.getElementById('edit-errors').classList.add('d-none');
                        
                        // If using CKEditor, update it
                        if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['edit-description']) {
                            CKEDITOR.instances['edit-description'].setData(article.description);
                        }
                    } else {
                        alert('Error loading article data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading article data');
                });
        });
    });
});
</script>
<script>
// Initialize CKEditor for edit modal
if (typeof CKEDITOR !== 'undefined') {
    CKEDITOR.replace('edit-description');
}
</script>
@endsection