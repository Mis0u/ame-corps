<?php

namespace App\Entity;

use App\Repository\EthicRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Helper\SimpleArticleTrait;


/**
 * @ORM\Entity(repositoryClass=EthicRepository::class)
 */
class Ethic
{
    use SimpleArticleTrait;
}
