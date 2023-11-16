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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


</head>

<body class="bg-gray-100">
    <header class="bg-white shadow">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
            <img src="{{ asset('/public/images/KickOffKickBack.png') }}" alt="My Store Logo" width="100" height="100">
           
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/home">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="/aboutus">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="/">Products</a></li>
                        @if (Route::has('login'))
                            @auth
                            
                                
                                @if(Auth::user()->role === 1)
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard">Admin Dashboard</a>
                                </li>
                                @endif
                               
                                <li class="nav-item">
                                    <a class="nav-link">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="text-black-600">Logout</button>
                                        </form>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a href="{{ route('profile.show') }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ asset('storage/app/public/' . Auth::user()->profile_picture) }}" alt="Profile Picture" width="45" height="45" class="rounded-circle">
                                    </a>
                                    
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class = "nav-link" href="{{ route('login') }}" class="text-black-600">Log in</a>
                                </li>

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a   class = "nav-link"  href="{{ route('register') }}" class="text-black-600">Register</a>
                                    </li>
                                @endif
                                
                        @endif
                        @endauth

    
                        
                    </ul>
                    @auth
                        <div class="d-flex">
                            @if(Auth::user()->role === 0)
                                    <a href="{{ route('cart.index') }}" class="btn btn-outline-dark flex-shrink-0">
                                    Cart 
                                    </a>
                                    &nbsp;
                                    <a href="{{ route('wishlist.index') }}" class="btn btn-outline-dark flex-shrink-0">
                                        Wishlist 
                                    </a>
                            @endif
                            
                            
                        </div>
                        
                    @endauth
                    @if (Route::has('login'))
                   
                    @endif
                </div>
            </div>
        </nav>

    </header>

    <main class="container mx-auto py-8">
    
        @yield('content')
    </main>

    <footer class="bg-gray-200 py-4 text-center">
    
        &copy; {{ date('Y') }} KickOffKickBack. All rights reserved.
    </footer>


</body>

</html>
