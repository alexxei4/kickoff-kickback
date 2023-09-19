<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    @yield('title', 'Default Title')
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link href="../assets/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="{{ asset('css/paper-dashboard.css') }}" rel="stylesheet">
  
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <i class="nc-icon nc-single-02"></i>
        Admin
      </div>
      <div class="sidebar-wrapper">
      
      
    <ul class="nav">
      <li class="{{ request()->is('sales') ? 'active' : '' }}">
        <a href="{{ route('admin.sales') }}">
            <i class="nc-icon nc-chart-bar-32"></i>
            <p>Sales/Analytics</p>
        </a>
    </li>
      <li class="{{ request()->is('users') ? 'active' : '' }}">
        <a href="{{ route('admin.users.users') }}">
            <i class="nc-icon nc-single-02"></i>
            <p>Users</p>
        </a>
    </li>
      <li class="{{ request()->is('admin') ? 'active' : '' }}">
        <a href="{{ route('frontend.index') }}">
          <i class="nc-icon nc-shop"></i>
          <p>Back to Store</p>
        </a>
      </li>
      <li class="{{ request()->is('admin') ? 'active' : '' }}">
        <a>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-black-600">Logout</button>
            
            <i class="nc-icon nc-button-power"></i>
            
          </form>
        </a>
         
      </li>
        <li class="{{ request()->is('admin') ? 'active' : '' }}">
            <a href="{{ url('/dashboard') }}">
                <i class="nc-icon nc-bank"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="{{ request()->is('categories') ? 'active' : '' }}">
            <a href="{{ url('/categories') }}">
                <i class="nc-icon nc-tile-56"></i>
                <p>Category</p>
            </a>
        </li>
        <li class="{{ request()->is('add-category') ? 'active' : '' }}">
            <a href="{{ url('/add-category') }}">
                <i class="nc-icon nc-tag-content"></i>
                <p>Add Category</p>
            </a>
        </li>
        <li class="{{ request()->is('/index-product') ? 'active' : '' }}">
            <a href="{{ url('/products') }}">
                <i class="nc-icon nc-box"></i>
                <p>Products</p>
            </a>
        </li>
        <li class="{{ request()->is('add-product') ? 'active' : '' }}">
            <a href="{{ url('/add-product') }}">
                <i class="nc-icon nc-cart-simple"></i>
                <p>Add Products</p>
            </a>
        </li>
    </ul>
</div>

    </div>
    <div class="main-panel">
      <div class="content">
        @yield('content')
      </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">
                © <script>
                  document.write(new Date().getFullYear())
                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
</body>

</html>
