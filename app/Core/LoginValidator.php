<?php
namespace App\Core;

use Illuminate\Http\Request;

class LoginValidator
{
    private $params = ['email', 'password'];

    public function validate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    }
}