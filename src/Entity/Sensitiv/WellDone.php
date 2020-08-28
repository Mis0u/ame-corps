<?php

namespace App\Entity\Sensitiv;

use App\Repository\WellDoneRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Helper\SimpleArticleTrait;


/**
 * @ORM\Entity(repositoryClass=WellDoneRepository::class)
 */
class WellDone
{
    use SimpleArticleTrait;
}
