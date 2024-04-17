<?php
namespace App\Service;
use Twilio\Rest\Client;

 class SMSService
{
    function sendSMS($nom)
    {
    $sid = 'AC178ae7e7e2e320a25709cb50b555834c';
$token = '8d98dc3965344773ea83cf3ebdaea666';

// Initialisation du client Twilio
$client = new Client($sid, $token);
$message = $client->messages->create(
    'YOUR_TWILIO_PHONE_NUMBER', // Numéro Twilio "from"
    [
        'from' => '+21625627870',
        'body' => 'le client'  . $nom . ' a ajouter une reclamation', // Corps du message SMS
        'to' => '+12057934754' // Numéro de téléphone de destination
    ]
);
    }


    
}
