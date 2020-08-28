<?php

namespace App\Entity\Actuality;

use App\Repository\ActualityCommentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=ActualityCommentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class ActualityComment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "L'email ne peut pas être vide")
     * @Assert\Email(message = "L'email {{ value }} n'est pas au bon format")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Le nom ne peut pas être vide")
     * @Assert\Length( 
     *  min = 2,
     *  minMessage = "Au minimum {{ limit }} lettres"
     * )
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=Actuality::class, inversedBy="actualityComments")
     * @ORM\JoinColumn()
     */
    private $actuality;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message = "Le commentaire ne peut pas être vide")
     */
    private $content;

    /**
     *@ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getActuality(): ?Actuality
    {
        return $this->actuality;
    }

    public function setActuality(?Actuality $actuality): self
    {
        $this->actuality = $actuality;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
