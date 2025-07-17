<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA Depan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            width: 330px;
            height: 560px;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        
        .card {
            width: 350px;
            height: 560px;
            position: relative;
            border-radius: 15px;
            overflow: hidden;
            background-image: url('{{ $frontBgBase64 }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #f0f0f0;
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
            font-size: 16px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            font-family: Arial, sans-serif;
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
    </style>
</head>
<body>
    <div class="card">
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
</body>
</html>