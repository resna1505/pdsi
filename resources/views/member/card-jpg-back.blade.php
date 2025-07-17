<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KTA Belakang</title>
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
            background-image: url('{{ $backBgBase64 }}');
            background-size: contain;
            background-position: center;
            background-repeat: no-repeat;
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="card">
        
    </div>
</body>
</html>