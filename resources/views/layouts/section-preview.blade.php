<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Section Preview</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { margin: 0; background: #fff; overflow-x: hidden; }
        /* Disable animations in preview */
        *, *::before, *::after { animation-duration: 0s !important; transition-duration: 0s !important; }
        .tp_fade_anim, .tp-text-revel-anim, .tp_text_anim { opacity: 1 !important; transform: none !important; }
    </style>
    @stack('styles')
</head>
<body>
    @yield('content')
    @stack('scripts')
</body>
</html>
