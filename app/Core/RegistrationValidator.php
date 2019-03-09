<?php
namespace App\Core;

use Symfony\Component\HttpFoundation\ParameterBag;

class RegistrationValidator
{
    private $params = ['email', 'password', 'confirm-password', 'first-name',
        'last-name', 'phone', 'address', 'email', 'password', 'parent-id',
        'referrer-id'];

    public function validate(ParameterBag $userData)
    {
        if (!($userData->get('password') === $userData->get('confirm-password'))) {
            return false;
        }

        return true;
    }
}