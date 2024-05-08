<?php
namespace App\Service;
use Twilio\Rest\Client;

 class SMSService
{
    function sendSMS($nom)
    {
    $sid = 'AC977033caa6735f5f352d2ae54f98273e';
$token = '6b00884c1f11e23df7c8b1b3676fa630';

// Initialisation du client Twilio
$client = new Client($sid, $token);
$message = $client->messages->create(
    '+12185203629', // Numéro Twilio "from"
    [
        'from' => '+12185203629',
        'body' => 'le client'  . $nom . ' a ajouter une reclamation', // Corps du message SMS
        'to' => '+21629250170' // Numéro de téléphone de destination
    ] 
);
    }


    
}
