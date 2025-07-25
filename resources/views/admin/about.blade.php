@extends('layouts.master')
@section('title')
About
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
                            <button class="btn btn-info addMembers-modal" data-bs-toggle="modal" data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add Galeri</button>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <ul class="nav nav-tabs nav-tabs-custom nav-secondary" role="tablist">
                       <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#video" role="tab" aria-selected="false">
                                Video
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#metode" role="tab" aria-selected="false">
                                Metode Pembelajaran
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#all" role="tab" aria-selected="false">
                                Galeri
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="tab-content">
                    <div class="tab-pane active" id="video" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($articles as $article)
                                    <div class="list-element">
                                        <div class="d-flex flex-column flex-sm-row mb-5">
                                            <div class="flex-shrink-0">
                                                @php
                                                    // Extract video ID from embed URL
                                                    preg_match('/\/embed\/([a-zA-Z0-9_-]{11})/', $article->url, $matches);
                                                    $videoId = $matches[1] ?? null;
                                                    $watchUrl = $videoId ? "https://www.youtube.com/watch?v={$videoId}" : $article->url;
                                                @endphp
                                                
                                                <!-- Video Container with Error Handling -->
                                                <div class="video-container position-relative" style="width: 300px; height: 200px;">
                                                    <iframe 
                                                        src="{{ $article->url }}" 
                                                        title="YouTube video: {{ $article->title }}" 
                                                        width="300" 
                                                        height="200"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                                        allowfullscreen 
                                                        class="rounded"
                                                        style="display: block;"
                                                        onload="this.style.display='block'; this.nextElementSibling.style.display='none';"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                    </iframe>
                                                    
                                                    <!-- Fallback jika video tidak bisa dimuat -->
                                                    <div class="video-fallback bg-light rounded d-flex flex-column justify-content-center align-items-center text-center p-3" 
                                                        style="display: none; width: 300px; height: 200px; position: absolute; top: 0; left: 0;">
                                                        @if($videoId)
                                                            <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" 
                                                                alt="Video Thumbnail" 
                                                                class="rounded mb-2" 
                                                                style="max-width: 280px; max-height: 150px;"
                                                                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                                            <div style="display: none;">
                                                                <i class="ri-youtube-line fs-1 text-muted mb-2"></i>
                                                            </div>
                                                        @else
                                                            <i class="ri-youtube-line fs-1 text-muted mb-2"></i>
                                                        @endif
                                                        {{-- <small class="text-muted">Video tidak dapat dimuat</small>
                                                        <a href="{{ $watchUrl }}" target="_blank" class="btn btn-sm btn-outline-primary mt-2">
                                                            <i class="ri-external-link-line"></i> Buka di YouTube
                                                        </a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                <div class="position-relative">
                                                    <a href="{{ $watchUrl }}" target="_blank">
                                                        <h5 class="mb-3">{{ $article->title }}</h5>
                                                    </a>
                                                </div>
                                                <p class="mb-2">
                                                    <i class="ri-youtube-line"></i> 
                                                    <a href="{{ $watchUrl }}" target="_blank" class="text-muted">
                                                        Buka di YouTube
                                                    </a>
                                                </p>
                                                <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
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
                                                        <a class="dropdown-item edit-list" href="#editVideo" data-bs-toggle="modal" data-edit-id="{{ $article->id }}">
                                                            <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
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
                    
                    <div class="tab-pane" id="metode" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($learning as $article)
                                    <div class="list-element">
                                        <div class="d-flex flex-column flex-sm-row mb-5">
                                            <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                <div class="position-relative">
                                                    <a href="javascript:void(0);" class="stretched-link">
                                                        <h5 class="mb-3">{{ $article->name }}</h5>
                                                    </a>
                                                </div>
                                                <p class="mb-2"><i class=" ri-refresh-line"></i> {{ $article->progress }} %</p>
                                                <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                    <li>
                                                        <i class="ph-clock-bold align-middle"></i>
                                                        {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-metode" href="#editMetode" data-bs-toggle="modal" data-edit-id="{{ $article->id }}">
                                                            <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
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

                    <div class="tab-pane" id="all" role="tabpanel">
                        <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                        <div class="row">
                            <div class="col-xxl-8 video-lists">
                                @foreach($activity as $article)
                                    <div class="list-element">
                                        <div class="d-flex flex-column flex-sm-row mb-5">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset('storage/galeri/' . $article->image) }}" alt="est" width="125" class="rounded" />
                                            </div>
                                            <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                <div class="position-relative">
                                                    <a href="javascript:void(0);" class="stretched-link">
                                                        <h5 class="mb-3">{{ $article->title }}</h5>
                                                    </a>
                                                </div>
                                                @php
                                                    $paragraphs = explode('</p>', $article->description);
                                                    $limitedContent = implode('</p>', array_slice($paragraphs, 0, 4)) . '</p>';
                                                @endphp
                                                <p class="text-muted mb-2">{{ \Illuminate\Support\Str::limit(strip_tags($article->description), 500) }}</p>
                                                <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <i class="ri-user-line"></i>
                                                            </div>
                                                            <div class="flex-grow-1 fs-13 ms-1">
                                                                {{ $article->location }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <i class="ph-clock-bold align-middle"></i>
                                                        {{ \Carbon\Carbon::parse($article->created_at)->diffForHumans() }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col text-end dropdown">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-2-fill fs-17"></i>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item edit-galeri" href="#editgaleri" data-bs-toggle="modal" data-edit-id="{{ $article->id }}">
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
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editgaleri" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="editMemberLabel">Edit Galeri</h5>
                <button type="button" class="btn-close" id="editMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" enctype="multipart/form-data" id="edit-form-galeri" class="needs-validation" novalidate>
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
                            <label for="edit-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="edit-location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="edit-location" name="location" required>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="edit-description" class="form-label">Description</label>
                            <textarea name="description" id="edit-description" class="form-control" rows="5" required></textarea>
                        </div>
                        
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addmemberModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="createMemberLabel">Add Galeri</h5>
                <button type="button" class="btn-close" id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('galeri.storegaleri') }}" enctype="multipart/form-data" id="memberlist-form" class="needs-validation" novalidate>
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
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="ckeditor-classic form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Galeri</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editVideo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="editMemberLabel">Edit Video</h5>
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
                        <div class="col-md-6 mb-3">
                            <label for="edit-titlevideo" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-titlevideo" name="title" required>
                        </div>                        
                        <div class="col-md-6 mb-3">
                            <label for="edit-url" class="form-label">URL</label>
                            <input type="text" class="form-control" id="edit-url" name="url" required>
                        </div>
                        
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Video</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editMetode" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title" id="editMemberLabel">Edit Metode</h5>
                <button type="button" class="btn-close" id="editMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" enctype="multipart/form-data" id="edit-form-metode" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    {{-- Error Display --}}
                    <div id="edit-errors" class="alert alert-danger d-none">
                        <ul class="mb-0" id="edit-error-list"></ul>
                    </div>

                    <div class="row">                 
                        <div class="col-md-6 mb-3">
                            <label for="edit-name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit-name" name="name" required>
                        </div>                        
                        <div class="col-md-6 mb-3">
                            <label for="edit-progress" class="form-label">Progress</label>
                            <input type="text" class="form-control" id="edit-progress" name="progress" required>
                        </div>
                        
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update About</button>
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
                const actionUrl = `/about/${articleId}`;
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit modal untuk VIDEO
        const editLinks = document.querySelectorAll('.edit-list');
        const editForm = document.getElementById('edit-form');
        
        editLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // TAMBAHAN: Prevent default action
                
                const articleId = this.getAttribute('data-edit-id');
                
                // Validasi articleId
                if (!articleId) {
                    alert('Invalid article ID');
                    return;
                }
                
                // Fetch article data
                fetch(`/about/${articleId}/edit`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const article = data.article;
                            
                            // Set form action
                            editForm.setAttribute('action', `/about/${articleId}`);
                            
                            // Fill form fields dengan validasi
                            const titleField = document.getElementById('edit-titlevideo');
                            const urlField = document.getElementById('edit-url');
                            
                            if (titleField) titleField.value = article.title || '';
                            if (urlField) urlField.value = article.url || '';
                            
                            // Clear previous errors
                            const errorContainer = document.getElementById('edit-errors');
                            if (errorContainer) {
                                errorContainer.classList.add('d-none');
                            }
                            
                        } else {
                            alert('Error loading article data: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error loading article data: ' + error.message);
                    });
            });
        });
        
        // TAMBAHAN: Handle form submission
        if (editForm) {
            editForm.addEventListener('submit', function(e) {
                const titleField = document.getElementById('edit-titlevideo');
                const urlField = document.getElementById('edit-url');
                
                if (!titleField.value.trim()) {
                    e.preventDefault();
                    alert('Title is required');
                    titleField.focus();
                    return;
                }
                
                if (!urlField.value.trim()) {
                    e.preventDefault();
                    alert('URL is required');
                    urlField.focus();
                    return;
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle edit modal
        const editLinks = document.querySelectorAll('.edit-metode');
        const editForm = document.getElementById('edit-form-metode');
        
        editLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const articleId = this.getAttribute('data-edit-id');
                
                fetch(`/about/${articleId}/editmetode`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const article = data.article;
                            
                            editForm.setAttribute('action', `/metode/${articleId}`);
                            
                            document.getElementById('edit-name').value = article.name;
                            document.getElementById('edit-progress').value = article.progress;
                            document.getElementById('edit-errors').classList.add('d-none');
                            
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
    // Script CKEditor untuk Galeri - diadaptasi dari script Article yang perfect
document.addEventListener('DOMContentLoaded', function() {
    let editCKEditor = null;
    let pendingDescription = '';
    
    // Initialize CKEditor untuk Add Galeri (yang biasa)
    if (typeof CKEDITOR !== 'undefined' && document.getElementById('description')) {
        CKEDITOR.replace('description', {
            height: 300,
            // Remove buttons yang bermasalah
            removeButtons: 'Image,Flash,Iframe,Smiley,ImageButton',
            // Remove plugins yang berhubungan dengan image
            removePlugins: 'image,image2,easyimage,cloudservices'
        });
    }
    
    // Handle edit modal
    const editLinks = document.querySelectorAll('.edit-galeri');
    const editForm = document.getElementById('edit-form-galeri');
    const editModal = document.getElementById('editgaleri'); // Perbaiki ID modal
    
    editLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const articleId = this.getAttribute('data-edit-id');
            
            // Fetch article data
            fetch(`/galeri/${articleId}/editgaleri`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const article = data.article;
                        
                        // Set form action
                        editForm.setAttribute('action', `/galeri/${articleId}`);
                        
                        // Fill form fields
                        document.getElementById('edit-title').value = article.title;
                        document.getElementById('edit-location').value = article.location;
                        
                        // Store description for later use
                        pendingDescription = article.description;
                        
                        // Set description in textarea immediately
                        document.getElementById('edit-description').value = article.description;
                        
                        // Show current image
                        const imagePreview = document.getElementById('current-image-preview');
                        if (article.image) {
                            imagePreview.innerHTML = `
                                <img src="{{ asset('storage/galeri/') }}/${article.image}" 
                                     alt="Current Image" width="150" class="rounded">
                            `;
                        } else {
                            imagePreview.innerHTML = '<p class="text-muted">No image</p>';
                        }
                        
                        // Clear previous errors
                        document.getElementById('edit-errors').classList.add('d-none');
                    } else {
                        alert('Error loading galeri data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading galeri data');
                });
        });
    });
    
    // Initialize CKEditor when modal is shown
    editModal.addEventListener('shown.bs.modal', function() {
        // Destroy existing CKEditor instance if exists
        if (editCKEditor) {
            if (typeof editCKEditor.destroy === 'function') {
                editCKEditor.destroy().then(() => {
                    initEditCKEditor();
                }).catch(error => {
                    console.error('Error destroying CKEditor:', error);
                    initEditCKEditor();
                });
            } else if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['edit-description']) {
                CKEDITOR.instances['edit-description'].destroy();
                editCKEditor = null;
                initEditCKEditor();
            }
        } else {
            initEditCKEditor();
        }
    });
    
    // Destroy CKEditor when modal is hidden
    editModal.addEventListener('hidden.bs.modal', function() {
        if (editCKEditor) {
            if (typeof editCKEditor.destroy === 'function') {
                editCKEditor.destroy().then(() => {
                    editCKEditor = null;
                }).catch(error => {
                    console.error('Error destroying CKEditor:', error);
                    editCKEditor = null;
                });
            } else if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances['edit-description']) {
                CKEDITOR.instances['edit-description'].destroy();
                editCKEditor = null;
            }
        }
    });
    
    function initEditCKEditor() {
        // Wait for modal animation to complete
        setTimeout(() => {
            // Check if CKEditor 5 is being used (ClassicEditor)
            if (typeof ClassicEditor !== 'undefined') {
                ClassicEditor
                    .create(document.querySelector('#edit-description'))
                    .then(editor => {
                        editCKEditor = editor;
                        // Set data after a short delay
                        setTimeout(() => {
                            if (pendingDescription) {
                                editor.setData(pendingDescription);
                            }
                        }, 100);
                    })
                    .catch(error => {
                        console.error('Error initializing CKEditor 5:', error);
                    });
            }
            // Check if CKEditor 4 is being used
            else if (typeof CKEDITOR !== 'undefined') {
                // Ensure textarea has the content
                if (pendingDescription) {
                    document.getElementById('edit-description').value = pendingDescription;
                }
                
                editCKEditor = CKEDITOR.replace('edit-description', {
                    height: 300,
                    // Remove buttons yang bermasalah
                    removeButtons: 'Image,Flash,Iframe,Smiley,ImageButton',
                    // Remove plugins yang berhubungan dengan image
                    removePlugins: 'image,image2,easyimage,cloudservices',
                    on: {
                        instanceReady: function(ev) {
                            // Multiple attempts to set data
                            setTimeout(() => {
                                if (pendingDescription) {
                                    ev.editor.setData(pendingDescription);
                                }
                            }, 100);
                            
                            setTimeout(() => {
                                if (pendingDescription) {
                                    ev.editor.setData(pendingDescription);
                                }
                            }, 500);
                        }
                    }
                });
            }
        }, 500); // Wait for modal to fully open
    }
});
</script>
<script>
    // Initialize CKEditor for edit modal
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('edit-description');
    }
</script>
@endsection