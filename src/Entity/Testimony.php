<?php

namespace App\Entity;

use App\Repository\TestimonyRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TestimonyRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Testimony
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank( message = "Le nom doit être renseigné")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(message = "L'email {{ value }} n'est pas au bon format")
     * @Assert\NotBlank(message = "L'email ne peut pas être vide")
     */
    private $email;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank( message = "Le contenu ne peut être vide")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setCreateAt()
    {
        $this->createdAt = new \DateTimeImmutable('now');
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
