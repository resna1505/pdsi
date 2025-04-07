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
    
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                    <i class="ri-user-add-line align-middle me-1"></i> Add Member
                </button>

                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                    <i class="ri-user-add-line align-middle me-1"></i> Export Excel
                </button>
        
                <div class="table-responsive mt-4">
                    <table id="siswaTable" class="table table-nowrap" style="width: 100%">
                        <thead style="background-color: #438EFF;">
                            <tr>
                                <th class="text-center text-white">Nama Lengkap</th>
                                <th class="text-center text-white">NPA</th>
                                <th class="text-center text-white">Asal Wilayah</th>
                                <th class="text-center text-white">Asal Cabang</th>
                                
                                <th class="text-center text-white">Tempat Lahir</th>
                                <th class="text-center text-white">Tanggal Lahir</th>
                                <th class="text-center text-white">Tanggal Daftar</th>
                                <th class="text-center text-white">Status Aktivasi</th>
                                <th class="text-center text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 0; $i < 15; $i++)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-2">
                                            <img src="{{ URL::asset('build/images/users/avatar-'. ($i + 1) . '.jpg') }}" alt="" class="avatar-xs rounded-circle" />
                                        </div>
                                        <div class="flex-grow-1">Terry White</div>
                                    </div>
                                </td>                                <td class="text-center">245944</td>
                                <td class="text-center">Bengkulu</td>
                                <td class="text-center">Kaur</td>
                                
                                <td class="text-center">Tegal Sari</td>
                                <td class="text-center">08 Dec 1998</td>
                                <td class="text-center">12 Sept 2023</td>
                                <td class="text-center"><span class="badge bg-success">Aktif</span></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary"><i class="ri-eye-line"></i></button>
                                    <button class="btn btn-sm btn-warning"><i class="ri-pencil-line"></i></button>
                                    <button class="btn btn-sm btn-danger"><i class="ri-delete-bin-line"></i></button>
                                </td>
                            </tr>
                            
                            @endfor
                        </tbody>
                    </table>
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