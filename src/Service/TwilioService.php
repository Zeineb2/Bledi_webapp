<?php
// src/Service/TwilioService.php
namespace App\Service;

use twilio\Rest\Client;

class TwilioService
{
    private $twilioAccountSid;
    private $twilioAuthToken;
    private $twilioPhoneNumber;

    public function __construct(string $twilioAccountSid, string $twilioAuthToken, string $twilioPhoneNumber)
    {
        $this->twilioAccountSid = $twilioAccountSid;
        $this->twilioAuthToken = $twilioAuthToken;
        $this->twilioPhoneNumber = $twilioPhoneNumber;
    }

    public function sendWelcomeMessage(string $phoneNumber): void
    {
        $twilioClient = new Client($this->twilioAccountSid, $this->twilioAuthToken);

        $messageBody = '_un Utilisateur vient de s inscrire';

        $twilioClient->messages->create(
            $phoneNumber,
            [
                'from' => $this->twilioPhoneNumber,
                'body' => $messageBody,
                //'to' => 
            ]
        );
    }
}

