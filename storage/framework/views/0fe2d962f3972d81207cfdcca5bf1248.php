<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>OTP Verification | <?php echo e(config('app.name')); ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');
        body { font-family: 'Inter', sans-serif; background-color:#f0f3fc; padding: 20px 0px; margin: 0; }
        .otp-code { 
            font-size: 32px; 
            letter-spacing: 10px; 
            padding: 15px 20px; 
            background: #f8f9fc; 
            display: inline-block; 
            margin: 15px 0;
            border-radius: 5px;
            color: #242e4d;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div style="margin: 50px 0px;">
        <table cellpadding="0" cellspacing="0" style="font-family: 'Inter','sans-serif'; font-size: 15px; font-weight: 400; max-width: 700px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow: 0 0 3px rgba(60, 72, 88, 0.15); width:50%;">
            <thead>
                <tr style="background-color: #3b395e; border: none; height: 70px;">
                    <th scope="col" style="padding: 28px;display: flex;align-items: center; justify-content: space-between;">
                        <img src="<?php echo e($message->embed(public_path('build/images/logo-light-full.png'))); ?>" alt="PDSI" height="45" />
                    </th>
                </tr>
            </thead>
                <tr>
                    <td style="padding: 25px 25px 0; color: #161c2d; font-size: 18px; text-align: center;">
                        Your OTP Verification Code
                    </td>
                </tr>
                <tr>
                    <td style="padding: 25px 25px 0; color: #7c8ca3; font-size: 14px; text-align: center; line-height: 1.5;">
                        <p>Hello, please use the following OTP code to complete your registration:</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 25px 25px 0; text-align: center;">
                        <div class="otp-code"><?php echo e($otp); ?></div>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 25px 25px 0; color: #7c8ca3; font-size: 14px; text-align: center; line-height: 1.5;">
                        <p>This code will expire in 10 minutes.<br>Do not share this code with anyone.</p>
                    </td>
                </tr>

                <tr>
                    <td style="padding: 20px 8px; color: #cad2dd; background-color: #3b395e; text-align: center;">
                        <?php echo e(date('Y')); ?> © <a href="#" style="color: #cad2dd; text-decoration: none;">PDSI</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH D:\Project\pdsi\resources\views/emails/otp-email.blade.php ENDPATH**/ ?>