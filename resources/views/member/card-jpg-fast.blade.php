<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA Fast</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            background: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        
        .container {
            width: 760px;
            height: 560px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
            align-items: center;
            justify-content: center;
        }
        
        .card {
            width: 300px;
            height: 450px;
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .card-front {
            @if(!empty($frontBgBase64))
                background-image: url('{{ $frontBgBase64 }}');
            @else
                background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            @endif
            background-size: cover;
            background-position: center;
        }
        
        .card-back {
            @if(!empty($backBgBase64))
                background-image: url('{{ $backBgBase64 }}');
            @else
                background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            @endif
            background-size: cover;
            background-position: center;
        }
        
        .avatar-container {
            position: absolute;
            top: 51%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 180px;
            height: 180px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid white;
            background: #ddd;
        }
        
        .avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .avatar-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }
        
        .member-info {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.8);
        }
        
        .member-name {
            bottom: 100px;
        }
        
        .member-id {
            bottom: 80px;
        }
        
        .member-number {
            bottom: 60px;
        }
        
        .card-label {
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Card Front -->
        <div>
            <div class="card card-front">
                <div class="avatar-container">
                    @if(!empty($avatarBase64))
                        <img src="{{ $avatarBase64 }}" alt="Avatar" class="avatar-img">
                    @else
                        <div class="avatar-placeholder">
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
        
        <!-- Card Back -->
        <div>
            <div class="card card-back">
                <!-- Background belakang -->
            </div>
            <div class="card-label">Bagian Belakang</div>
        </div>
    </div>
</body>
</html>