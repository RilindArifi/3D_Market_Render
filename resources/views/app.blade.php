<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="shortcut icon" href="{{asset('assets/img/dashboard/3dicon.jfif')}}" type="image/icon">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        {{-- back --}}

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />


        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

        <link href="{{ asset('assets/css/styles.css?v=1.0.3') }}" rel="stylesheet" />

        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>

        {{-- back --}}
        <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}" async></script>

        <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>

        <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.3') }}" async></script>
{{--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
</html>
