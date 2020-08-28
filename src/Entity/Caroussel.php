<?php

namespace App\Entity;

use App\Repository\CarousselRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CarousselRepository::class)
 * @Vich\Uploadable
 */
class Caroussel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image;

    /**
     * @Vich\UploadableField(mapping="caroussel_uploads", fileNameProperty="image")
     * @Assert\File(
     *  maxSize = "500K",
     *  maxSizeMessage = "L'image est trop lourde, Ne pas dépasser {{ limit }} {{ suffix }}",
     *  mimeTypes = {"image/png","image/jpg","image/jpeg"},
     *  mimeTypesMessage = "Le format {{ type }} n'est pas pris en compte, veuillez uploadez ces types d'image {{ types }}"
     * )
     * @Assert\NotBlank( message = "Une image doit être fourni")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

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
}
