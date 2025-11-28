<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reset Password SIPADU</title>
</head>
<body style="margin:0;padding:0;background:#eef2f7;font-family:'Segoe UI',Roboto,Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="padding:30px 0;">
    <tr>
        <td align="center">

            <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;box-shadow:0 10px 30px rgba(0,0,0,0.08);overflow:hidden;">
                
                <!-- HEADER -->
                <tr>
                    <td style="background:linear-gradient(135deg,#dc2626,#991b1b);padding:30px;text-align:center;">

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
                        <h2 style="margin-top:0;">Reset Password Akun</h2>
                        <p style="font-size:15px;color:#6b7280;">
                            Kami menerima permintaan reset password akun Anda.  
                            Gunakan kode OTP berikut untuk melanjutkan proses reset:
                        </p>

                        <div style="
                            margin:30px auto;
                            display:inline-block;
                            background:#fef2f2;
                            padding:20px 40px;
                            border-radius:12px;
                            font-size:36px;
                            font-weight:bold;
                            letter-spacing:8px;
                            color:#dc2626;
                        ">
                            {{ $otp }}
                        </div>

                        <p style="font-size:14px;color:#374151;">
                            Kode ini berlaku selama <strong>5 menit</strong>.
                        </p>

                        <p style="font-size:13px;color:#9ca3af;">
                            Jika Anda tidak meminta reset password, segera abaikan email ini.
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
