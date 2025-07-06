<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KTA Preview - {{ $anggota->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .cards-wrapper {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
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
        }
        
        .card-front {
            background-image: url('{{ asset('build/images/kta_pdsi_depan.png') }}');
        }
        
        .card-back {
            background-image: url('{{ asset('build/images/kta_pdsi_belakang.png') }}');
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
        
        @media (max-width: 768px) {
            .cards-wrapper {
                flex-direction: column;
                align-items: center;
            }
            
            .card {
                width: 300px;
                height: 480px;
            }
            
            .avatar-container {
                width: 180px;
                height: 180px;
            }
        }
    </style>
</head>
<body>
    <div class="cards-wrapper">
        <!-- Card Front -->
        <div class="card-container">
            <div class="card card-front">
                <div class="avatar-container">
                    @if($anggota->avatar && file_exists(public_path('storage/images/users/' . $anggota->avatar)))
                        <img src="{{ asset('storage/images/users/' . $anggota->avatar) }}" 
                             alt="Avatar" class="avatar-img">
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
        
        <!-- Card Back -->
        <div class="card-container">
            <div class="card card-back">
                <div class="qr-container">
                    {!! QrCode::size(80)->generate($anggota->name . ' ' . $anggota->last_name . ' ' . $anggota->id . ' ' . $anggota->created_at) !!}
                </div>
            </div>
            <div class="card-label">Bagian Belakang</div>
        </div>
    </div>
</body>
</html>