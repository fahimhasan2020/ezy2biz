<?php
namespace App\Core;

use Symfony\Component\HttpFoundation\ParameterBag;

class LoginValidator
{
    private $params = ['email', 'password'];

    public function validate(ParameterBag $request)
    {
        return true;
    }
}