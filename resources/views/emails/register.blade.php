<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; font-family:Arial, Helvetica, sans-serif;">

    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f4f4f4; padding:40px 0;">
        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.08);">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="background:#0d6efd; color:#ffffff; padding:30px;">
                            <h1 style="margin:0; font-size:28px;">Welcome!</h1>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding:40px; color:#333333;">

                            <h2 style="margin-top:0;">
                                Hello, {{ $user->name }} 👋
                            </h2>

                            <p style="font-size:16px; line-height:1.6;">
                                Thank you for registering with our
                                <strong>AI Powered E-commerce Website</strong>.
                            </p>

                            <p style="font-size:16px; line-height:1.6;">
                                Your account has been created successfully, and you can now start exploring our products.
                            </p>

                            <div style="text-align:center; margin:35px 0;">
                                <a href="{{ url('/') }}"
                                   style="background:#0d6efd; color:#ffffff; text-decoration:none; padding:12px 28px; border-radius:5px; display:inline-block; font-weight:bold;">
                                    Visit Store
                                </a>
                            </div>

                            <p style="margin-bottom:0; color:#666666;">
                                Happy Shopping!<br>
                                <strong>AI Powered E-commerce Team</strong>
                            </p>

                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center" style="background:#f8f9fa; color:#888888; font-size:13px; padding:18px;">
                            © {{ date('Y') }} AI Powered E-commerce. All rights reserved.
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>