<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use App\Entity\Helper\SimpleArticleTrait;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    use SimpleArticleTrait;
}
