<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>CodePen - Datepicker with TailwindCSS and AlpineJS</title>
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <style>
            [x-cloak] {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="antialiased sans-serif bg-gray-200">
            @yield('content')
        </div>
    </body>
</html>