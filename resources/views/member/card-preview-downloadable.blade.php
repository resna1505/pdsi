<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KTA Preview</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f0f0f0;
        }
        
        .download-controls {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .download-btn {
            background: #0066cc;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin: 0 10px;
        }
        
        .download-btn:hover {
            background: #004499;
        }
        
        .card-container {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .membership-card {
            width: 300px;
            height: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            position: relative;
            background: linear-gradient(135deg, #0066cc, #004499);
        }
        
        .card-front, .card-back {
            background: linear-gradient(135deg, #0066cc, #004499);
            color: white;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
        }
        
        .card-back {
            background: linear-gradient(135deg, #004499, #0066cc);
        }
        
        .header {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        
        .logo-area {
            text-align: center;
            font-size: 12px;
            margin-bottom: 20px;
        }
        
        .avatar-container {
            display: flex;
            justify-content: center;
            margin: 20px 0;
        }
        
        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid white;
            object-fit: cover;
            background: #ddd;
        }
        
        .member-info {
            text-align: center;
            margin-top: 20px;
        }
        
        .info-item {
            margin: 8px 0;
            font-size: 14px;
        }
        
        .qr-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        
        .qr-code {
            background: white;
            padding: 10px;
            border-radius: 8px;
        }
        
        .back-info {
            font-size: 11px;
            line-height: 1.5;
        }
        
        .back-info h4 {
            margin: 0 0 10px 0;
            font-size: 13px;
        }
        
        .issue-date {
            text-align: center;
            margin-top: auto;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="download-controls">
        <button class="download-btn" onclick="downloadCard('front')">Download Depan</button>
        <button class="download-btn" onclick="downloadCard('back')">Download Belakang</button>
        <button class="download-btn" onclick="downloadCard('both')">Download Keduanya</button>
    </div>

    <div class="card-container">
        <!-- BAGIAN DEPAN KARTU -->
        <div class="membership-card" id="card-front">
            <div class="card-front">
                <div class="header">
                    PERKUMPULAN DOKTER<br>
                    SELURUH INDONESIA
                </div>
                
                <div class="logo-area">
                    www.pdsionline.org
                </div>
                
                <div class="avatar-container">
                    @if($anggota->avatar && file_exists(storage_path('app/public/images/users/' . $anggota->avatar)))
                        <img src="{{ asset('storage/images/users/' . $anggota->avatar) }}" alt="Avatar" class="avatar">
                    @else
                        <div class="avatar" style="display: flex; align-items: center; justify-content: center; background: #ccc; color: #666;">
                            NO PHOTO
                        </div>
                    @endif
                </div>
                
                <div class="member-info">
                    <div class="info-item"><strong>Nama:</strong><br>{{ $anggota->nama }}</div>
                    <div class="info-item"><strong>ID:</strong> {{ $anggota->id }}</div>
                    <div class="info-item"><strong>No. Anggota:</strong> {{ $anggota->id }}</div>
                </div>
            </div>
        </div>
        
        <!-- BAGIAN BELAKANG KARTU -->
        <div class="membership-card" id="card-back">
            <div class="card-back">
                <div class="header">
                    KARTU ANGGOTA PDSI
                </div>
                
                <div class="qr-container">
                    <div class="qr-code">
                        {!! QrCode::size(80)->generate($anggota->nama . ' ' . ($anggota->last_name ?? '') . ' ' . $anggota->id . ' ' . $anggota->created_at) !!}
                    </div>
                </div>
                
                <div class="back-info">
                    <h4>Ketentuan Penggunaan:</h4>
                    <p>1. Kartu identitas resmi PDSI</p>
                    <p>2. Wajib dibawa saat praktek</p>
                    <p>3. Hubungi sekretariat jika hilang</p>
                    <p>4. Tidak dapat dipindahtangankan</p>
                    
                    <h4>Kontak:</h4>
                    <p>Email: info@pdsionline.org<br>
                    Website: www.pdsionline.org</p>
                </div>
                
                <div class="issue-date">
                    <strong>Diterbitkan:</strong> {{ date('d/m/Y') }}
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadCard(type) {
            const memberName = '{{ str_replace(" ", "_", $anggota->nama) }}';
            const currentDate = new Date().toISOString().split('T')[0];
            
            if (type === 'front') {
                captureAndDownload('card-front', `KTA_Depan_${memberName}_${currentDate}.jpg`);
            } else if (type === 'back') {
                captureAndDownload('card-back', `KTA_Belakang_${memberName}_${currentDate}.jpg`);
            } else if (type === 'both') {
                captureAndDownload('card-front', `KTA_Depan_${memberName}_${currentDate}.jpg`);
                setTimeout(() => {
                    captureAndDownload('card-back', `KTA_Belakang_${memberName}_${currentDate}.jpg`);
                }, 1000);
            }
        }
        
        function captureAndDownload(elementId, filename) {
            const element = document.getElementById(elementId);
            
            html2canvas(element, {
                scale: 2,
                useCORS: true,
                allowTaint: false,
                backgroundColor: null,
                width: element.offsetWidth,
                height: element.offsetHeight
            }).then(canvas => {
                // Convert canvas to blob
                canvas.toBlob(function(blob) {
                    // Create download link
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = filename;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                }, 'image/jpeg', 0.9);
            }).catch(err => {
                console.error('Error capturing image:', err);
                alert('Gagal membuat gambar. Silakan coba lagi.');
            });
        }
    </script>
</body>
</html>