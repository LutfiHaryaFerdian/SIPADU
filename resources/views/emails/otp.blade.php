<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP SIPADU</title>
</head>
<body style="margin:0;padding:0;background:#eef2f7;font-family:'Segoe UI',Roboto,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.08);overflow:hidden;">
                
                <!-- HEADER -->
                <tr>
                    <td style="background:linear-gradient(135deg,#2563eb,#1e40af);padding:30px;text-align:center;">

                        <!-- ICON MORTARBOARD (EMAIL SAFE) -->
                        <div style="margin-bottom:10px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="#ffffff" viewBox="0 0 16 16">
                                <path d="M8 0L0 4l8 4 6.325-3.162v4.838h1V4.5L16 4 8 0z"/>
                                <path d="M3 6.5v3.691c0 .755 2.239 1.809 5 1.809s5-1.054 5-1.809V6.5L8 9 3 6.5z"/>
                            </svg>
                        </div>

                        <h1 style="color:#ffffff;margin:0;font-size:26px;letter-spacing:1px;">
                            SIPADU
                        </h1>
                    </td>
                </tr>

                <!-- CONTENT -->
                <tr>
                    <td style="padding:40px 30px;text-align:center;color:#1f2937;">
                        <h2 style="margin-top:0;">Verifikasi Akun Anda</h2>
                        <p style="font-size:15px;color:#6b7280;">
                            Terima kasih telah mendaftar di SIPADU.  
                            Gunakan kode OTP berikut untuk menyelesaikan proses registrasi:
                        </p>

                        <div style="
                            margin:30px auto;
                            display:inline-block;
                            background:#f1f5f9;
                            padding:20px 40px;
                            border-radius:12px;
                            font-size:36px;
                            font-weight:bold;
                            letter-spacing:8px;
                            color:#2563eb;
                        ">
                            {{ $otp }}
                        </div>

                        <p style="font-size:14px;color:#374151;">
                            Kode ini berlaku selama <strong>5 menit</strong>.
                        </p>

                        <p style="font-size:13px;color:#9ca3af;">
                            Jika Anda tidak merasa melakukan pendaftaran, silakan abaikan email ini.
                        </p>
                    </td>
                </tr>

                <!-- FOOTER -->
                <tr>
                    <td style="background:#f8fafc;padding:20px;text-align:center;font-size:12px;color:#6b7280;">
                        &copy; {{ date('Y') }} SIPADU - Sistem Informasi Pelayanan Terpadu<br>
                        Universitas Anda
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>
