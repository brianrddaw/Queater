<!DOCTYPE html>
<html lang="es" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body class="overflow-x-hidden">
    @yield('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            min-width: 0;
        }
    </style>
</body>
</html>
