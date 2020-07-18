<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tittle'){{ config('app.name', 'Laravel') }}</title>

    <!-- BEGIN: Vendor JS Common-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS Common-->

    <!-- BEGIN: Theme JS Common-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/core/app.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS Common-->

    <!-- Custom JS for pages-->
    @stack('js')

{{--    <!-- Scripts -->--}}
{{--    <script src="{{ asset('public/js/app.js') }}" defer></script>--}}
{{--    <!-- Styles -->--}}
{{--    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">--}}



    <link rel="apple-touch-icon" href="{{asset('public/assets/backend')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/backend')}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS Common-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS Common-->

    <!-- BEGIN: Theme CSS Common-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS Common-->

    <!-- CUSTOM: Page CSS-->
    @stack('css')
    <!-- CUSTOM: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/assets/css/style.css">
    <!-- END: Custom CSS-->
</head>
<body>


@yield('content')






</body>
</html>

