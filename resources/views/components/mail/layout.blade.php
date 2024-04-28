<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-100 min-h-screen">
            <main class="px-4">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
