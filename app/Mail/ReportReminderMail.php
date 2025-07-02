<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Report;

class ReportReminderMail extends Mailable
{
    use SerializesModels;

    public $user;
    public $report;

    public function __construct(User $user, Report $report)
    {
        $this->user = $user;
        $this->report = $report;
    }

    public function build()
    {
        return $this->subject('📢 Lembrete: Seu relatório mensal')
                    ->view('emails.report-reminder');
    }
}
