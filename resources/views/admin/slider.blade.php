@extends('layouts.master')
@section('title')
Slider Management
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
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addSliderModal">
                                <i class="ri-add-fill me-1 align-bottom"></i> Add Slider
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-xxl-12 slider-lists">
                        @foreach($sliders as $slider)
                            <div class="list-element">
                                <div class="d-flex flex-column flex-sm-row mb-5">
                                    <div class="flex-shrink-0">
                                        @if($slider->image)
                                            <img src="{{ asset('storage/sliders/' . $slider->image) }}" 
                                                 alt="{{ $slider->title }}" width="200" height="150" class="rounded" />
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 200px; height: 150px;">
                                                <i class="ri-image-line fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                        <div class="position-relative">
                                            <h5 class="mb-3">{{ $slider->title }}</h5>
                                            <p class="text-muted mb-2">{{ $slider->sub_title }}</p>
                                            <div class="mb-2">
                                                <strong>Banner Title:</strong> {{ $slider->title_banner }}
                                            </div>
                                            <div class="mb-2">
                                                <strong>Banner Subtitle:</strong> {{ $slider->sub_title_banner }}
                                            </div>
                                        </div>
                                        <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                            <li>
                                                <span class="badge {{ $slider->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $slider->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </li>
                                            <li>
                                                <i class="ph-clock-bold align-middle"></i>
                                                {{ $slider->created_at->diffForHumans() }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col text-end dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="ri-more-2-fill fs-17"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item edit-slider" href="#editSlider" 
                                                   data-bs-toggle="modal" data-edit-id="{{ $slider->id }}">
                                                    <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('slider.toggleStatus', $slider->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="ri-toggle-line me-2 align-bottom text-muted"></i>
                                                        {{ $slider->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item remove-slider" href="#removeSliderModal" 
                                                   data-bs-toggle="modal" data-remove-id="{{ $slider->id }}">
                                                    <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                </a>
                                            </li>
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

<!-- Add Slider Modal -->
<div class="modal fade" id="addSliderModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Add Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   name="image" id="image" accept="image/*" required>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="title_banner" class="form-label">Title Banner</label>
                            <input type="text" class="form-control @error('title_banner') is-invalid @enderror" 
                                   id="title_banner" name="title_banner" value="{{ old('title_banner') }}" required>
                            @error('title_banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="sub_title" class="form-label">Sub Title</label>
                            <textarea name="sub_title" id="sub_title" 
                                      class="form-control @error('sub_title') is-invalid @enderror" 
                                      rows="3" required>{{ old('sub_title') }}</textarea>
                            @error('sub_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="sub_title_banner" class="form-label">Sub Title Banner</label>
                            <textarea name="sub_title_banner" id="sub_title_banner" 
                                      class="form-control @error('sub_title_banner') is-invalid @enderror" 
                                      rows="3" required>{{ old('sub_title_banner') }}</textarea>
                            @error('sub_title_banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" 
                                       id="is_active" value="1" checked>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Add Slider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Slider Modal -->
<div class="modal fade" id="editSlider" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Edit Slider</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" enctype="multipart/form-data" id="edit-form" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Current Image</label>
                            <div id="current-image-preview"></div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit-image" class="form-label">New Image (optional)</label>
                            <input type="file" class="form-control" name="image" id="edit-image" accept="image/*">
                            <small class="text-muted">Leave empty to keep current image</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="edit-title-banner" class="form-label">Title Banner</label>
                            <input type="text" class="form-control" id="edit-title-banner" name="title_banner" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit-sub-title" class="form-label">Sub Title</label>
                            <textarea name="sub_title" id="edit-sub-title" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit-sub-title-banner" class="form-label">Sub Title Banner</label>
                            <textarea name="sub_title_banner" id="edit-sub-title-banner" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit-is-active" value="1">
                                <label class="form-check-label" for="edit-is-active">
                                    Active
                                </label>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Update Slider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Slider Modal -->
<div id="removeSliderModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this slider ?</p>
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
        const editLinks = document.querySelectorAll('.edit-slider');
        const editForm = document.getElementById('edit-form');
        
        editLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const sliderId = this.getAttribute('data-edit-id');
                
                if (!sliderId) {
                    alert('Invalid slider ID');
                    return;
                }
                
                fetch(`/slider/${sliderId}/edit`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const slider = data.slider;
                            
                            editForm.setAttribute('action', `/slider/${sliderId}`);
                            
                            document.getElementById('edit-title').value = slider.title || '';
                            document.getElementById('edit-sub-title').value = slider.sub_title || '';
                            document.getElementById('edit-title-banner').value = slider.title_banner || '';
                            document.getElementById('edit-sub-title-banner').value = slider.sub_title_banner || '';
                            document.getElementById('edit-is-active').checked = slider.is_active;
                            
                            // Show current image
                            const imagePreview = document.getElementById('current-image-preview');
                            if (slider.image) {
                                imagePreview.innerHTML = `
                                    <img src="{{ asset('storage/sliders/') }}/${slider.image}" 
                                         alt="Current Image" width="150" class="rounded">
                                `;
                            } else {
                                imagePreview.innerHTML = '<p class="text-muted">No image</p>';
                            }
                            
                        } else {
                            alert('Error loading slider data: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error loading slider data: ' + error.message);
                    });
            });
        });
    });

    // Handle delete modal
    document.addEventListener('DOMContentLoaded', function() {
        const removeLinks = document.querySelectorAll('.remove-slider');
        const deleteForm = document.getElementById('deleteForm');
        
        removeLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const sliderId = this.getAttribute('data-remove-id');
                const actionUrl = `/slider/${sliderId}`;
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    });
</script>
@endsection