@extends('layouts.master')
@section('title')
    @lang('translation.starter')
@endsection
@section('css')
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .dataTables_wrapper .dataTables_filter {
            float: right;
            width: 100%;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 6px;
            border: 1px solid #dee2e6;
            padding: 5px 12px;
            margin-left: 5px;
            width: 100%;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 6px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 50% !important;
            margin: 2px;
        }

        .dataTables_wrapper .dataTables_paginate .current {
            background-color: #0d6efd !important;
            color: white !important;
        }

        .card-body {
            padding: 24px;
        }

        .action-btn {
            display: flex;
            gap: 6px;
        }

        @media (max-width: 576px) {
            .action-btn {
                flex-direction: column;
                align-items: center;
            }

            .btn-icon {
                width: 100%;
                justify-content: center;
            }
        }

    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Menu
        @endslot
        @slot('title')
            Member
        @endslot
    @endcomponent
    
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMitra"><i class="bi bi-plus align-middle"></i> Add Mitra</button>
        
                <div class="table-responsive mt-4">
                    <table id="siswaTable" class="table table-nowrap" style="width: 100%">
                        <thead style="background-color: #438EFF;">
                            <tr>
                                <th class="text-center text-white">Nama</th>
                                <th class="text-center text-white">Telephone</th>
                                <th class="text-center text-white">Email</th>
                                <th class="text-center text-white">Daerah</th>                                
                                <th class="text-center text-white">Type</th>
                                <th class="text-center text-white">Email</th>
                                <th class="text-center text-white">Status</th>
                                <th class="text-center text-white">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mitras as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-2">
                                                <img src="{{ asset('storage/' . $item->image) }}" class="avatar-xs rounded-circle me-2" alt="{{ $item->name }}">
                                            </div>
                                            <div class="flex-grow-1">{{ $item->title }}</div>
                                        </div>
                                    </td>                                
                                    <td class="text-center">{{ $item->telephone }}</td>
                                    <td class="text-center">{{ $item->email }}</td>
                                    <td class="text-center">{{ $item->address }}</td>
                                    <td class="text-center">{{ $item->type }}</td>
                                    <td class="text-center">{{ $item->website }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $item->is_active ? 'success' : 'danger' }}">
                                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('mitra.update', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <form action="{{ route('mitra.destroy', $item->id) }}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                                    <i class="ri-delete-bin-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addMitra" tabindex="-1" aria-labelledby="addMitraLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-4 pb-0 m-2">
                    <h1 class="modal-title fs-5 fw-bold" id="addMitraLabel">Add Mitra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="addContact-btnClose" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 p-4">
                    <form method="POST" action="{{ route('mitra.store') }}" enctype="multipart/form-data" id="contactlist-form">
                        @csrf                       
                        <div class="d-flex flex-column gap-3">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Foto</label>
                                <input type="file" class="form-control" name="image" id="inputGroupFile01" accept="image/png, image/gif, image/jpeg" required> 
                                <div class="invalid-feedback">
                                    Please enter a name.
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="title" placeholder="Enter your name" required />
                                <div class="invalid-feedback">
                                    Please enter a name.
                                </div>
                            </div>
                            <div>
                                <label for="telephone" class="form-label">Phone Number</label>
                                <input type="phone" class="form-control" id="telephone" name="telephone" placeholder="Enter your number" required />
                                <div class="invalid-feedback">
                                    Please enter phone number.
                                </div>
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
                                <div class="invalid-feedback">
                                    Please enter an email.
                                </div>
                            </div>
                            <div>
                                <label for="address" class="form-label">Daerah</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter your address" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter a address.
                                </div>
                            </div>
                            <div>
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="Rumah Sakit">Rumah Sakit</option>
                                    <option value="Universitas">Universitas</option>
                                    <option value="Layanan Kesehatan">Layanan Kesehatan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a label.
                                </div>
                            </div>
                            <div>
                                <label for="website" class="form-label">Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Enter your website" required />
                                <div class="invalid-feedback">
                                    Please enter a website.
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-secondary">Add Mitra</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMitra" tabindex="-1" aria-labelledby="editMitraLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-4 pb-0 m-2">
                    <h1 class="modal-title fs-5 fw-bold" id="editMitraLabel">Add Mitra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" id="addContact-btnClose" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 p-4">
                    <form method="POST" action="{{ route('mitra.store') }}" enctype="multipart/form-data" id="contactlist-form">
                        @csrf                       
                        <div class="d-flex flex-column gap-3">
                            <div class="input-group">
                                <label class="input-group-text" for="inputGroupFile01">Foto</label>
                                <input type="file" class="form-control" name="image" id="inputGroupFile01" accept="image/png, image/gif, image/jpeg" required> 
                                <div class="invalid-feedback">
                                    Please enter a name.
                                </div>
                            </div>
                            <div>
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="title" placeholder="Enter your name" required />
                                <div class="invalid-feedback">
                                    Please enter a name.
                                </div>
                            </div>
                            <div>
                                <label for="telephone" class="form-label">Phone Number</label>
                                <input type="phone" class="form-control" id="telephone" name="telephone" placeholder="Enter your number" required />
                                <div class="invalid-feedback">
                                    Please enter phone number.
                                </div>
                            </div>
                            <div>
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required />
                                <div class="invalid-feedback">
                                    Please enter an email.
                                </div>
                            </div>
                            <div>
                                <label for="address" class="form-label">Daerah</label>
                                <textarea class="form-control" id="address" name="address" placeholder="Enter your address" required></textarea>
                                <div class="invalid-feedback">
                                    Please enter a address.
                                </div>
                            </div>
                            <div>
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type" required>
                                    <option value="">Select Type</option>
                                    <option value="Rumah Sakit">Rumah Sakit</option>
                                    <option value="Universitas">Universitas</option>
                                    <option value="Layanan Kesehatan">Layanan Kesehatan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a label.
                                </div>
                            </div>
                            <div>
                                <label for="website" class="form-label">Website</label>
                                <input type="text" class="form-control" id="website" name="website" placeholder="Enter your website" required />
                                <div class="invalid-feedback">
                                    Please enter a website.
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-secondary">Add Mitra</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/tom-select/js/tom-select.base.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#siswaTable').DataTable({
                responsive: false,
                autoWidth: false,
                scrollX: true, // aktifkan horizontal scroll dari DataTables juga

                language: {
                    search: "Cari Data:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    zeroRecords: "Tidak ada data ditemukan",
                    info: "Menampilkan halaman _PAGE_ dari _PAGES_",
                    infoEmpty: "Tidak ada data tersedia",
                    // infoFiltered: "(difilter dari total _MAX_ entri)",
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                }
            });
        });
    </script>
@endsection