        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta property="description" content="@yield('description')" />
        <meta property="keywords" content="@yield('keywords')" />

        {{-- facebook Meta --}}
        <meta property="og:description" content="@yield('description')" />
        <meta property="og:image" content="@yield('metaImage')" />
        <meta property="og:image:type" content="image/jpeg" />


        {{-- twitter Meta --}}
        <meta property="twitter:card" content="@yield('summary_large_image')" />
        <meta property="twitter:site" content="{{ config('services.twitter.handle') }}" />
        <meta property="twitter:image" content="@yield('metaImage')" />
        <meta property="twitter:description" content="@yield('description')" />
        <meta property="twitter:title" content="@yield('title')" />
        <meta name="theme-color" content="#6777ef"/>

        {{-- Title --}}
        <title>@yield('title', ''.application('name'))</title>

        <link rel="shortcut icon" href="{{ asset('storage/'.application('image')) }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('storage/'.application('image')) }}" type="image/x-icon">
        <link rel="apple-touch-icon" href="{{ asset('storage/'.application('image')) }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">

        <script type='text/javascript' src='https://maps.google.com/maps/api/js?language=en&key={{ config('services.google.api_key') }}&libraries=places&region=GB'></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/choices.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('dist/css/agent.css') }}">
        <link href="{{ asset('css/nouislider.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/axios-loader.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/notiflix.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/toastr.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('plugins/ekko-lightbox/ekko-lightbox.css') }}">

        <script src="{{ mix('js/app.js') }}" defer></script>

        @stack('styles')

        @bukStyles(true)

        @livewireStyles
        @livewireScripts