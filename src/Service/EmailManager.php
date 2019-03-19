<?php

namespace App\Service;

use App\Entity\Child;
use App\Entity\Sheet;
use Twig\Environment;

class EmailManager
{
    /** @var Environment $twig */
    protected $twig;
    /** @var \Swift_Mailer */
    private $mailer;

    public function __construct(Environment $twig, \Swift_Mailer $mailer)
    {
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    public function sendMail(Sheet $sheet, Child $child, array $emails, array $failedEmails)
    {
        $message = (new \Swift_Message("Rapport journalier de {$child->getFirstname()} {$child->getLastname()}"))
            ->setFrom('camieapp@gmail.com')
            ->setTo($emails)
            ->setBody(
                $this->twig->render('sheet_view/daily-summary.html.twig', [
                    'child' => $child,
                    'sheet' => $sheet,
                ]), 'text/html'
            );

        return $this->mailer->send($message, $failedEmails);
    }
}
