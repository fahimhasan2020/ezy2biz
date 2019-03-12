<?php
namespace App\Core;

use Symfony\Component\HttpFoundation\ParameterBag;

class ProductValidator
{
    private $params = ['name', 'description', 'sale-price', 'wholesale-price', 'commission', 'image'];

    public function validate(ParameterBag $productData)
    {
        return true;
    }
}