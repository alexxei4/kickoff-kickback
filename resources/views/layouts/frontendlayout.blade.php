<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>@yield('title')</title>
    <!-- Add your CSS stylesheets and any necessary meta tags here -->
        <!-- Bootstrap and jQuery JS (Add this before the closing </body> tag of your layout file) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <!-- Bootstrap CSS (Add this to the <head> section of your layout file) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- OwlCarousel CSS (Add this to the <head> section of your layout file) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">



    <!-- OwlCarousel JS (Add this before the closing </body> tag of your layout file) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


</head>

<body class="bg-gray-100">
    <header class="bg-white shadow">
        <!-- Add your header content here -->
        <nav class="container mx-auto py-4 px-8 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-black-600"> <img src="{{ asset('images/KickOffKickBack.png') }}" alt="My Store Logo" width="100" height="100"></a>
            <ul class="flex space-x-4">

                <li><a href="{{ route('frontend.index') }}" class="text-black-600">Products</a></li>
                @if (Route::has('login'))
                    @auth
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-black-600">Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-black-600">Log in</a></li>

                        @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="text-black-600">Register</a></li>
                        @endif
                    @endauth
                @endif
                <!-- Add more navigation links as required -->
            </ul>
        </nav>

    </header>

    <main class="container mx-auto py-8">
        <!-- Add the main content of your pages here -->
        @yield('content')
    </main>

    <footer class="bg-gray-200 py-4 text-center">
        <!-- Add your footer content here -->
        &copy; {{ date('Y') }} KickOffKickBack. All rights reserved.
    </footer>

    <!-- Add your JavaScript files here if needed -->
</body>

</html>
