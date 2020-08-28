<?php

namespace App\Controller\Admin\Crud\Helper;

use App\Controller\Admin\Crud\Services\ConfigureCrud;

trait CrudConstructorTrait
{
    private $configureCrud;

    public function __construct(ConfigureCrud $configureCrud)
    {
        $this->configureCrud = $configureCrud;
    }
}
