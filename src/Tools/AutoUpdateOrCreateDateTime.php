<?php

namespace App\Tools;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait AutoUpdateOrCreateDateTime
{
    /**
     * Gets triggered only on insert.
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new DateTime('now');
        $this->updateAt = new DateTime('now');
    }

    /**
     * Gets triggered every time on update.
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updateAt = new DateTime('now');
    }
}