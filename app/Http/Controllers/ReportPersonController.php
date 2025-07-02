<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportPerson;
use Illuminate\Http\Request;

class ReportPersonController extends Controller
{
    // Formulário para adicionar pessoa ao relatório
    public function create(Report $report)
    {
        return view('report_people.create', compact('report'));
    }

    // Armazenar nova pessoa
    public function store(Request $request, Report $report)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'is_pioneer' => 'required|boolean',
            'hours' => 'nullable|integer',
            'hours_tick' => 'nullable|boolean',
            'studies' => 'required|integer|min:0',
        ]);

        // Corrigir consistência dos campos
        if ($validated['is_pioneer']) {
            $validated['hours_tick'] = null;
        } else {
            $validated['hours'] = null;
        }

        $validated['report_id'] = $report->id;

        ReportPerson::create($validated);

        return redirect()->route('reports.show', $report);
    }
}
