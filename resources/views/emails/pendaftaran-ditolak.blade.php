<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Pendaftaran Ditolak | {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color:#f0f3fc; padding: 20px 0px; margin: 0; }
    </style>
</head>
<body>
    <div style="margin: 50px 0px;">
        <table cellpadding="0" cellspacing="0" style="font-family: 'Inter','sans-serif'; font-size: 15px; font-weight: 400; max-width: 700px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15); width: 90%;">
            <thead>
                <tr style="background-color: #3b395e; border: none; height: 70px;">
                    <th scope="col" style="padding: 28px; text-align: left;">
                        <img src="{{ $message->embed(public_path('build/images/logo-light-full.png')) }}" alt="PDSI" height="45" />
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 25px 25px 0; color: #161c2d; font-size: 18px;">
                        Pendaftaran Anggota Ditolak
                    </td>
                </tr>
                <tr>
                    <td style="padding: 15px 25px 0; color: #4a5568; font-size: 14px; line-height: 1.6;">
                        <p>Yth. {{ $anggota->nama }},</p>
                        <p>Terima kasih telah mendaftar sebagai anggota. Setelah kami periksa, pendaftaran Anda
                            <strong>belum dapat kami setujui</strong> dengan alasan berikut:</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 0 25px;">
                        <div style="background: #fdf2f2; border-left: 4px solid #e55353; padding: 12px 16px; color: #161c2d; font-size: 14px; line-height: 1.6; white-space: pre-line;">{{ $anggota->alasan_penolakan }}</div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 25px 30px; color: #4a5568; font-size: 14px; line-height: 1.6;">
                        <p>Silakan hubungi sekretariat apabila ada pertanyaan atau untuk melengkapi persyaratan.</p>
                        <p style="margin-bottom: 0;">Hormat kami,<br>Sekretariat {{ config('app.name') }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
