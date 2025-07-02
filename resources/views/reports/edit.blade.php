@extends('layouts.app')
@php($title = 'Editar Relatório')

@section('content')
    <h2 class="text-2xl font-bold text-[#653C8B] mb-6">Editar Relatório</h2>

    <form action="{{ route('reports.update', $report) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Mês (desabilitado para edição) -->
        <div>
            <label class="block text-md font-bold text-[#653C8B] mb-1">Mês</label>
            <input type="month" name="month" value="{{ $report->month }}" disabled
                   class="w-full rounded-xl border border-gray-300 px-4 py-2 bg-gray-100">
        </div>

        <!-- Participantes existentes -->
        <div class="space-y-6">
            <h3 class="text-lg font-semibold text-[#653C8B]">Participantes</h3>

            @foreach ($people as $person)
                <div class="participant-form bg-white p-6 rounded-xl shadow-md border border-gray-200 space-y-4 relative">
                    <button type="button" onclick="removeExisting(this, {{ $person->id }})"
                            class="absolute top-2 right-2 text-sm text-red-500 hover:text-red-700 transition">
                        ✕
                    </button>

                    <input type="hidden" name="people[{{ $person->id }}][id]" value="{{ $person->id }}">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" name="people[{{ $person->id }}][name]" value="{{ $person->name }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horas</label>
                        <input type="number" name="people[{{ $person->id }}][hours]" value="{{ $person->hours }}"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estudos</label>
                        <input type="number" name="people[{{ $person->id }}][studies]" value="{{ $person->studies }}" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Participantes novos -->
        <div id="new-participants-wrapper" class="space-y-6 mt-6">
            <h4 class="text-md font-semibold text-[#653C8B]">Adicionar Novos Participantes</h4>
        </div>

        <!-- Botões -->
        <div class="flex justify-end gap-4 pt-4">
            <x-button.secondary type="button" onclick="addNewParticipant()">+ Novo Participante</x-button.secondary>
            <x-button.primary>Salvar Alterações</x-button.primary>
        </div>

        <!-- Participantes removidos -->
        <div id="removed-people-container"></div>
    </form>

    <script>
        let newIndex = 0;

        function addNewParticipant() {
            const wrapper = document.getElementById('new-participants-wrapper');
            const html = `
                <div class="participant-form bg-white p-6 rounded-xl shadow-md border border-gray-200 space-y-4 relative group">
                    <button type="button" onclick="this.closest('.participant-form').remove()"
                        class="absolute top-2 right-2 text-sm text-red-500 hover:text-red-700 transition">✕</button>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
                        <input type="text" name="new_people[${newIndex}][name]" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horas</label>
                        <input type="number" name="new_people[${newIndex}][hours]"
                               class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estudos</label>
                        <input type="number" name="new_people[${newIndex}][studies]" required
                               class="w-full rounded-lg border border-gray-300 px-4 py-2">
                    </div>
                </div>
            `;
            wrapper.insertAdjacentHTML('beforeend', html);
            newIndex++;
        }

        function removeExisting(button, id) {
            if (confirm('Deseja realmente remover este participante? Isso apagará os dados da base.')) {
                button.closest('.participant-form').remove();
                const container = document.getElementById('removed-people-container');
                container.innerHTML += `<input type="hidden" name="remove_people[]" value="${id}">`;
            }
        }
    </script>
@endsection
