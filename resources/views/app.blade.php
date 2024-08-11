<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" centent="{{ csrf_token() }}" />
    <title>{{ ENV('APP_NAME') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Favicon -->
    <link rel="icon" href="assets/img/brand/favicon.png" type="image/x-icon"/>
    <!-- Icons css -->
    <link href="assets/css/icons.css" rel="stylesheet">
    <!-- Bootstrap css -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--  Custom Scroll bar-->
    <link href="assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
    <!--  Sidebar css -->
    <link href="assets/plugins/sidebar/sidebar.css" rel="stylesheet">
    <!--- Internal Morris css-->
    <link href="assets/plugins/morris.js/morris.css" rel="stylesheet">
    <!--- Style css --->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/boxed.css" rel="stylesheet">
    <link href="assets/css/dark-boxed.css" rel="stylesheet">
    <!--- Dark-mode css --->
    <link href="assets/css/style-dark.css" rel="stylesheet">
    <!---Skinmodes css-->
    <link href="assets/css/skin-modes.css" rel="stylesheet" />
    
</head>
<body class="main-body">
    @if(Auth::check())
        @php 
          $user_auth_data =
            [
                'isLogedin' => true,
                'user'    => Auth::user()
            ]
        @endphp
    @else
        @php 
          $user_auth_data = 
            [
            'isLogedin' => false 
            ]
        @endphp
    @endif    

    <script>
        window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'))
    </script>
    <div id="app"></div>
    
    <!-- End Page -->
    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="las la-angle-double-up"></i></a>
    <!-- JQuery min js -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap Bundle js -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Ionicons js -->
    <script src="assets/plugins/ionicons/ionicons.js"></script>
    <!-- Moment js -->
    <script src="assets/plugins/moment/moment.js"></script>
    <!--Internal Sparkline js -->
    <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!-- Moment js -->
    <script src="assets/plugins/raphael/raphael.min.js"></script>
    <!-- Internal Piety js -->
    <script src="assets/plugins/peity/jquery.peity.min.js"></script>
    <!-- Rating js-->
    <script src="assets/plugins/rating/jquery.rating-stars.js"></script>
    <script src="assets/plugins/rating/jquery.barrating.js"></script>
    <!-- Eva-icons js -->
    <script src="assets/js/eva-icons.min.js"></script>
    <!-- Horizontalmenu js-->
    <script src="assets/plugins/horizontal-menu/horizontal-menu-2/horizontal-menu.js"></script>
    <!-- Sticky js -->
    <script src="assets/js/sticky.js"></script>
    <!-- Internal Chart js -->
    <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
    <!--Internal  index js -->
    <script src="assets/js/index.js"></script>
    <!-- custom js -->
    <script src="assets/js/custom.js"></script>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>
</body>
</html>