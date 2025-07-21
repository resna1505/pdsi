@extends('layouts.master')
@section('title')
Testimonial Management
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/glightbox/css/glightbox.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .rating-stars {
        color: #ffc107;
        font-size: 1.2rem;
    }
</style>
@endsection
@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        {{ session('error') }}
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
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-auto ms-auto">
                        <div class="list-grid-nav hstack gap-1">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
                                <i class="ri-add-fill me-1 align-bottom"></i> Add Testimonial
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-xxl-12 testimonial-lists">
                        @foreach($testimonials as $testimonial)
                            <div class="list-element">
                                <div class="d-flex flex-column flex-sm-row mb-5">
                                    <div class="flex-shrink-0">
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 200px; height: 150px;">
                                            <div class="text-center">
                                                <div class="rating-stars mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $testimonial->rating)
                                                            <i class="ri-star-fill"></i>
                                                        @else
                                                            <i class="ri-star-line"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h6 class="text-muted">{{ $testimonial->rating }}/5 Stars</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                        <div class="position-relative">
                                            <h5 class="mb-3">{{ $testimonial->anggota_name }}</h5>
                                            <p class="text-muted mb-2">{{ $testimonial->testimonial_text }}</p>
                                        </div>
                                        <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                            <li>
                                                <span class="badge {{ $testimonial->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </li>
                                            <li>
                                                <i class="ph-clock-bold align-middle"></i>
                                                {{ $testimonial->created_at->diffForHumans() }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col text-end dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-17"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            @if($testimonial->anggota_id == auth()->id())
                                                <li>
                                                    <a class="dropdown-item edit-testimonial" href="#editTestimonial" 
                                                       data-bs-toggle="modal" data-edit-id="{{ $testimonial->id }}">
                                                        <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item remove-testimonial" href="#removeTestimonialModal" 
                                                       data-bs-toggle="modal" data-remove-id="{{ $testimonial->id }}">
                                                        <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Testimonial Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Add Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('testimonial.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select class="form-select @error('rating') is-invalid @enderror" 
                                    name="rating" id="rating" required>
                                <option value="">Select Rating...</option>
                                <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5 Stars)</option>
                                <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4 Stars)</option>
                                <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3 Stars)</option>
                                <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2 Stars)</option>
                                <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>⭐ (1 Star)</option>
                            </select>
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="testimonial_text" class="form-label">Testimonial Text</label>
                            <textarea name="testimonial_text" id="testimonial_text" 
                                      class="form-control @error('testimonial_text') is-invalid @enderror" 
                                      rows="5" placeholder="Bagikan pengalaman Anda..." required>{{ old('testimonial_text') }}</textarea>
                            @error('testimonial_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Testimonial</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Testimonial Modal -->
<div class="modal fade" id="editTestimonial" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Edit Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" id="edit-form" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="edit-rating" class="form-label">Rating</label>
                            <select class="form-select" name="rating" id="edit-rating" required>
                                <option value="">Select Rating...</option>
                                <option value="5">⭐⭐⭐⭐⭐ (5 Stars)</option>
                                <option value="4">⭐⭐⭐⭐ (4 Stars)</option>
                                <option value="3">⭐⭐⭐ (3 Stars)</option>
                                <option value="2">⭐⭐ (2 Stars)</option>
                                <option value="1">⭐ (1 Star)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit-testimonial-text" class="form-label">Testimonial Text</label>
                            <textarea name="testimonial_text" id="edit-testimonial-text" 
                                      class="form-control" rows="5" placeholder="Bagikan pengalaman Anda..." required></textarea>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Testimonial</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Testimonial Modal -->
<div id="removeTestimonialModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" 
                               colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this testimonial ?</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-sm btn-danger">Yes, Delete It!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="{{ URL::asset('build/libs/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script>
    // Search functionality
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        
        if (searchInput) {
            searchInput.addEventListener("input", function() {
                const keyword = this.value.toLowerCase();
                const items = document.querySelectorAll(".list-element");
                
                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    const match = text.includes(keyword);
                    item.style.display = match ? "block" : "none";
                });
            });
        }
    });

    // Handle edit modal
    document.addEventListener('DOMContentLoaded', function() {
        const editLinks = document.querySelectorAll('.edit-testimonial');
        const editForm = document.getElementById('edit-form');
        
        editLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const testimonialId = this.getAttribute('data-edit-id');
                
                if (!testimonialId) {
                    alert('Invalid testimonial ID');
                    return;
                }
                
                fetch(`/testimonial/${testimonialId}/edit`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const testimonial = data.testimonial;
                            
                            editForm.setAttribute('action', `/testimonial/${testimonialId}`);
                            
                            document.getElementById('edit-rating').value = testimonial.rating || '';
                            document.getElementById('edit-testimonial-text').value = testimonial.testimonial_text || '';
                            
                        } else {
                            alert('Error loading testimonial data: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error loading testimonial data: ' + error.message);
                    });
            });
        });
    });

    // Handle delete modal
    document.addEventListener('DOMContentLoaded', function() {
        const removeLinks = document.querySelectorAll('.remove-testimonial');
        const deleteForm = document.getElementById('deleteForm');
        
        removeLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const testimonialId = this.getAttribute('data-remove-id');
                const actionUrl = `/testimonial/${testimonialId}`;
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    });
</script>
@endsection