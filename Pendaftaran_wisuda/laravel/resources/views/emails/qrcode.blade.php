<!DOCTYPE html>
<html>
<head>
    <title>Tiket Wisuda</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8fafc; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <div style="background-color: #0b3c39; padding: 30px; text-align: center;">
            <h1 style="color: white; margin: 0; font-size: 24px;">Tiket QR Code Wisuda</h1>
        </div>
        <div style="padding: 40px; text-align: center;">
            <p style="font-size: 16px; color: #4a5568; margin-bottom: 30px;">
                Halo <strong>{{ $pendaftaran->nama_mahasiswa }}</strong>,<br><br>
                Selamat! Pendaftaran wisuda Anda telah disetujui. Berikut adalah QR Code tiket masuk Anda. Harap tunjukkan kepada panitia saat memasuki lokasi acara.
            </p>
            
            <div style="background: #f1f5f9; padding: 20px; border-radius: 15px; display: inline-block; margin-bottom: 30px;">
                 <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ $pendaftaran->qr_token }}" alt="QR Code" width="200">
            </div>
            
            <p style="font-size: 14px; color: #718096; margin-bottom: 0;">
                Kode Tiket: <strong>{{ $pendaftaran->qr_token }}</strong>
            </p>
        </div>
        <div style="background-color: #f1f5f9; padding: 20px; text-align: center; color: #718096; font-size: 12px;">
            &copy; {{ date('Y') }} Sistem Pendaftaran Wisuda.
        </div>
    </div>
</body>
</html>
