<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
		<link href="https://cdn.jsdelivr.net/npm/daisyui@4.10.2/dist/full.min.css" rel="stylesheet" type="text/css" />

        {{-- baru --}}
        <link href="./dist/css/tabler.min.css?1684106062" rel="stylesheet"/>
        <link href="./dist/css/tabler-flags.min.css?1684106062" rel="stylesheet"/>
        <link href="./dist/css/tabler-payments.min.css?1684106062" rel="stylesheet"/>
        <link href="./dist/css/tabler-vendors.min.css?1684106062" rel="stylesheet"/>
        <link href="./dist/css/demo.min.css?1684106062" rel="stylesheet"/>
        <style>
        @import url('https://rsms.me/inter/inter.css');
        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }
        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
        </style>
        {{-- endbaru --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            {{-- <livewire:layout.navigation /> --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="./dist/js/demo-theme.min.js?1684106062"></script>
        <!-- Libs JS -->
    <script src="./dist/libs/apexcharts/dist/apexcharts.min.js?1684106062" defer></script>
    <script src="./dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062" defer></script>
    <script src="./dist/libs/jsvectormap/dist/maps/world.js?1684106062" defer></script>
    <script src="./dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062" defer></script>
    <!-- Tabler Core -->
    <script src="./dist/js/tabler.min.js?1684106062" defer></script>
    <script src="./dist/js/demo.min.js?1684106062" defer></script>

	<script src="https://cdn.tailwindcss.com"></script>
    </body>
</html>
