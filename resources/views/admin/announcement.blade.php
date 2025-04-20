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
                </div>
                <div class="mt-4">
                    @php use Illuminate\Support\Str; @endphp

                    <ul class="nav nav-tabs nav-tabs-custom nav-secondary" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#all" role="tab" aria-selected="false">
                                All Results
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a class="nav-link" 
                                data-bs-toggle="tab" 
                                id="{{ Str::slug($category->name) }}-tab" 
                                href="#{{ Str::slug($category->name) }}" 
                                role="tab" 
                                aria-selected="false">
                                    {{ $category->name }}
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
                                @forelse ($allArticles as $article)
                                    <div class="list-element">
                                        <div class="d-flex flex-column flex-sm-row mb-5">
                                            <div class="flex-shrink-0">
                                                <iframe 
                                                    src="{{ $article->video_url }}" 
                                                    title="YouTube video" 
                                                    allowfullscreen 
                                                    class="rounded">
                                                </iframe>
                                            </div>
                                            <a href="{{ route('announcement.show', $article->id) }}" class="text-decoration-none text-reset">
                                                <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                    <div class="position-relative">
                                                        <h5 class="mb-3">{{ $article->title }}</h5>
                                                    </div>
                                                    <p class="text-muted mb-2">
                                                        {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 300, '...') }}
                                                    </p>
                                                        <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                        <li>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0">
                                                                    <i class="ri-user-line"></i>
                                                                </div>
                                                                <div class="flex-grow-1 fs-13 ms-1">
                                                                    {{ $article->author }}
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li><i class="ph-clock-bold align-middle"></i> {{ $article->created_at->diffForHumans() }}</li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-muted">Belum ada artikel tersedia.</p>
                                @endforelse
                            </div>
                    
                            <div class="d-flex align-items-center border-top pt-3">
                                <div class="flex-grow-1">
                                    <div class="text-muted pagination-info mb-2"></div>
                                </div>
                                <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                            </div>
                        </div>
                    </div>                    
                    
                    @foreach ($categories as $category)
                        <div class="tab-pane fade" id="{{ Str::slug($category->name) }}" role="tabpanel">
                            <p class="text-muted mb-4">Showing results for <span id="searchKeyword"></span></p>
                            <div class="row">
                                <div class="col-xxl-8 video-lists">
                                    @forelse ($category->articles as $article)
                                        <div class="list-element">
                                            <div class="d-flex flex-column flex-sm-row mb-5">
                                                <div class="flex-shrink-0">
                                                    <iframe 
                                                        src="{{ $article->video_url }}" 
                                                        title="YouTube video" 
                                                        allowfullscreen 
                                                        class="rounded">
                                                    </iframe>
                                                </div>
                                                <a href="{{ route('announcement.show', $article->id) }}" class="text-decoration-none text-reset">
                                                    <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                                        <div class="position-relative">
                                                            <h5 class="mb-3">{{ $article->title }}</h5>
                                                        </div>
                                                        <p class="text-muted mb-2">
                                                            {{ \Illuminate\Support\Str::limit(strip_tags($article->description), 300, '...') }}
                                                        </p>
                                                        <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                                            <li>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-shrink-0">
                                                                        <i class="ri-user-line"></i>
                                                                    </div>
                                                                    <div class="flex-grow-1 fs-13 ms-1">
                                                                        {{ $article->author }}
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li><i class="ph-clock-bold align-middle"></i> {{ $article->created_at->diffForHumans() }}</li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-muted">Belum ada artikel di kategori ini.</p>
                                    @endforelse
                                </div>
                                <div class="d-flex align-items-center border-top pt-3">
                                    <div class="flex-grow-1">
                                        <div class="text-muted pagination-info mb-2"></div>
                                    </div>
                                    <ul class="pagination pagination-separated justify-content-center mb-0"></ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/search-result.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
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
                link.addEventListener("shown.bs.tab", function () {
                    const targetId = this.getAttribute("href");
                    const targetPane = document.querySelector(targetId);
                    if (targetPane) initPagination(targetPane);
                });
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("searchInput");
            const searchKeyword = document.getElementById("searchKeyword");
        
            if (searchInput) {
                searchInput.addEventListener("input", function () {
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
