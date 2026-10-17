@extends('layouts.master-without-nav')
@section('title')
    Verifikasi KTA
@endsection
@section('content')
    @php
        $badge = [
            'aktif' => ['success', 'ri-checkbox-circle-fill', 'Anggota Aktif'],
            'kedaluwarsa' => ['warning', 'ri-time-fill', 'Masa Berlaku Habis'],
            'nonaktif' => ['danger', 'ri-close-circle-fill', 'Keanggotaan Tidak Aktif'],
        ][$status] ?? null;
    @endphp
    <div class="auth-page-wrapper py-5 d-flex align-items-center min-vh-100 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="text-center mb-4">
                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="40"
                            onerror="this.style.display='none'">
                        <h5 class="mt-3 mb-0">Verifikasi Kartu Tanda Anggota</h5>
                    </div>
                    <div class="card">
                        <div class="card-body p-4">
                            @if (!$anggota)
                                <div class="text-center">
                                    <i class="ri-error-warning-fill text-danger display-5"></i>
                                    <h5 class="mt-3">Kartu Tidak Terdaftar</h5>
                                    <p class="text-muted mb-0">QR code ini tidak cocok dengan data anggota mana pun.</p>
                                </div>
                            @else
                                <div class="text-center mb-4">
                                    <span class="badge bg-{{ $badge[0] }}-subtle text-{{ $badge[0] }} fs-14 px-3 py-2">
                                        <i class="{{ $badge[1] }} align-middle me-1"></i>{{ $badge[2] }}
                                    </span>
                                </div>
                                <div class="d-flex align-items-center gap-3 mb-4">
                                    @if ($anggota->avatar)
                                        <img src="{{ URL::asset('storage/images/users/' . $anggota->avatar) }}" alt=""
                                            class="rounded" style="width: 72px; height: 96px; object-fit: cover;">
                                    @endif
                                    <div>
                                        <h5 class="mb-1">{{ $anggota->nama }}</h5>
                                        <p class="text-muted mb-0">{{ $anggota->perhimpunan->nama ?? $anggota->profesi }}</p>
                                    </div>
                                </div>
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="ps-0 text-muted fw-medium">No. Anggota</th>
                                            <td class="text-end pe-0">{{ $anggota->no_kartu_anggota }}</td>
                                        </tr>
                                        @if ($anggota->perhimpunan)
                                            <tr>
                                                <th class="ps-0 text-muted fw-medium">Perhimpunan</th>
                                                <td class="text-end pe-0">{{ $anggota->perhimpunan->singkatan }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th class="ps-0 text-muted fw-medium">Berlaku Sampai</th>
                                            <td class="text-end pe-0">
                                                {{ $anggota->kta_berlaku_sampai ? $anggota->kta_berlaku_sampai->locale('id')->translatedFormat('d F Y') : '-' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
