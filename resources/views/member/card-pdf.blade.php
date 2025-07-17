<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA - {{ $anggota->nama }}</title>
    <style>
        @page {
            margin: 15mm;
            size: A4 portrait;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        
        .cards-wrapper {
            display: block;
            text-align: center;
        }
        
        .card-container {
            margin-bottom: 40px;
            display: inline-block;
        }
        
        .card {
            width: 350px;
            height: 550px;
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
            margin: 0 auto;
        }
        
        .card-front {
            background-image: url('{{ $frontBgBase64 }}');
        }
        
        .card-back {
            background-image: url('{{ $backBgBase64 }}');
        }
        
        .avatar-container {
            position: absolute;
            top: 51%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 220px;
            height: 220px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid white;
            background-color: #ddd;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .member-info {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
        }
        
        .member-name {
            bottom: 120px;
        }
        
        .member-id {
            bottom: 95px;
        }
        
        .member-number {
            bottom: 70px;
        }
        
        .qr-container {
            position: absolute;
            top: 15%;
            right: 10%;
            transform: translateY(-50%);
            background: white;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        }
        
        .card-label {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        /* Fallback styles jika background image tidak ada */
        .card-front-fallback {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .card-back-fallback {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body>
    <div class="cards-wrapper">
        <!-- Card Front -->
        <div class="card-container">
            <div class="card @if(!empty($frontBgBase64)) card-front @else card-front-fallback @endif">
                <div class="avatar-container">
                    @if(!empty($avatarBase64))
                        <img src="{{ $avatarBase64 }}" alt="Avatar" class="avatar-img">
                    @else
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                    width: 100%; height: 100%; 
                                    display: flex; align-items: center; justify-content: center; 
                                    color: white; font-size: 18px; font-weight: bold;">
                            {{ strtoupper(substr($anggota->nama, 0, 2)) }}
                        </div>
                    @endif
                </div>
                
                <div class="member-info member-name">
                    Nama : {{ $anggota->nama }}
                </div>
                <div class="member-info member-id">
                    Id : {{ $anggota->id }}
                </div>
                <div class="member-info member-number">
                    No.Urut Anggota : {{ $anggota->id }}
                </div>
            </div>
            <div class="card-label">Bagian Depan</div>
        </div>
        
        <!-- Page Break for PDF -->
        <div class="page-break"></div>
        
        <!-- Card Back -->
        <div class="card-container">
            <div class="card @if(!empty($backBgBase64)) card-back @else card-back-fallback @endif">
                {{-- QR Code placeholder - bisa ditambahkan nanti --}}
                {{-- <div class="qr-container">
                    <div style="width: 80px; height: 80px; background: #f0f0f0; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; font-size: 10px;">
                        QR CODE<br>{{ $anggota->id }}
                    </div>
                </div> --}}
            </div>
            <div class="card-label">Bagian Belakang</div>
        </div>
    </div>
</body>
</html>