<?php

namespace App\Entity\Sensitiv;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Helper\SimpleArticleTrait;
use App\Repository\OperationRepository;

/**
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 */
class Operation
{
    use SimpleArticleTrait;
}
