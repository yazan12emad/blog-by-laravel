@props([
    'title' => 'blog | laravel version'
])

<!doctype html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css"/>

    <style>
        :root {
            color-scheme: dark;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(180deg, #0b1120 0%, #111827 100%);
            color: #e5e7eb;
        }

        .app-shell {
            min-height: 100vh;
        }

        .page-content {
            width: min(100%, 1200px);
            margin: 0 auto;
            padding: 1.5rem 1rem 2.5rem;
        }

        @media (min-width: 640px) {
            .page-content {
                padding: 2rem 1.5rem 3rem;
            }
        }
    </style>

    @stack('styles')
</head>

<body>
<div class="app-shell">
    <x-nav />

    <main class="page-content">
        {{ $slot }}
    </main>
</div>
</body>
</html>
