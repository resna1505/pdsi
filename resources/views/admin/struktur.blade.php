@extends('layouts.master')
@section('title')
Struktur Management
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
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addStrukturModal">
                                <i class="ri-add-fill me-1 align-bottom"></i> Add Struktur
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-xxl-12 struktur-lists">
                        @foreach($struktur as $item)
                            <div class="list-element">
                                <div class="d-flex flex-column flex-sm-row mb-5">
                                    <div class="flex-shrink-0">
                                        @if($item->image)
                                            <img src="{{ asset('storage/struktur/' . $item->image) }}" 
                                                 alt="{{ $item->title }}" width="200" height="150" class="rounded" />
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                 style="width: 200px; height: 150px;">
                                                <i class="ri-image-line fs-1 text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-grow-1 ms-sm-3 mt-2 mt-sm-0">
                                        <div class="position-relative">
                                            <h5 class="mb-3">{{ $item->title }}</h5>
                                            <p class="text-muted mb-2">{{ $item->subtitle }}</p>
                                        </div>
                                        <ul class="list-unstyled d-flex align-items-center gap-3 text-muted fs-14 mb-0">
                                            <li>
                                                <span class="badge {{ $item->is_active ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $item->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </li>
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
                                                <a class="dropdown-item edit-struktur" href="#editStruktur" 
                                                   data-bs-toggle="modal" data-edit-id="{{ $item->id }}">
                                                    <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('struktur.toggleStatus', $item->id) }}" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="ri-toggle-line me-2 align-bottom text-muted"></i>
                                                        {{ $item->is_active ? 'Deactivate' : 'Activate' }}
                                                    </button>
                                                </form>
                                            </li>
                                            {{-- <li>
                                                <a class="dropdown-item remove-struktur" href="#removeStrukturModal" 
                                                   data-bs-toggle="modal" data-remove-id="{{ $item->id }}">
                                                    <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                                                </a>
                                            </li> --}}
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

<!-- Add Struktur Modal -->
<div class="modal fade" id="addStrukturModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Add Struktur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('struktur.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
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
                        <div class="col-md-12 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <textarea name="subtitle" id="subtitle" 
                                      class="form-control @error('subtitle') is-invalid @enderror" 
                                      rows="3" required>{{ old('subtitle') }}</textarea>
                            @error('subtitle')
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
                            <button type="submit" class="btn btn-success">Add Struktur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Struktur Modal -->
<div class="modal fade" id="editStruktur" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Edit Struktur</h5>
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
                        <div class="col-md-12 mb-3">
                            <label for="edit-title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="edit-title" name="title" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="edit-subtitle" class="form-label">Subtitle</label>
                            <textarea name="subtitle" id="edit-subtitle" class="form-control" rows="3" required></textarea>
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
                            <button type="submit" class="btn btn-success">Update Struktur</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Struktur Modal -->
<div id="removeStrukturModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
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
                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this struktur ?</p>
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
        const editLinks = document.querySelectorAll('.edit-struktur');
        const editForm = document.getElementById('edit-form');
        
        editLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                const strukturId = this.getAttribute('data-edit-id');
                
                if (!strukturId) {
                    alert('Invalid struktur ID');
                    return;
                }
                
                fetch(`/struktur/${strukturId}/edit`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const struktur = data.struktur;
                            
                            editForm.setAttribute('action', `/struktur/${strukturId}`);
                            
                            document.getElementById('edit-title').value = struktur.title || '';
                            document.getElementById('edit-subtitle').value = struktur.subtitle || '';
                            document.getElementById('edit-is-active').checked = struktur.is_active;
                            
                            // Show current image
                            const imagePreview = document.getElementById('current-image-preview');
                            if (struktur.image) {
                                imagePreview.innerHTML = `
                                    <img src="{{ asset('storage/struktur/') }}/${struktur.image}" 
                                         alt="Current Image" width="150" class="rounded">
                                `;
                            } else {
                                imagePreview.innerHTML = '<p class="text-muted">No image</p>';
                            }
                            
                        } else {
                            alert('Error loading struktur data: ' + (data.message || 'Unknown error'));
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error loading struktur data: ' + error.message);
                    });
            });
        });
    });

    // Handle delete modal
    document.addEventListener('DOMContentLoaded', function() {
        const removeLinks = document.querySelectorAll('.remove-struktur');
        const deleteForm = document.getElementById('deleteForm');
        
        removeLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const strukturId = this.getAttribute('data-remove-id');
                const actionUrl = `/struktur/${strukturId}`;
                deleteForm.setAttribute('action', actionUrl);
            });
        });
    });
</script>
@endsection