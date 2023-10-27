<?php

namespace App\MessageHandler;


use App\Message\ContactMessage;
use App\Service\MailService;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ContactMessageHandler
{
    private  MailService $mailService;

    /**
     * @param MailService $mailService
     */
    public function __construct(MailService $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function __invoke(ContactMessage $message): void
    {
        $this->mailService->sendMail(
            $message->getFrom(),
            $message->getSubject(),
            'email/_contact.html.twig',
            [
                'userName' => $message->getFullName(),
                "Message" => $message->getMessage(),
            ],
        );
    }


}