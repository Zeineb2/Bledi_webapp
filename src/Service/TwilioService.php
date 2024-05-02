<?php
// src/Service/TwilioService.php

namespace App\Service;

use Twilio\Rest\Client;

class TwilioService
{
    private $client;

    public function __construct(string $sid, string $token)
    {
        $this->client = new Client($sid, $token);
    }

    public function sendSMS(string $to, string $message): void
    {
        $this->client->messages->create(
            $to,
            [
                'from' => $_ENV['TWILIO_PHONE_NUMBER'],
                'body' => $message
            ]
        );
    }
}
