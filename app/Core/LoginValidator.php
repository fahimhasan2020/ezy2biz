<?php
namespace App\Core;

use Illuminate\Http\Request;

class LoginValidator
{
    private $params = ['email', 'password'];

    public function validate(Request $request)
    {
        return true;
    }
}