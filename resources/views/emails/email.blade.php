<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
</head>
<body>
    <h2>Reset Your Password</h2>
    
    <p>Hello,</p>
    
    <p>You are receiving this email because we received a password reset request for your account.</p>
    
    <p>
        Click the button below to reset your password:
        <br>
        <a href="{{ $resetUrl }}" target="_blank">{{ $resetUrl }}</a>
    </p>
    
    <p>If you did not request a password reset, no further action is required.</p>
</body>
</html>