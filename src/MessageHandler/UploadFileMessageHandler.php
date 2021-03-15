<?php

namespace App\MessageHandler;

use App\Message\UploadFileMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadFileMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(UploadFileMessage $uploadFileMessage)
    {
        $context = $uploadFileMessage->getContext();
    }
}