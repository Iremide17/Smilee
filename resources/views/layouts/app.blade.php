<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="font-sans antialiased text-sm">
        <x-jet-banner />

        <div class="hold-transition sidebar-mini layout-fixed">

            <div class="">

                <!-- Preloader -->
                <div class="preloader flex-column justify-content-center align-items-center">
                  <x-logos.main class="animation__shake" height="60" width="60"/>
                </div>
	            {{-- <div class="preloader"></div> --}}

                {{-- navbar --}}
                <x-dashboard.nav />

                {{-- Sidenav --}}
                    <x-dashboard.sidenav />


                <div class="content-wrapper">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <section class="content-header">
                            <header class="mx-6 mt-6 text-gray-50 shadow bg-theme-blue-100">
                                <div class="px-4 py-6 wrapper">
                                    {{ $header }}
                                </div>
                            </header>
                        </section>
                    @endif

                    {{-- Alerts --}}
                        <div class="mx-6 mt-6">
                            <x-alerts.main />
                        </div>

                    <!-- Page Content -->
                    <main class="m-6 bg-white shadow">
                        <div class="py-6">
                            <section class="content">
                                {{-- @includeWhen(request()->is('/'), 'partials.map') --}}
                                {{ $slot }}
                            </section>
                        </div>
                    </main>
                </div>
            </div>

        </div>

        <!--Scroll to top-->
        <div class="back-to-top scroll-to-target show-back-to-top" data-target="html">TOP</div>

        @include('partials.script')
    </body>
</html>
