<?php

namespace App\Entity;

use App\Repository\PriceRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Helper\SimpleArticleTrait;


/**
 * @ORM\Entity(repositoryClass=PriceRepository::class)
 */
class Price
{
    use SimpleArticleTrait;
}
