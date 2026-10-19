{{-- Kartu pendaftar menunggu verifikasi (dibuka di offcanvas #viewVerification) --}}
<div class="col list-element">
    <div class="card">
        <div class="card-body p-4 m-2">
            <div class="row mb-4 pb-2">
                <div class="col">
                    <div class="flex-shrink-0 me-2">
                        <button type="button"
                        class="btn btn-outline-success custom-toggle rounded-circle btn-icon btn-sm"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#viewVerification"
                        data-id="{{ $item->user_id }}"
                        data-nama="{{ $item->nama }}"
                        data-ktp="{{ $item->noktp }}"
                        data-npwp="{{ $item->npwp }}"
                        data-lahir="{{ $item->tempat_lahir ?: '-' }}"
                        data-birthday="{{ $item->tanggal_lahir ?: '-' }}"
                        data-email="{{ $item->email }}"
                        data-phone="{{ $item->no_hp }}"
                        data-address="{{ $item->alamat }}"
                        data-city="{{ $item->kota ?: '-' }}"
                        data-provinsi="{{ $item->provinsi ?: '-' }}"
                        data-profesi="{{ $item->profesi }}"
                        data-perhimpunan="{{ $item->perhimpunan ? $item->perhimpunan->nama . ' (' . $item->perhimpunan->singkatan . ')' : 'Anggota Biasa PDSI' }}"
                        data-nostr="{{ $item->no_str ?: '-' }}"
                        data-strberlaku="{{ $item->str_berlaku_sampai ? $item->str_berlaku_sampai->format('d/m/Y') : ($item->no_str ? 'Seumur hidup' : '-') }}"
                        data-docs="{{ json_encode($item->dokumenVerifikasi()) }}"
                        data-avatar="{{ URL::asset("storage/images/users/{$item->avatar}") }}"
                        >
                            <i class="ri-eye-fill"></i>
                        </button>
                    </div>
                </div>
                <div class="col text-end dropdown"> <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false"> <i class="ri-more-fill fs-17"></i> </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item remove-list" href="#removeMemberModal" data-bs-toggle="modal" data-remove-id="{{ $item->user_id }}">
                            <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>Remove
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="text-center mb-4">
                <img src="{{ URL::asset("storage/images/users/{$item->avatar}") }}" alt="" class="avatar-md rounded-3" />
            </div>
            <div class="text-center">
                <h5 class="fs-17">{{ $item->nama }}</h5>
                <p class="text-muted mb-0">{{ $item->email }}</p>
                @if ($item->perhimpunan)
                    <span class="badge bg-primary-subtle text-primary mt-2">{{ $item->perhimpunan->singkatan }}</span>
                @endif
                <span class="badge bg-warning text-dark mt-2">Pending Verification</span>
            </div>
        </div>
    </div>
</div>
