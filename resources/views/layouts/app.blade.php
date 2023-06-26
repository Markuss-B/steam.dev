<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @if (isset($styles))
            {{ $styles }}
        @endif
        
        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jscroll/2.4.1/jquery.jscroll.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @if (isset($scripts))
            {{ $scripts }}
        @endif

        <!-- Styles -->
        <x-stylesheets />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    @if (isset($header))
                        {{ $header }}
                    @elseif (isset($title))
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $title }}
                        </h2>
                    @endif
                </div>
            </header>
                        
            <!-- Alert box -->
            @if (session('success_message'))
                <x-alert-box type="success" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ session('success_message') }}
                </x-alert-box>
            @elseif (session('error_message'))
                <x-alert-box type="error" class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ session('error_message') }}
                </x-alert-box>
            @endif

            <!-- Page Content -->
            <main>
            @if (!$basiclayout)
                    {{ $slot }}
                @else
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-fill">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </main>
        </div>
    </body>
</html>
