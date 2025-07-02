<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Relatórios' }}</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-[#F9FAFB] dark:bg-gray-900 dark:text-gray-100 text-gray-800 flex flex-col">

    <header class="bg-[#653C8B] text-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-lg font-bold">Relatório Mensal</h1>
            <nav class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('reports.create') }}" class="hover:underline">Criar</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:underline">Sair</button>
                </form>
            </nav>
        </div>
    </header>

    <main class="flex-1 max-w-4xl mx-auto w-full px-4 py-8">
        @yield('content')
    </main>

</body>
</html>
