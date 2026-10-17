<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { margin: 0; padding: 0; background: #fff; }
    </style>
    @include('member.kta.style')
    <style>
        /* Diperbesar 2x (Browsershot membatasi deviceScaleFactor maks. 3) */
        .kta-card { transform: scale(2); transform-origin: 0 0; }
    </style>
</head>
<body>
    @include('member.kta.card', ['side' => $side])
</body>
</html>
