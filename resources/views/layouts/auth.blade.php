<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Autenticação' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-[#F5F5F5] text-gray-800">
    <div class="w-full max-w-md p-6 bg-white rounded-2xl shadow-xl border-t-8 border-[#653C8B]">
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-[#653C8B]">{{ $title ?? 'Bem-vindo' }}</h1>
        </div>

        @yield('content')
    </div>
</body>
</html>
