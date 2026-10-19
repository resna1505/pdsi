@extends('layouts.master')
@section('title')
Member Perhimpunan
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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-light pb-0 border-0">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">Member Perhimpunan</h5>
                        <p class="text-muted small mb-0">Anggota perhimpunan yang sudah diverifikasi. Terpisah dari member PDSI Online.</p>
                    </div>
                    <input type="text" class="form-control" id="searchMember" placeholder="Cari nama / no. anggota..." style="max-width: 260px;">
                </div>
                <div class="mt-4">
                    <ul class="nav nav-tabs nav-tabs-custom nav-secondary" role="tablist">
                        @foreach ($perhimpunans as $perhimpunan)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#perhimpunan-{{ $perhimpunan->id }}" role="tab">
                                    {{ $perhimpunan->singkatan }}
                                    <span class="badge bg-primary-subtle text-primary ms-1">{{ $perhimpunan->anggotas->count() }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card-body p-4">
                @if ($perhimpunans->isEmpty())
                    <p class="text-muted text-center py-4 mb-0">Belum ada perhimpunan aktif.</p>
                @endif
                <div class="tab-content">
                    @foreach ($perhimpunans as $perhimpunan)
                        <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="perhimpunan-{{ $perhimpunan->id }}" role="tabpanel">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                                <p class="text-muted mb-0">{{ $perhimpunan->nama }}</p>
                                <a href="{{ route('member.perhimpunan.export', $perhimpunan->id) }}" class="btn btn-soft-success btn-sm">
                                    <i class="ri-file-excel-line align-middle me-1"></i> Export Excel
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 50px;">No</th>
                                            <th>Nama</th>
                                            <th>No. Anggota</th>
                                            <th>Kontak</th>
                                            <th>No. STR</th>
                                            <th>KTA Berlaku</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="member-rows">
                                        @forelse ($perhimpunan->anggotas as $anggota)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="{{ URL::asset("storage/images/users/{$anggota->avatar}") }}" alt=""
                                                            class="rounded" style="width: 36px; height: 48px; object-fit: cover;">
                                                        <div>
                                                            <div class="fw-medium">{{ $anggota->nama }}</div>
                                                            <small class="text-muted">{{ $anggota->profesi }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span class="fw-medium">{{ $anggota->no_kartu_anggota ?? '-' }}</span></td>
                                                <td>
                                                    <div>{{ $anggota->email }}</div>
                                                    <small class="text-muted">{{ $anggota->no_hp }}</small>
                                                </td>
                                                <td>
                                                    <div>{{ $anggota->no_str ?: '-' }}</div>
                                                    @if ($anggota->no_str)
                                                        <small class="text-muted">s/d {{ $anggota->str_berlaku_sampai ? $anggota->str_berlaku_sampai->format('d/m/Y') : 'seumur hidup' }}</small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($anggota->kta_berlaku_sampai)
                                                        <span class="badge {{ $anggota->isKtaExpired() ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' }}">
                                                            {{ $anggota->kta_berlaku_sampai->format('d/m/Y') }}
                                                        </span>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-end text-nowrap">
                                                    <a href="{{ route('member.show', $anggota->user_id) }}" class="btn btn-sm btn-soft-primary" title="Overview">
                                                        <i class="ri-eye-line"></i>
                                                    </a>
                                                    <a href="{{ route('member.edit', $anggota->user_id) }}" class="btn btn-sm btn-soft-info" title="Edit">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <a href="https://wa.me/{{ $anggota->no_hp }}" target="_blank" class="btn btn-sm btn-soft-success" title="WhatsApp">
                                                        <i class="ri-whatsapp-line"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-soft-danger remove-member" title="Hapus"
                                                        data-bs-toggle="modal" data-bs-target="#removeMemberModal"
                                                        data-user-id="{{ $anggota->user_id }}" data-nama="{{ $anggota->nama }}">
                                                        <i class="ri-delete-bin-5-line"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">Belum ada member {{ $perhimpunan->singkatan }} yang diverifikasi.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="removeMemberModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-2 text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Hapus member?</h4>
                        <p class="text-muted mx-4 mb-0">Data <strong id="removeMemberName"></strong> beserta dokumennya akan dihapus permanen.</p>
                    </div>
                </div>
                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Batal</button>
                    <form id="removeMemberForm" method="POST" style="display: inline;">
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
        document.getElementById('searchMember').addEventListener('input', function () {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll('.member-rows tr').forEach(function (row) {
                row.style.display = row.textContent.toLowerCase().includes(keyword) ? '' : 'none';
            });
        });

        const removeForm = document.getElementById('removeMemberForm');
        document.querySelectorAll('.remove-member').forEach(function (button) {
            button.addEventListener('click', function () {
                removeForm.setAttribute('action', `{{ url('member') }}/${this.dataset.userId}`);
                document.getElementById('removeMemberName').textContent = this.dataset.nama;
            });
        });
    });
</script>
@endsection
