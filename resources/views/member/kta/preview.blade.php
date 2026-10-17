<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KTA - {{ $anggota->nama }}</title>
    <style>
        body { margin: 0; padding: 24px 16px; background: #f3f3f9; font-family: Helvetica, Arial, sans-serif; }
        .kta-preview { max-width: 640px; margin: 0 auto; }
        .kta-preview h1 { font-size: 18px; color: #333; margin: 0 0 4px; }
        .kta-preview p { font-size: 13px; color: #777; margin: 0 0 20px; }
        .mb-3 { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="kta-preview">
        <h1>Kartu Tanda Anggota</h1>
        <p>{{ $anggota->nama }} &middot; {{ $anggota->no_kartu_anggota }}</p>
        @include('member.kta.display')
    </div>
</body>
</html>
