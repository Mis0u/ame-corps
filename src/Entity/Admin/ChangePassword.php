<?php

namespace App\Entity\Admin;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;


class ChangePassword
{
    /**
     * @SecurityAssert\UserPassword(
     *     message = "L'ancien mot de passe n'est pas le bon "
     * )
     */
    protected $oldPassword;


    public function getOldPassword()
    {
        return $this->oldPassword;
    }

    public function setOldPassword($oldPassword)
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }
}
