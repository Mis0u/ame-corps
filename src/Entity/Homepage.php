<?php

namespace App\Entity;

use App\Repository\HomepageRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Helper\SimpleArticleTrait;


/**
 * @ORM\Entity(repositoryClass=HomepageRepository::class)
 */
class Homepage
{
    use SimpleArticleTrait;
}
