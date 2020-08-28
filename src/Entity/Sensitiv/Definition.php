<?php

namespace App\Entity\Sensitiv;

use App\Entity\Helper\SimpleArticleTrait;
use App\Repository\DefinitionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DefinitionRepository::class)
 */
class Definition
{
    use SimpleArticleTrait;
}
