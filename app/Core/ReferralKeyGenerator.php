<?php
namespace App\Core;

use Symfony\Component\HttpFoundation\ParameterBag;

class ReferralKeyGenerator
{
    public function generateKey(ParameterBag $referralData)
    {
        $time = time();
        $str = "[$time]r={$referralData->get('referrer-id')}&p={$referralData->get('parent-id')}";
        return md5(uniqid($str, true));
    }
}