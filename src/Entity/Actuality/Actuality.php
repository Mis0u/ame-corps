<?php

namespace App\Entity\Actuality;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Helper\SimpleArticleTrait;
use App\Repository\ActualityRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * @ORM\Entity(repositoryClass=ActualityRepository::class)
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("title", message="Ce titre existe déja")
 */
class Actuality
{
    use SimpleArticleTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="actuality_uploads", fileNameProperty="image")
     * @Assert\File(
     *  maxSize = "500K",
     *  maxSizeMessage = "L'image est trop lourde, Ne pas dépasser {{ limit }} {{ suffix }}",
     *  mimeTypes = {"image/png","image/jpg","image/jpeg"},
     *  mimeTypesMessage = "Le format {{ type }} n'est pas pris en compte, veuillez uploadez ces types d'image {{ types }}"
     * )
     * @Assert\NotBlank(
     *  groups={"new"},
     *  message = "Une image doit être fourni"
     * )
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\OneToMany(targetEntity=ActualityComment::class, mappedBy="actuality", orphanRemoval=true, cascade={"remove", "persist"})
     */
    private $actualityComments;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->actualityComments = new ArrayCollection();
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setSlugValue()
    {
        $slugify = new Slugify();
        $this->slug = $slugify->slugify($this->title);
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTimeImmutable('now');
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|ActualityComment[]
     */
    public function getActualityComments(): Collection
    {
        return $this->actualityComments;
    }

    public function addActualityComment(ActualityComment $actualityComment): self
    {
        if (!$this->actualityComments->contains($actualityComment)) {
            $this->actualityComments[] = $actualityComment;
            $actualityComment->setActuality($this);
        }

        return $this;
    }

    public function removeActualityComment(ActualityComment $actualityComment): self
    {
        if ($this->actualityComments->contains($actualityComment)) {
            $this->actualityComments->removeElement($actualityComment);
            // set the owning side to null (unless already changed)
            if ($actualityComment->getActuality() === $this) {
                $actualityComment->setActuality(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        if (strlen($this->title) > 20) {
            return substr($this->title, 0, 20) . '...';
        }
        return $this->title;
    }


    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @param  File  $imageFile
     *
     * @return  self
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
