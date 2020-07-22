<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('tittle'){{ config('app.name', 'Laravel') }}</title>

    <link rel="apple-touch-icon" href="{{asset('public/assets/backend')}}/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon"
          href="{{asset('public/assets/backend')}}/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS Common-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/vendors/css/ui/prism.min.css">
    <!-- END: Vendor CSS Common-->

    <!-- BEGIN: Theme CSS Common-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS Common-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/assets/backend')}}/assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css"
          href="{{asset('public/assets/backend')}}/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <!-- END: Page CSS-->

    <!-- ***************************************************************************************************-->

    <!-- BEGIN: Theme JS Common-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/core/app.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS Common-->

    <!-- BEGIN: Vendor JS Common-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/vendors.min.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('public/assets/backend')}}/app-assets/js/core/app.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('public/assets/backend')}}/app-assets/vendors/js/ui/prism.min.js"></script>
    <!-- END: Page Vendor JS-->
{{--    tooster--}}
    <link rel="stylesheet" href="https://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <!-- Custom CSS for pages-->
@stack('css')
<!-- Custom Script for pages-->
    @stack('js')

</head>
@guest
    @yield('auth_content')
@else


    <body class="vertical-layout semi-dark-layout vertical-menu-modern 2-columns  navbar-floating footer-static  " data-open="click"
          data-menu="vertical-menu-modern" data-col="2-columns">
    <!-- fixed-top-->
    @include('layouts.backend.partial.header')
    @include('layouts.backend.partial.sidebar')


    @yield('content')
    </div>
    <!-- END Content-->


    <!-- START FOOTER LIGHT-->
    @include('layouts.backend.partial.footer')
    <!-- END FOOTER LIGHT-->


    <!-- END: Body-->


    <script src="https://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
                toastr.error('{{$error}}');
            @endforeach
        @endif
    </script>


    </body>
</html>
@endguest
