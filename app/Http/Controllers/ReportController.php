<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReportPerson;

class ReportController extends Controller
{
    // Listar relatórios do usuário
    public function index()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();

        return view('dashboard', compact('reports'));
    }

    // Formulário para criar novo relatório
    public function create()
    {
        return view('reports.create');
    }

    // Salvar novo relatório
    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required|date_format:Y-m',
            'people.*.name' => 'required|string',
            'people.*.studies' => 'required|integer|min:0',
            'people.*.hours' => 'nullable|integer|min:0',
        ]);

        $currentMonth = date('Y-m');
        $inputMonth = $request->input('month');

        if ($inputMonth !== $currentMonth) {
            return back()->withErrors(['month' => 'Você só pode criar relatórios para o mês atual.']);
        }

        $exists = Report::where('user_id', Auth::id())
            ->where('month', $inputMonth)
            ->exists();

        if ($exists) {
            return back()->withErrors(['month' => 'Você já criou um relatório para este mês.']);
        }

        $report = Report::create([
            'user_id' => Auth::id(),
            'month' => $inputMonth,
            'author_name' => Auth::user()->name,
        ]);

        foreach ($request->people as $person) {
            $report->people()->create([
                'name' => $person['name'],
                'hours' => $person['hours'] ?? null,
                'studies' => $person['studies'],
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Relatório criado com sucesso!');
    }

    // Ver detalhes do relatório
    public function show(Report $report)
    {
        // Garantir que só o dono veja
        abort_if($report->user_id !== Auth::id(), 403);

        $report->load('people'); // Carrega a relação

        return view('reports.show', [
            'report' => $report,
            'people' => $report->people,
        ]);
    }

    public function edit(Report $report)
    {
        abort_if($report->user_id !== Auth::id(), 403);

        $people = $report->people;

        return view('reports.edit', compact('report', 'people'));
    }


    public function update(Request $request, Report $report)
    {
        // Garantir que o usuário é o dono do relatório
        abort_if($report->user_id !== Auth::id(), 403);

        // Atualizar participantes existentes
        if ($request->has('people')) {
            foreach ($request->people as $id => $data) {
                $person = ReportPerson::find($id);
                if ($person && $person->report_id === $report->id) {
                    $person->update([
                        'name' => $data['name'],
                        'hours' => $data['hours'] ?? null,
                        'studies' => $data['studies'],
                    ]);
                }
            }
        }

        // Adicionar novos participantes
        if ($request->has('new_people')) {
            foreach ($request->new_people as $data) {
                if (!empty($data['name']) && isset($data['studies'])) {
                    $report->people()->create([
                        'name' => $data['name'],
                        'hours' => $data['hours'] ?? null,
                        'studies' => $data['studies'],
                    ]);
                }
            }
        }

        // Remover participantes marcados
        if ($request->has('remove_people')) {
            foreach ($request->remove_people as $id) {
                $person = ReportPerson::where('id', $id)
                    ->where('report_id', $report->id)
                    ->first();
                if ($person) {
                    $person->delete();
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Relatório atualizado com sucesso!');
    }

    public function destroy(Report $report)
    {
        abort_if($report->user_id !== Auth::id(), 403);

        $report->delete();

        return redirect()->route('dashboard')->with('success', 'Relatório deletado com sucesso!');
    }
}
