<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="data:image/png;base64,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" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->

            @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @include('sweetalert::alert')
    </body>
</html>
