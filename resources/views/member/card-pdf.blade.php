<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA PDSI - {{ $anggota->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .card-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .card-side {
            width: 350px;
            height: 550px;
            margin: 20px auto;
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            page-break-after: always;
        }
        
        .card-front {
            background-image: url('{{ public_path('build/images/kta_pdsi_depan.png') }}');
        }
        
        .card-back {
            background-image: url('{{ public_path('build/images/kta_pdsi_belakang.png') }}');
        }
        
        .avatar-container {
            position: absolute;
            top: 51%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 200px;
            height: 200px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid white;
            background-color: #ddd;
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
            font-size: 14px;
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
            right: 15%;
            transform: translateY(-50%);
        }
        
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <!-- Card Front -->
        <div class="card-side card-front">
            <div class="avatar-container">
                @if($anggota->avatar && file_exists(public_path('storage/images/users/' . $anggota->avatar)))
                    <img src="{{ public_path('storage/images/users/' . $anggota->avatar) }}" 
                         alt="Avatar" class="avatar-img">
                @else
                    <div style="background-color: #ccc; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #666;">
                        No Photo
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
        
        <!-- Card Back -->
        <div class="card-side card-back page-break">
            <div class="qr-container">
                {!! QrCode::size(80)->generate($anggota->name . ' ' . $anggota->last_name . ' ' . $anggota->id . ' ' . $anggota->created_at) !!}
            </div>
        </div>
    </div>
</body>
</html>