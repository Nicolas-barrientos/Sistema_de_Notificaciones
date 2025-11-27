<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @auth
        <meta name="user-id" content="{{ auth()->id() }}">
        @endauth

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Script para prevenir flash del tema -->
        <script>
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- 🔔 Script para sincronizar el contador de notificaciones en el header -->
        <script>
            // Función global para actualizar el badge de notificaciones
            window.updateNotificationBadge = function(count) {
                const badge = document.getElementById('notification-badge');
                const badgeMobile = document.getElementById('notification-badge-mobile');
                
                if (badge && badgeMobile) {
                    if (count > 0) {
                        badge.textContent = count > 99 ? '99+' : count;
                        badgeMobile.textContent = count > 99 ? '99+' : count;
                        badge.classList.remove('hidden');
                        badgeMobile.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                        badgeMobile.classList.add('hidden');
                    }
                }
            };
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
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

        <!-- Scripts adicionales -->
        @stack('scripts')
    </body>
</html>