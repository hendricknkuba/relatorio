@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8 p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold text-[#653C8B] mb-4">Relatório de {{ $report->month }}</h2>

    <table class="w-full table-auto border-collapse mb-6">
        <thead>
            <tr class="bg-[#653C8B] text-white">
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">Horas</th>
                <th class="px-4 py-2 text-left">Estudos</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($people as $person)
                <tr class="border-b hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $person->name }}</td>
                    <td class="px-4 py-2">
                        {{ is_numeric($person->hours) ? $person->hours . 'h' : '✓' }}
                    </td>
                    <td class="px-4 py-2">{{ $person->studies }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">Nenhum participante encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('reports.edit', $report) }}" class="bg-[#8157b6] text-white px-4 py-2 rounded hover:bg-[#7142a2] transition">Editar</a>
        <a href="{{ route('dashboard') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">Voltar</a>
    </div>
</div>
@endsection
