@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <h2 class="text-2xl font-bold text-[#653C8B] mb-6">Seus Relatórios</h2>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Sucesso! </strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    @if ($reports->count())
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-[#653C8B] text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">Mês</th>
                        <th class="px-4 py-2 text-left">Autor</th>
                        <th class="px-4 py-2">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $report)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $report->month }}</td>
                            <td class="px-4 py-2">{{ $report->author_name }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('reports.show', $report) }}" class="text-primary font-semibold hover:underline">Ver</a>
                                    <a href="{{ route('reports.edit', $report) }}" class="text-yellow-600 font-semibold hover:underline">Editar</a>
                                    <form method="POST" action="{{ route('reports.destroy', $report) }}" onsubmit="return confirm('Tem certeza que deseja excluir este relatório?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 font-semibold hover:underline">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-600">Você ainda não criou nenhum relatório.</p>
    @endif
</div>
@endsection
