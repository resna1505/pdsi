@extends('layouts.master')
@section('title')
    Product Detail
@endsection
@section('content')    
    <div class="container-fluid" id="app">            
            <!-- ##### PRODUCT DETAIL SECTION ##### -->
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-4">
                <!-- Product Image Carousel -->
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('storage/workshops/' . $workshops->image) }}" class="d-block rounded" alt="Product Image 1" width="700" height="400">

                        </div>
                        {{-- <div class="carousel-item">
                            <img src="https://placehold.co/1050x700/DCEDC8/767676/" class="d-block w-100 rounded" alt="Product Image 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://placehold.co/1050x700/E1BEE7/767676/" class="d-block w-100 rounded" alt="Product Image 3">
                        </div>
                        <div class="carousel-item">
                            <img src="https://placehold.co/1050x700/BBDEFB/767676/" class="d-block w-100 rounded" alt="Product Image 4">
                        </div>
                        <div class="carousel-item">
                            <img src="https://placehold.co/1050x700/388E3C/FFFFFF/" class="d-block w-100 rounded" alt="Product Image 5">
                        </div>
                        <div class="carousel-item">
                            <img src="https://placehold.co/1050x700/651FFF/FFFFFF/" class="d-block w-100 rounded" alt="Product Image 6">
                        </div> --}}
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
            
            <div class="col-lg-6 col-md-6">
                <div class="product-info">
                    <h6 class="text-muted">{{ $workshops->tagline }}</h6>
                    <h2 class="fw-bold mb-3">{{ $workshops->title }}</h2>                    
                    @php
                        $rate = collect($ratings)->pluck('rounded_rating')->implode(', ');
                    @endphp
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning me-2">
                             @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rate)
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-muted"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="fw-bold me-2">{{ $ratings[0]->rounded_rating ?? 0 }}</span>
                        <span class="text-muted">| 213 Sales</span>
                    </div>
                    
                    <!-- Description -->
                    <p class="text-muted mb-4">{{ $workshops->short_description }}</p>
                    
                    <!-- Action Buttons -->
                    <div class="d-flex gap-3">
                        {{-- <button class="btn btn-outline-primary rounded-pill">Add to Wishlist</button> --}}
                        <button class="btn btn-primary rounded-pill">Daftar & Bayar Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ##### DESCRIPTION SECTION ##### -->
        <div class="row py-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="fw-bold mb-4">Description</h4>
                        {!! $workshops->description !!}
                        
                        <!-- Social Actions -->
                        <div class="d-flex gap-3">
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-share-alt me-2"></i>Share
                            </button>
                            <button class="btn btn-outline-secondary">
                                <i class="fas fa-star me-2"></i>Rate this
                            </button>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="product-properties">
                            @foreach ($property as $item)
                                <h6 class="fw-bold">{{ $item->name }}</h6>
                                <p class="text-muted mb-3">{{ $item->value }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ##### RELATED PRODUCTS SECTION ##### -->
        <div class="row py-5">
            <div class="col-12">
                <h4 class="fw-bold mb-4">Related Products</h4>
                <div class="row g-4">
                    <!-- Product Card 1 -->
                    @foreach ($related as $item)
                        @php
                            $rate = collect($ratings)->where('workshop_id', $item->id)->pluck('rounded_rating')->implode(', ');
                        @endphp
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card h-100">
                                <img src="{{ asset('storage/workshops/'.$item->image) }}" class="card-img-top" alt="Product">
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title">{{ $item->title }}</h6>
                                    <p class="card-text text-muted flex-grow-1">{{ \Illuminate\Support\Str::limit(strip_tags($item->description), 50) }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $rate)
                                                    <i class="fas fa-star text-warning"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <strong>Rp. {{ number_format($item->price, 0, ',', '.') }}</strong>
                                    </div>
                                    <a href="{{ route('workshop.index', $item->id) }}" class="btn btn-outline-primary w-100">See Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach                                        
                </div>
            </div>
        </div>
        
        <!-- ##### COMMENTS SECTION ##### -->
        <div class="row py-5">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="fw-bold mb-4">Comments</h4>
                        
                        <!-- Comment Form -->
                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/images/users/' . Auth::user()->anggota->avatar) }}" alt="Avatar" class="rounded-circle me-3" width="40" height="40">
                                        <div class="flex-grow-1">
                                            <div class="input-group">
                                                <input type="text" name="content" class="form-control" placeholder="Write Comments" required>
                                                <input type="hidden" name="workshop_id" value="{{ $workshops->id }}">
                                                <button class="btn btn-primary" type="submit">
                                                    <span class="d-none d-sm-inline">Send Message</span>
                                                    <i class="fas fa-paper-plane d-sm-none"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="comments-list">
                            @foreach ($comments as $item)
                                <div class="d-flex mb-4">
                                    <img src="{{ asset('storage/images/users/' . $item->avatar) }}" alt="John Doe" class="rounded-circle me-3" width="40" height="40">
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h6 class="fw-bold mb-0">{{ $item->nama }}</h6>
                                            <small class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</small>
                                        </div>
                                        <p class="mb-0">{{ $item->content }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach                            
                        </div>
                    </div>
                    
                    <!-- Sidebar Actions -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="list-group list-group-flush">
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="fas fa-info-circle text-primary me-3"></i>
                                    <span>Laporkan Data Tidak Valid</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                                    <i class="fas fa-question-circle text-primary me-3"></i>
                                    <span>Laporkan Pelanggaran Etika</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="{{ URL::asset('build/libs/tom-select/js/tom-select.base.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
@endsection