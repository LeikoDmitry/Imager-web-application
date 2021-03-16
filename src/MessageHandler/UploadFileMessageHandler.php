<?php

namespace App\MessageHandler;

use App\Entity\Attachment;
use App\Entity\Document;
use App\Message\UploadFileMessage;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Generator;

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
        $contextItemGenerator = $this->iterateContextItem($context);
        foreach ($contextItemGenerator as $contextItem) {
            $name = explode('.', $contextItem);
            $attachment = $this->getAttachment()->setName(reset($name))->setPath($contextItem);
            $document = $this->getDocument()->setName($attachment->getName())->setSlug($attachment->getName())->setAttachment($attachment);
            $this->entityManager->persist($attachment);
            $this->entityManager->persist($document);
            $this->entityManager->flush();
        }
    }

    protected function iterateContextItem(array $context): Generator
    {
        foreach ($context as $item) {
            yield $item;
        }
    }

    protected function getDocument(): Document
    {
        return new Document();
    }

    protected function getAttachment(): Attachment
    {
        return new Attachment();
    }
}