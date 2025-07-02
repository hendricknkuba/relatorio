<?php
namespace App\Services;

use Twilio\Rest\Client;

class TwilioWhatsAppService
{
    public static function send($to, $message)
    {
        $sid = env('TWILIO_SID');
        $token = env('TWILIO_AUTH_TOKEN');
        $from = env('TWILIO_WHATSAPP_FROM');

        $client = new Client($sid, $token);

        return $client->messages->create($to, [
            'from' => $from,
            'body' => $message,
        ]);
    }
}
