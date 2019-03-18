<?php

namespace App\Command;

use App\Entity\Child;
use App\Entity\Sheet;
use App\Entity\User;
use App\Service\ChildManager;
use App\Service\SheetManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Twig\Environment;

class SendSheetCommand extends Command
{
    protected static $defaultName = 'mail:sheet';

    /** @var ChildManager */
    protected $childManager;
    /** @var SheetManager */
    protected $sheetManager;
    /** @var Environment */
    protected $twig;
    /** @var \Swift_Mailer */
    protected $mailer;

    public function __construct(ChildManager $childManager, SheetManager $sheetManager,Environment $twig, \Swift_Mailer $mailer)
    {
        parent::__construct();
        $this->childManager = $childManager;
        $this->sheetManager = $sheetManager;
        $this->twig = $twig;
        $this->mailer = $mailer;
    }

    protected function configure()
    {
        $this
            ->setDescription('Send the daily sheet by mail for a given child')
            ->addArgument('child', InputArgument::REQUIRED, 'Child ID')
            ->addArgument('sheet', InputArgument::REQUIRED, 'Sheet ID')
            //->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $childId = $input->getArgument('child');
        $sheetId = $input->getArgument('sheet');

        $child = $this->childManager->getChildById($childId);
        /** @var Sheet $sheet */
        $sheet = $child->getSheets()->filter(function (Sheet $sheet) use($sheetId) {return $sheet->getId() == $sheetId; })->first();

        if (!$sheet) {
            $io->warning(sprintf('Child "%s" has no sheet with id "%s". No mails sent.', $childId, $sheetId));
            return 0;
        }

        $emails = $child->getUsers()
                        ->filter(function (User $user) {return in_array('ROLE_GUARDIAN', $user->getRoles()); })
                        ->map(function (User $user) {return $user->getEmail();})
        ;

        if ($emails->isEmpty()) {
            $io->warning(sprintf('Child "%s" has no Guardians with an email. No mails sent.', $childId));
            return 0;
        }

        if ($output->isVerbose()) {
            $io->note(sprintf('sending sheet "%s" for child "%s" to :', $sheetId, $childId));
            foreach ($emails as $email) {
                $io->note($email);
            }
        }

        $failedEmails = [];
        $mailsSent = $this->sendMail($sheet, $child, $emails->toArray(), $failedEmails);

        if (empty($failedEmails)) {
            $io->success(sprintf('%s mails sent.', $mailsSent));
        } else {
            $failedEmailsString = implode(", ", $failedEmails);
            $io->error(sprintf('An error occured when sending the sheet of "%s" for email(s) %s.', $childId, $failedEmailsString));
        }

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
