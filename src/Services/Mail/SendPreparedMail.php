<?php 

namespace App\Services\Mail;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendPreparedMail
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMailToSupport(string $email,string $contentMessage, string $subjectMessage)
    {
        $email = (new TemplatedEmail())
            ->from('noreply@monsite.com')
            ->to('becool.lj@gmail.com')
            ->subject($subjectMessage)
            ->htmlTemplate('email/support.html.twig')
            ->context([
                'emailCustomer' => $email,
                'contentMessage' => $contentMessage,
                'subjectMessage' => $subjectMessage
            ]);

        $this->mailer->send($email);

    }

    public function sendMailToContact(string $email, string $message, string $nom, string $prenom)
    {
        $contactEmail = (new TemplatedEmail())
            ->from('noreply@monsite.com')
            ->to('frank.bollea@gmail.com')
            /* ->to('support@monsite.com') */
            ->subject($message)
            ->htmlTemplate('email/contact.html.twig')
            ->context([
                'email' => $email,
                'nom' => $nom,
                'prenom' => $prenom,
                'message' => $message
            ]);

        $this->mailer->send($contactEmail);
    }
}