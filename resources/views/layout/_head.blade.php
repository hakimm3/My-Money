<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
{{-- <link rel="shortcut icon" type="image/png" href="{{ asset('/assets/images/icon/favicon.ico') }}"> --}}
<link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/metisMenu.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/slicknav.min.css') }}">
<!-- others css -->
<link rel="stylesheet" href="{{ asset('/assets/css/typography.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/default-css.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/styles.css') }}">
<link rel="stylesheet" href="{{ asset('/assets/css/responsive.css') }}">
<!-- modernizr css -->
<script src="{{ asset('/assets/js/vendor/modernizr-2.8.3.min.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- AM Chart --}}
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/locales/de_DE.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/germanyLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/fonts/notosans-sc.js"></script>
