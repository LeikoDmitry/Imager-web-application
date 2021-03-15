<?php

namespace App\Message;

class UploadFileMessage
{
    private array $context;

    public function __construct(array $context = [])
    {
        $this->context = $context;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function setContext(array $context): void
    {
        $this->context = $context;
    }
}
