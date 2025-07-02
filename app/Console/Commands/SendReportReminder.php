<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Report;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportReminderMail;
use App\Services\TwilioWhatsAppService;

class SendReportReminder extends Command
{
    protected $signature = 'send:report-reminder';
    protected $description = 'Envia lembrete para revisar o relatório mensal';

    public function handle()
    {
        $today = Carbon::now();

        // Remover isso em produção. Apenas para testes:
        if (!app()->environment('production')) {
            $this->info("[TESTE] Forçando envio para todos os relatórios do mês atual");
            $reports = Report::where('month', $today->format('Y-m'))->get();
        } else {
            $lastDay = $today->copy()->endOfMonth();
            if ($lastDay->diffInDays($today) !== 2) {
                return;
            }
            $reports = Report::where('month', $today->format('Y-m'))->get();
        }

        foreach ($reports as $report) {
            $user = $report->user;
            Mail::to('leonkubamn2020@gmail.com')->send(new ReportReminderMail($user, $report));
            TwilioWhatsAppService::send(env('WHATSAPP_TO'), "📢 Lembrete: revise seu relatório de {$report->month}");
        }


        $this->info("Lembretes enviados com sucesso!");
    }
}
