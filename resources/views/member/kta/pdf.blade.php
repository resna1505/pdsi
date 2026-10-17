<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA - {{ $anggota->nama }}</title>
    <style>
        @page { margin: 0; }
        html, body { margin: 0; padding: 0; }
        .page-break { page-break-after: always; }
    </style>
    @include('member.kta.style')
    <style>
        /* Sedikit lebih kecil dari ukuran kertas agar tidak meluber ke halaman baru */
        .kta-card { height: 53.8mm; }
    </style>
</head>
<body>
    <div class="page-break">
        @include('member.kta.card', ['side' => 'front'])
    </div>
    @include('member.kta.card', ['side' => 'back'])
</body>
</html>
