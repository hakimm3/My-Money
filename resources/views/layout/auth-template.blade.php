
<!doctype html>
<html class="no-js" lang="en">

<head>
   @include('layout._head')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->
    <!-- login area start -->
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
              @yield('content')
            </div>
        </div>
    </div>
    <!-- login area end -->

    <!-- jquery latest version -->
    @include('layout._script')
</body>

</html>
