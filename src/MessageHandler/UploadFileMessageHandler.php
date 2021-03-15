<?php

namespace App\MessageHandler;

use App\Message\UploadFileMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UploadFileMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private LoggerInterface $logger;

    public function __construct(EntityManagerInterface $entityManager, LoggerInterface $logger)
    {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    public function __invoke(UploadFileMessage $uploadFileMessage)
    {
        $context = $uploadFileMessage->getContext();
        $this->logger->info(implode('|', $context));
    }
}