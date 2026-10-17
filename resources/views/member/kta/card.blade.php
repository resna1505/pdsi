{{--
    Satu sisi KTA (85,6 x 54 mm).
    Parameter: $side ('front'|'back'), $anggota, $frontBg, $backBg, $avatar, $qr
    Posisi elemen dalam persen terhadap desain kta_default_depan.jpg.
--}}
@php
    $namaLength = mb_strlen($anggota->nama ?? '');
    $namaSize = $namaLength > 60 ? '5pt' : ($namaLength > 40 ? '5.8pt' : '6.8pt');
@endphp
<div class="kta-card">
    @if ($side === 'back')
        @if ($backBg)
            <img class="kta-bg" src="{{ $backBg }}" alt="">
        @endif
    @else
        @if ($frontBg)
            <img class="kta-bg" src="{{ $frontBg }}" alt="">
        @endif

        <div class="kta-photo">
            @if ($avatar)
                <img src="{{ $avatar }}" alt="">
            @endif
        </div>

        <div class="kta-value kta-nama" style="font-size: {{ $namaSize }};">{{ $anggota->nama }}</div>
        <div class="kta-value kta-nomor">{{ $anggota->no_kartu_anggota ?? '-' }}</div>
        <div class="kta-value kta-berlaku">
            {{ $anggota->kta_berlaku_sampai ? $anggota->kta_berlaku_sampai->locale('id')->translatedFormat('d F Y') : '-' }}
        </div>

        @if ($qr)
            <img class="kta-qr" src="{{ $qr }}" alt="QR">
        @endif
    @endif
</div>
