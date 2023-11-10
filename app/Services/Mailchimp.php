<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MailchimpTransactional\ApiClient;

class Mailchimp
{
    public function send($to, $toName, $subject, $message, $from=null, $fromName=null){
        if (!$from){
            $from = config('services.mailchimp.from');
        }

        if (!$fromName){
            $fromName = config('services.mailchimp.fromName');
        }

        $mailchimp = new ApiClient();
        $mailchimp->setApiKey(config('services.mailchimp.token'));

        $messageParams = [
            'text' => $message,
            'subject' => $subject,
            'from_email' => $from,
            'from_name' => $fromName,
            'to' => [
                [
                    'email' => $to,
                    'name' => $to,
                    'type' => 'to',
                ]
            ],
        ];

        $response = $mailchimp->messages->send(["message" => $messageParams]);

        Log::debug('Mailchimp request', $messageParams);
        return true;
    }
}
