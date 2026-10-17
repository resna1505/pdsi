@extends('layouts.master')
@section('title')
Perhimpunan
@endsection
@section('content')

@foreach (['success' => 'success', 'error' => 'danger'] as $key => $color)
    @if (session($key))
        <div class="alert alert-{{ $color }} alert-dismissible fade show mt-2" role="alert">
            {{ session($key) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endforeach
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex flex-wrap align-items-center gap-3">
                <div class="flex-grow-1">
                    <h5 class="card-title mb-1">Master Perhimpunan</h5>
                    <p class="text-muted mb-0 small">
                        Perhimpunan aktif muncul di form register. Desain KTA khusus bersifat opsional; jika kosong, kartu memakai desain default.
                    </p>
                </div>
                <input type="text" class="form-control" id="searchPerhimpunan" placeholder="Cari perhimpunan..." style="max-width: 260px;">
                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addPerhimpunanModal">
                    <i class="ri-add-fill me-1 align-bottom"></i> Tambah Perhimpunan
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Nama Perhimpunan</th>
                                <th>Singkatan</th>
                                <th class="text-center">Anggota</th>
                                <th>Desain KTA</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="perhimpunanTable">
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td><span class="fw-medium">{{ $item->singkatan }}</span></td>
                                    <td class="text-center">{{ $item->anggotas_count }}</td>
                                    <td>
                                        @if ($item->kta_depan || $item->kta_belakang)
                                            <span class="badge bg-primary-subtle text-primary">Khusus</span>
                                        @else
                                            <span class="badge bg-light text-muted">Default</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->is_active)
                                            <span class="badge bg-success-subtle text-success">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="text-end text-nowrap">
                                        <button type="button" class="btn btn-sm btn-soft-primary edit-perhimpunan"
                                            data-bs-toggle="modal" data-bs-target="#editPerhimpunanModal" data-id="{{ $item->id }}">
                                            <i class="ri-pencil-line"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-soft-danger remove-perhimpunan"
                                            data-bs-toggle="modal" data-bs-target="#removePerhimpunanModal" data-id="{{ $item->id }}"
                                            data-nama="{{ $item->nama }}">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">Belum ada data perhimpunan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal tambah --}}
<div class="modal fade" id="addPerhimpunanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Tambah Perhimpunan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ route('perhimpunan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="add-nama" class="form-label">Nama Perhimpunan</label>
                            <input type="text" class="form-control" id="add-nama" name="nama" value="{{ old('nama') }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="add-singkatan" class="form-label">Singkatan</label>
                            <input type="text" class="form-control" id="add-singkatan" name="singkatan" value="{{ old('singkatan') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="add-kta-depan" class="form-label">Desain KTA Depan <span class="text-muted">(opsional)</span></label>
                            <input type="file" class="form-control" id="add-kta-depan" name="kta_depan" accept=".jpg,.jpeg,.png">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="add-kta-belakang" class="form-label">Desain KTA Belakang <span class="text-muted">(opsional)</span></label>
                            <input type="file" class="form-control" id="add-kta-belakang" name="kta_belakang" accept=".jpg,.jpeg,.png">
                        </div>
                        <div class="col-12 mb-3">
                            <small class="text-muted">
                                Desain KTA: gambar landscape rasio kartu ID (85,6 × 54 mm), mis. 2024 × 1276 px. Bagian depan harus mengikuti tata letak
                                desain default (area foto di kiri, Nama/No. Anggota/Masa Berlaku di tengah, QR di kanan).
                            </small>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="add-is-active" name="is_active" value="1" checked>
                                <label class="form-check-label" for="add-is-active">Aktif (tampil di form register)</label>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal edit --}}
<div class="modal fade" id="editPerhimpunanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header p-4 pb-0">
                <h5 class="modal-title">Edit Perhimpunan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="" enctype="multipart/form-data" id="editPerhimpunanForm">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="edit-nama" class="form-label">Nama Perhimpunan</label>
                            <input type="text" class="form-control" id="edit-nama" name="nama" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="edit-singkatan" class="form-label">Singkatan</label>
                            <input type="text" class="form-control" id="edit-singkatan" name="singkatan" required>
                        </div>
                        @foreach (['kta_depan' => 'Depan', 'kta_belakang' => 'Belakang'] as $field => $label)
                            <div class="col-md-6 mb-3">
                                <label for="edit-{{ $field }}" class="form-label">Desain KTA {{ $label }}</label>
                                <div class="mb-2 d-none" id="edit-{{ $field }}-current">
                                    <img src="" alt="" class="img-fluid rounded border mb-2" style="max-height: 120px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="hapus_{{ $field }}" value="1" id="edit-hapus-{{ $field }}">
                                        <label class="form-check-label small" for="edit-hapus-{{ $field }}">Hapus, kembali ke desain default</label>
                                    </div>
                                </div>
                                <input type="file" class="form-control" id="edit-{{ $field }}" name="{{ $field }}" accept=".jpg,.jpeg,.png">
                            </div>
                        @endforeach
                        <div class="col-12 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="edit-is-active" name="is_active" value="1">
                                <label class="form-check-label" for="edit-is-active">Aktif (tampil di form register)</label>
                            </div>
                        </div>
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal hapus --}}
<div id="removePerhimpunanModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Hapus perhimpunan?</h4>
                        <p class="text-muted mx-4 mb-0" id="removePerhimpunanName"></p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Batal</button>
                    <form id="deletePerhimpunanForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-sm btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pencarian
        document.getElementById('searchPerhimpunan').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('#perhimpunanTable tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
            });
        });

        // Edit
        const editForm = document.getElementById('editPerhimpunanForm');
        document.querySelectorAll('.edit-perhimpunan').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                editForm.reset();
                editForm.setAttribute('action', `/perhimpunan/${id}`);

                fetch(`/perhimpunan/${id}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) {
                            alert(data.message || 'Gagal memuat data perhimpunan');
                            return;
                        }
                        document.getElementById('edit-nama').value = data.perhimpunan.nama;
                        document.getElementById('edit-singkatan').value = data.perhimpunan.singkatan;
                        document.getElementById('edit-is-active').checked = !!data.perhimpunan.is_active;

                        ['kta_depan', 'kta_belakang'].forEach(function (field) {
                            const current = document.getElementById(`edit-${field}-current`);
                            const url = data[`${field}_url`];
                            current.classList.toggle('d-none', !url);
                            current.querySelector('img').src = url || '';
                        });
                    })
                    .catch(() => alert('Gagal memuat data perhimpunan'));
            });
        });

        // Hapus
        const deleteForm = document.getElementById('deletePerhimpunanForm');
        document.querySelectorAll('.remove-perhimpunan').forEach(function (button) {
            button.addEventListener('click', function () {
                deleteForm.setAttribute('action', `/perhimpunan/${this.dataset.id}`);
                document.getElementById('removePerhimpunanName').textContent = this.dataset.nama;
            });
        });
    });
</script>
@endsection
