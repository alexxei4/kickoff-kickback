<!DOCTYPE html>
<html>
<head>
    <title>Password Reset</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            color: #666;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Password Reset</h2>
        <p>Hello,</p>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p>
            Click the button below to reset your password:<br>
            <a href="{{ route('password.reset', ['token' => $token, 'email' => $email]) }}" target="_blank">Reset Password</a>
        </p>
        <p>If you did not request a password reset, no further action is required.</p>
    </div>
</body>
</html>
