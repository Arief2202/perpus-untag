<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <title>@yield('title')</title>
        <meta content="" name="description">
        @if(isset(Auth::user()->email))
            <meta name="csrf-token" content="{{ Session::token() }}"> 
            <meta name="userEmail" content="{{ Auth::user()->email }}"> 
        @endif
        <meta content="" name="keywords">

        <!-- Favicons -->
        <link href="/main_display/img/favicon.ico" rel="icon">
        <link href="/main_display/img/apple-touch-icon.png" rel="apple-touch-icon">

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

        <!-- Vendor CSS Files -->
        <link href="/main_display/vendor/aos/aos.css" rel="stylesheet">
        <link href="/main_display/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="/main_display/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="/main_display/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="/main_display/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="/main_display/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
        <link href="/main_display/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
        <!-- @if(Request::segment(1) == 'dashboard')<link href="/main_display/css/sidebars.css" rel="stylesheet">@endif -->

        @if(Request::segment(1) == 'dashboard')
            <link href="/dashboard_resources/css/global.css" rel="stylesheet">
            <link href="/dashboard_resources/css/sidebar/style.css" rel="stylesheet">
        @else            
            <link href="/main_display/css/style.css" rel="stylesheet">
        @endif
        @yield('style')

    </head>

    <body @if(Request::segment(1) == 'dashboard') class="{{Auth::user()->darkMode == '1' ? 'dark' : ''}}" @endif>
        
        @if(Request::segment(1) == 'dashboard')
            @include('components.sidebar')
            <section class="home">        
                @yield('content')            
            </section>
        @else
            @include('components.navbar')
            
            @yield('content')
            
            @include('components.footer')
        @endif      

        <!-- Vendor JS Files -->
        <script src="/main_display/vendor/jquery/jquery-3.6.4.min.js"></script>
        <script src="/main_display/vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="/main_display/vendor/purecounter/purecounter_vanilla.js"></script>
        <script src="/main_display/vendor/aos/aos.js"></script>
        <script src="/main_display/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/main_display/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="/main_display/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="/main_display/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="/main_display/vendor/waypoints/noframework.waypoints.js"></script>
        <script src="/main_display/vendor/php-email-form/validate.js"></script>
        @if(Request::segment(1) == 'dashboard')
            <script type="text/javascript" src="/dashboard_resources/js/sidebar/script.js"></script>
        @else
            <script src="/main_display/js/main.js"></script>
        @endif
        @yield('script')
    </body>

</html>