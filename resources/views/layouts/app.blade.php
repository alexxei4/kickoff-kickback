
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'KickOffKickBack') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            text-align: center;
        }

        .title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .content {
            font-size: 18px;
            color: #666;
        }
        a:hover { text-decoration: none; color:blue; }
        a:focus { text-decoration: none; color:teal; }
        a:visited { text-decoration: none; color:teal; }
    </style>
</head>


<body>
    <div class="container">
        <div class="title">Forgot Password, or NVM?</div>
        <div class="title">↓</div>
        <div class="navbar">
                
                <a style="text-decoration:none" href="{{ route('login') }}">Login</a></li>
                <a style="text-decoration:none" href="{{ route('register') }}">Register</a></li>
                <a style="text-decoration:none" href="{{ route('frontend.index') }}">Products</a></li>
            
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>
</html>

