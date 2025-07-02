@extends('layouts.app')
@php($title = 'Criar Relatório')

@section('content')
    <h2 class="text-2xl font-bold text-[#653C8B] mb-6">Criar Novo Relatório</h2>

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


    <form action="{{ route('reports.store') }}" method="POST" class="space-y-8 relative">
        @csrf

        <!-- Mês -->
        <div>
            <label for="month" class="block text-md font-bold text-[#653C8B] mb-1">Mês do Relatório</label>
            <input type="month" name="month" id="month" required
                   class="w-full rounded-xl border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] shadow-sm px-4 py-2">
        </div>

        <!-- Participantes -->
        <div id="participants-wrapper" class="space-y-6 mt-2">
            <h3 class="text-lg font-semibold text-[#653C8B]">Participantes</h3>

            <div class="participant-form bg-white p-6 rounded-xl shadow-md border border-gray-200 space-y-4 relative">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                    <input type="text" name="people[0][name]" required
                           class="w-full rounded-lg border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Horas (pioneiro)</label>
                    <input type="number" name="people[0][hours]" placeholder="Se não for, deixe em branco"
                           class="w-full rounded-lg border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estudos</label>
                    <input type="number" name="people[0][studies]" required
                           class="w-full rounded-lg border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] px-4 py-2">
                </div>
            </div>
        </div>

        <!-- Botões -->
        <div class="flex justify-end gap-4 pt-2">
            <x-button.secondary type="button" onclick="addParticipant()">+ Participante</x-button.secondary>

            <x-button.primary>Salvar Relatório</x-button.primary>
        </div>
    </form>

    <script>
        let participantIndex = 1;

        function addParticipant() {
            const wrapper = document.getElementById('participants-wrapper');
            const html = `
                <div class="participant-form bg-white p-6 rounded-xl shadow-md border border-gray-200 space-y-4 relative group">
                    <button type="button" onclick="removeParticipant(this)"
                        class="absolute top-2 right-2 text-sm text-red-500 hover:text-red-700 transition">
                        ✕
                    </button>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" name="people[${participantIndex}][name]" required
                               class="w-full rounded-lg border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horas (pioneiro)</label>
                        <input type="number" name="people[${participantIndex}][hours]"
                               class="w-full rounded-lg border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] px-4 py-2"
                               placeholder="Se não for, deixe em branco">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estudos</label>
                        <input type="number" name="people[${participantIndex}][studies]" required
                               class="w-full rounded-lg border border-gray-300 focus:border-[#653C8B] focus:ring-[#653C8B] px-4 py-2">
                    </div>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
            participantIndex++;
        }

        function removeParticipant(button) {
            const participantForm = button.closest('.participant-form');
            participantForm.remove();
        }
    </script>
@endsection
