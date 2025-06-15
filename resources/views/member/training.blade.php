@extends('layouts.master')
@section('title')
    Workshop
@endsection

@section('content')
<!-- Preloader -->
<div id="preloader" class="position-fixed w-100 h-100 d-flex align-items-center justify-content-center" style="z-index: 10000; background: #fafafa;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="container-fluid">
    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Mobile Filter Content - Copy dari desktop filter -->
                    <div id="mobileFilterContent">
                        <!-- Categories Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Filter Categories</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action active mobile-category" data-category="all">All categories</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-category" data-category="cat-a">Category A</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-category" data-category="cat-b">Category B</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-category" data-category="cat-c">Category C</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-category" data-category="cat-d">Category D</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-category" data-category="cat-e">Category E</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-category" data-category="cat-f">Category F</a>
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Rating</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action active mobile-rating" data-rating="0">All Rating</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-rating" data-rating="1">⭐ Minimum 1 star</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-rating" data-rating="2">⭐⭐ Minimum 2 stars</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-rating" data-rating="3">⭐⭐⭐ Minimum 3 stars</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-rating" data-rating="4">⭐⭐⭐⭐ Minimum 4 stars</a>
                                <a href="#" class="list-group-item list-group-item-action mobile-rating" data-rating="5">⭐⭐⭐⭐⭐ 5 stars only</a>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Price Range</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" class="form-control" placeholder="From" id="mobilePriceFrom" value="0">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" placeholder="To" id="mobilePriceTo" value="1000000">
                                </div>
                            </div>
                        </div>

                        <!-- Tags Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Filter Tags</h6>
                            <div class="d-flex flex-wrap gap-2">
                                <div class="form-check">
                                    <input class="form-check-input mobile-tag" type="checkbox" value="tag-one" id="mobileTagOne" checked>
                                    <label class="form-check-label" for="mobileTagOne">Tag One</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input mobile-tag" type="checkbox" value="tag-two" id="mobileTagTwo" checked>
                                    <label class="form-check-label" for="mobileTagTwo">Tag Two</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input mobile-tag" type="checkbox" value="tag-three" id="mobileTagThree" checked>
                                    <label class="form-check-label" for="mobileTagThree">Tag Three</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input mobile-tag" type="checkbox" value="tag-four" id="mobileTagFour" checked>
                                    <label class="form-check-label" for="mobileTagFour">Tag Four</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="resetFilters()">Reset</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="applyFilters()">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Banner -->
    <div class="bg-light py-4 mb-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h1 class="display-6 fw-bold mb-3">Temukan Workshop dan Acara Terbaik</h1>
                    <p class="lead mb-4">Akses berbagai workshop medis berkualitas</p>
                    <div class="search-box">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="ri-search-line"></i></span>
                            <input type="text" class="form-control" placeholder="Masukkan kata kunci workshop ..." id="searchProduct">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Filter (Desktop) -->
            <div class="col-lg-3 col-md-4 d-none d-md-block">
                <div class="card">
                    <div class="card-body">
                        <!-- Categories Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Filter Categories</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action active desktop-category" data-category="all">All categories</a>
                                @foreach ($category as $item)
                                    <a href="#" class="list-group-item list-group-item-action desktop-category" data-category="{{ $item->name }}">{{ $item->name }}</a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Rating Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Rating</h6>
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action active desktop-rating" data-rating="0">All Rating</a>
                                <a href="#" class="list-group-item list-group-item-action desktop-rating" data-rating="1">
                                    <div class="d-flex flex-column">
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                            <i class="far fa-star text-muted"></i>
                                            <i class="far fa-star text-muted"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                        <small>Minimum 1 star rating</small>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action desktop-rating" data-rating="2">
                                    <div class="d-flex flex-column">
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                            <i class="far fa-star text-muted"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                        <small>Minimum 2 star rating</small>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action desktop-rating" data-rating="3">
                                    <div class="d-flex flex-column">
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                        <small>Minimum 3 star rating</small>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action desktop-rating" data-rating="4">
                                    <div class="d-flex flex-column">
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="far fa-star text-muted"></i>
                                        </div>
                                        <small>Minimum 4 star rating</small>
                                    </div>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action desktop-rating" data-rating="5">
                                    <div class="d-flex flex-column">
                                        <div class="stars">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <small>Minimum 5 star rating</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Price Range</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="number" class="form-control" placeholder="From" id="priceFrom" value="0">
                                </div>
                                <div class="col-6">
                                    <input type="number" class="form-control" placeholder="To" id="priceTo" value="1000000">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm mt-2 w-100" onclick="applyPriceFilter()">Apply</button>
                        </div>

                        <!-- Tags Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Filter Tags</h6>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($tags as $item)
                                    <div class="form-check">
                                        <input class="form-check-input desktop-tag" type="checkbox" value="{{ $item->name }}" id="{{ $item->name }}" checked>
                                        <label class="form-check-label" for="{{ $item->name }}">{{ $item->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <button class="btn btn-secondary btn-sm mt-2 w-100" onclick="resetFilters()">Reset All</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Section -->
            <div class="col-lg-9 col-md-8">
                <!-- Sort and View Controls -->
                <div class="row align-items-center mb-4">
                    <div class="col-md-6">
                        <h4 class="mb-0"><span id="resultCount">6</span> Items Found</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end align-items-center gap-3">
                            <!-- Mobile Filter Button -->
                            <button class="btn btn-outline-primary d-md-none" data-bs-toggle="modal" data-bs-target="#filterModal">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                                                        
                            <!-- Sort Dropdown -->
                            <select class="form-select" style="width: auto;" id="sortBy">
                                <option value="">Sort By:</option>
                                <option value="title-asc">Title A to Z</option>
                                <option value="title-desc">Title Z to A</option>
                                <option value="price-asc">Price Low to High</option>
                                <option value="price-desc">Price High to Low</option>
                                <option value="rating-desc">Rating High to Low</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row" id="productsContainer">
                    <!-- Product 1 -->
                    @foreach ($workshops as $item)
                        @php
                            $tags = $tagworkshops->where('workshop_id', $item->id)->pluck('name')->implode(', ');
                            $rate = collect($ratings)->where('workshop_id', $item->id)->pluck('rounded_rating')->implode(', ');
                        @endphp
                        <div class="col-lg-4 col-md-6 mb-4 product-item" 
                            data-category="{{$item->name}}" 
                            data-rating="{{ $rate }}" 
                            data-price="{{ number_format($item->price, 2) }}" 
                            data-tags="{{ $tags }}" 
                            data-title="{{$item->title}}">
                            <div class="card h-100 product-card">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/workshops/'.$item->image) }}" class="card-img-top" alt="Product" style="height: 200px; object-fit: cover;">
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{$item->title}}</h6>                                    
                                    <p class="card-text text-muted small">Category: {{ $item->name }} • Tag: {{ $tags }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rate)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-muted"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <strong class="text-primary">Rp. {{ number_format($item->price, 0, ',', '.') }}</strong>
                                        </div>
                                        <a href="{{ route('workshop.index', $item->id) }}" class="btn btn-outline-primary w-100">See Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- No Results Message -->
                <div id="noResults" class="text-center py-5" style="display: none;">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>No products found</h4>
                    <p class="text-muted">Try adjusting your filters or search terms</p>
                    <button class="btn btn-primary" onclick="resetFilters()">Reset Filters</button>
                </div>

                <!-- Pagination -->
                <nav aria-label="Products pagination" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<style>
.product-card {
    transition: transform 0.2s, box-shadow 0.2s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.stars i {
    font-size: 0.9rem;
}

#preloader {
    transition: opacity 0.3s ease;
}

.search-box {
    max-width: 500px;
    margin: 0 auto;
}

.product-item {
    transition: all 0.3s ease;
}

.product-item.hidden {
    display: none !important;
}

@media (max-width: 768px) {
    .hero-banner {
        padding: 2rem 0;
    }
    
    .display-5 {
        font-size: 1.5rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hide preloader
    setTimeout(function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 300);
        }
    }, 1000);

    // Pagination configuration
    const itemsPerPage = 9;
    let currentPage = 1;
    let filteredProducts = [];

    // Global filter state
    let currentFilters = {
        category: 'all',
        rating: 0,
        priceFrom: 0,
        priceTo: 1000000,
        tags: ['Dokter Umum', 'Dokter Spesialis', 'Mahasiswa'],
        search: ''
    };

    // Search functionality
    const searchInput = document.getElementById('searchProduct');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentFilters.search = this.value.toLowerCase();
            applyFilters();
        });
    }

    // Desktop Category filter functionality
    document.querySelectorAll('.desktop-category').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all category links
            document.querySelectorAll('.desktop-category').forEach(l => {
                l.classList.remove('active');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Update filter and apply
            currentFilters.category = this.dataset.category;
            syncMobileFilters();
            applyFilters();
        });
    });

    // Desktop Rating filter functionality
    document.querySelectorAll('.desktop-rating').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all rating links
            document.querySelectorAll('.desktop-rating').forEach(l => {
                l.classList.remove('active');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Update filter and apply
            currentFilters.rating = parseInt(this.dataset.rating);
            syncMobileFilters();
            applyFilters();
        });
    });

    // Desktop Tags filter functionality
    document.querySelectorAll('.desktop-tag').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateTagsFilter();
            syncMobileFilters();
            applyFilters();
        });
    });

    // Mobile Category filter functionality
    document.querySelectorAll('.mobile-category').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all mobile category links
            document.querySelectorAll('.mobile-category').forEach(l => {
                l.classList.remove('active');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Update filter
            currentFilters.category = this.dataset.category;
            syncDesktopFilters();
        });
    });

    // Mobile Rating filter functionality
    document.querySelectorAll('.mobile-rating').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all mobile rating links
            document.querySelectorAll('.mobile-rating').forEach(l => {
                l.classList.remove('active');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Update filter
            currentFilters.rating = parseInt(this.dataset.rating);
            syncDesktopFilters();
        });
    });

    // Mobile Tags filter functionality
    document.querySelectorAll('.mobile-tag').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateTagsFilterMobile();
            syncDesktopFilters();
        });
    });

    // Sort functionality
    const sortBy = document.getElementById('sortBy');
    if (sortBy) {
        sortBy.addEventListener('change', function() {
            sortProducts(this.value);
        });
    }

    // Price filter inputs
    const priceFrom = document.getElementById('priceFrom');
    const priceTo = document.getElementById('priceTo');
    
    if (priceFrom && priceTo) {
        priceFrom.addEventListener('change', function() {
            currentFilters.priceFrom = parseInt(this.value) || 0;
            document.getElementById('mobilePriceFrom').value = this.value;
            applyFilters();
        });
        
        priceTo.addEventListener('change', function() {
            currentFilters.priceTo = parseInt(this.value) || 1000000;
            document.getElementById('mobilePriceTo').value = this.value;
            applyFilters();
        });
    }

    // Mobile price filter inputs
    const mobilePriceFrom = document.getElementById('mobilePriceFrom');
    const mobilePriceTo = document.getElementById('mobilePriceTo');
    
    if (mobilePriceFrom && mobilePriceTo) {
        mobilePriceFrom.addEventListener('change', function() {
            currentFilters.priceFrom = parseInt(this.value) || 0;
            document.getElementById('priceFrom').value = this.value;
        });
        
        mobilePriceTo.addEventListener('change', function() {
            currentFilters.priceTo = parseInt(this.value) || 1000000;
            document.getElementById('priceTo').value = this.value;
        });
    }

    // Helper functions
    function updateTagsFilter() {
        const checkedTags = [];
        document.querySelectorAll('.desktop-tag:checked').forEach(checkbox => {
            checkedTags.push(checkbox.value);
        });
        currentFilters.tags = checkedTags;
    }

    function updateTagsFilterMobile() {
        const checkedTags = [];
        document.querySelectorAll('.mobile-tag:checked').forEach(checkbox => {
            checkedTags.push(checkbox.value);
        });
        currentFilters.tags = checkedTags;
    }

    function syncMobileFilters() {
        // Sync category
        document.querySelectorAll('.mobile-category').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.category === currentFilters.category) {
                link.classList.add('active');
            }
        });

        // Sync rating
        document.querySelectorAll('.mobile-rating').forEach(link => {
            link.classList.remove('active');
            if (parseInt(link.dataset.rating) === currentFilters.rating) {
                link.classList.add('active');
            }
        });

        // Sync tags
        document.querySelectorAll('.mobile-tag').forEach(checkbox => {
            checkbox.checked = currentFilters.tags.includes(checkbox.value);
        });

        // Sync price
        document.getElementById('mobilePriceFrom').value = currentFilters.priceFrom;
        document.getElementById('mobilePriceTo').value = currentFilters.priceTo;
    }

    function syncDesktopFilters() {
        // Sync category
        document.querySelectorAll('.desktop-category').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.category === currentFilters.category) {
                link.classList.add('active');
            }
        });

        // Sync rating
        document.querySelectorAll('.desktop-rating').forEach(link => {
            link.classList.remove('active');
            if (parseInt(link.dataset.rating) === currentFilters.rating) {
                link.classList.add('active');
            }
        });

        // Sync tags
        document.querySelectorAll('.desktop-tag').forEach(checkbox => {
            checkbox.checked = currentFilters.tags.includes(checkbox.value);
        });

        // Sync price
        document.getElementById('priceFrom').value = currentFilters.priceFrom;
        document.getElementById('priceTo').value = currentFilters.priceTo;
    }

    function applyFilters() {
        const products = document.querySelectorAll('.product-item');
        filteredProducts = [];

        products.forEach(product => {
            let isVisible = true;

            // Category filter
            if (currentFilters.category !== 'all') {
                if (product.dataset.category !== currentFilters.category) {
                    isVisible = false;
                }
            }

            // Rating filter
            if (currentFilters.rating > 0) {
                const productRating = parseInt(product.dataset.rating);
                if (productRating < currentFilters.rating) {
                    isVisible = false;
                }
            }

            // Price filter
            const productPrice = parseInt(product.dataset.price);
            if (productPrice < currentFilters.priceFrom || productPrice > currentFilters.priceTo) {
                isVisible = false;
            }

            // Tags filter
            if (currentFilters.tags.length > 0) {
                const productTags = product.dataset.tags.split(',');
                const hasMatchingTag = currentFilters.tags.some(tag => productTags.includes(tag));
                if (!hasMatchingTag) {
                    isVisible = false;
                }
            }

            // Search filter
            if (currentFilters.search) {
                const title = product.dataset.title.toLowerCase();
                const category = product.dataset.category.toLowerCase();
                const tags = product.dataset.tags.toLowerCase();
                
                if (!title.includes(currentFilters.search) && 
                    !category.includes(currentFilters.search) && 
                    !tags.includes(currentFilters.search)) {
                    isVisible = false;
                }
            }

            // Collect filtered products
            if (isVisible) {
                filteredProducts.push(product);
            }
        });

        // Reset to first page when filters change
        currentPage = 1;
        
        // Update display
        updateProductDisplay();
        updatePagination();
    }

    function updateProductDisplay() {
        // Hide all products first
        document.querySelectorAll('.product-item').forEach(product => {
            product.classList.add('hidden');
        });

        // Calculate pagination
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentPageProducts = filteredProducts.slice(startIndex, endIndex);

        // Show current page products
        currentPageProducts.forEach(product => {
            product.classList.remove('hidden');
        });

        // Update result count
        document.getElementById('resultCount').textContent = filteredProducts.length;

        // Show/hide no results message
        const noResults = document.getElementById('noResults');
        if (filteredProducts.length === 0) {
            noResults.style.display = 'block';
        } else {
            noResults.style.display = 'none';
        }
    }

    function updatePagination() {
        const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
        const paginationContainer = document.querySelector('.pagination');
        
        if (!paginationContainer) return;

        // Clear existing pagination
        paginationContainer.innerHTML = '';

        // Hide pagination if only one page or no results
        if (totalPages <= 1) {
            paginationContainer.parentNode.style.display = 'none';
            return;
        } else {
            paginationContainer.parentNode.style.display = 'block';
        }

        // Previous button
        const prevItem = document.createElement('li');
        prevItem.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
        prevItem.innerHTML = `<a class="page-link" href="#" ${currentPage === 1 ? 'tabindex="-1" aria-disabled="true"' : ''}>Previous</a>`;
        
        if (currentPage > 1) {
            prevItem.querySelector('.page-link').addEventListener('click', function(e) {
                e.preventDefault();
                currentPage--;
                updateProductDisplay();
                updatePagination();
            });
        }
        paginationContainer.appendChild(prevItem);

        // Calculate page range to show
        let startPage = Math.max(1, currentPage - 2);
        let endPage = Math.min(totalPages, currentPage + 2);

        // Adjust range if we're near the beginning or end
        if (currentPage <= 3) {
            endPage = Math.min(5, totalPages);
        }
        if (currentPage >= totalPages - 2) {
            startPage = Math.max(1, totalPages - 4);
        }

        // First page and ellipsis
        if (startPage > 1) {
            const firstItem = document.createElement('li');
            firstItem.className = 'page-item';
            firstItem.innerHTML = '<a class="page-link" href="#">1</a>';
            firstItem.querySelector('.page-link').addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = 1;
                updateProductDisplay();
                updatePagination();
            });
            paginationContainer.appendChild(firstItem);

            if (startPage > 2) {
                const ellipsisItem = document.createElement('li');
                ellipsisItem.className = 'page-item disabled';
                ellipsisItem.innerHTML = '<span class="page-link">...</span>';
                paginationContainer.appendChild(ellipsisItem);
            }
        }

        // Page numbers
        for (let i = startPage; i <= endPage; i++) {
            const pageItem = document.createElement('li');
            pageItem.className = `page-item ${i === currentPage ? 'active' : ''}`;
            pageItem.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            
            if (i !== currentPage) {
                pageItem.querySelector('.page-link').addEventListener('click', function(e) {
                    e.preventDefault();
                    currentPage = i;
                    updateProductDisplay();
                    updatePagination();
                });
            }
            paginationContainer.appendChild(pageItem);
        }

        // Last page and ellipsis
        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                const ellipsisItem = document.createElement('li');
                ellipsisItem.className = 'page-item disabled';
                ellipsisItem.innerHTML = '<span class="page-link">...</span>';
                paginationContainer.appendChild(ellipsisItem);
            }

            const lastItem = document.createElement('li');
            lastItem.className = 'page-item';
            lastItem.innerHTML = `<a class="page-link" href="#">${totalPages}</a>`;
            lastItem.querySelector('.page-link').addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = totalPages;
                updateProductDisplay();
                updatePagination();
            });
            paginationContainer.appendChild(lastItem);
        }

        // Next button
        const nextItem = document.createElement('li');
        nextItem.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
        nextItem.innerHTML = `<a class="page-link" href="#">Next</a>`;
        
        if (currentPage < totalPages) {
            nextItem.querySelector('.page-link').addEventListener('click', function(e) {
                e.preventDefault();
                currentPage++;
                updateProductDisplay();
                updatePagination();
            });
        }
        paginationContainer.appendChild(nextItem);
    }

    function sortProducts(sortType) {
        if (!sortType) return;

        filteredProducts.sort((a, b) => {
            switch (sortType) {
                case 'title-asc':
                    return a.dataset.title.localeCompare(b.dataset.title);
                case 'title-desc':
                    return b.dataset.title.localeCompare(a.dataset.title);
                case 'price-asc':
                    return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                case 'price-desc':
                    return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                case 'rating-desc':
                    return parseInt(b.dataset.rating) - parseInt(a.dataset.rating);
                default:
                    return 0;
            }
        });

        // Reset to first page after sorting
        currentPage = 1;
        updateProductDisplay();
        updatePagination();
    }

    // Global functions for buttons
    window.applyFilters = function() {
        applyFilters();
    };

    window.applyPriceFilter = function() {
        currentFilters.priceFrom = parseInt(document.getElementById('priceFrom').value) || 0;
        currentFilters.priceTo = parseInt(document.getElementById('priceTo').value) || 1000000;
        syncMobileFilters();
        applyFilters();
    };

    window.resetFilters = function() {
        // Reset filter state
        currentFilters = {
            category: 'all',
            rating: 0,
            priceFrom: 0,
            priceTo: 1000000,
            tags: ['Dokter Umum', 'Dokter Spesialis', 'Mahasiswa'],
            search: ''
        };

        // Reset UI elements
        document.getElementById('searchProduct').value = '';
        document.getElementById('priceFrom').value = '0';
        document.getElementById('priceTo').value = '1000000';
        document.getElementById('mobilePriceFrom').value = '0';
        document.getElementById('mobilePriceTo').value = '1000000';
        document.getElementById('sortBy').value = '';

        // Reset desktop filters
        document.querySelectorAll('.desktop-category').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.category === 'all') {
                link.classList.add('active');
            }
        });

        document.querySelectorAll('.desktop-rating').forEach(link => {
            link.classList.remove('active');
            if (link.dataset.rating === '0') {
                link.classList.add('active');
            }
        });

        document.querySelectorAll('.desktop-tag').forEach(checkbox => {
            checkbox.checked = true;
        });

        // Reset mobile filters
        syncMobileFilters();

        // Reset page to 1
        currentPage = 1;

        // Apply filters
        applyFilters();
    };

    // Function to go to specific page (for external use)
    window.goToPage = function(page) {
        const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
        if (page >= 1 && page <= totalPages) {
            currentPage = page;
            updateProductDisplay();
            updatePagination();
        }
    };

    // Initial load
    applyFilters();
});
</script>
@endsection