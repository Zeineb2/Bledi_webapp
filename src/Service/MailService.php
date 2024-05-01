<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class MailerService
{
    
    private $mailer;
    
    
    public function __construct( MailerInterface $mailer)
     {
        
        $this->mailer=$mailer;
     }
    
    public function sendEmail(    ): void
    {
        
        $email = (new Email())
            ->from('rochdaouini@gmail.com')
            ->to("rochdaouini@gmail.com")
            ->subject("reponse")
            ->text("Un utilisateur vient de s'inscrire");
            
             
            $this->mailer->send($email);
      
        // ...
    }
}
?>