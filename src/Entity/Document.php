<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DocumentRepository;
use App\Tools\AutoUpdateOrCreateDateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTimeInterface;

/**
 * @ApiResource()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document
{
    use AutoUpdateOrCreateDateTime;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Assert\Length(
     *     min = 2,
     *     max = 50
     * )
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $name;

    /**
     * @Assert\Length(
     *     min = 2,
     *     max = 50
     * )
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $slug;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTimeInterface $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private DateTimeInterface $updateAt;

    /**
     * @ORM\OneToOne(targetEntity=Attachment::class, inversedBy="document", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $attacment;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdateAt(): ?DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getAttachment(): ?Attachment
    {
        return $this->attacment;
    }

    public function setAttachment(Attachment $attacment): self
    {
        $this->attacment = $attacment;

        return $this;
    }
}
