<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: #fff; padding: 30px; border-radius: 10px; text-align: center;">
        <h2 style="color: #333;">Welcome to {{ config('app.name') }}!</h2>
        <p style="font-size: 16px; color: #555;">
            Please verify your email to activate your account.
        </p>
        <p style="font-size: 14px; color: #888;">
            This is the verification link to verify your email address.
        </p>
        <a href="{{ $verificationUrl }}" 
           style="display: inline-block; padding: 12px 25px; background-color: #1a73e8; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 20px;">
            Verify Email
        </a>
        <p style="margin-top: 20px; font-size: 12px; color: #888;">
            If you did not create an account, no action is required.
        </p>
    </div>
</body>
</html>
